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
        if(!empty(Api::sess()->getSession('user'))&&unserialize(Api::sess()->getSession('user'))[1]==md5(Api::request()->cookies[Api::fun()->getSessionName()])&&!empty(Api::fun()->getDB()->field('user_name')->where(array('user_session'=>md5(Api::request()->cookies[Api::fun()->getSessionName()]),'user_md5'=>md5(unserialize(Api::sess()->getSession('user'))[0]),'user_del'=>'0'))->limit(1)->select('user'))) {
            return true;
        } else {
            die(Api::json(['status' => 'error', 'data' => '抱歉，权限不足！']));
        }
    }

}
