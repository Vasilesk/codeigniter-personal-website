<?php echo form_open('', 'class="form-horizontal"');?>
    <fieldset>
        <legend>
            <?= $legend ?>
            <h3>
                <?php echo validation_errors(); ?>
            </h3>
        </legend>

        <div class="form-group">
          <label for="field_title" class="col-lg-2 control-label">Title</label>
          <div class="col-lg-10">
            <?php echo form_input($field_title);?>
          </div>
        </div>

        <div class="form-group">
          <label for="field_text" class="col-lg-2 control-label">Summary</label>
          <div class="col-lg-10">
            <?php echo form_textarea($field_summary);?>
          </div>
        </div>

        <div class="form-group">
          <label for="field_text" class="col-lg-2 control-label">Text</label>
          <div class="col-lg-10">
            <?php echo form_textarea($field_text);?>
          </div>
        </div>

        <div class="form-group">
          <label for="field_created_date" class="col-lg-2 control-label">Date published</label>
          <div class="col-lg-10">
            <?php echo form_input($field_created_date);?>
          </div>
        </div>

        <div class="form-group">
          <label for="field_created_time" class="col-lg-2 control-label">Time published</label>
          <div class="col-lg-10">
            <?php echo form_input($field_created_time);?>
          </div>
        </div>

        <div class="form-group">
          <label for="field_status" class="col-lg-2 control-label">Post status</label>
          <div class="col-lg-10">
            <?php echo form_dropdown('field_status', $field_status['options'], $field_status['chosen'], $field_status['extra']);?>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <?php echo form_submit($send_button);?>
          </div>
        </div>
    </fieldset>

<?php echo form_close();?>
