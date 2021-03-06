<?php
namespace app\libs\backend;

use Api;

class IndexController extends BaseController{

    /**
     * 首页
     * @param  [type] $cid  [description]
     * @param  [type] $page [description]
     * @return [type]       [description]
     */
    public static function index() {
        parent::__checkManagePrivate();

        //插入
        //$data = array('user_name'=>'tongji','user_pwd'=>'d6ceebf494d774931e92e45f834d490f','user_md5'=>'21232f297a57a5a743894a0e4a801fc3','user_lock'=>'d6ceebf494d774931e92e45f834d490f','user_email'=>'10010@qq.com','user_ip'=>'127.0.0.1','user_logintime'=>1311954804);
        //$dbData = Api::fun()->getDB()->insert('user',$data);

        //SELECT JOIN 用法说明
        //$option = array('user.user_name','=','admin.admin_name');
        //$dbData = Api::fun()->getDB()
        //->field('user.user_id,admin.admin_id')
        //->join(array('LEFT','admin',$option))
        //->where(array('user_name'=>'admin','admin_ip'=>'127.0.0.1'))
        //->order('user_id desc,user_logintime asc')
        //->limit(1,2)
        //->select('user');

        //SQL:: SELECT user.user_id,admin.admin_id FROM info_user AS user LEFT JOIN info_admin AS admin ON user.user_name=admin.admin_name WHERE (`user_name`='admin') AND (`admin_ip`='127.0.0.1') ORDER BY user_id desc,user_logintime asc LIMIT 0,2 

        //UPDATE JOIN 用法说明
        //$option = array('user.user_name','=','admin.admin_name');
        //$dbData = Api::fun()->getDB()
        //->join(array('LEFT','admin',$option))
        //->where(array('user_name'=>'admin'))
        //->update('user',array('user_email'=>'100000@qq.com','user_ip'=>'127.0.0.1',array('admin',array('admin_email'=>'100000@qq.com','admin_ip'=>'127.0.0.1'))));

        //SQL:: UPDATE info_user AS user LEFT JOIN info_admin AS admin ON user.user_name=admin.admin_name SET `user_email`="admin@qq.com",`user_ip`="127.0.0.1",`admin_email`="admin@qq.com",`admin_ip`="127.0.0.1" WHERE (`user_name`='admin') 

        //DELETE JOIN 用法说明
        //$option = array('user.user_name','=','admin.admin_name');
        //$dbData = Api::fun()->getDB()
        //->field('user,admin')
        //->join(array('LEFT','admin',$option))
        //->where(array('user_name'=>'admin','admin_name'=>'admin'))
        //->delete('user');

        //SQL:: DELETE `user`,`admin` FROM info_user AS user LEFT JOIN info_admin AS admin ON user.user_name=admin.admin_name WHERE (`user_name`='admin') AND (`admin_name`='admin') 

        //INNER JOIN 关键字在表中存在至少一个匹配时返回行。
        //LEFT JOIN 关键字从左表（table1）返回所有的行，即使右表（table2）中没有匹配。如果右表中没有匹配，则结果为 NULL。
        //RIGHT JOIN 关键字从右表（table2）返回所有的行，即使左表（table1）中没有匹配。如果左表中没有匹配，则结果为 NULL。
        //FULL OUTER JOIN 关键字只要左表（table1）和右表（table2）其中一个表中存在匹配，则返回行。FULL OUTER JOIN 关键字结合了 LEFT JOIN 和 RIGHT JOIN 的结果。

        //SELECT 用法说明
        //$dbData = Api::fun()->getDB()
        //->field(array('sid','aa','bbc'))
        //->order(array('sid'=>'desc','aa'=>'asc'))
        //->where(array('sid'=>"101",'aa'=>array('123455','>','or')))
        //->limit(1,2)
        //->select('t_table');

        //上语句等同下语句

        //$dbData = Api::fun()->getDB()
        //->field('sid,aa,bbc')
        //->order('sid desc,aa asc')
        //->where('sid=101 or aa>123455')
        //->limit(1,2)
        //->select('t_table');

        //$option = array('user_name'=>'admin');
        //$dbData = Api::fun()->getDB()
        //->field('user_id,user_name,user_logintime')
        //->order('user_id desc,user_logintime asc')
        //->where($option)
        //->limit(1,2)
        //->select('user');

        //获取最后执行的sql语句
        //$dbData = Api::fun()->getDB()->getLastSql();

        //直接执行sql语句
        //$option = "show tables";
        //$dbData = Api::fun()->getDB()->doSql($sql);

        //事务
        //$dbData = Api::fun()->getDB()->startTrans();
        //$dbData = Api::fun()->getDB()->where(array('user_name'=>'user'))->update('user',array('user_face'=>'测试一下'));
        //$dbData = Api::fun()->getDB()->where(array('user_name'=>'tongji'))->delete('user');
        //$dbData = Api::fun()->getDB()->commit();

        Api::render('admin/index', array('title' => '管理后台-'.Api::fun()->getTitle(), 'site_url' => Api::fun()->getSiteURL()));

    }

