<?php 

include 'config.php';

error_reporting(0);

session_start();


if (!isset($_SESSION['name'])) {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="welcome_style.css">

	<!--Jquery Library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>View Assignment</title>
</head>
<body>
	<header class="container-header">
        <nav class="navbar">
            <ul>
                <li><a href="logout.php"><button class="btn"> Logout </button></a></li>
            </ul>
        </nav>
    </header>

    <center>
    <table align="center" border="1px" style="width:600px; line-height:40px; margin-top: 20px;"> 
	<tr> 
		<th colspan="5"><h2>Assignment List</h2></th> 
		</tr> 
			  <th> Assignment ID </th> 
			  <th> Name </th> 
			  <th> Subject </th> 
			  <th> Access Code </th> 
			  <th> Select Assignment </th>
		</tr>

	
		<?php 



$name = $_SESSION['name'];
			//echo $name;
$query="select * from users where name ='$name'"; 
$data = mysqli_query($conn,$query);
$total = mysqli_num_rows($data);


		
		if ($total==0 && !empty($name)){
			//echo "\nNo records for this email id";
			echo '<script>alert("No records found for this email")</script>';
		}
		
	
if($total!=0){
	
	
	while(($result=mysqli_fetch_assoc($data))){

		$teacherID = $result['id'];
		//echo "TeacherID".$teacherID;
		
	}
}
	

$query1="select * from student_assignment where teacherID='$teacherID'"; 
$data1 = mysqli_query($conn,$query1);
$total1 = mysqli_num_rows($data1);


if($total1!=0){
	
	while(($result=mysqli_fetch_assoc($data1))){


		echo "
		<tr align = 'center'>
		<td class='myid'>".$result['assign_id']."</td>
		<td>".$result['assign_name']."</td><td>".$result['assign_subject']."</td><td>".$result['assign_code']."</td>
		<td><a><button class = 'btnSelect'> View </button></a></td>
		</tr>";
	}	

//	echo "Present";
}
else{
//	echo "Not found";
}
?>
</table>
	</center>
<script>
	
	$(document).ready(function(){
		// code to read selected table row cell data (values).
		$(".btnSelect").on('click',function(){
			 currentRow = $(this).closest("tr");
			 col1 = currentRow.find("td:eq(0)").html();
			 
			 // alert(col1);
			  location.href = `http://localhost/webpanel/folder/assignList.php?v_id=${col1}`
			  
			
	});
});
	
</script>

<?php
	$a_id = $_GET['v_id'];
	//echo "Value: ".$a_id;
	// here i want col1 value to be displayed, should be in php
?>
<!-- ALL SUBMISSIONS HERE -->
<center>
<table align="center" border="1px" style="width:600px; line-height:40px; margin-top: 20px;"> 
	<tr> 
		<th colspan="7"><h2>Speech Record</h2></th> 
		</tr> 
			  <th> Student Name </th>  
			  <th> File Name </th> 
			  <th> Time </th> 
			  <th> Words </th> 
			  <th> Pace </th> 
			  <th> Pitch </th> 
			  <th> Text </th>  
			  
			  
		</tr>


<?php 

$query="select * from speaches where assign_id ='$a_id'"; 
$data = mysqli_query($conn,$query);
$total = mysqli_num_rows($data);


		
		if ($total==0 && !empty($a_id)){
			//echo "\nNo records for this email id";
			echo '<script>alert("No Assignment Submitted")</script>';
		}
		
		
		

if($total!=0){
	
	while(($result=mysqli_fetch_assoc($data))){

		$student_id = $result['UserID'];
		$query1 = "select name from users where id ='$student_id'"; 
		$data1 = mysqli_query($conn,$query1);
		$result1 = mysqli_fetch_assoc($data1);

		echo "
		<tr>
		<td>".$result1['name']."</td>
		<td>".$result['file']."</td><td>".$result['time']."</td><td>".$result['words']."</td><td>".$result['pace']."</td><td>".$result['pitch']."</td><td>".$result['speach']."</td>
		</tr>";
	}
}

?> 

	</table>
	</center>
</body>
</html>