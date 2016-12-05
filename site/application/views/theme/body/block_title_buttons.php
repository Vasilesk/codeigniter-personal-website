<?php if(isset($tabs)): ?>
    <ul class="nav nav-pills">
        <?php foreach ($tabs as $name => $tab): ?>
            <li class="<?= $name == $active ? 'active' : '' ?>" <?= $name == 'copyright' ? 'data-izimodal-open="modal-copyright"' : '' ?>><a href="<?= $tab['link']['href'] ?>"><?= $tab['title'] ?></a></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
