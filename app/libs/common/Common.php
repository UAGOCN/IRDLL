<?php 
namespace app\libs\common;

use app;

class Common extends app\Engine {

    // 私有获取数据
    private function getData() {
        $config = $this->get('web.config');
        return $config;
    }

    // 网站名称
    public function getTitle() {
        return trim($this->getData()['title']);
    }

    // 作用域
    public function getDomain() {
        return trim($this->getData()['sess.domain']);
    }

    // RSA 第三次公共证书
    public function getKey($name = 'public') {
        return trim(preg_replace('/[\r\n]/', '',$this->getData()[$name.'.third']));
    }

    // RSA 加密, 解密, 签名, 验签 返回JSON
    public function getRSA($id = 're', $data, $sign = false, $third = false) {
        $this->loader->register('getRsaSrt', 'app\libs\common\ModeRsa',array(
            $this->getData()['public.third'],
            $this->getData()['private'],
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
}