<?php 
namespace app\libs\common;

use app;

class Common extends app\Engine {

    // 私有获取数据
    private function getDatas() {
        $config = $this->get('web.config');
        return $config;
    }

    // 网站名称
    public function getTitle() {
        return trim($this->getDatas()['title']);
    }

    // SESSION时间
    public function getTimeOut() {
        return trim(ceil($this->getDatas()['timeout'])*1000);
    }

    // 访问协议
    public function getSecure() {
        return trim($this->request()->scheme);
    }

    // SESSION Name ID
    public function getSessionName(){
        return trim($this->getDatas()['sess.name']);
    }

    // 作用域
    public function getDomain() {
        return trim($this->getDatas()['sess.domain']);
    }

    // Token
    public function getToken($srt = null) {
        if(!empty($srt)||empty($this->sess()->getSession('token'))||$this->msectime()>unserialize($this->sess()->getSession('token'))[3]) {
            $getToken = $this->getTokenID('GET');
            $postToken = $this->getTokenID('POST');
            $token = md5($getToken.uniqid().$this->msectime().$postToken);
            $this->sess()->setSession('token',serialize(array($token, $getToken, $postToken,$this->msectime()+$this->fun()->getTimeOut())));
            return $token;
        } else {
            $token = unserialize($this->sess()->getSession('token'))[0];
            return $token;
        }
    }

    // GET|POST MD5
    public function getTokenID($srt) {
        return md5(md5($srt).md5($this->request()->url).md5($this->request()->scheme).md5($this->request()->user_agent).md5($this->request()->cookies[$this->fun()->getSessionName()]).md5($this->request()->accept).unserialize($this->sess()->getSession('key'))[0]);
    }

    // RSA 第三次公共证书
    public function getKey($name = 'public') {
        return trim(preg_replace('/[\r\n]/', '',$this->getDatas()[$name.'.third']));
    }

    // RSA 加密, 解密, 签名, 验签 返回JSON
    public function getRSA($id = 're', $data, $sign = false, $third = false) {
        $this->loader->register('getRsaSrt', 'app\libs\common\ModeRsa',array(
            $this->getDatas()['public.third'],
            $this->getDatas()['private'],
            (empty($third)?$this->getKey():$this->getKey($third)),
        ));
        $srt = $this->getRsaSrt();
        switch ($id) {
            case 're':
                return $srt->privEncrypt($data); // 私钥加密
                break;
            case 'ud':
                return $srt->publicDecrypt($data); // 公钥解密
                break;
            case 'ue':
                return $srt->publicEncrypt($data); // 公钥加密
                break;
            case 'rd':
                return $srt->privDecrypt($data); // 私钥解密
                break;
            case 'rs':
                return $srt->privSign($data); // 私钥签名
                break;
            case 'uv':
                return $srt->publicVerifySign($data, $sign); // 公钥验证
                break;
            case 'tv':
                return $srt->publicVerifySignThird($data, $sign); // 第三方公钥验证
                break;
            default:
                return 'RSA Error: Data not';
        }
    }

    // 设置数据库链接
    public function getDB($name = 'db') {
        if (!isset(self::$dbsInstances[$name])) {
            $this->loader->register('getDbPdo', 'app\libs\common\MySQLPDO',array (
                $this->getDatas()[$name.'.host'],    // 数据库主机地址 默认='127.0.0.1'
                $this->getDatas()[$name.'.user'],    // 数据库用户名
                $this->getDatas()[$name.'.pass'],    // 数据库密码
                $this->getDatas()[$name.'.name'],    // 数据库名称
                $this->getDatas()[$name.'.charset'], // 数据库编码 默认=utf8
                $this->getDatas()[$name.'.port'],    // 数据库端口 默认=3306
                $this->getDatas()[$name.'.prefix'],  // 数据库表前缀
            ));
            try {
                $dbs = $this->getDbPdo();
                if (!$dbs) {
                    throw new \Exception();
                }
                self::$dbsInstances[$name] = $dbs;
            } catch (\Exception $e) {
                die(json_encode(array('code'=>500, 'msg'=>'Mysqli数据库连接失败', 'data'=>false), JSON_UNESCAPED_UNICODE));
            }
        }
        return self::$dbsInstances[$name];
    }

    // 获取运行毫秒
    public function msectime() {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }
}
