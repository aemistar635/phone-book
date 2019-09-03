<?PHP 
    require 'common/sql_connection.php';
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";
    
    if(!$userId){
      header('location:login.php');
    }
    else{
           $u_contact = $_GET['u_id'];
          $s = "SELECT * FROM contacts WHERE c_id =$u_contact";
         $show = mysqli_query($db_link,$s) or die(mysql_error($s));
          $record = mysqli_fetch_assoc($show);
          
          $cat_id = $record['cat_id'];

    if(isset($_POST['btn_update'])){

        
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $cat_id = $_POST['category'];
        $gender = $_POST['gender'];
        $phone_num = $_POST['phone_num'];
        $email = $_POST['email'];
        $address = $_POST['address'];
      
       $sql = "UPDATE contacts SET f_name='$f_name',l_name='$l_name',cat_id='$cat_id',gender='$gender',phone_no='$phone_num',email='$email',address='$address' WHERE c_id='$u_contact'";
       echo $rs = mysqli_query($db_link,$sql);
        if($rs){
        header('location:index.php');
        echo 'good';
        }
        else {echo "bad";}
    }

    $show_cat = mysqli_query($db_link,"SELECT * FROM category ");

?>
<!DOCTYPE HTML>
<html>
<style type="text/css">
  
</style>
<?php require 'common/top_header.php' ?>

<body>
  <div id="main">
    <?php require 'common/nav_header.php' ?>

    <div id="content_header"></div>
    <div id="site_content">

        <h1 class="bdr text-center">Welcome to the <span class="clr-green">PaKisTan</span> Phone Book Directory</h1>

        <h1 class="bdr text-center">UPDATE-CONTACT</h1>
        <hr></hr>
        <!-- insert the page content here -->
          <form action="" class="bdr" method="post">
          <div class="form_settings text-center">
            <table class="sign-up-table">
              <tr>
                <td>FIRSR NAME</td>
                  <td><input type="text" name="f_name" value="<?php echo $record['f_name']?>" required /></td>
              </tr>
              <tr>    
                  <td>LAST NAME</td>
                  <td><input type="text" name="l_name" value="<?php echo $record['l_name']?>" required/></td>
              </tr>
              <tr>
                <td>CATEGORY</td>
                  <td>
                      <select id="id" name="category" value="<?php echo $cat_id ?>">
                        <?php
                            while($data = mysqli_fetch_assoc($show_cat)){
                              echo '<option value="'.$data['cat_id'].'">'.$data['cat_name'].'</option>
';
                            }
                        ?>
                      </select>
                  </td>
              </tr>
              <tr>
                <td>GENDER</td>
                  <td >
                    <input type="text" class="long-text" name="gender" value="<?php echo $record['gender'] ?>" required/>

                  </td>
              </tr> 
              <tr>
                <td>PHONE NO</td>
                  <td >
                    <input type="number" class="long-text" name="phone_num" value="<?php echo $record['phone_no'] ?>"placeholder="Enter Phone No" required/>
                  </td>
              </tr>
              <tr>
                <td>EMAIL</td>
                  <td >
                    <input type="text" class="long-text" name="email" value="<?php echo $record['email'] ?>" placeholder="Enter Mail" required  />
                  </td>
                  
              </tr> 
              <tr>
                <td>ADDRESS</td>
                  <td>
                    <input type="text" class="long-text" name="address" value="<?php echo $record['address'] ?>" placeholder="Enter address" required/>
                  </td>
              </tr>
             <tr>
              <td colspan="2"><input class="submit sign-up" type="submit" name="btn_update" value="UPDATE CONTACT" /></td>
             </tr>
            </table>
            
          </div>
        </form>

<br><hr></hr><br>

  </div>
    <?php require 'common/footer.php' ?>
  </div>
</body>
</html>
<?php
}
?>