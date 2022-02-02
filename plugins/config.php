s<?php 
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
   	public function insertQr($event_id,$field_1,$qrimage,$qrlink)
   	{
   			$sql = "INSERT INTO registered (event_id,field_1,qrImage,qrlink) VALUES('$event_id','$field_1','$qrimage','$qrlink')";
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