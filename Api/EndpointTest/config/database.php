<?php 
    class Database {

        public $envQa = "Qa";
        public $env_Dev = "Dev";
        public $env_Prod = "Prod";

        //public $envCurrent = "Qa";

        public function __construct(){
            //define environment
            //$this->envCurrent = "X";
        }

        private $host = "";
        private $database_name = "";
        private $username = "";
        private $password = "";
        public $conn;

        //get environment
        private function getenv($envCurrent){
            
            if($envCurrent == $this->envQa){
                $this->host = "127.0.0.1";
                $this->database_name = "testendpoint";
                $this->username = "root";
                $this->password = "";
            }else if($envCurrent == $this->env_Dev){
                $this->host = "127.0.0.1";
                $this->database_name = "testendpoint";
                $this->username = "root";
                $this->password = "";
            }else  if($envCurrent == $this->env_Prod){
                $this->host = "127.0.0.1";
                $this->database_name = "testendpoint";
                $this->username = "root";
                $this->password = "";
            }else{
                //None
                $this->host = "";
                $this->database_name = "";
                $this->username = "";
                $this->password = "";
            }
        }

        public function getConnection(){

            //define environment
            $this->getenv($this->envQa);

            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }

       

       
        
    }  

     
?>