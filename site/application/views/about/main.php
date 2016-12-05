<div class="row">
    <h1>About me</h1>
    <center>
        <h4>My name is...</h4>
    </center>
    <div class="col-md-12">
        <img src="/static/images/me.jpg" class="img-rounded img-responsive" alt="me" style="margin: 0 auto;">
    </div>
    <div class="col-md-12">
        <p>
            <?= $about_upper ?>
            <br />
        </p>
        <ul>
            <?php foreach ($features as $feature): ?>
                <li>
                     <?= $feature ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>
