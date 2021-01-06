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

        //$data = array('user_name'=>'tongji','user_pwd'=>'d6ceebf494d774931e92e45f834d490f','user_md5'=>'21232f297a57a5a743894a0e4a801fc3','user_lock'=>'d6ceebf494d774931e92e45f834d490f','user_email'=>'10010@qq.com','user_ip'=>'127.0.0.1','user_logintime'=>1311954804);
        //$dbData = Api::fun()->getDB()->insert('user',$data);
        //$option = array('user.user_name','=','admin.admin_name');
        //$dbData = Api::fun()->getDB()->field('user.user_name,admin.admin_name')->join(array('LEFT','admin',$option))->select('user',1);
        //$option = array('user_name'=>'admin');
        //$dbData = Api::fun()->getDB()->where($option)->select('user',1);
        //$dbData = Api::fun()->getDB()->startTrans();
        //$dbData = Api::fun()->getDB()->where(array('user_name'=>'user'))->update('user',array('user_face'=>'测试一下'));
        //$dbData = Api::fun()->getDB()->where(array('user_name'=>'tongji'))->delete('user');
        //$dbData = Api::fun()->getDB()->commit();

        Api::render('admin/index', array('title' => '管理后台-'.Api::fun()->getTitle()));

    }

    public static function login() {
        if(Api::request()->method==='GET') {
            $token = Api::fun()->getToken(1);
        }
        if(Api::request()->method==='POST') {
            $toke = unserialize(Api::sess()->getSession('token'));
            if(time()>$toke[3]) {
                header('Location: /login');
                exit();
            }
            if(isset(Api::request()->data['__hash__'])&&md5($toke[0])===md5(Api::request()->data['__hash__'])&&$toke[1]===(Api::fun()->getTokenID('GET'))&&$toke[2]===(Api::fun()->getTokenID('POST'))) {
                Api::sess()->delSession('token');
                $loginpwd = trim(Api::fun()->getRSA('rd',Api::request()->data['nloginpwd']));
                if(md5(substr($loginpwd,-32))!=md5($toke[0])){
                    header('Location: /login');
                    exit();
                }
                $nloginpwd = md5(substr($loginpwd,0,-32));
                $option = array('user_md5'=>md5(Api::request()->data['loginname']),'user_pwd'=>$nloginpwd);
                $dbData = Api::fun()->getDB()->where($option)->select('user',1);
                if(!empty($dbData)&&Api::request()->data['loginname']===$dbData['user_name']) {
                    Api::sess()->setSession('user',serialize(array($dbData['user_name'],md5(Api::request()->cookies[Api::fun()->getSessionName()]))));
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
        Api::render('admin/login', array('pubKey' => base64_encode(Api::fun()->getKey('public')), 'token' => $token, 'domain' => Api::fun()->getDomain(), 'title' => '管理登录-'.Api::fun()->getTitle()));
    }

    public static function logout() {
        Api::sess()->delSession('user');
        Api::sess()->destroy();
        header('Location: /login');
        exit();
    }

    public static function error() {
        Api::render('error');
    }

}