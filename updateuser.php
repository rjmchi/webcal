<?php require_once('classes/class.users.php');?>

<?php 
	if (isset($_POST['submit']))
	{
		

	}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Add User</title>
<link rel="stylesheet" href="admin.css">
</head>

<body>
	<div class="page_wrap">
	
	<?php $user->updateUserForm();?>
		
	</div><!--end page_wrap-->
</body>
</html>

