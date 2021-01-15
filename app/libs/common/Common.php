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

    // 网站名称
    public function getEmail() {
        return trim($this->getDatas()['email']);
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

    // 网站域名
    public function getSiteURL() {
        return trim($this->getDatas()['site.url']);
    }

    // 作用域
    public function getDomain() {
        return trim($this->getDatas()['sess.domain']);
    }

    // 找回密码模板
    public function getForgotMB($username, $email, $toKCode) {
        return "<div style='width:640px; background:#fff; border:solid 1px #efefef; margin:0 auto; padding:35px 0 35px 0'><table width='560' border='0' align='center' cellpadding='0' cellspacing='0' style=' margin:0 auto; margin-left:30px; margin-right:30px;'><tbody><tr><td><h3 style='font-weight:normal; font-size:18px'>尊敬的客户：<span style='font-weight:bold; margin-left:5px;'>".$username."</span></h3><p style='color:#666; font-size:14px'>请在24小时内点击下面链接找回您的登录密码：<a href='".$this->getSiteURL()."/forgot-password?email=".$email."&amp;toKCode=".$toKCode."' target='_blank' style='display:block; margin-top:10px; color:#2980b9; line-height:24px; text-decoration:none;word-break:break-all; width:575px;'>".$this->getSiteURL()."/forgot-password?email=".$email."&amp;toKCode=".$toKCode."</a></p><p style='margin:0 0 5px 0; padding:0 0 3px 0;'><a href='".$this->getSiteURL()."/forgot-password?email=".$email."&amp;toKCode=".$toKCode."' style='display:inline-block; width:105px; text-align:center; background:#2980b9; color:#fff;  font-size:16px; text-decoration:none; line-height:34px; padding:0;border-radius:5px;' target='_blank'>查看详情</a></p><p style='margin:10px 0 5px 0; padding:3px 0;color:#666; font-size:14px'>如果您无法访问此链接，请将地址复制到您的浏览器（例如：Edge）的地址栏再访问。</p><p style='margin:5px 0; padding:3px 0;color:#666; font-size:14px'>如果链接已经失效，请重新到<a href='".$this->getSiteURL()."' target='_blank' style='color:#2980b9;'>".$this->getSiteURL()."</a>找回您的密码！</p></td></tr></tbody></table></div>";
    }

    // Token
    public function getToken($value = null) {
        if(!empty($value)||empty($this->sess()->getSession('token'))||$this->msectime()>unserialize($this->sess()->getSession('token'))[3]) {
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
    public function getTokenID($value = 'GET') {
        return md5(md5($value).md5($this->request()->url).md5($this->request()->scheme).md5($this->request()->user_agent).md5($this->request()->cookies[$this->fun()->getSessionName()]).md5($this->request()->accept).unserialize($this->sess()->getSession('key'))[0]);
    }

    // RSA 第三次公共证书
    public function getKey($name = 'public') {
        return trim(preg_replace('/[\r\n]/', '',$this->getDatas()[$name.'.third']));
    }

    // RSA 加密, 解密, 签名, 验签 返回JSON
    public function getRSA($id = 're', $data = false, $sign = false, $third = false) {
        $this->loader->register('getRsaSrt', 'app\libs\common\ModeRsa',array(
            $this->getDatas()['public.third'],
            $this->getDatas()['private'],
            (empty($third)?$this->getKey():$this->getKey($third)),
        ));
        $value = $this->getRsaSrt();
        switch ($id) {
            case 're':
                return $value->privEncrypt($data); // 私钥加密
                break;
            case 'ud':
                return $value->publicDecrypt($data); // 公钥解密
                break;
            case 'ue':
                return $value->publicEncrypt($data); // 公钥加密
                break;
            case 'rd':
                return $value->privDecrypt($data); // 私钥解密
                break;
            case 'rs':
                return $value->privSign($data); // 私钥签名
                break;
            case 'uv':
                return $value->publicVerifySign($data, $sign); // 公钥验证
                break;
            case 'tv':
                return $value->publicVerifySignThird($data, $sign); // 第三方公钥验证
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

    // 正则过滤
    public function getSrt($type = null, $value = null) {
        $pattern = '';
        switch ($type) {
            case "user":
                $pattern = '/^[\w\-\.]{1,32}$/ui';
                break;
            case "passwd":
                $pattern = '/(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,16}/ui';
                break;
            case "email":
                $pattern = '/([a-z0-9]*[-_\.]?[a-z0-9]+)*@([a-z0-9]*[-_]?[a-z0-9]+)+[\.][a-z]{2,3}([\.][a-z]{2})?/ui';
                break;
            case "tel":
                $pattern = '/^1[34578]\d{9}$/ui';
                break;
            case "ip":
                if(strpos($value,':')!==false) {
                    $pattern = '/^((([0-9A-Fa-f]{1,4}:){7}(([0-9A-Fa-f]{1,4}){1}|:))|(([0-9A-Fa-f]{1,4}:){6}((:[0-9A-Fa-f]{1,4}){1}|((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){5}((:[0-9A-Fa-f]{1,4}){1,2}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){4}((:[0-9A-Fa-f]{1,4}){1,3}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){3}((:[0-9A-Fa-f]{1,4}){1,4}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){2}((:[0-9A-Fa-f]{1,4}){1,5}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(([0-9A-Fa-f]{1,4}:){1}((:[0-9A-Fa-f]{1,4}){1,6}|:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:))|(:((:[0-9A-Fa-f]{1,4}){1,7}|(:[fF]{4}){0,1}:((22[0-3]|2[0-1][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})([.](25[0-5]|2[0-4][0-9]|[0-1][0-9][0-9]|([0-9]){1,2})){3})|:)))$/ui';
                } else {
                    $pattern = '/^(?:(?:2[0-4][0-9]\.)|(?:25[0-5]\.)|(?:1[0-9][0-9]\.)|(?:[1-9][0-9]\.)|(?:[0-9]\.)){3}(?:(?:2[0-5][0-5])|(?:25[0-5])|(?:1[0-9][0-9])|(?:[1-9][0-9])|(?:[1-9]))$/ui';
                }
                break;
            default:
                $pattern = '/^[\w\-\.]{1,32}$/ui';
        }
        preg_match_all($pattern, $value, $match);
        return !empty($match[0])?trim(implode('',$match[0])):FALSE;
    }

    // 发送 SMTP 邮件
    public function getSMTP($email = null, $name = null, $Subject = null, $body = null) {
        $this->loader->register('getSMTPPOP', 'app\libs\common\PHPMailer',array (TRUE));
        try {
            // 服务器设置
            $this->getSMTPPOP()->SMTPDebug  = SMTP::DEBUG_OFF;                          // 启用详细调试输出
            $this->getSMTPPOP()->isSMTP();                                              // 使用SMTP发送
            $this->getSMTPPOP()->Host       = trim($this->getDatas()['smtp.host']);     // 设置SMTP服务器进行发送
            $this->getSMTPPOP()->SMTPAuth   = true;                                     // 启用SMTP身份验证
            $this->getSMTPPOP()->Username   = trim($this->getDatas()['smtp.user']);     // SMTP用户名
            $this->getSMTPPOP()->Password   = trim($this->getDatas()['smtp.pass']);     // SMTP密码
            $this->getSMTPPOP()->SMTPSecure = trim($this->getDatas()['smtp.tlss']);     // 启用TLS加密或者SSL加密
            $this->getSMTPPOP()->Port       = trim($this->getDatas()['smtp.port']);     // 要连接到TCP 465端口, 请在上面使用 ssl 模式
            $this->getSMTPPOP()->CharSet    = "utf-8";

            //Recipients
            $this->getSMTPPOP()->setFrom(trim($this->getDatas()['smtp.user']), $this->getTitle());    // 设置发件人
            $this->getSMTPPOP()->addAddress(trim($email), trim($name));                               // 添加收件人
            //$this->getSMTPPOP()->addAddress('ellen@example.com');                                   // 名称可写项
            $this->getSMTPPOP()->addReplyTo(trim($this->getDatas()['smtp.user']), $this->getTitle()); // 添加回复人
            //$this->getSMTPPOP()->addCC('cc@example.com');
            //$this->getSMTPPOP()->addBCC('bcc@example.com');
        
            // Attachments
            //$this->getSMTPPOP()->addAttachment('/var/tmp/file.tar.gz');               // 添加附件
            //$this->getSMTPPOP()->addAttachment('/tmp/image.jpg', 'new.jpg');          // Optional name
        
            // Content
            $this->getSMTPPOP()->isHTML(true);                                          // 将电子邮件格式设置为HTML
            $this->getSMTPPOP()->Subject = trim($Subject);
            $this->getSMTPPOP()->Body    = trim($body);
            //$this->getSMTPPOP()->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $this->getSMTPPOP()->send();
            return TRUE;
        } catch (Exception $e) {
            return FALSE; // $this->getSMTPPOP()->ErrorInfo
        }
    }

    // 获取运行毫秒
    public function msectime() {
        list($msec, $sec) = explode(' ', microtime());
        $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
        return $msectime;
    }
}
