<div>
    <h2><?= $post['title'] ?><?= isset($edit_href) ? ' - <a href="' . $edit_href . '">Edit</a>' : '' ?></h2>
    <small>
        <p>
            <span class="glyphicon glyphicon-time"></span>
            <?= $post['created'] ?>
        </p>
    </small>
    <?= $post['text_main'] ?>
</div>
<hr />
