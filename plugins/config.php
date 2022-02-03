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
   	public function insertQr($event_id,$fields,$qrimage,$qrlink)
   	{
      $sql = "REPLACE INTO registered (event_id ";
      for ($i=0; $i < count($fields); $i++) { 
        $aa = $i + 1;
        $sql = $sql . ", field_" . $aa;
        $sql = $sql . ", qrImage ";
        $sql = $sql . ", qrlink ";
      }
      $sql = $sql . ") VALUES ('$event_id'";
      for ($j=0; $j < count($fields); $j++) { 
        $field = $fields[$j];
        $sql = $sql . ", '$field'";
        $sql = $sql . ", qrimage ";
        $sql = $sql . ", qrlink ";
      }
      $sql = $sql . ")";

 			// $sql = "INSERT INTO registered (event_id,field_1,qrImage,qrlink) VALUES('$event_id','$field_1','$qrimage','$qrlink')";
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