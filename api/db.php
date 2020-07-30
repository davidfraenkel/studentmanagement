<?php

    class DB {
        public function connect() {
            $server = 'localhost';
            $db = 'students';
            $user = 'root';
            $password = '';

            $DSN = 'mysql:host=' . $server . ';dbname=' . $db . ';charset=utf8';

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            try {
                $connection = new PDO($DSN, $user, $password, $options);
            }catch(PDOException $e) {
                echo 'Connection unsuccesfull';
                die('Connection unsuccessfull: ' . $connection->connect_error());
                exit();
            }
            return($connection);
        }

        public function disconnect($conobj) {
            $conobj = null;
        }
    }