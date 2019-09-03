<?PHP 
    require 'common/sql_connection.php';
    $userId = $_SESSION['user_id'] ?? "";
    $userRoll = $_SESSION['user_role'] ?? "";

    if(!$userId){
      header('location:login.php');
    }
    else{
 
    $show_cat = mysqli_query($db_link,"SELECT * FROM category");
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

        <h1 class="bdr text-center">SEE ALL UER's</h1>
        <hr></hr>
        <!-- insert the page content here -->
          

<table style="width:100%; border-spacing:0;">
          <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <?php 
              if ($userRoll=='admin') {
                  echo '<th>Action</th>
                        <th>Status</th>';
              }
            ?>
          </tr>
          <?php 
              if($userRoll=='admin'){
               $sql = "SELECT * FROM users";
              }

              $rs = mysqli_query($db_link,$sql);
              $i=0;
              if($rs){
              while ($data1 = mysqli_fetch_assoc($rs)) {
                echo '<tr>
                      <td>'.++$i.'</td>
                      <td>'.$data1['f_name'].' '.$data1['l_name'].'</td>
                      <td>'.$data1['email'].'</td>
                      <td>'.$data1['password'].'</td>
                      <td>'.$data1['role'].'</td>';
                      if ($userRoll =='admin') {
                          echo '<td class="text-dec"><a href="actions/update_user.php?u_id='.$data1['u_id'].'">EDIT</a></td>';
                            if($data1['status']== 0){
                            echo '<td class="text-dec"><a href="actions/user_status_update.php?status='.$data1['u_id'].'" class="text-danger">Pending</a></td>';
                              }
                              else{
                            echo '<td class="text-dec"><a href="actions/user_status_update.php?status='.$data1['u_id'].'" class="text-success">Active</a></td>';
                              }

                                                        
                      }
            
                    echo '</tr>';
              }
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
?>