<?php

require '../includes/url.php';
require '../classes/Database.php';
require '../includes/auth.php';
require '../classes/User.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $db = new Database();
    $conn = $db->getConn();

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])) {

        session_regenerate_id(true); // new id will prevent theft of a session from logged-in user 

        $_SESSION['is_logged_in'] = true;

        redirect('/admin');

    } else {

        $error = "login incorrect";

    }
}

?>
<?php require '../includes/header.php'; ?>

<h3>Login</h3>

<?php if (! empty($error)) : ?>
    <p><?= $error ?></p>
<?php endif; ?>

<form method="post">

    <div class="form-group">
        <label for="username">Username</label>
        <input name="username" id="username"  class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password"  class="form-control">
    </div>

    <button class="btnbtn-primary">Log in</button>

</form>

<?php require '../includes/footer.php'; ?>
