<?PHP
require 'common/sql_connection.php';
$userId = $_SESSION['user_id'] ?? "";
$userRoll = $_SESSION['user_role'] ?? "";
$r_save = 0;
if (!$userId) {
    header('location:login.php');
} else {
    if (isset($_POST['btn_save'])) {

        $status = 1;
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $cat_id = $_POST['category'];
        $gender = $_POST['gender'];
        $phone_num = $_POST['phone_num'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $creator = $userRoll;
        if ($creator = 'user') {
            $status = 0;
        }
        $sql = "INSERT INTO contacts (f_name,l_name,cat_id,gender,phone_no,email,address,creator,status) VALUES ('$f_name','$l_name','$cat_id','$gender','$phone_num','$email','$address','$creator',$status)";
        $rs = mysqli_query($db_link, $sql);
        if ($rs) {
            ++$r_save;
        } else {
            --$r_save;
        }
    }

    $show_cat = mysqli_query($db_link, "SELECT * FROM category");

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

            <h1 class="bdr text-center">Insert-Contact</h1>
            <hr></hr>
            <!-- insert the page content here -->
            <p class="msg-success">
                <?php
                if ($r_save == 1) {
                    echo 'Contact Save Successfully';
                }
                ?>
            </p>
            <form action="" class="bdr" method="post">
                <div class="form_settings text-center">
                    <table class="sign-up-table">
                        <tr>
                            <td><input type="text" name="f_name" placeholder="Enter First Name" required/></td>
                            <td><input type="text" name="l_name" placeholder="Enter Last Name" required/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <select id="id" name="category" class="select-tag2">
                                    <option>Select Category</option>
                                    <?php
                                    while ($data = mysqli_fetch_assoc($show_cat)) {
                                        echo '<option value="' . $data['cat_id'] . '">' . $data['cat_name'] . '</option>
';
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <label>Female</label><input type="radio" name="gender" checked value="female"/>
                                <label>Male</label><input type="radio" name="gender" value="male"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="number" class="long-text" name="phone_num" placeholder="Enter Phone No"
                                       required minlength="11" maxlength="11"/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" class="long-text" name="email" placeholder="Enter Mail" required/>
                            </td>

                        </tr>
                        <tr>
                            <td colspan="2">
                                <input type="text" class="long-text" name="address" placeholder="Enter address"
                                       required/>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><input class="submit sign-up" type="submit" name="btn_save"
                                                   value="SAVE CONTACT"/></td>
                        </tr>
                    </table>

                </div>
            </form>

            <br>
            <hr></hr>
            <br>
            <table style="width:100%; border-spacing:0;">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Phone#</th>
                    <th>Email</th>
                    <th>Occupation</th>
                    <th>Gender</th>
                    <th>Location</th>
                    <?php
                    if ($userRoll == 'admin') {
                        echo '<th>Action</th>
                        <th>Status</th>';
                    }
                    ?>
                </tr>
                <?php
                if ($userRoll == 'admin') {
                    $sql = "SELECT * FROM contacts LEFT JOIN category 
               ON contacts.cat_id=category.cat_id";
                } else {
                    $sql = "SELECT * FROM contacts LEFT JOIN category 
               ON contacts.cat_id=category.cat_id where status=1";
                }

                $rs = mysqli_query($db_link, $sql);
                $i = 0;
                if ($rs) {
                    while ($data1 = mysqli_fetch_assoc($rs)) {
                        echo '<tr>
                      <td>' . ++$i . '</td>
                      <td>' . $data1['f_name'] . ' ' . $data1['l_name'] . '</td>
                      <td>' . $data1['phone_no'] . '</td>
                      <td>' . $data1['email'] . '</td>
                      <td>' . $data1['cat_name'] . '</td>
                      <td>' . $data1['gender'] . '</td>
                      <td>' . $data1['address'] . '</td>';
                        if ($userRoll == 'admin') {
                            echo '<td class="text-dec"><a href="actions/update_contact.php?u_id=' . $data1['c_id'] . '">EDIT</a>|<a href="actions/delete_contact.php?del_id=' . $data1['c_id'] . '">Delete</a></td>';
                            if ($data1['status'] == 0) {
                                echo '<td class="text-dec"><a href="actions/contact_status_update.php?status=' . $data1['c_id'] . '" class="text-danger">Pending</a></td>';
                            } else {
                                echo '<td class="text-dec"><a href="actions/contact_status_update.php?status=' . $data1['c_id'] . '" class="text-success">Active</a></td>';
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