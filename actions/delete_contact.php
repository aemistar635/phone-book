<?PHP 
    require '../common/sql_connection.php';
    
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";

    $c_id = $_GET['del_id'];
    $rs = mysqli_query($db_link,"DELETE FROM contacts WHERE c_id=$c_id");
    header('location:../insert_contact.php')
?>