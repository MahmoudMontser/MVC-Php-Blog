<?php
include_once '.\app\Views\layout\partials\header.php';
include_once './helpers/session_helper.php';
?>

    <h1 class="header">Please Signup</h1>

    <?php flash('register') ?>

    <form method="post" action="<?=ROOT_URL?>?p=AuthController&amp;a=register">
        <input type="text" name="name"
        placeholder="Full name...">
        <input type="text" name="email"
        placeholder="Email...">
        <input type="password" name="password"
        placeholder="Password...">
        <input type="password" name="password_confirmation"
        placeholder="Repeat password">
        <button type="submit" name="submit">Sign Up</button>
    </form>

<?php
include_once '.\app\Views\layout\partials\header.php'
?>