    // 会员登陆
    public static function login() {
        if(Api::request()->method==='GET') {
            $token = Api::fun()->getToken(1);
        }
        if(Api::request()->method==='POST') {
            $toke = unserialize(Api::sess()->getSession('token'));
            if(Api::fun()->msectime()>$toke[3]) {
                header('Location: /login');
                exit();
            }
            if(isset(Api::request()->data['__hash__'])&&md5($toke[0])===md5(Api::request()->data['__hash__'])&&$toke[1]===(Api::fun()->getTokenID('GET'))&&$toke[2]===(Api::fun()->getTokenID('POST'))) {
                Api::sess()->delSession('token');

                $proxy_ip = Api::fun()->getSrt('ip',Api::request()->proxy_ip);
                if(!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::fun()->getRSA('rd',Api::request()->data['nloginpwd']));
                if(md5(substr($loginpwd,-32))!=md5($toke[0])){
                    header('Location: /login');
                    exit();
                }

                $inUser = Api::fun()->getSrt('user',trim(Api::request()->data['loginname']));
                $nloginpwd = md5(substr($loginpwd,0,-32));

                $option = array('user_md5'=>md5($inUser));
                $dbData = Api::fun()->getDB()->field('user_id,user_name,user_pwd,user_lock,user_session,user_del')->where($option)->limit(1)->select('user');

                if(!empty($dbData[0])&&Api::request()->data['loginname']===trim($dbData[0]['user_name'])&&$nloginpwd===trim($dbData[0]['user_pwd'])&&trim($dbData[0]['user_del'])==='0') {
                    if($dbData[0]['user_session']!=md5('000000')) {
                        Api::fun()->getDB()->where(array('user_id'=>$dbData[0]['user_id']))->update('user',array('user_session'=>md5(Api::request()->cookies[Api::fun()->getSessionName()]),'user_ip'=>trim(Api::fun()->getSrt('ip',Api::request()->ip)),'user_logintime'=>time()));
                    }
                    Api::sess()->setSession('user',serialize(array($dbData[0]['user_id'],$dbData[0]['user_name'],md5(Api::request()->cookies[Api::fun()->getSessionName()]))));
                    header('Location: /admin-index');
                    exit();
                } else {
                    header('Location: /login');
                    exit();
                }
            } else {
                header('Location: /login');
                exit();
            }
        }
        Api::render('admin/login', array('pubKey' => base64_encode(Api::fun()->getKey('public')), 'token' => $token, 'site_url' => Api::fun()->getSiteURL(), 'title' => '会员登录-'.Api::fun()->getTitle()));
    }

