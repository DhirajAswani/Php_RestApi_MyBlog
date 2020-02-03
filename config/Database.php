<?php
class Database
{

    private $host = 'localhost';
    private $db_name = 'myblog';
    private $username = 'dhiraj';
    private $password = 'dhiraj';
    private $conn;

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
            // new PDO('mysql:host=localhost;dbname=test', $user, $pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection Error : " . $e->getMessage();
        }

        return $this->conn;
    }
}
