<?php
class DBController{
   
    // connection property 
    public $conn = null;

    // mysqli object 
    public $mysqli = null;

    protected $host= 'localhost';
    protected $user = 'root';
    protected $password = '';
    protected $db_name = 'cms';

    public function __construct()
    {
        $this->mysqli = new mysqli($this->host,$this->user,$this->password,$this->db_name);
        $this->conn = mysqli_connect($this->host,$this->user,$this->password,$this->db_name);
        if($this->conn->connect_error){
            echo "Fail".$this->conn->connect_error;
        }
        else
        echo "db connection successful.";
    }

    //destructor function 
    public function __destruct()
    {
        $this->closeConnection();
    }


    //close connection fucntion 
    public function closeConnection(){
        if($this->conn != null)
        {
            $this->conn->close();
            $this->conn = null;

        }
    }
}


?>