
<?php
include_once '.\app\Views\layout\partials\header.php';
    include_once './helpers/session_helper.php';
?>
    <h1 class="header">Please Login</h1>

    <?php flash('login') ?>

    <form method="post" action="<?=ROOT_URL?>?p=AuthController&amp;a=auth">
    <input type="hidden" name="type" value="login">
        <input type="text" name="email"
        placeholder="Username/Email...">
        <input type="password" name="password"
        placeholder="Password...">
        <button type="submit" name="submit">Log In</button>
    </form>


<?php
include_once '.\app\Views\layout\partials\header.php'
?>