<?php 

   
    require_once("config.php");
    class Model{
        private $database;

        public function __construct()
        {
            $this->database = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
        } 

        public function Select($table,$query = null)
        {
            if($query == null) 
                $result = mysqli_query($this->database, "SELECT * FROM $table");
            else 
                $result = mysqli_query($this->database, "SELECT * FROM $table ". $query);  
            return $result;
        }
    

        public function Delete($table, $id)
        {
            $date = "bb";//date('Y-m-d');
            mysqli_query($this->database, "UPDATE '$table' SET `title` = $date WHERE '$id' = `id`");
        }
    }