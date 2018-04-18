<?php
if (!class_exists('Db')) {
    class Db
    {

        protected static $instance = null;

        public static function getInstance()
        {
            if (!isset(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        private function connect()
        {
            global $dbConfig;

            $connection = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['pass'], $dbConfig['db']);

            if (mysqli_connect_errno()) {
                printf("DB connection error: %s\n", mysqli_connect_error());
                exit();
            } else {
                return $connection;
            }
        }

        public function __construct()
        {
            // ?
        }

        public function __destruct()
        {
            // ?
        }

        private function __clone()
        {
            // !
        }

        public function query($query)
        {
            //$results = array();
            $db = $this->connect();

            if (!$db->set_charset("utf8")) {
                //printf("Ошибка при загрузке набора символов utf8: %s\n", $db->error);
            } else {
                //printf("Текущий набор символов: %s\n", $db->character_set_name());
            }

            $result = $db->query($query);

            return $result;

//            while ($row = $result->fetch_object()) {
//                $results[] = $row;
//            }
//
//            return $results;
        }

        public function insert($query)
        {
            $db = $this->connect();

            if (!$db->set_charset("utf8")) {
                //printf("Ошибка при загрузке набора символов utf8: %s\n", $db->error);
            } else {
                //printf("Текущий набор символов: %s\n", $db->character_set_name());
            }

            $result = $db->query($query);

            return $result;
        }
    }
}