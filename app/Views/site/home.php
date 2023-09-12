<?php
include_once '.\app\Views\layout\partials\header.php';
include_once './helpers/session_helper.php';
?>
<?php flash('home') ?>

<h4 id="index-text">Welcome,<br/>
    <?php if (isset($_SESSION['usersId'])) {
        echo explode(" ", $_SESSION['UserName'])[0];
    } else {
        echo 'Login and Begin Your Journey';
    }
    ?> </h4>
<?php if (isset($_SESSION['usersId'])): ?>
    <p>
        <button type="button" onclick="window.location='<?= ROOT_URL ?>?p=PostController&amp;a=add'"
                class="btn btn-success">Add Post!
        </button>
    </p>
<?php endif ?>


<?php if (empty($this->posts)): ?>
    <p class="bold">There is no Blog Post.</p>
<?php else: ?>


    <div id="blog" class="row ">
        <?php foreach ($this->posts as $post): ?>
            <div class="col-md-12 ">
                <h1>
                    <a href="<?= ROOT_URL ?>?p=PostController&amp;a=show&amp;target=<?= $post->id ?>"><?= htmlspecialchars($post->title) ?></a>
                </h1>
                <article><p>
                        <?= nl2br(htmlspecialchars(mb_strimwidth($post->body, 0, 100, '...'))) ?>
                    </p></article>
                <a href="<?= ROOT_URL ?>?p=PostController&amp;a=show&amp;target=<?= $post->id ?>">READ MORE</a>
                <p class="left small italic">Posted on <?= $post->createdDate ?></p>
                <div class="row">
                    <?php if (isset($_SESSION['usersId'])): ?>
                        <?php if ($_SESSION['usersId'] == $post->user_id): ?>
                            <button type="button" onclick="window.location='<?= ROOT_URL ?>?p=PostController&amp;a=edit&amp;target=<?= $post->id ?>'"
                                    class="btn btn-primary">Update
                            </button>
                            <button type="button" onclick="window.location='<?= ROOT_URL ?>?p=PostController&amp;a=delete&amp;target=<?= $post->id ?>'"
                                    class="btn btn-danger">Delete
                            </button>
                        <?php endif ?>
                    <?php endif ?>
                </div>
            </div>

            <hr class="clear"/><br/>
        <?php endforeach ?>
    </div>

<?php endif ?>



<?php
include_once '.\app\Views\layout\partials\footer.php'
?>

