<?php 

include 'config.php';

session_start();

error_reporting(0);

if (!isset($_SESSION['name'])) {
    header("Location: index.php");
}
//Here it starts

$name = $_SESSION['name'];
			//echo $emailadd;
//echo "<script type='text/javascript'>alert('$name');</script>";

$query="select * from users where name ='$name'"; 
$data = mysqli_query($conn,$query);
$total = mysqli_num_rows($data);


		/*
		if ($total==0 && !empty($name)){
			//echo "\nNo records for this email id";
			echo '<script>alert("No records found for this email")</script>';
		}
		*/
		
		
		

if($total!=0){
	
	while(($result=mysqli_fetch_assoc($data))){

		$teacherID = $result['id'];
		//echo "User".$userid;
		
	}
}
//Here it ends

if (isset($_POST['submit'])) {
	$assign_name = $_POST['assign_name'];
	$assign_subject = $_POST['assign_subject'];
	$assign_code = $_POST['assign_code'];
	
	
		$sql = "SELECT * FROM student_assignment WHERE assign_name ='$assign_name'";
		$result = mysqli_query($conn, $sql);
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO student_assignment (assign_name, assign_subject, assign_code, teacherID)
					VALUES ('$assign_name', '$assign_subject', '$assign_code', $teacherID)";
			$result = mysqli_query($conn, $sql);
			if ($result) {
				echo "<script>alert('Wow! Assignment created successfully.')</script>";
				$assign_name = "";
				$assign_subject = "";
				$assign_code = "";
			} else {
				echo "<script>alert('Woops! Something Wrong Went.')</script>";
			}
		} else {
			echo "<script>alert('Woops! Assignment Already Exists.')</script>";
		}
		
	
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="welcome_style.css">
    <title>Welcome</title>
</head>
<body>
	<!--
    <?php echo "<h1>Welcome " . $_SESSION['name'] . "</h1>"; ?>

-->
	
	<header class="container-header">
        <nav class="navbar">
            <ul>
                <li><a href="logout.php"><button class="btn"> Logout </button></a>	</li>
            </ul>
        </nav>
    </header>
    
    <center>
    <div class="container">
		<form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Create Assignment</p>
			<div class="input-group">
				<input type="text" placeholder="Assignment Name" name="assign_name" value="<?php echo $assign_name; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Subject" name="assign_subject" value="<?php echo $email; ?>" required>
			</div>
			<div class="input-group">
				<input type="text" placeholder="Code" name="assign_code" value="<?php echo $assign_code; ?>" required>
			</div>
			
			<div class="input-group">
				<button name="submit" class="btn">Create</button>
			</div>
			<p class="login-register-text">Want to view Assignments? <a href="assignList.php">View Here</a></p>
		</form>
	</div>
	</center>


    
</body>
</html>