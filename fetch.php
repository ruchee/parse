<?php

class Fetch {

    private static $_snoopy;


    public function __construct () {
        load_lib('snoopy');
        if (! self::$_snoopy) self::$_snoopy = new Snoopy;
    }


    /**
     * 获取指定网页的内容
     */
    protected function get ($url, $is_ajax = false, $use_proxy = false) {
        logger('start fetch '.$url, $is_ajax, $use_proxy);

        if ($use_proxy) {  // 使用代理
            $ret = $this->_vget($url, $is_ajax);
        } else {  // 不使用代理
            $ret = $this->_get($url, $is_ajax);
        }

        logger('finished fetch '.$url, $is_ajax, $use_proxy);

        if ($ret) return $ret;
        return false;
    }


    /**
     * 字符串转DOM对象
     */
    protected function str2dom ($str) {
        load_lib('simplehtmldom');
        return str_get_html($str);
    }


    /**
     * 不使用代理获取内容
     */
    private function _get ($url, $is_ajax) {
        self::$_snoopy->fetch($url);
        return self::$_snoopy->results;
    }


    /**
     * 使用代理获取内容
     */
    private function _vget ($url, $is_ajax) {
        load_config('agent');
    }

}
