<?php
    // function safeInput(){
    //     // return htmlspecialchars()
    // }
    
error_reporting(E_ERROR | E_WARNING | E_PARSE);
class Database{
    public $host;
    public $dbname;
    public $user;
    public $pass;
    public $conn;
    public $stmt;
    public function __construct($host,$dbname,$user,$pass){
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
        $this->connect();
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Inserts Data into the database
     *
     * @param query string - the sql query
     * @param data array -  the data to be bound to the query using prepared staments
     * @return null
     */
    public function connect(){
        $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;", $this->user, $this->pass);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    /**
     * Selects all of the data that matches the search criteria
     *
     * @param query string - the sql query
     * @param data array -  the data to be bound to the query using prepared staments
     * @return array - all of the affected rows as an array
     */
    public function select($query, $data = []){
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($data);
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    /**
     * Counts the numbers of rows returned from the database
     *
     * @param query string - the sql query
     * @param data array -  the data to be bound to the query using prepared staments
     * @return int - number of rows
     */
    public function count($query, $data = []){
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($data);
        return count($this->stmt->fetchAll(PDO::FETCH_ASSOC));
    }
    /**
     * Inserts Data into the database
     *
     * @param query string - the sql query
     * @param data array -  the data to be bound to the query using prepared staments
     * @return null
     */
    public function insert($query, $data = []){
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($data);
    }
};
// Macbook Login Details
$dbx = new Database('localhost','block5_erevive','root','root');
// PC Login Details
// $dbx = new Database('localhost','block5_erevive','root','');

// var_dump($dbx->select("SELECT * FROM user"));
// echo("DBX");
                                
// An example select statement
// $dbx->select("SELECT * FROM test where id = ?",[1])