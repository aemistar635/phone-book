<?PHP 
    require 'common/sql_connection.php';
        $u_status = "";

    if(isset($_POST['btn_login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];
        $_SESSION['user_id']='';
        $_SESSION['user_role']='';

       $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $rs = mysqli_query($db_link,$sql);
        if ($row = mysqli_num_rows($rs)==1) {
            $data = mysqli_fetch_assoc($rs);
            $user_status = $data['status'];
            $_SESSION['user_role'] = $data['role'];
            $_SESSION['user_id'] = $data['u_id'];

            if($user_status==1){

            header('location:index.php');
          }else{
              
                 $u_status='0';

          }

         // echo  "record save successfully";
        }
        else{
          echo "record not save";
        }
    }


?>
<!DOCTYPE HTML>
<html>
<?php require 'common/top_header.php' ?>

<body>
  <div id="main">
    <?php require 'common/nav_header.php' ?>

    <div id="content_header"></div>
    <div id="site_content">

        <h1 class="bdr text-center">Welcome to the <span class="clr-green">PaKisTan</span> Phone Book Directory</h1>

        <!-- insert the page content here -->
          <form action="" class="bdr" method="post">
          <div class="form_settings text-center">
        
            <?php if($u_status=='0')
                  echo '<p class="login_status">Your Account is not activated by admin pleas<br>
                   waite for your Account Activation</p>'

             ?>
            <p><input type="text" name="email" placeholder="Enter Mail/User Name" value="" /></p>
            <p><input type="password" name="password" placeholder="Enter Password" value=""/></p>
            <p><input class="submit login" type="submit" name="btn_login" value="LOGIN" /></p>
          </div>
        </form>
  </div><br><br><br><br><br><br>
    <?php require 'common/footer.php' ?>
  </div>
</body>
</html>
