<?php
namespace app\libs\common;

class ModeRSA extends Common {

    /**
     * 签名算法， 默认为 OPENSSL_ALGO_SHA1
     */
    const RSA_ALGORITHM_SIGN = OPENSSL_ALGO_SHA512;

    /**
     * 公钥
     * @var string
     */
    private static $publicKey = false;

    /**
     * 私钥
     * @var string
     */
    private static $privateKey = false;

    /**
     * 第三方公钥 交互验签使用
     * @var string
     */
    private static $thirdPublicKey = false;

    /**
     * 初始化秘钥信息
     * @var string
     */
    public function __construct($public_key_file = false, $private_key_file = false, $third_key_file = false) {
        self::$publicKey = $public_key_file;
        self::$privateKey = $private_key_file;
        self::$thirdPublicKey = $third_key_file;
    }

    /**
     * 是否使用安全base64需要参考第三方验签的解析方案，如果也是php推荐使用安全方式
     * @param $data
     * @return string
     */
    private static function url_safe_base64_encode($data) {
        return str_replace(array('+', '/', '='), array('-', '_', '~'), base64_encode($data));
    }

    /**
     * @param $data
     * @return string
     */
    private static function url_safe_base64_decode($data) {
        $base_64 = str_replace(array('-', '_', '~'), array('+', '/', '='), $data);
        return base64_decode($base_64);
    }

    /**
     * 获取rsa密钥加密位数
     * @param $source
     * @return mixed
     */
    private static function getKeyBitDetail($source) {
        $srt = openssl_pkey_get_details($source);
        return $srt['bits'];
    }

    /**
     * 获取文本格式私钥 并重新格式化 为保证任何key都可以识别
     * 由于各个语言以及环境使用的证书格式不同。参考下一节： ### 秘钥格式解析
     * @return bool|resource
     */
    private static function getPrivateKey() {
        //if (file_exists(self::$publicKey)) {
            //$source =  file_get_contents(self::$privateKey);
            $source =  self::$privateKey;

            $search = array(
                "-----BEGIN RSA PRIVATE KEY-----",
                "-----END RSA PRIVATE KEY-----",
                "\n",
                "\r",
                "\r\n"
            );

            $private_key = str_replace($search,"",$source);
            return openssl_pkey_get_private($search[0] . PHP_EOL . wordwrap($private_key, 64, "\n", true) . PHP_EOL . $search[1]);
        //}
    }

    /**
     * 获取公钥 并重新格式化
     * @return resource
     */
    private static function getPublicKey() {
        //if (file_exists(self::$publicKey)) {
            //$source = file_get_contents(self::$publicKey);
            $source =  self::$publicKey;

            $search = array(
                "-----BEGIN PUBLIC KEY-----",
                "-----END PUBLIC KEY-----",
                "\n",
                "\r",
                "\r\n"
            );
            $public_key = str_replace($search,"",$source);

            return openssl_pkey_get_public($search[0] . PHP_EOL . wordwrap($public_key, 64, "\n", true) . PHP_EOL . $search[1]);
        //}
    }

    /**
     * 获取第三方公钥，并格式化
     * @return resource
     */
    private static function getPublicKeyThird() {
        //if (file_exists(self::$thirdPublicKey)) {
            //$source = file_get_contents(self::$thirdPublicKey);
            $source =  self::$thirdPublicKey;

            $search = array(
                "-----BEGIN PUBLIC KEY-----",
                "-----END PUBLIC KEY-----",
                "\n",
                "\r",
                "\r\n"
            );
            $public_key = str_replace($search, "", $source);

            return openssl_pkey_get_public($search[0] . PHP_EOL . wordwrap($public_key, 64, "\n", true) . PHP_EOL . $search[1]);
        //}
    }

    /**
     * 排序数据并生成待验签字符串（类似微信支付，使用此方法，而非例子中json_encode方法）
     * @return string
     */
    private static function createLinkString($data = array()) {
        unset($data['sign']);

        foreach ($data as $key => $val) {
            if (!$val) {
                unset($data[$key]);
            }
        }
        ksort($data);

        return urldecode(http_build_query($data));
    }

