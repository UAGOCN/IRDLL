<?php
return array(
# ======> 公共配置
    # 网站名称
    'title' => '地球村',
    # 法务邮箱
    'email' => 'support@a.com',
    # SESSION 数据用户未登录过期时间 秒
    'timeout' => '30',
    # SESSION 数据用户登陆后过期时间 秒
    'usertime' => '86400',
    # TOKEN 有效时长 秒
    'token' => '120',
    # 登陆锁屏时间 秒
    'lock' => '120',
    # SESSION作用域
    'sess.domain' => '.a.com',
    # 网站域名
    'site.url' => 'http://a.com',
# ======> SMTP 配置
    'smtp.host' =>'smtp.qq.com',
    'smtp.user' =>'jiweimr@qq.com',
    'smtp.pass' =>'lhfuhmkzvdyncjab',
    'smtp.port' =>'465',
    # port:465 tlss:ssl
    # port:587 tlss:tls
    'smtp.tlss' =>'ssl',
# ======> Mysql数据库配置
    # 数据库主机地址
    'db.host' => '127.0.0.1',
    # 数据库端口
    'db.port' => '3306',
    # 数据库用户名
    'db.user' => 'root',
    # 数据库密码
    'db.pass' => 'root',
    # 数据库名称
    'db.name' => 'root',
    # 数据库表前缀
    'db.prefix'=>'info_',
    # 数据库编码，默认utf8
    'db.charset' => 'utf8',
# ======> 保存 会员ID 到 Redis
    # Redis主机地址
    'user.host' => '127.0.0.1',
    # Redis端口，默认6379
    'user.port' => '6379',
    # Redis数据库号，范围1~16，默认无需修改，0默认预留给杂项使用
    'user.db' => '0',
    # Redis密码
    'user.auth' => '123456',
    # Redis链接时间 秒
    'user.ttl' => '10',
# ======> 保存 SESSION 到 Redis
    # Redis 主机地址
    'sess.host' => '127.0.0.1',
    # Redis端口，默认6379
    'sess.port' => '6379',
    # Redis数据库号，范围1~16，默认无需修改，0默认预留给杂项使用
    'sess.db' => '0',
    # Redis密码
    'sess.auth' => '123456',
    # Redis链接时间 秒
    'sess.ttl' => '10',
    # SESSION名称 #默认：PHPSESSID
    'sess.name' => '__cflb',
# ======> RSA 公钥, 私钥
    # RSA 私钥
    'private' => '
MIIEpAIBAAKCAQEA2KJ4i1DKa1TLCqjwRIA+BQw/zqIjey6FIL4G2qfSE4MKUbSCeZ1UKehLJyaweD4s9l9k7QOA87t3HtGWeMGxlam9kLCijc/XDdR3cD98ncfl8t+k6HsIORCcKXEbbOg/He0BrkbCSn2hzpXZEY1iIrG4w070XsV8WsNpkYkWU12F3mGwK1GW093tmNaqu5iz9Ra6peARI3231Ef7cAeSqJwzICLtE/QqYW1k9y8TXHT1kwbM4IG1jv/LOyjQoqcNk7v09wcDAOl3V0obI/BVF7jqweYZ1QOkUjr5asJ7+Dl2x9hzQMzvZA8NKDioXb7gwftn2KSFXFvVi8yiITnyDwIDAQABAoIBAEca9OQNbZNTLp3eG5bwXOr9PUhOkcTR3SKFHOzSHrMG1PFChXzzdfeXZmuAWHXvOoTXhOICv2XAx3WXJ4OVV/uezjjasVBIwvaoIVf3jqifP0u7un4QO/+3AvrbRDw38teYvm98jDM1D1Imfywyst5eZR2+IZmlyo5kC5eYXnqX4jZhh73dMxuhK0WjT8hGOx1+dsoIjnAim3rHfZI7X4DXnNNCYk7+1TJfBd+lXXo6d+TvCfPDZlprf6CbXnsmOIzFhafRnHrbWRolcDZFLK3DBvFJdbhNj5KOAyxi6nI3gOPbJfWlTpjEVbtknsH5/vfrd38so7q54YOSjcxSFzECgYEA81EPNxi327cYIyctFRMYHp1mc/VDgcUAJjReOhH53whWe0WqXi83ylySBdkfaapeHPtuJoa4KewrR4+/VmBa1KW2/L8/4AGMIpL3MpC50KdV3wq3OpujVEphQLmBDq4gC7+Wgr1cr49knbcdAKqsGH+Bj5BQiy2Y/ZhiHMyeMYcCgYEA4+1afiA3QFtVERcHvUsIVQiNfIkVqGmIs2UQRjtyR3rqAIKFWEmnWAr+wwqNg2dH6XZ9IuVYRXuC6M1UYFIeGR5oVkEwNMKNlvc0o+kPtYr3D4Uln/lGUpN6BIs+OkHB4sNHkiFDzvxSAXsZv8ehDttTZmg+nceh9WNkB8oefTkCgYEAy2fRQ2sLkMcQi5qdioeq2zUUSA4aQCrzQ/z1ZLBQZg4vVeBYW2I3zpjyjacEJq6A/NOIMvbekFVZnPpjpw7n/+sE/WfYOyiwANtBgekRHYg2Nj5cDMe9k6KWiKhLZn1UVt30MhmhmTZTk7FXso37ToORSPYJD0CwLBgutQqtmJMCgYAWNLy5Rwg7A+rwxE6juZixOCkYtf5fLxD7cWA5h3cl0arUq+Kz7FEaec/CTtfksn5GF54vdSq5ckQZzE9pJvb5uYWuyaEZss66o5EEWyOFq2lQoMc+o7mfN/EOWkaQxHFQV3g0m3sQwnJ25Hhov9lIKkQg2Q0osBduYeWQALghuQKBgQDosAJsjOZLDaBPXkm9OgZL9SCFJtX9rhGbb4dt4+33BocEWAP0ZrSpFdV2TQ8+g1C/rRu/XAtWMjgfm/ymJ9b3a21eCiBDZVp0HU22ck7dCSafprJwdXhn2c00rUy6+Kp25xIg6oBM+4tGBTMpUZ1cqNeVBPjFG5GH314JpIifnQ==
',

    # RSA 公钥
    'public.third' => '
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2KJ4i1DKa1TLCqjwRIA+BQw/zqIjey6FIL4G2qfSE4MKUbSCeZ1UKehLJyaweD4s9l9k7QOA87t3HtGWeMGxlam9kLCijc/XDdR3cD98ncfl8t+k6HsIORCcKXEbbOg/He0BrkbCSn2hzpXZEY1iIrG4w070XsV8WsNpkYkWU12F3mGwK1GW093tmNaqu5iz9Ra6peARI3231Ef7cAeSqJwzICLtE/QqYW1k9y8TXHT1kwbM4IG1jv/LOyjQoqcNk7v09wcDAOl3V0obI/BVF7jqweYZ1QOkUjr5asJ7+Dl2x9hzQMzvZA8NKDioXb7gwftn2KSFXFvVi8yiITnyDwIDAQAB
',

    # RSA 第三方公钥
    'alipay.third' => '
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEA2KJ4i1DKa1TLCqjwRIA+BQw/zqIjey6FIL4G2qfSE4MKUbSCeZ1UKehLJyaweD4s9l9k7QOA87t3HtGWeMGxlam9kLCijc/XDdR3cD98ncfl8t+k6HsIORCcKXEbbOg/He0BrkbCSn2hzpXZEY1iIrG4w070XsV8WsNpkYkWU12F3mGwK1GW093tmNaqu5iz9Ra6peARI3231Ef7cAeSqJwzICLtE/QqYW1k9y8TXHT1kwbM4IG1jv/LOyjQoqcNk7v09wcDAOl3V0obI/BVF7jqweYZ1QOkUjr5asJ7+Dl2x9hzQMzvZA8NKDioXb7gwftn2KSFXFvVi8yiITnyDwIDAQAB
',

    # RSA Cookie公钥
    'cookie.third' => '
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmY1dRW9s1Tphflxwt4VvZmoF7BBEV+xCQqRGAtCJaF8GxjZg2v4wkBM7px3T0wSFWYWrb2dL6W4fkDzQp/tc5dCCbk8RUccwpCg29hKgk6ibaxVXL1VTgTdeQqXea+HBWQtMYAWTVsTMe0Hn7AxXWFlJhBgIwD4ET1KVuqpK+azuI2Z0vNAj0mi7wbxooDSeSNrN5jcL2f7HkJClBK6L0wXK6lBMsWq+YaP76WIdQ/rd/RFg+YTT4iaOh675mmrgDA2WHpIMId7i0td8Q9muYUUXbOGFSl8EE5tS0LZe3AyJLwBfW3eSIstCMB/NLHffFgq6YPzRfGn45snEgIZ7OQIDAQAB
',

    # RSA Token公钥
    'token.third' => '
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmY1dRW9s1Tphflxwt4VvZmoF7BBEV+xCQqRGAtCJaF8GxjZg2v4wkBM7px3T0wSFWYWrb2dL6W4fkDzQp/tc5dCCbk8RUccwpCg29hKgk6ibaxVXL1VTgTdeQqXea+HBWQtMYAWTVsTMe0Hn7AxXWFlJhBgIwD4ET1KVuqpK+azuI2Z0vNAj0mi7wbxooDSeSNrN5jcL2f7HkJClBK6L0wXK6lBMsWq+YaP76WIdQ/rd/RFg+YTT4iaOh675mmrgDA2WHpIMId7i0td8Q9muYUUXbOGFSl8EE5tS0LZe3AyJLwBfW3eSIstCMB/NLHffFgq6YPzRfGn45snEgIZ7OQIDAQAB
',

);
