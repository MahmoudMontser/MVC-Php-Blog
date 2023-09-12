<?php
include_once '.\app\Views\layout\partials\header.php';
include_once './helpers/session_helper.php';
?>

    <h1 class="header">Edit Your Post Data</h1>

    <?php flash('edit') ?>

    <form method="post" action="<?=ROOT_URL?>?p=PostController&amp;a=update&amp;target=<?=$this->post->id ?>">
        <input type="text" name="title"
        placeholder="Post Title..." value=" <?=$this->post->title ?>">
        <textarea  placeholder="Post Body..." name="body" >

               <?=$this->post->body ?>
        </textarea>
        <button type="submit" name="submit">Update</button>
    </form>

<?php
include_once '.\app\Views\layout\partials\header.php'
?>