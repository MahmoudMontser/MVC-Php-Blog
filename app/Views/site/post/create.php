<?php
include_once '.\app\Views\layout\partials\header.php';
include_once './helpers/session_helper.php';
?>

    <h1 class="header">Add Your Post Data</h1>

    <?php flash('create') ?>

    <form method="post" action="<?=ROOT_URL?>?p=PostController&amp;a=store">
        <input type="text" name="title"
        placeholder="Post Title...">
        <textarea  placeholder="Post Body..." name="body">

        </textarea>
        <button type="submit" name="submit">Create</button>
    </form>

<?php
include_once '.\app\Views\layout\partials\header.php'
?>