<?php 
class Config
{
    public $serverName = 'localhost';
    public $userName = 'lenovo';
    public $password = 'lenovo';
    public $dataBaseName = 'attn';


    public function connect(){
        $conn= new mysqli($this->serverName,$this->userName,$this->password,
                $this->dataBaseName);
                
    //check error
    // if($conn->connect_error){ 
    //     die("Connection failed: " . $conn->connect_error);
    // }
    // else {
    //     echo "connection to database established" ;
    // }
    return $conn;
    }    
}
?>   