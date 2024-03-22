<?php 

    class Database {

    private $username;
    private $dbname;
    private $conn;
    private $password;
    private $host;
    private $port;

    
    public function __construct() {
        
        $this->dbname = getenv('DBNAME');
        $this->host = getenv('DBHOST');
        $this->username = getenv('DBUSERNAME');
        $this->port = getenv('DBPORT');
        $this->password = getenv('DBPASSWORD');

    }

    public function getConnection(){
        if ($this->conn){
            return $this->conn;
        } else {
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}";

            try {        
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $this->conn;
            } catch (PDOException $e) {
                echo 'Connection Error: ' . $e->getMessage();
                }
            }
        }
    }

