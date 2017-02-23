<?php
class Users{
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
	function newUser($userid, $password, $firstname, $lastname,$email){

		try {
			$password = md5($password); 
			$sth = $this->dbh->prepare("insert into users (userid, password,firstname,lastname,email) values(:userid, :password, :firstname, :lastname, :email)");
			$sth->bindParam(':userid', $userid);
			$sth->bindParam(':firstname' , $firstname);
			$sth->bindParam(':lastname' , $lastname);
			$sth->bindParam(':password' ,$password);
			$sth->bindParam(':email' , $email);
			$c = $sth->execute();
		}
		catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	
	function validateUser($userid, $password){
		$password = md5($password);
		
		$stmt = $this->dbh->prepare("select * from users where userid=? and password=?");
		$stmt->execute(array ($userid, $password));
		$result = $stmt->fetchAll(PDO::FETCH_OBJ);
		return (sizeof($result) > 0);	
	}
	
	function updateUserForm () {
?>
<form name="UpdateUser" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<label for="userid">User ID:</label>
	<input name="userid" id="userid" type="text" size="25">
	<label for="password">Password:</label>
	<input type="password" name="password" id="password">
			
	<label for="newpassword">New Password:</label>
	<input type="password" name="newpassword" id="newpassword">

	<label for="rptpassword">Repeat Password:</label>
	<input type="password" name="rptpassword" id="rptpassword">

	<input type="submit" name="submit" id="submit" value="Update User">
</form>
<?php 		
	}
	
function newUserForm () {
?>
<form name="NewUser" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
	<label for="userid">User ID:</label>
	<input name="userid" id="userid" type="text" size="25">
	<label for="password">Password:</label>
	<input type="password" name="password" id="password">

	<label for="rptpassword">Repeat Password:</label>
	<input type="password" name="rptpassword" id="rptpassword">

	<input type="submit" name="submit" id="submit" value="Update User">
</form>
<?php 		
	}	
}

$user = new Users;
//$user->newUser('rjmchi', 'password','Robert','Milanowski','robert@rjmchicago.com');
//print_r($user);

//if ($user->validateUser('rjmchi', 'password'))
//{
//	echo 'valid';
//}
//else {
//	echo 'not valide';
//}

