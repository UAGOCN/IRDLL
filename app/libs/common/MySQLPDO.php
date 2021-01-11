<?php
namespace app\libs\common;

class MySQLPDO extends Common {

    /**
     * 静态属性,所有数据库实例共用,避免重复连接数据库
     */
    protected static $_dbh = null;

    /**
     * 数据库是否使用长连接
     */
    protected $_pconnect = true;

    /**
     * 最后一条sql语句
     */
    protected $_sql = false;

    /**
     * 初始化 WHERE 默认值
     */
    protected $_where = '';

    /**
     * 初始化 JOIN 默认值
     */
    protected $_join = '';

    /**
     * 初始化 ORDER 默认值
     */
    protected $_order = '';

    /**
     * 初始化 LIMIT 默认值
     */
    protected $_limit = '';

    /**
     * 初始化 FIELD 默认值
     */
    protected $_field = '*';

    /**
     * 状态，0表示查询条件干净，1表示查询条件污染
     */
    protected $_clear = 0;

    /**
     * 事务指令数
     */
    protected $_trans = 0;

    /**
     * 初始化类
     * @param array $conf 数据库配置
     */
    public function __construct($dbhost = null, $dbuser = null, $dbpass = null, $dbname = null, $dbcharset = null, $dbport = null, $dbprefix = null) {
        class_exists('PDO') or die('PDO: class not exists.');
        $this->_host = trim($dbhost);
        $this->_port = trim($dbport);
        $this->_user = trim($dbuser);
        $this->_pass = trim($dbpass);
        $this->_dbName = trim($dbname);
        $this->_prefix = trim($dbprefix);
        $this->_charset = trim($dbcharset);
        //连接数据库
        if (is_null(self::$_dbh)) {
            $this->_connect();
        }
    }