    // 会员找回密码
    public static function forgot_password() {
        if(Api::request()->method==='GET') {
            $token = Api::fun()->getToken(1);

            // 重置密码
            if(!empty(Api::request()->query['email'])&&Api::request()->query['toKCode']) {
                $inEmail = Api::fun()->getSrt('email',trim(Api::request()->query['email']));
                $toKCode = Api::fun()->getSrt('toKCode',trim(Api::request()->query['toKCode']));
                if(empty($inEmail)||empty($toKCode)) {
                    header('Location: /forgot-password');
                    exit();
                }
                Api::render('admin/reset-password', array('pubKey' => base64_encode(Api::fun()->getKey('public')), 'toKCode' => $toKCode, 'inEmail' => $inEmail, 'token' => $token, 'site_url' => Api::fun()->getSiteURL(), 'title' => '重置密码-'.Api::fun()->getTitle()));
                exit();
            }
        }
        if(Api::request()->method==='POST') {
            $toke = unserialize(Api::sess()->getSession('token'));
            if(Api::fun()->msectime()>$toke[3]) {
                header('Location: /forgot-password');
                exit();
            }
            if(isset(Api::request()->data['__hash__'])&&md5($toke[0])===md5(Api::request()->data['__hash__'])&&$toke[1]===(Api::fun()->getTokenID('GET'))&&$toke[2]===(Api::fun()->getTokenID('POST'))) {
                Api::sess()->delSession('token');

                // 重置密码
                if(!empty(Api::request()->query['email'])&&Api::request()->query['toKCode']) {
                    $inEmail = Api::fun()->getSrt('email',trim(Api::request()->query['email']));
                    $toKCode = Api::fun()->getSrt('toKCode',trim(Api::request()->query['toKCode']));
                    if(empty($inEmail)||empty($toKCode)) {
                        header('Location: /forgot-password');
                        exit();
                    }
                    $loginpwd = trim(Api::fun()->getRSA('rd',Api::request()->data['nloginpwd']));
                    if(md5(substr($loginpwd,-32))!=md5($toke[0])){
                        header('Location: /forgot-password');
                        exit();
                    }
                    $loginpwd = Api::fun()->getSrt('passwd',trim(substr($loginpwd,0,-32)));
                    if(empty($loginpwd)){
                        header('Location: /forgot-password');
                        exit();
                    }
                    $dbData = Api::fun()->getDB()->field('user_id,user_name,user_session,user_del,user_logintime')->where(array('user_email'=>$inEmail))->limit(1)->select('user');
                    if(!empty($dbData[0])&&trim($dbData[0]['user_session'])===$toKCode&&trim($dbData[0]['user_del'])==='2'&&(trim($dbData[0]['user_logintime'])+86400)>time()) {
                        Api::fun()->getDB()->where(array('user_id'=>$dbData[0]['user_id']))->update('user',array('user_pwd'=>md5($loginpwd),'user_lock'=>md5($loginpwd),'user_session'=>md5(Api::request()->cookies[Api::fun()->getSessionName()]),'user_del'=>0,'user_ip'=>trim(Api::fun()->getSrt('ip',Api::request()->ip)),'user_logintime'=>time()));
                        Api::sess()->setSession('user',serialize(array(trim($dbData[0]['user_id']),trim($dbData[0]['user_name']),md5(Api::request()->cookies[Api::fun()->getSessionName()]))));
                        header('Location: /admin-index');
                        exit();
                    } else {
                        header('Location: /forgot-password');
                        exit();
                    }
                }

                // 找回密码
                $inEmail = trim(Api::fun()->getRSA('rd',Api::request()->data['loginmail']));
                if(md5(substr($inEmail,-32))!=md5($toke[0])){
                    header('Location: /forgot-password');
                    exit();
                }
                $inEmail = Api::fun()->getSrt('email',trim(substr($inEmail,0,-32)));
                if(empty($inEmail)){
                    header('Location: /forgot-password');
                    exit();
                }
                $dbData = Api::fun()->getDB()->field('user_id,user_name,user_del')->where(array('user_email'=>$inEmail))->limit(1)->select('user');
                if(!empty($dbData[0]&&(trim($dbData[0]['user_del'])==='0'||trim($dbData[0]['user_del'])==='2'))) {
                    $outToken = md5(uniqid().Api::request()->cookies[Api::fun()->getSessionName()]);
                    Api::fun()->getDB()->where(array('user_id'=>trim($dbData[0]['user_id'])))->update('user',array('user_session'=>md5($outToken),'user_del'=>2,'user_ip'=>trim(Api::fun()->getSrt('ip',Api::request()->ip)),'user_logintime'=>time()));
                    Api::fun()->getSMTP($inEmail, trim($dbData[0]['user_name']), '['.Api::fun()->getTitle().'] 重置密码说明', Api::fun()->getForgotMB(trim($dbData[0]['user_name']), $inEmail, md5($outToken)));
                    header('Location: /login');
                    exit();
                } else {
                    header('Location: /forgot-password');
                    exit();
                }
            } else {
                header('Location: /forgot-password');
                exit();
            }
        }
        Api::render('admin/forgot-password', array('pubKey' => base64_encode(Api::fun()->getKey('public')), 'token' => $token, 'site_url' => Api::fun()->getSiteURL(), 'title' => '找回密码-'.Api::fun()->getTitle()));
    }

