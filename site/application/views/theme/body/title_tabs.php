<ul class="grid cs-style-<?= $is_portable ? '3' : '4' ?>">
	<?php foreach ($tabs as $tab): ?>
		<li<?= $is_portable ? ' class="portable"' : '' ?>>
			<figure>
				<div><img src="static/images/tabs/<?= $tab['pic'] ?>" alt="<?= $tab['title'] ?>"></div>
				<figcaption>
					<h3><?= $tab['title'] ?></h3>
					<span><?= $tab['info'] ?></span>
					<a href="<?= $tab['link']['href'] ?>"><?= $tab['link']['text'] ?></a>
				</figcaption>
			</figure>
		</li>
	<?php endforeach; ?>
</ul>
<script src="static/js/toucheffects.js"></script>
