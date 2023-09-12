<?php
if(!isset($_SESSION))
{
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> M.Montaser Blog </title>
    <link rel="stylesheet" href="./assets/style/style.css" type="text/css">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav>
    <ul>
        <a href="<?=ROOT_URL?>"><li>Home</li></a>
        <?php if(!isset($_SESSION['usersId'])) : ?>
            <a href="<?=ROOT_URL?>?p=AuthController&amp;a=signup"><li>Sign Up</li></a>
            <a href="<?=ROOT_URL?>?p=AuthController&amp;a=login"><li>Login</li></a>
        <?php else: ?>
            <a href="<?=ROOT_URL?>?p=AuthController&amp;a=logout"><li>Logout</li></a>
        <?php endif; ?>
    </ul>
</nav>
<div class="container text-center">