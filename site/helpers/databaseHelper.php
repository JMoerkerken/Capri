<?php
  
  class DatabaseHelper {
    private $host = 'localhost';
    private $user = 'capri';
    private $pass = 'wi!ansir';
    private $name = 'capri';
    private $connection = '';
      
    function __construct(){
        $this->connection=mysqli_connect($this->host,$this->user,$this->pass,$this->name);
        if (mysqli_connect_errno($this->connection))
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    
    public function query($query){
        $queryOutput = array();
        $filterdQueryString = strtolower(str_replace(' ', '', $query));
        if(
            (
                is_int(strpos($filterdQueryString, 'select')) && 
                (strpos($filterdQueryString, 'select') < 5)
            )
        ){
            $sqlResult = mysqli_query($this->connection,$query);
            while($sqlRow = mysqli_fetch_array($sqlResult)){
                $queryOutput[] = $sqlRow;
            }
        }else{
            mysqli_query($this->connection,$query);
        }
        return $queryOutput;
    }
    
    public function returnLastInsertId(){
        return $this->connection->insert_id;
    }
      
  }
?> 