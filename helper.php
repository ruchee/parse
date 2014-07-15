<?php

/**
 * 加载爬虫
 */
function load_fetch ($fetch_name) {
    $file_path = __DIR__.'/fetch/'.$fetch_name.'_fetch.php';
    if (file_exists($file_path)) {
        include $file_path;
        return true;
    }
    file_not_exists($file_path);
}


/**
 * 加载模型
 */
function load_model ($model_name) {
    $file_path = __DIR__.'/model/'.$model_name.'_model.php';
    if (file_exists($file_path)) {
        include $file_path;
        return true;
    }
    file_not_exists($file_path);
}


/**
 * 加载配置
 */
function load_config ($config_name) {
    $file_path = __DIR__.'/config/'.$config_name.'_config.php';
    if (file_exists($file_path)) {
        $config = include $file_path;
        return $config;
    }
    file_not_exists($file_path);
}


/**
 * 加载第三方库
 */
function load_lib ($lib_name) {
    $file_path = __DIR__.'/lib/'.$lib_name.'_lib.php';
    if (file_exists($file_path)) {
        include $file_path;
        return true;
    }
    file_not_exists($file_path);
}


/**
 * 指定文件不存在
 */
function file_not_exists ($file_path) {
    $file_path = str_replace('\\', '/', $file_path);
    logger_exit('file not exists: '.$file_path);
}


/**
 * 记录日志
 */
function logger ($msg, $is_ajax = false, $use_proxy = false) {
    $time = time();
    $date = date('Y-m-d', $time);
    $time = date('H:i:s', $time);
    $file = __DIR__.'/log/'.$date.'.txt';

    if ($is_ajax) $msg .= ' (ajax)';
    if ($use_proxy) $msg .= ' (proxy)';

    file_put_contents($file, $time.': '.$msg."\r\n", FILE_APPEND);
    echo $time.': '.$msg."\n";
}


/**
 * 记录日志并退出
 */
function logger_exit ($msg, $is_ajax = false, $use_proxy = false) {
    logger($msg, $is_ajax, $use_proxy);
    exit();
}
