<?php
namespace app\libs\backend;

use Api;

class BaseController {

    /**
     * 检测管理员权限
     * @param  boolean $force [description]
     * @return [type]         [description]
     */
    protected static function __checkManagePrivate() {
        if(!empty(Api::sess()->getSession('user'))&&unserialize(Api::sess()->getSession('user'))[2]==md5(Api::request()->cookies[Api::fun()->getSessionName()])) {
            $dbData = Api::fun()->getDB()->field('user_session,user_del')->where(array('user_id'=>unserialize(Api::sess()->getSession('user'))[0]))->limit(1)->select('user');
            if($dbData[0]['user_session']===md5('000000')) {
                header('Location: /active');
                exit();
            }
            if(trim($dbData[0]['user_session'])===md5(Api::request()->cookies[Api::fun()->getSessionName()])&&trim($dbData[0]['user_del'])==='0') {
                return true;
            } else {
                header("Cache-control:no-cache,no-store,must-revalidate");
                header("Pragma:no-cache");
                header("Expires:0");
                Api::sess()->delSession('user');
                Api::sess()->destroy();
                header('Location: /login');
                exit();
            }
        } else {
            die(Api::json(['status' => 'error', 'data' => '抱歉，权限不足！']));
        }
    }

}
