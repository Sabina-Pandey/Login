<?php 

include 'config.php';

session_start();

error_reporting(0);

if (isset($_SESSION['firstname'])) {
    header("Location: welcome.php");
}

if (isset($_POST['Submit'])) {
	$email = $_POST['email'];
	$password = ($_POST['password']);
   
	$sql = "SELECT * FROM signform WHERE email='$email' AND password='$password'";
	$result = mysqli_query($conn, $sql);

	if ($result->num_rows > 0) {
		$row = mysqli_fetch_assoc($result);
		$_SESSION['firstname'] = $row['firstname'];
		header("Location: welcome.php");
	} else {
		echo "<script>alert('Woops! Email or Password is Wrong.')</script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
</head>
<body>
    <div class="container">
        <h1>Welcome to the Login Page!!</h1>

        <br></br>

        <form action="" method="POST">
            Email : <input type="email" name="email" placeholder="Enter Your email" 
			value="<?php echo $email; ?>" required> <br></br>

            Password: <input type="password" name="password" placeholder="Enter Your Password"  
			value="<?php echo $_POST['password']; ?>" required> <br></br>
	
            <button name="Submit" class="btn">Login</button>

            <p class="demo">Don't have an account? <a href="register.php">SignUp Here</a></p>
             
        </form>  
    </div>
</body>
</html>
