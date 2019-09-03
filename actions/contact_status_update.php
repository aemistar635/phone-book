<?php
    require '../common/sql_connection.php';

		$contact_id = $_GET['status'];
		$rs = mysqli_query($db_link,"SELECT * FROM contacts WHERE c_id=$contact_id");
			$data = mysqli_fetch_assoc($rs);
			$status = $data['status'];
			if($status=='0'){
		$rs =  mysqli_query($db_link,"UPDATE contacts SET status=1 WHERE c_id=$contact_id");
		header('location:../insert_contact.php');
			}
			else{
			$rs =  mysqli_query($db_link,"UPDATE contacts SET status=0 WHERE c_id=$contact_id");
		header('location:../insert_contact.php');	
			}
?>