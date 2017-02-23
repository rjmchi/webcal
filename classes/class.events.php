<?php
class Events{
	public $dbh;
	
	function __construct()
	{ 		
		$dbname = "webcal";
		$user = "root";
		$pw = "kether1330";
		$server = "localhost";
		if (strstr($_SERVER['SERVER_NAME'],"rjmchicago"))
		{
			$dbname = "rjmilano_webcal";
			$user = "fill this in";
			$pw = "fill this in";
		}
		else if (strstr($_SERVER['SERVER_NAME'],"rjmprogramming"))
		{
			$dbname = "rjmprogr_webcal";
			$user = "fill this in";
			$pw = "fill this in";		
		}
		
		try {
			$this->dbh = new PDO("mysql:host=$server;dbname=$dbname", $user, $pw);
		}
		catch (PDOException $e)
		{
			die ($e->getMessage());
		}
	 	$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		
	}
	
	function newEvent($month, $day, $year, $event, $description, $sortorder){
		try {
			$sth = $this->dbh->prepare("insert into calendar (month,day,year,event,description, sortorder)values(:month, :day, :year, :event, :description, :sortorder)");
			$sth->bindParam(':month', $month);
			$sth->bindParam(':day' , $day);
			$sth->bindParam(':year' , $year);
			$sth->bindParam(':event' ,$event);
			$sth->bindParam(':description' , $description);
			$sth->bindParam(':sortorder' , $sortorder);
			$c = $sth->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
}

//$event = new Events;
//$event->newEvent(5,20,2016,"Another New Event","This is another new event with sortorder", 1);
//print_r($event);

