<?PHP 
    require '../common/sql_connection.php';
    
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";

    $cat_id = $_GET['u_id'];
    $sql = mysqli_query($db_link,"SELECT * FROM category WHERE cat_id=$cat_id");
    $data = mysqli_fetch_assoc($sql);
    $cat_name = $data['cat_name'];

    if (isset($_POST['btn_update'])) {
       $c_name = $_POST['cat_name'];
       $update = mysqli_query($db_link,"UPDATE category SET cat_name='$c_name' where cat_id='$cat_id'");
       header('location:../insert_cat.php');

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

        <h1 class="bdr text-center">UPDATE-CATEGORY</h1>
        <hr></hr>
        <!-- insert the page content here -->
          <form action="#" class="bdr" method="post">
          <div class="form_settings text-center">
            <table class="cat-table">
              <tr>
                  <td>CATEGORY NAME</td>
                  <td >
                    <input type="text" class="cat-long-text" name="cat_name" value="<?php echo $cat_name; ?>" required/>
                  </td>
                  
              </tr>
             <tr>
              <td colspan="2"><input class="submit sign-up" type="submit" name="btn_update" value="UPDATE CATEGORY" /></td>
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