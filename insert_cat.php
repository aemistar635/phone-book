<?PHP 
    require 'common/sql_connection.php';
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";
    $r_save = 0;
    if($userId != "" && $userRoll=='admin')
    {
    

    if(isset($_POST['btn_save'])){

      $category = $_POST['cat_name'];
      $sql = "INSERT INTO category (cat_name) values ('$category')";
      $rs  = mysqli_query($db_link,$sql);
        if ($rs) {
            ++$r_save;
        } else {
            --$r_save;
        }
    }

    $show_cat = mysqli_query($db_link,"SELECT * FROM category ORDER BY cat_name ASC");

?>
<!DOCTYPE HTML>
<html>

</style>
<?php require 'common/top_header.php' ?>

<body>
  <div id="main">
    <?php require 'common/nav_header.php' ?>

    <div id="content_header"></div>
    <div id="site_content">

        <h1 class="bdr text-center">Welcome to the <span class="clr-green">PaKisTan</span> Phone Book Directory</h1>

        <h1 class="bdr text-center">Insert-Contact</h1>
        <hr></hr>
        <!-- insert the page content here -->
         <p class="msg-success"><?php
                               if ($r_save == 1) {
                                   echo 'Contact Save Successfully';
                               }
                               ?> </p >
          <form action="" class="bdr" method="post">
          <div class="form_settings text-center">
            <table class="cat-table">
              <tr>
                  <td >
                    <input type="text" class="cat-long-text" name="cat_name" placeholder="Enter Category" required/>
                  </td>
                  <td >
                    <select id="id" name="category" class="select-tag2">
                        <option value="1">CATEGORY</option>
                        <?php
                            while($data = mysqli_fetch_assoc($show_cat)){
                              echo '<option value="">'.$data['cat_name'].'</option>
';
                            }
                        ?>
                      </select>
                  </td>
              </tr>
             <tr>
              <td colspan="2"><input class="submit sign-up" type="submit" name="btn_save" value="SAVE CATEGORY" /></td>
             </tr>
            </table>
            
          </div>
        </form>

        <br><hr></hr><br>
<table style="width:100%; border-spacing:0;">
          <tr>
            <th>S.No</th>
            <th>Category Name</th>
            <th>Action</th>
          </tr>
          <?php 
              
               $sql = "SELECT * FROM category";

              $rs = mysqli_query($db_link,$sql);
              $i=0;
              while ($data1 = mysqli_fetch_assoc($rs)) {
                echo '<tr>
                      <td>'.++$i.'</td>
                      <td>'.$data1['cat_name'].'</td>
                      <td class="text-dec"><a href="actions/update_cat.php?u_id='.$data1['cat_id'].'">EDIT</a>|<a href="actions/delete_cat.php?del_id='.$data1['cat_id'].'">Delete</a></td>
                      </tr>';
                      }
            
         ?>
          
        </table>
  </div>
    <?php require 'common/footer.php' ?>
  </div>
</body>
</html>
<?php
}
else{
  header('location:index.php');
}
?>