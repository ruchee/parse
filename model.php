<?php

class Model {

    protected static $_conn;  // 数据库连接句柄


    public function __construct () {
        if (! self::$_conn) $this->connection();
    }


    /**
     * 连接数据库
     */
    private function connection () {
        try {
            $conf = load_config('db');
            $dsn = 'mysql:dbname='.$conf['database'].';host='.$conf['hostname'];
            self::$_conn = new PDO($dsn, $conf['username'], $conf['password']);
            logger('link database success');
        } catch (PDOException $e) {
            logger('link database error');
            exit('Connection failed: '.$e->getMessage());
        }
    }

}
