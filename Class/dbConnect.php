<?php


class dbConnect {
    var $servername;
    var $dbUsername;
    var $dbPassword;
    var $dbName;
    var $conn;

    public function __construct($servername, $dbUsername, $dbPassword, $dbName) {
        $this->servername = $servername;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbName = $dbName;
    }

    public function  getConn() {
        $this->conn = mysqli_connect($this->servername, $this->dbUsername, $this->dbPassword, $this->dbName);
        return $this->conn;
    }

    public function connFailed() {
        if (!$this->conn){
            die("Connection failed: ".mysqli_connect_error());
        }
    }
}