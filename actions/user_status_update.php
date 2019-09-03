<?php
    require '../common/sql_connection.php';

		    $u_id = $_GET['status'];
			$rs = mysqli_query($db_link,"SELECT * FROM users WHERE u_id=$u_id");
			$data = mysqli_fetch_assoc($rs);
			$status = $data['status'];
		if($status=='0'){
		echo $rs =  mysqli_query($db_link,"UPDATE users SET status='1' WHERE u_id=$u_id");
		header('location:../users.php');
		}
		else
		{
		echo $rs =  mysqli_query($db_link,"UPDATE users SET status='0' WHERE u_id=$u_id");
		header('location:../users.php');
		}
?>