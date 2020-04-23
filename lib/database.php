<?php 

 class Database{
        private $db_name="mysql:host=localhost; dbname=db_lr;";
        private $db_user="root";
        private $db_pass="";
        public $conn;

        public function __construct(){
            if(!isset($this->conn)){
                try {
                    $link= new PDO("$this->db_name,$this->db_user,$this->db_pass");
                    $link->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                    $this->conn = $link;
                } catch (PDOException $e) {
                    die("connection failed".$e->getMessage());
                }
            }
        }
}

?>