    // 会员注册
    public static function register() {
        if(Api::request()->method==='GET') {
            $token = Api::fun()->getToken(1);
        }
        if(Api::request()->method==='POST') {
            $toke = unserialize(Api::sess()->getSession('token'));
            if(Api::fun()->msectime()>$toke[3]) {
                header('Location: /register');
                exit();
            }

            if(isset(Api::request()->data['__hash__'])&&md5($toke[0])===md5(Api::request()->data['__hash__'])&&$toke[1]===(Api::fun()->getTokenID('GET'))&&$toke[2]===(Api::fun()->getTokenID('POST'))) {
                Api::sess()->delSession('token');

                $proxy_ip = Api::fun()->getSrt('ip',Api::request()->proxy_ip);
                if(!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::fun()->getRSA('rd',Api::request()->data['nloginpwd']));
                if(md5(trim(substr($loginpwd,-32)))!=md5($toke[0])){
                    header('Location: /register');
                    exit();
                }

                $inIP = Api::fun()->getSrt('ip',Api::request()->ip);
                $inPwd = Api::fun()->getSrt('passwd',trim(substr($loginpwd,0,-32)));
                $inUser = Api::fun()->getSrt('user',trim(Api::request()->data['loginname']));
                $inEmail = Api::fun()->getSrt('email',trim(Api::request()->data['loginmail']));

                if(empty($inPwd)||empty($inUser)||empty($inEmail)||trim($inUser)!==trim(Api::request()->data['loginname'])||trim($inPwd)!==trim(substr($loginpwd,0,-32))||trim($inEmail)!==trim(Api::request()->data['loginmail'])) {
                    header('Location: /register');
                    exit();
                }

                if(!empty(Api::fun()->getDB()->field('user_id')->where(array('user_md5'=>md5(trim($inUser)),'user_email'=>array($inEmail,'=','or')))->limit(1)->select('user')[0])) {
                    header('Location: /register');
                    exit();
                } else {
                    $inLook = mt_rand(100000,900000);
                    $option = array('user_name'=>trim($inUser),'user_pwd'=>md5($inPwd),'user_md5'=>md5($inUser),'user_lock'=>md5($inLook),'user_session'=>md5('000000'),'admin_ok'=>'1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','user_email'=>trim($inEmail),'user_del'=>0,'user_ip'=>trim($inIP),'user_logintime'=>time());
                    Api::fun()->getDB()->insert('user', $option);
                    Api::fun()->getSMTP($inEmail, $inUser, '['.Api::fun()->getTitle().'] 注册成功说明', Api::fun()->getRegisterMB($inUser, $inEmail, $inLook));
                    header('Location: /login');
                    exit();
                }
            } else {
                header('Location: /register');
                exit();
            }
        }
        Api::render('admin/register', array('pubKey' => base64_encode(Api::fun()->getKey('public')), 'token' => $token, 'site_url' => Api::fun()->getSiteURL(), 'title' => '会员注册-'.Api::fun()->getTitle()));
    }


    // 会员激活
    public static function active() {
        if(Api::request()->method==='GET') {
            $token = Api::fun()->getToken(1);
        }
        if(Api::request()->method==='POST') {
            $toke = unserialize(Api::sess()->getSession('token'));
            if(Api::fun()->msectime()>$toke[3]) {
                header('Location: /active');
                exit();
            }

            if(isset(Api::request()->data['__hash__'])&&md5($toke[0])===md5(Api::request()->data['__hash__'])&&$toke[1]===(Api::fun()->getTokenID('GET'))&&$toke[2]===(Api::fun()->getTokenID('POST'))) {
                Api::sess()->delSession('token');

                $proxy_ip = Api::fun()->getSrt('ip',Api::request()->proxy_ip);
                if(!empty($proxy_ip)) {
                    Api::render('error');
                }

                $loginpwd = trim(Api::fun()->getRSA('rd',Api::request()->data['nloginpwd']));
                if(md5(trim(substr($loginpwd,-32)))!=md5($toke[0])){
                    header('Location: /active');
                    exit();
                }

                $inPwd = Api::fun()->getSrt('active',trim(substr($loginpwd,0,-32)));
                $dbData = Api::fun()->getDB()->field('user_id,user_pwd,user_lock,user_session')->where(array('user_id'=>unserialize(Api::sess()->getSession('user'))[0]))->limit(1)->select('user');

                if($dbData[0]['user_session']===md5('000000')&&$dbData[0]['user_lock']===md5($inPwd)) {
                    Api::fun()->getDB()->where(array('user_id'=>trim($dbData[0]['user_id'])))->update('user',array('user_lock' => $dbData[0]['user_pwd'],'user_session'=>md5(Api::request()->cookies[Api::fun()->getSessionName()]),'user_ip'=>trim(Api::fun()->getSrt('ip',Api::request()->ip)),'user_logintime'=>time()));
                    header('Location: /admin-index');
                    exit();
                }
            } else {
                header('Location: /register');
                exit();
            }
        }
        Api::render('admin/active', array('pubKey' => base64_encode(Api::fun()->getKey('public')), 'token' => $token, 'site_url' => Api::fun()->getSiteURL(), 'title' => '会员激活-'.Api::fun()->getTitle()));
    }

    // 会员退出
    public static function logout() {
        header("Cache-control:no-cache,no-store,must-revalidate");
        header("Pragma:no-cache");
        header("Expires:0");
        header('Location: /login');
        Api::sess()->delSession('user');
        Api::sess()->destroy();
        exit();
    }

    public static function error() {
        Api::render('error');
    }

}