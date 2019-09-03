<?PHP
require 'common/sql_connection.php';
$userId = $_SESSION['user_id'] ?? "";
$userRoll = $_SESSION['user_role'] ?? "";
$fileUpload = 0;

if (!$userId) {
    header('location:login.php');
} else {
    if (isset($_POST['btn_save'])) {

        if ($_FILES['upload']['name']) {
            $file_name = explode('.', $_FILES['upload']['name']);
            if ($file_name[1] == 'csv') {
                $handle = fopen($_FILES['upload']['tmp_name'], "r");
                $i = 0;
                while ($data = fgetcsv($handle)) {
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    $item1 = mysqli_real_escape_string($db_link, $data[0]);
                    $item2 = mysqli_real_escape_string($db_link, $data[1]);
                    $item3 = mysqli_real_escape_string($db_link, $data[2]);
                    $item4 = mysqli_real_escape_string($db_link, $data[3]);
                    $item5 = mysqli_real_escape_string($db_link, $data[4]);
                    $item6 = mysqli_real_escape_string($db_link, $data[5]);
                    $item7 = mysqli_real_escape_string($db_link, $data[6]);

                    $s = "INSERT INTO contacts (f_name,l_name,gender,phone_no,email,address,cat_id)
values ('$item1','$item2','$item3','$item4','$item5','$item6','$item7')";
                    mysqli_query($db_link, $s);
//                        $_SESSION['uploaded'] = 1;
                    $fileUpload = 1;
                }
                fclose($handle);
                echo "import done";
            }
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

            <h1 class="bdr text-center">Import-Contact's</h1>
            <hr></hr>
            <!-- insert the page content here -->
            <form action="" class="" method="post" enctype="multipart/form-data">
                <div class="form_settings bdr ">
                    <table class="bdr sign-up-table text-center2">
                        <tr>
                            <td>FILE UPLOAD</td>
                            <td><input type="file" name="upload" placeholder="Upload File" required/></td>
                        </tr>
                        <?php
                        if ($fileUpload == 1) {
                            echo '<tr>
                                        <td colspan="2s"><p class="text-canter text-success">File Is Uploaded Successfully</p></td>
                                    </tr>';
                        }
                        ?>
                        <tr>
                            <td colspan="2"><input class="submit sign-up" type="submit" name="btn_save"
                                                   value="SAVE CONTACT"/></td>
                        </tr>
                    </table>

                </div>
            </form>


        </div>
        <?php require 'common/footer.php' ?>
    </div>
    </body>
    </html>
    <?php
}
?>