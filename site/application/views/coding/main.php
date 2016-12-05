<h1>Coding</h1>
<p>
    My code is here
</p>
<h2>Projects</h2>
<div class="table-responsive">
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Name</th>
        <th>Language</th>
        <th>Status</th>
        <th>Description</th>
        <th>Link</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach ($projects as $project): ?>
            <?php
            switch ($project['status'])
            {
                case 'ready':
                    $tr_class = 'info';
                    $td_status = 'Ready';
                    break;
                case 'closed':
                    $tr_class = 'warning';
                    $td_status = 'Closed';
                    break;
                case 'redesign':
                    $tr_class = 'danger';
                    $td_status = 'Depreciated';
                    break;
                case 'maintained':
                    $tr_class = 'success';
                    $td_status = 'Maintained';
                    break;
            }

            ?>
            <tr class="<?= $tr_class ?>">
              <td><?= $project['name'] ?></td>
              <td><?= $project['language'] ?></td>
              <td><?= $td_status ?></td>
              <td><?= $project['description'] ?></td>
              <td><a href="<?= $project['link']['href'] ?>" rel="nofollow" target="_blank"><?= $project['link']['text'] ?></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
  </table>
</div>
