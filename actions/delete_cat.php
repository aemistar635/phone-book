<?PHP 
    require '../common/sql_connection.php';
    
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";

    $cat_id = $_GET['del_id'];
    $rs = mysqli_query($db_link,"DELETE FROM category WHERE cat_id=$cat_id");
    header('location:../insert_cat.php')
?>