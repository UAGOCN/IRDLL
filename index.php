<?php
require 'app/Inlet.php';

// 需要开启openssl扩展
if (!extension_loaded("openssl")) {
    exit("Please open the openssl extension first.");
}

// 开启 SESSION
Api::sess()->Session();

Api::start();
