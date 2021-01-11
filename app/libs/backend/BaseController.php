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
        if(!empty(Api::sess()->getSession('user'))&&unserialize(Api::sess()->getSession('user'))[1]==md5(Api::request()->cookies[Api::fun()->getSessionName()])) {
            return true;
        } else {
            die(Api::json(['status' => 'error', 'data' => '抱歉，权限不足！']));
        }
    }

}
