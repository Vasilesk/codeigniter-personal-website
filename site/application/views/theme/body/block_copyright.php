<link rel="stylesheet" type="text/css" href="/static/css/iziModal.min.css" />
<script src="/static/js/iziModal.min.js"></script>
<div class="row">
  <div class="col-md-12">
    <br />
    <p class="footer-notice">
      <abbr title="<?= $copyright['title'] ?>" data-izimodal-open="modal-copyright" data-izimodal-transitionin="fadeInDown">
          &copy; Me and co
      </abbr>
      , 2016.
    </p>
  </div>
</div>

<!-- Modal -->
<div id="modal-copyright"
    class="iziModal"
    style="display: none;"
    data-izimodal-title="<?= $copyright['title'] ?>"
    data-izimodal-subtitle="<?= $copyright['subtitle'] ?>">
        <?= $copyright['text'] ?>
</div>
<!-- Modal ends -->
