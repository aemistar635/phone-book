<?php

$userId = $_SESSION['user_id'] ?? "";
$userRoll = $_SESSION['user_role'] ?? "";

if ($userId) {
    echo '<div class="top-nav"><div class="top-nav-login"><a href="logout.php">Logout</a></div></div>';
} else {
    echo '<div class="top-nav"><div class="top-nav-login"><a href="login.php">Login</a>|<a href="signup.php">Signup</a></div></div>';
}
?>
<div id="header">
    <div id="logo">
        <div id="logo_text">
            <!-- class="logo_colour", allows you to change the colour of the text -->
            <h1><a href="index.php"><span class="clr-green">PaKisTan</span> Phone_<span
                            class="logo_colour"> Book</span></a></h1>
            <h2>Provide contacts....</h2>
        </div>
    </div>
    <div id="menubar">
        <ul id="menu">
            <!-- put class="selected" in the li tag for the selected page - to highlight which page you're on -->
            <li class="selected"><a href="index.php">Home</a></li>
            <?php
            if ($userRoll == 'admin') {
                echo '<li><a href="insert_contact.php">Insert Contacts</a></li>
                      <li><a href="import_contact.php">Import</a></li>
                      <li><a href="insert_cat.php">Insert Category</a></li>
                      <li><a href="users.php">Users</a></li>';

            }
            if ($userRoll == 'user') {
                echo '<li><a href="insert_contact.php">Insert Contact</a></li>';
            }
            ?>

            <li><a href="contact_us.php">Contact Us</a></li>

        </ul>
    </div>
</div>