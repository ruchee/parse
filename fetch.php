<?php

class Fetch {

    /**
     * 获取指定网页的内容
     */
    protected function get ($url, $is_ajax = false, $use_proxy = false) {
        logger('start fetch '.$url, $is_ajax, $use_proxy);
        $ret = $this->_curl($url, $is_ajax, $use_proxy);
        logger('finished fetch '.$url, $is_ajax, $use_proxy);

        return $ret ?: false;
    }


    /**
     * 从链接地址获取网页内容，并转DOM对象
     */
    protected function url2dom ($url) {
        load_lib('simplehtmldom');
        return file_get_html($url);
    }


    /**
     * 字符串转DOM对象
     */
    protected function str2dom ($str) {
        load_lib('simplehtmldom');
        return str_get_html($str);
    }


    /**
     * CURL模拟请求
     */
    private function _curl ($url, $is_ajax = false, $use_proxy = false) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0;)');
        if (parse_url($url, PHP_URL_SCHEME) == 'https') {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        $ret = curl_exec($ch);
        $res = curl_getinfo($ch);
        curl_close($ch);

        return $ret;
    }

}
