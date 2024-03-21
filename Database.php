<?php
class Database {
    // Database credentials
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;
    private $port;

    // Constructor
    public function __construct() {
        $this->username = getenv('DBUSERNAME');
        $this->password = getenv('DBPASSWORD');
        $this->db_name = getenv('DBNAME');
        $this->host = getenv('DBHOST');
        $this->port = getenv('DBPORT');
    }

    // Getting the database connection
    public function getConnection() {
        if ($this->conn){
            return $this->conn;
        } else{
            $dsn = "pgsql:host={$this->host};port={$this->port};dbname={$this->db_name}";
        }
        
    
        try {  
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $this->conn;
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            
        }
    
        
        
    }
    
}