    /**
     * 排序数据并生成待验签字符串（类似微信支付，使用此方法，而非例子中json_encode方法）
     * @return string
     */
    public static function createLinkStringNew($data = array()) {
        $mac = false;
        ksort($data);
        unset($data['sign'], $data['sign_type']);

        foreach ($data as $key => $val) {
            if ($val) {
                $mac .= "&{$key}={$val}";
            }
        }

        return ltrim($mac, '&');
    }

    /**
     * 私钥加密
     * @param $data
     * @return bool|null
     */
    public static function privEncrypt($data = false) {
        $privKey = self::getPrivateKey();

        $partLen = self::getKeyBitDetail($privKey) / 8 - 11;

        if(is_array($data)) {
            ksort($data);
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        $parts = str_split($data, $partLen);

        $encrypted = false;

        foreach ($parts as $part) {
            openssl_private_encrypt($part, $partEncrypt, $privKey);
            $encrypted .= $partEncrypt;
        }
        openssl_free_key($privKey);

        return $encrypted ? self::url_safe_base64_encode($encrypted) : null;
    }

    /**
     * 公钥解密
     * @param string $encrypted
     * @return bool|null
     */
    public static function publicDecrypt($encrypted = false) {
        $pubKey = self::getPublicKey();

        $partLen = self::getKeyBitDetail($pubKey) / 8;

        $parts = str_split(self::url_safe_base64_decode($encrypted), $partLen);

        $decrypted = false;

        foreach ($parts as $part) {
            openssl_public_decrypt($part, $partDecrypt, $pubKey);
            $decrypted .= $partDecrypt;
        }

        openssl_free_key($pubKey);

        return $decrypted ?: null;
    }

    /**
     * 公钥加密
     * @param string $data
     * @return bool|null
     */
    public static function publicEncrypt($data = false) {
        $pubKey = self::getPublicKey();

        $partLen = self::getKeyBitDetail($pubKey) / 8 - 11;

        if(is_array($data)) {
            ksort($data);
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        $parts = str_split($data, $partLen);

        $encrypted = false;

        foreach ($parts as $part) {
            openssl_public_encrypt($part, $partEncrypt, $pubKey);
            $encrypted .= $partEncrypt;
        }

        openssl_free_key($pubKey);

        return $encrypted ? self::url_safe_base64_encode($encrypted) : null;
    }

    /**
     * 私钥解密
     * @param string $encrypted
     * @return bool|null
     */
    public static function privDecrypt($encrypted = false) {
        $privKey = self::getPrivateKey();

        $partLen = self::getKeyBitDetail($privKey) / 8;

        $parts = str_split(self::url_safe_base64_decode($encrypted), $partLen);

        $decrypted = false;

        foreach ($parts as $part) {
            openssl_private_decrypt($part, $partDecrypt, $privKey);
            $decrypted .= $partDecrypt;
        }

        openssl_free_key($privKey);

        return $decrypted ?: null;
    }

    /**
     * 私钥签名
     * @param array $data
     * @return null|string
     */
    public static function privSign($data = array()) {
        $privKey = self::getPrivateKey();

        openssl_sign(self::createLinkStringNew($data), $sign, $privKey, self::RSA_ALGORITHM_SIGN);

        openssl_free_key($privKey);

        return $sign ? self::url_safe_base64_encode($sign) : null;
    }

    /**
     * 公钥验签
     * @param array $data
     * @param string $sign
     * @return int
     */
    public static function publicVerifySign($data = array(), $sign = false) {
        $pubKey = self::getPublicKey();

        $res = openssl_verify(self::createLinkStringNew($data), self::url_safe_base64_decode($sign), $pubKey, self::RSA_ALGORITHM_SIGN);

        openssl_free_key($pubKey);

        return $res;
    }

    /**
     * 公钥验签(第三方)
     * @param array $data
     * @param string $sign
     * @return int
     */
    public static function publicVerifySignThird($data = array(), $sign = false) {
        $pubKey = self::getPublicKeyThird();

        $res = openssl_verify(self::createLinkStringNew($data), self::url_safe_base64_decode($sign), $pubKey, self::RSA_ALGORITHM_SIGN);

        openssl_free_key($pubKey);

        return $res;
    }
}
