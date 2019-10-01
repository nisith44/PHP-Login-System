<?php session_start(); ?>
<?php require_once('connection.php') ; ?>
<?php 

$error=0;

if(isset($_POST['submit'])){
	$Username=mysqli_real_escape_string($connection,$_POST['Username']);
	$Password=mysqli_real_escape_string($connection,$_POST['Password']);

	$query="SELECT * FROM users WHERE username='{$Username}' AND password='{$Password}' LIMIT 1";

	$result_set=mysqli_query($connection,$query);

	if($result_set){
		if(mysqli_num_rows($result_set)==1){
			$this_user=mysqli_fetch_assoc($result_set);
			$this_user_type=$this_user['user_type'];
			$_SESSION['user_id']=$this_user['id'];
			
			
			if($this_user_type=="s"){
				header('Location:student.php');
			}
			if($this_user_type=="l"){
				header('Location:lecture.php');
			}
			if($this_user_type=="a"){
				header('Location:staff.php');
			}
			
		}
		else{
		$error=1;
		}
	}
}


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

<style type="text/css">
	.box{border: 2px solid black;width: 400px;padding: 30px;margin: 0 auto;margin-top: 100px;}
</style>

<div class="container">
	
	<div class="box">
		<form action="login.php" method="post">
			<h1>Please Login</h1>
			<?php if(isset($_GET['logout'])){
          	echo '<p class="info alert alert-success">you have succesfully logout from the system</p>';
          	} ?>
			<label>Username :</label>
			<input type="text" name="Username" class="form-control" required>
			<br>
			<label>Password :</label>
			<input type="password" name="Password" class="form-control">
			<br>
			<?php if($error==1){
				echo "<p class=\"error alert alert-danger\">Invalid username or password</p>";
			} ?>
			
			
			<button class="btn btn-lg btn-primary " type="submit" name="submit">LOG IN</button>

		</form>
		
	</div>	



</div>

</body>
</html>