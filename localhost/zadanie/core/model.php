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
        public function Insert($table, $data)
        {
            
                mysqli_query($this->database, "INSERT INTO $table
                    (category_id, title, price,  created_at)
                    VALUES ($data[0], $data[1], $data[2], $data[3], $data[4]))");
            
            
        }

        public function Delete($table, $id)
        {
            $date = (String)date('Y-m-d');
            mysqli_query($this->database, "UPDATE products SET updated_at = $date WHERE id = $id");
        }
    }