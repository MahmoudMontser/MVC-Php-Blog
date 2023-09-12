
<?php
include_once '.\app\Views\layout\partials\header.php';
include_once './helpers/session_helper.php';
?>

    <h1 class="header">Show Post</h1>

    <?php flash('show') ?>

<div id="blog" class="row ">
        <div class="col-md-12 ">
            <h1>
                <a href="<?= ROOT_URL ?>?p=PostController&amp;a=show&amp;target=<?= $this->post->id ?>"><?= htmlspecialchars($this->post->title) ?></a>
            </h1>
            <article><p>
                    <?= nl2br(htmlspecialchars($this->post->body)) ?>
                </p></article>
            <p class="left small italic">Posted on <?= $this->post->createdDate ?></p>
            <div class="row">
                <?php if (isset($_SESSION['usersId'])): ?>
                    <?php if ($_SESSION['usersId'] == $this->post->user_id): ?>
                        <button type="button" onclick="window.location='<?= ROOT_URL ?>?p=PostController&amp;a=edit&amp;target=<?= $this->post->id ?>'"
                                class="btn btn-primary">Update
                        </button>
                        <button type="button" onclick="window.location='<?= ROOT_URL ?>?p=PostController&amp;a=delete&amp;target=<?= $this->post->id ?>'"
                                class="btn btn-danger">Delete
                        </button>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>

        <hr class="clear"/><br/>
</div>

<?php
include_once '.\app\Views\layout\partials\header.php'
?>