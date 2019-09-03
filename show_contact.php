<?PHP 
    require 'common/sql_connection.php';

         $sql = "SELECT * FROM contacts ";
        $rs = mysqli_query($db_link,$sql);

?>
<!DOCTYPE HTML>
<html>

<?php require 'common/top_header.php' ?>

<body>
  <div id="main">
    <?php require 'common/nav_header.php' ?>

    <div id="content_header"></div>
    <div id="site_content">
      <div id="banner"></div>

        <h1 class="bdr text-center">Welcome to the Pakistan Phone Book Directory</h1>

	   <?php //require 'common/side_bar.php' ?>


      <div id="content bdr">
        <!-- insert the page content here -->
           

          <table style="width:100%; border-spacing:0;">
          <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Phone#</th>
            <th>Email/User Name</th>
            <th>Occupation</th>
            <th>Gender</th>
            <th>Actions</th>

          </tr>
          <?php 
          
                $i=0;
              while ($data1 = mysqli_fetch_assoc($rs)) {
                echo '<tr>
            <td>'.++$i.'</td>
            <td>'.$data1['f_name'].''.$data1['l_name'].'</td>
            <td>'.$data1['phone_no'].'</td>
            <td>'.$data1['email'].'</td>
            <td>'.$data1['gender'].'</td>
            <td>'.$data1['gender'].'</td>
            <td><a href="">EDIT</a>|<a href="">DELETE</a></td>
          </tr>';
              }
          ?>
          
        </table>
        
      </div>
    </div>
    <?php require 'common/footer.php' ?>
  </div>
</body>
</html>
