<?php 
include_once 'config.php';

if (isset($_POST['ugcourse_id'])) {
	$query = "SELECT * FROM ugcourse where c_id=".$_POST['ugcourse_id'];
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
			echo '<option value="">Select ugcourse</option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['id'].'>'.$row['course_name'].'</option>';
		 }
	}else{

		echo '<option>No ugcourse Found!</option>';
	}

}elseif (isset($_POST['semester_id'])) {
	$query = "SELECT * FROM ugsemester where s_id=".$_POST['semester_id'];
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
			echo '<option value="">Select ugsemester</option>';
		 while ($row = $result->fetch_assoc()) {
		 	echo '<option value='.$row['id'].'>'.$row['semester_no'].'</option>';
		 }
	}else{

		echo '<option>No ugsemester Found!</option>';
	}
} elseif (isset($_POST['year_id'])) {
	$query = "SELECT * FROM ugyear WHERE y_id=".$_POST['year_id'];
	$result = $db->query($query);
	if ($result->num_rows > 0 ) {
		echo '<option value="">Select ugyear</option>';
		while ($row = $result->fetch_assoc()) {
			echo '<option value='.$row['id'].'>'.$row['year_no'].'</option>';
		}
	}else{
		echo '<option>No ugyear Found!</option>';
	}	

}


?>