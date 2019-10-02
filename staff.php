<?php session_start(); ?>
<?php require_once('connection.php') ; ?>

<?php if (!isset($_SESSION['user_id'])) {
  header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>


<div class="container-fluid">

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">STAFF</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?action=create_user">Create User</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Pricing</a>
      </li>
    </ul>
    <span class="navbar-text">
     <a href="logout.php">Logout</a>
    </span>
  </div>
</nav>


<?php

$action = $_GET['action'];

if ($action == 'create_user') {



if (isset($_POST['create_user'])) {

  $user_type = filter_input(INPUT_POST, 'user_type', FILTER_SANITIZE_ENCODED);
  $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_ENCODED);
  $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_ENCODED);
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
  $password = $hashed_password;

  $sql = "INSERT INTO users (username, password, user_type)
  VALUES ('$username', '$password', '$user_type')";
  
  if (mysqli_query($connection, $sql)) {
      echo '
<div class="alert alert-success" role="alert">
 <strong>Successfully</strong> created user
</div>';
  } else {
      echo '
<div class="alert alert-danger" role="alert">
 <strong>Error!</strong> creating user
</div>
      ';
  }

}


echo '

<form METHOD="POST">

<div class="form-group">
<label for="exampleFormControlSelect1">Type User</label>
<select name="user_type" class="form-control">
  <option value="l">Lecture</option>
  <option value="s">Student</option>
  <option value="a">Staff</option>
</select>
</div>

  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input name="username" type="text" class="form-control" aria-describedby="login" placeholder="Username">
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password" type="password" class="form-control" placeholder="Password">
  </div>

  <button name="create_user" type="submit" class="btn btn-primary">Create</button>
</form>

';

} else {

echo "Index Page";

}


?>

</div>

</body>
</html>