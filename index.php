<?php
require 'app/Inlet.php';

Api::route('/', function(){
    echo 'hello world!';
});

Api::start();
