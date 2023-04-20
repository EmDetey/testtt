<?php 

   
    require_once('core/model.php');
    

    class Controller{
        private $model;
        public function __construct()
        {
            $this->model = new Model();

        }
        public function DeleteTovar($table,$id)
        {
            
             
            $this->model->Delete($table, $id);
             
 
        }
        public function SelectAllTovars($table)
        {
            if(isset($_REQUEST['selectAllTovars']))
            {
                $tovars = $this->model->Select($table);
                return $tovars;
            }
        }

        public function SelectAllDeletedTovars($table)
        {
            if(isset($_REQUEST['selectAllDeletedTovars']))
            {
                $tovars = $this->model->Select($table,"WHERE deleted_at IS NOT NULL");
                return $tovars;
                
                
            }
        }

        public function AddNewTovar($table,$data)
        {
            $this->model->Insert($table,$data);
        }

       
    }


    $controller = new Controller();