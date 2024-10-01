<?php 
    mysqli_report(false);
    class Database
    {
        public $connection = null;
        public $query     = null;
        public $result    = null;

        public function __construct($hostname,$username,$password,$database){

            $this->connection = mysqli_connect($hostname,$username,$password,$database);

            if(mysqli_connect_errno()){
                echo "<p style='color:red'>Connction Problem Error No". mysqli_connect() ."</p>";
                echo "<p style='color:red'>Connection failed Error Massage:".mysqli_connect_error()."</p>";
            }
            else{
                // echo"database connected";
            }

        }
       

        public function query_excute($query){
            $this->query = $query;
            $this->result = mysqli_query($this->connection, $this->query) or die("<p style='color:red'>Error No: ".mysqli_errno($this->connection)." Error Message: ".mysqli_error($this->connection)."</p>");
		
			return $this->result;

        }
        public function __destruct(){
            mysqli_close($this->connection);
        }

    }


?>