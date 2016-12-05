<div>
    <h1>Блог</h1>
    <?= $pagination ?>
    <?php foreach ($posts as $post): ?>
        <div>
            <h3><a href="/blog/<?= $post['id'] ?>"><?= $post['title'] ?></a></h3>
            <small>
                <p>
                    <span class="glyphicon glyphicon-time"></span>
                    <?= $post['created'] ?>
                </p>
            </small>
            <div>
                <?= $post['text_summary'] ?>
            </div>
            <p><a href="/blog/<?= $post['id'] ?>">Read</a></p>
        </div>
        <hr />
    <?php endforeach ?>
    <?= $pagination ?>
</div>
