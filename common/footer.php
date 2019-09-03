<?php

$userId = $_SESSION['user_id'] ?? "";
$userRoll = $_SESSION['user_role'] ?? "";

?>
<div id="content_footer"></div>
    <div id="footer">
      <p><a href="index.php">Home</a> |
<?php
if ($userRoll == 'admin') {

echo '<a href="insert_contact.php">Insert Contacts</a>|<a href="import_contact.php">Import</a>|
      <a href="insert_cat.php">Insert Category</a>|<a href="users.php">Users</a></li>';
}
if ($userRoll == 'user') {
                echo '<a href="insert_contact.php">Insert Contact</a>';
}
?>
 | <a href="contact_us.php">Contact Us</a>
        <p class="text-dec "><a class="text-white" href="http://schoolpk.com/" >Copyright &copy; schoolpK </a></p>
    </div>



