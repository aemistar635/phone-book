<?PHP
require 'common/sql_connection.php';


$userId = $_SESSION['user_id'] ?? "";
$userRoll = $_SESSION['user_role'] ?? "";
$f_name = $_POST['f_name'] ?? '';
$sql = "SELECT * FROM contacts 
       LEFT JOIN category ON contacts.cat_id=category.cat_id WHERE f_name like '%$f_name%' ";
// $sql = "SELECT * FROM contacts WHERE f_name like '%$f_name%'";
$page = $_GET['page'] ?? 1;
$perPage = $_GET['perPage'] ?? 10;

if (isset($_POST['btn_search'])) {
    $l_name = $_POST['l_name'];
    $address = $_POST['address'];
    $cat_id = $_POST['category'];
    $gender = $_POST['gender'];

    if ($userRoll == 'admin') {
        $email = $_POST['email'];
        $phone_no = $_POST['phone_no'];
    } else {
        $email = "";
        $phone_no = "";
    }
    if ($l_name) {
        $sql .= " AND l_name like '%$l_name%'";
    }
    if ($address) {
        $sql .= " AND address like '%$address%'";
    }
    if ($cat_id) {
        $sql .= " AND contacts.cat_id=$cat_id";
    }
    if ($email) {
        $sql .= " AND email like '%$email'";
    }
    if ($phone_no) {
        $sql .= " AND phone_no like '%$phone_no%'";
    }
    if($gender){
        $sql .="AND gender='$gender'";
    }

}
$offset = $perPage * ($page - 1);
$countQuery = mysqli_query($db_link, $sql);
$sql .= " LIMIT {$perPage} OFFSET {$offset}";
if (isset($_POST['btn_export'])) {

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition:attachment; filename=data.csv');

    $output = fopen("php://output", "w");
    fputcsv($output, ['F_NAME', 'l_NAME', 'GENDER', 'CELL#', 'EMAIL', 'ADDRESS', 'CATEGORY_ID', 'CATEGORY']);
    $s = "SELECT contacts.f_name,contacts.l_name,contacts.gender,contacts.phone_no,contacts.email,contacts.address,contacts.cat_id,category.cat_name name from contacts left join category on contacts.cat_id = contacts.cat_id ";
    $result = mysqli_query($db_link, $s);
    while ($r = mysqli_fetch_assoc($result)) {
        fputcsv($output, $r);
    }
    fclose($output);
    exit;
}
$sql;
$rs = mysqli_query($db_link, $sql);
$totalResults = mysqli_num_rows($countQuery);
$totalPages = ceil($totalResults / $perPage);

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
        <div id="banner"></div>

        <h1 class="bdr text-center">Welcome to the <span class="clr-green">PaKisTan</span> Phone Book Directory</h1>

        <?php //require 'common/side_bar.php' ?>


        <div id="content bdr">
            <!-- insert the page content here -->
            <div class="bdr">
                <div class="bdr ">
                    <h3 class="upper-case text-center text-bold">Search</h3>
                    <form method="post" action="" id="search_form">
                        <p class="bdr">
                            <input class="search" type="text" name="f_name" placeholder="Search by First Name"/>
                            <input class="search" type="text" name="l_name" placeholder="Search by Last Name"/>
                            <input class="search" type="text" name="address" placeholder="Search by Location"/>
                            <?php
                            if ($userRoll == 'admin' || $userRoll == 'user') {
                                echo '<input class="search" type="text" name="email" placeholder="Search by Email" />
                                    <input class="search" type="text" name="phone_no" placeholder="Search by Number" />';
                            }
                            ?>

                            <select id="id" name="gender" class="select-tag">
                                <option value="">Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>

                            </select>
                            <select id="id" name="category" class="select-tag">
                                <option value="">Category</option>
                                <?php
                                while ($data = mysqli_fetch_assoc($show_cat)) {
                                    echo '<option value="' . $data['cat_id'] . '">' . $data['cat_name'] . '</option>
';
                                }
                                ?>
                            </select>

                            <!-- <input name="search" type="image" style="border: 0; margin: 0 0 -9px 5px;" src="style/search.png" alt="Search" title="Search" /> -->
                            <input class="submit btn-search" type="submit" name="btn_search" value="Search"/>
                        </p>
                        <hr></hr>
                        <?php
                        if ($userRoll == 'admin') {
                            echo '<input class="submit btn-export" type="submit" name="btn_export" value="EXPORT INTO EXCEL"/>';
                        }
                        ?>

                    </form>

                </div>
            </div>

            <table style="width:100%; border-spacing:0;">
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <?php
                    if ($userRoll == 'admin' || $userRoll == 'user') {
                        echo '<th>Phone#</th>
                                   <th>Email</th>';
                    }
                    ?>

                    <th>Occupation</th>
                    <th>Gender</th>
                    <th>Location</th>

                </tr>
                <?php

                if ($sql) {
                    $i = 0;
                    while ($data1 = mysqli_fetch_assoc($rs)) {
                        echo '<tr>
            <td>' . ++$i . '</td>
            <td>' . $data1['f_name'] . '' . $data1['l_name'] . '</td>';

                        if($userRoll=='admin'|| $userRoll=='user'){
                            echo '<td>' . $data1['phone_no'] . '</td>
                                 <td>' . $data1['email'] . '</td>';
                        }


                echo '
                <td>' . $data1['cat_name'] . '</td>
                <td>' . $data1['gender'] . '</td>
                <td>' . $data1['address'] . '</td>
                </tr>';
                }

                }


                ?>

            </table>

            <?php

            for ($i = 1; $i <= $totalPages; $i++) {
                ?><a  class="paging"  href="index.php?page=<?php echo $i; ?>"  ><?php echo $i . ' ' ?></a><?php
            }
            ?>

        </div>
    </div>
    <?php require 'common/footer.php' ?>
</div>
</body>

</html>
