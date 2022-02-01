<?php 
  class EventQR
  {
    public $server = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "oer";
  	public $conn;
    public function __construct()
    {
    	$this->conn= new mysqli($this->server,$this->user,$this->pass,$this->dbname);
    	if($this->conn->connect_error)
    	{
    		die("connection failed");
    	}
    }
   	public function insertQr($event_id,$field_1,$field_2,$field_3,$field_4,$field_5,$field_6,$field_7,$qrimage,$qrlink)
   	{
   			$sql = "INSERT INTO registered (event_id,field_1,field_2,field_3,field_4,field_5,field_6,field_7,qrImage,qrlink) VALUES('$fullname','$branchname','$zone','$qrimage','$qrlink')";
   			$query = $this->conn->query($sql);
   			return $query;

   	
   	}
   	public function displayImg()
   	{
   		$sql = "SELECT qrImage,qrlink from registered where qrImage='$qrimage'";
   	}
  }
  $register = new EventQR();
?>