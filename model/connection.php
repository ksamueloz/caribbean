<?php

    class Connection {
        private $server = "localhost";
        private $username = "root";
        private $password = "";
        private $database = "caribbean";

        public function __construct() {
            $this -> server   = "localhost";
            $this -> user     = "root";
            $this -> password = "";
            $this -> database = "caribbean";
        }

        public function connect() {
            try {
                $conn = new PDO("mysql:host=$this->server;dbname=$this->database;", $this -> user, $this -> password);
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                #echo "Conexión exitosa";
                return $conn;
            } catch (PDOException $e) {
                echo "Falla en la conexión: ".$e -> getMessage();
            }
        }
    }