<?php
    require 'common/sql_connection.php';
    $c = 0;
$user_exist = 0;
    if(isset($_POST['btn_signup'])){

      $f_name  = $_POST['f_name'];
      $l_name  = $_POST['l_name'];
      $email  = $_POST['email'];
      $password  = $_POST['password'];
      $c_password  = $_POST['c_password'];


      if($password == $c_password){
           $s = "SELECT * FROM users WHERE email='$email'";
          $r = mysqli_query($db_link, $s) or die(mysqli_error());
          if($user_ex = mysqli_num_rows($r)>0){
                    $user_exist = 1;
            }
            else {
              $sql = "INSERT INTO users (f_name,l_name,email,password,role,status) VALUES('$f_name','$l_name','$email','$password','user','0')";
              $rs = mysqli_query($db_link, $sql);

              if ($rs) {
                  header('location:login.php');
              } else {
                  echo "your record not save";
              }
          }
      }
      else{
          $c = 1;
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


        <h1 class="bdr text-center">Registration</h1>
        <hr></hr>
        <!-- insert the page content here -->
          <form action="" class="bdr" method="post">
          <div class="form_settings text-center">
            <table class="sign-up-table">
              <tr>
                  <td><input type="text" name="f_name" placeholder="Enter First Name" required /></td>
                  <td><input type="text" name="l_name" placeholder="Enter Last Name"  required/></td>
              </tr>
              <tr>
                  <td colspan="2">
                  <?php
                        if($user_exist=='0'){
                          echo '<input type="text" class="long-text" name="email" placeholder="Enter Mail/User Name" required  />';
                        }
                        if ($user_exist=='1'){

                            echo ' <input type="lont-text text" style="color: red;" name="email" value="This Email/Username Already Exist" required/>';

                        }
                  ?>


                  </td>

              </tr>
              <?php

                    if(!$c == 1){

                        echo '<tr>
                  <td colspan="2">
                    <input type="password" class="long-text" name="password" placeholder="Enter Password" required/>
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                    <input type="password" class="long-text" name="c_password" placeholder="Confirm Password" required/>
                  </td>
              </tr>';
                    }
                    else{

                        echo '<tr>
                  <td colspan="2">
                    <input type="password" class="long-text" name="password" placeholder="Enter Password" required/>
                  </td>
              </tr>
              <tr>
                  <td colspan="2">
                    <input type="text" style="color: red;" name="c_password" value="Please Enter same as above password" required/>
                  </td>
              </tr>';

                    }

              ?>

            <tr>
              <td colspan="2"><input class="submit sign-up" type="submit" name="btn_signup" value="SIGNUP" /></td?
            </tr>
            </table>

          </div>
        </form>
  </div>
    <?php require 'common/footer.php' ?>
  </div>
</body>
</html>
