<?php
  class EventDB
  {
    public $server = "localhost";
    public $user = "root";
    public $pass = "";
    public $dbname = "oer";
    public $conn;
    public function __construct()
    {
      $this->conn= new mysqli($this->server, $this->user, $this->pass, $this->dbname);
      if($this->conn->connect_error)
      {
        die("connection failed");
      }
    }
    public function insert($eventname,$venue,$filename)
    {
        $sql = "INSERT INTO event(eventname,venue,image) VALUES('$eventname','$venue','$filename')";
        $query = $this->conn->query($sql);
        return $query;

    
    }
    // public function displayImg()
    // {
    //   $sql = "SELECT qrImage,qrlink from barcodes where qrImage='$qrimage'";
    // }
  }
  $db = new EventDB(); 
?>