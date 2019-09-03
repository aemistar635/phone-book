<?PHP 
    require '../common/sql_connection.php';
    
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";

    $u_id = $_GET['u_id'];
    $sql = mysqli_query($db_link,"SELECT * FROM users WHERE u_id=$u_id");
    $data = mysqli_fetch_assoc($sql);
    $role = $data['role'];

    if (isset($_POST['btn_update'])) {
       $role = $_POST['role'];
       $update = mysqli_query($db_link,"UPDATE users SET role='$role' where u_id='$u_id'");
       header('location:../users.php');

     }

?>
<!DOCTYPE HTML>
<html> 

<?php require '../common/top_header.php' ?>

<body>
  <div id="main">
    <?php //require '../common/nav_header.php' ?>

    <div id="content_header"></div>
    <div id="site_content">

        <h1 class="bdr text-center">Welcome to the <span class="clr-green">PaKisTan</span> Phone Book Directory</h1>

        <h1 class="bdr text-center">UPDATE-USER</h1>
        <hr></hr>
        <!-- insert the page content here -->
          <form action="" class="bdr" method="post">
          <div class="form_settings text-center">
            <table class="cat-table">
              <tr>
                  <td>CURRENT ROLE</td>
                  
                  <td >
                    <input type="text" class="cat-long-text" readonly value="<?php echo  $role; ?>" required/>
                  </td>
              </tr>
              <tr>
                  <td>UPDATE ROLE</td>
                  <td >
                      <select name="role">
                            <option vaule="user">user</option>
                            <option vaule="admin">admin</option>

                      </select> 
                    
                  </td>
                  
              </tr>
             <tr>
              <td colspan="2"><input class="submit sign-up" type="submit" name="btn_update" value="UPDATE" /></td>
             </tr>
            </table>
            
          </div>
        </form>

        <br><hr></hr><br>

  </div>
  </div>
</body>
</html>
<?php

?>