    /**
     * 连接数据库的方法
     */
    protected function _connect() {
        $dsn = 'mysql:host=' . $this->_host . ';port=' . $this->_port . ';dbname=' . $this->_dbName;
        //持久化连接
        $options = $this->_pconnect ? array(\PDO::ATTR_PERSISTENT => true) : array();
        try {
            $dbh = new \PDO($dsn, $this->_user, $this->_pass, $options);
            $dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION); // 设置如果sql语句执行错误则抛出异常，事务会自动回滚
            $dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false); // 禁用prepared statements的仿真效果(防SQL注入)
        }
        catch(\PDOException $e) {
            die('Connection failed: ' . $e->getMessage());
        }
        $dbh->exec('SET NAMES '.$this->_charset);
        self::$_dbh = $dbh;
        $dsn = $this->_user = $this->_pass = $this->_charset = null;
    }

    /**
     * 防止克隆
     */
    private function __clone() {
        $this->_host = null;
        $this->_port = null;
        $this->_user = null;
        $this->_pass = null;
        $this->_dbName = null;
        $this->_prefix = null;
        $this->_charset = null;
        self::$_dbh = null;
    }

    /**
     * 字段和表名添加 `符号
     * 保证指令中使用关键字不出错 针对mysql
     * @param string $value
     * @return string
     */
    protected function _addChar($value) {
        if ('*' == $value || false !== strpos($value, '(') || false !== strpos($value, '.') || false !== strpos($value, '`')) {
            //如果包含* 或者 使用了sql方法 则不作处理
        } elseif (false === strpos($value, '`')) {
            $value = '`' . trim($value) . '`';
        }
        return $value;
    }

    /**
     * 取得数据表的字段信息
     * @param string $tbName 表名
     * @return array
     */
    protected function _tbFields($tbName) {
        $sql = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME="' . $tbName . '" AND TABLE_SCHEMA="' . $this->_dbName . '"';
        $stmt = self::$_dbh->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $stmt->PDOStatement = null;
        $ret = array();
        foreach ($result as $key => $value) {
            $ret[$value['COLUMN_NAME']] = 1;
        }
        return $ret;
    }

    /**
     * 过滤并格式化数据表字段
     * @param string $tbName 数据表名
     * @param array $data POST提交数据
     * @return array $newdata
     */
    protected function _dataFormat($tbName, $data) {
        if (!is_array($data)) { return array(); }
        $table_column = $this->_tbFields($tbName);
        $ret = array();
        foreach ($data as $key => $val) {
            if (!is_scalar($val)) { continue; } //值不是标量则跳过
            if (array_key_exists($key, $table_column)) {
                $key = $this->_addChar($key);
                if (is_int($val)) {
                    $val = intval($val);
                } elseif (is_float($val)) {
                    $val = floatval($val);
                } elseif (preg_match('/^\(\w*(\+|\-|\*|\/)?\w*\)$/i', $val)) {
                    // 支持在字段的值里面直接使用其它字段 ,例如 (score+1) (name) 必须包含括号
                    $val = $val;
                } elseif (is_string($val)) {
                    //将字符串中的单引号（'）、双引号（"）、反斜线（\）与 NUL（NULL 字符转义
                    $val = '"' . addslashes($val) . '"';
                }
                $ret[$key] = $val;
            }
        }
        return $ret;
    }

    /**
     * 执行查询 主要针对 SELECT, SHOW 等指令
     * @param string $sql sql指令
     * @return mixed
     */
    protected function _doQuery($sql = '') {
        $this->_sql = $sql;
        $pdostmt = self::$_dbh->prepare($this->_sql); //prepare或者query 返回一个PDOStatement
        $pdostmt->execute();
        $result = $pdostmt->fetchAll(\PDO::FETCH_ASSOC);
        $pdostmt->PDOStatement = null;
        return $result;
    }

    /**
     * 执行语句 针对 INSERT, UPDATE 以及DELETE,exec结果返回受影响的行数
     * @param string $sql sql指令
     * @return integer
     */
    protected function _doExec($sql = '') {
        $this->_sql = $sql;
        return self::$_dbh->exec($this->_sql);
    }

    /**
     * 执行sql语句，自动判断进行查询或者执行操作
     * @param string $sql SQL指令
     * @return mixed
     */
    public function doSql($sql = '') {
        $queryIps = 'INSERT|UPDATE|DELETE|REPLACE|CREATE|DROP|LOAD DATA|SELECT .* INTO|COPY|ALTER|GRANT|REVOKE|LOCK|UNLOCK';
        if (preg_match('/^\s*"?(' . $queryIps . ')\s+/i', $sql)) {
            return $this->_doExec($sql);
        } else {
            //查询操作
            return $this->_doQuery($sql);
        }
    }

    /**
     * 获取最近一次查询的sql语句
     * @return String 执行的SQL
     */
    public function getLastSql() {
        return $this->_sql;
    }

    /**
     * 插入方法
     * @param string $tbName 操作的数据表名
     * @param array $data 字段-值的一维数组
     * @return int 受影响的行数
     */
    public function insert($tbName, array $data) {
        $data = $this->_dataFormat(trim($this->_prefix).trim($tbName), $data);
        if (!$data) { return; }
        $sql = 'INSERT INTO ' . trim($this->_prefix).trim($tbName) . '(' . implode(',', array_keys($data)) . ') VALUES(' . implode(',', array_values($data)) . ')';
        return $this->_doExec($sql);
    }

    /**
     * 删除方法
     * @param string $tbName 操作的数据表名
     * @return int 受影响的行数
     */
    public function delete($tbName) {
        //安全考虑,阻止全表删除
        if (!trim($this->_where)) { return false; }
        $sql = 'DELETE FROM ' . trim($this->_prefix).trim($tbName) . ' ' . $this->_where;
        $this->_clear = 1;
        $this->_clear();
        return $this->_doExec($sql);
    }

    /**
     * 更新函数
     * @param string $tbName 操作的数据表名
     * @param array $data 参数数组
     * @return int 受影响的行数
     */
    public function update($tbName, array $data) {
        //安全考虑,阻止全表更新
        if (!trim($this->_where)) { return false; }
        $data = $this->_dataFormat(trim($this->_prefix).trim($tbName), $data);
        if (!$data) { return; }
        $valArr = array();
        foreach ($data as $k => $v) {
            $valArr[] = $k . '=' . $v;
        }
        $valStr = implode(',', $valArr);
        $sql = 'UPDATE ' . trim($this->_prefix).trim($tbName) . ' SET ' . trim($valStr) . ' ' . trim($this->_where);
        return $this->_doExec($sql);
    }

    /**
     * 查询函数
     * @param string $tbName 操作的数据表名
     * @return array 结果集
     */
    public function select($tbName = '') {
        $sql = 'SELECT ' . trim($this->_field) . ' FROM ' . trim($this->_prefix).trim($tbName) .' AS '. trim($tbName) . ' ' . trim($this->_join) . ' ' . trim($this->_where) . ' ' . trim($this->_order) . ' ' . trim($this->_limit);
        $this->_clear = 1;
        $this->_clear();
        return $this->_doQuery(trim($sql));
    }

    /**
     * 查询SQL组装 join
     * INNER JOIN（内连接,或等值连接）：获取两个表中字段匹配关系的记录。
     * LEFT JOIN（左连接）：获取左表所有记录，即使右表没有对应匹配的记录。
     * RIGHT JOIN（右连接）： 与 LEFT JOIN 相反，用于获取右表所有记录，即使左表没有对应匹配的记录。
     * @param  mixed $option 关联的表名的二维数组 例：$option = array('type', 'table', array('a', '=', 'b'));
     * @return $this
     */
    public function join($option) {
        if ($this->_clear > 0) {
            $this->_clear();
        }
        $this->_join = '';
        $conditionis = '';
        if (!empty($option)&&is_array($option)) {
            if(is_array($option[0])) {
                foreach ($option as $k => $v) {
                    if (is_array($v[2][0])) {
                        foreach ($v[2] as $l => $i) {
                            $condition = $i[0] . $i[1] . $i[2];
                            $logic = ' AND ';
                            $conditionis.= isset($mark) ? $logic . $condition : $condition;
                            $mark = 1;
                        }
                    } else {
                        $conditionis = $v[2][0] . $v[2][1] . $v[2][2];
                    }
                    $this->_join .= ' ' . strtoupper($v[0]) . ' JOIN ' . trim($this->_prefix).trim($v[1]) .' AS '.trim($v[1]) . ' ON ' . $conditionis . ' ';
                }
            } else {
                if (is_array($option[2][0])) {
                    foreach ($option[2] as $k => $v) {
                        $condition = $v[0] . $v[1] . $v[2];
                        $logic = ' AND ';
                        $conditionis.= isset($mark) ? $logic . $condition : $condition;
                        $mark = 1;
                    }
                } else {
                    $conditionis = $option[2][0] . $option[2][1] . $option[2][2];
                }
                $this->_join .= ' ' . strtoupper($option[0]) . ' JOIN ' . trim($this->_prefix).trim($option[1]) .' AS '.trim($option[1]) . ' ON ' . $conditionis . ' ';
            }
        }
        return $this;
    }

    /**
     * @param mixed $option 组合条件的二维数组，例：$option['field1'] = array(1,'=>','or')
     * @return $this
     */
    public function where($option) {
        if ($this->_clear > 0) {
            $this->_clear();
        }
        $this->_where = ' WHERE ';
        $logic = 'AND';
        if (is_string($option)) {
            $this->_where.= $option;
        } elseif (is_array($option)) {
            foreach ($option as $k => $v) {
                if (is_array($v)) {
                    $relative = isset($v[1]) ? $v[1] : '=';
                    $logic = isset($v[2]) ? $v[2] : 'AND';
                    $condition = ' (' . $this->_addChar($k) . ' ' . $relative . ' \'' . $v[0] . '\') ';
                } else {
                    $logic = 'AND';
                    $condition = ' (' . $this->_addChar($k) . '=\'' . $v . '\') ';
                }
                $this->_where.= isset($mark) ? $logic . $condition : $condition;
                $mark = 1;
            }
        }
        return $this;
    }

    /**
     * 设置排序
     * @param mixed $option 排序条件数组 例:array('sort'=>'desc')
     * @return $this
     */
    public function order($option) {
        if ($this->_clear > 0) {
            $this->_clear();
        }
        $this->_order = ' ORDER BY ';
        if (is_string($option)) {
            $this->_order.= $option;
        } elseif (is_array($option)) {
            foreach ($option as $k => $v) {
                $order = $this->_addChar($k) . ' ' . $v;
                $this->_order.= isset($mark) ? ',' . $order : $order;
                $mark = 1;
            }
        }
        return $this;
    }

    /**
     * 设置查询行数及页数
     * @param int $page pageSize不为空时为页数，否则为行数
     * @param int $pageSize 为空则函数设定取出行数，不为空则设定取出行数及页数
     * @return $this
     */
    public function limit($page, $pageSize = null) {
        if ($this->_clear > 0) {
            $this->_clear();
        }
        if ($pageSize === null) {
            $this->_limit = 'LIMIT ' . $page;
        } else {
            $pageval = intval(($page - 1) * $pageSize);
            $this->_limit = 'LIMIT ' . $pageval . ',' . $pageSize;
        }
        return $this;
    }

    /**
     * 设置查询字段
     * @param mixed $field 字段数组
     * @return $this
     */
    public function field($field) {
        if ($this->_clear > 0) {
            $this->_clear();
        }
        if (is_string($field)) {
            $field = explode(',', $field);
        }
        $nField = array_map(array($this, '_addChar'), $field);
        $this->_field = implode(',', $nField);
        return $this;
    }

    /**
     * 清理标记函数
     */
    protected function _clear() {
        $this->_where = '';
        $this->_join = '';
        $this->_order = '';
        $this->_limit = '';
        $this->_field = '*';
        $this->_clear = 0;
    }

    /**
     * 手动清理标记
     * @return $this
     */
    public function clearKey() {
        $this->_clear();
        return $this;
    }

    /**
     * 启动事务
     * @return void
     */
    public function startTrans() {
        //数据rollback 支持
        if ($this->_trans == 0) {
            self::$_dbh->beginTransaction();
        }
        $this->_trans++;
        return;
    }

    /**
     * 用于非自动提交状态下面的查询提交
     * @return boolen
     */
    public function commit() {
        $result = true;
        if ($this->_trans > 0) {
            $result = self::$_dbh->commit();
            $this->_trans = 0;
        }
        return $result;
    }

    /**
     * 事务回滚
     * @return boolen
     */
    public function rollback() {
        $result = true;
        if ($this->_trans > 0) {
            $result = self::$_dbh->rollback();
            $this->_trans = 0;
        }
        return $result;
    }

    /**
     * 关闭连接
     * PHP 在脚本结束时会自动关闭连接
     */
    public function close() {
        if (!is_null(self::$_dbh)) { self::$_dbh = null; }
    }

    public function __destruct() {
        $this->close();
    }
}
