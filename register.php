<?php 
include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['firstname'])) {
    header("Location: login.php");
}
if (isset($_POST['Submit'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
	$cpassword = $_POST['cpassword'];
    $number = $_POST['number'];
    $Gender = $_POST['Gender'];
	

	if ($password == $cpassword) {
		$sql = "SELECT * FROM signform WHERE email='$email'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO signform (firstname, lastname, email, password, number, Gender)
					VALUES ('$firstname', '$lastname', '$email', '$password', '$number', '$Gender')";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! User Registration Completed.')</script>";
				$firstname = "";
                $lastname = "";
				$email = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
                $number="";
                $Gender="";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Email Already Exists.')</script>";
		}
		
	} else {
		echo "<script>alert('Password Not Matched.')</script>";
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    
</head>
<body>
    <div class="container">
        <h1>Welcome to the SignUp Page!</h1>

        <br></br>

        <form action="register.php" method="POST">
            First Name : <input type="text" name="firstname" placeholder="Enter Your FirstName"
			 value="<?php echo $firstname; ?>" required> <br></br>

            Last Name : <input type="text" name="lastname" placeholder="Enter Your LastName" 
			value="<?php echo $lastname; ?>" required> <br></br>

            Email : <input type="email" name="email" placeholder="Enter Your email" 
			value="<?php echo $email; ?>" required> <br></br>

            Password: <input type="password" name="password" placeholder="Enter Your Password"  
			value="<?php echo $_POST['password']; ?>" required> <br></br>
	
			Confirm Password: <input type="password" placeholder="Confirm Password" name="cpassword"
				value="<?php echo $_POST['cpassword']; ?>" required> <br></br>
			
            Mobile Number: <input type="number" name="number" placeholder="Enter Your Mobile Number"
			 value="<?php echo $_POST['number']; ?>" required> <br></br>

            Gender: <input type="text" name="Gender" placeholder="Enter Your Gender" 
			value="<?php echo $Gender; ?>" required> <br></br>

            <input type="Submit" name="Submit" value="Sign Up">

            <br></br>

            <p class="demo">Have an account? <a href="login.php">Login Here</a></p>
            
        </form>  
    </div>
</body>
</html>
