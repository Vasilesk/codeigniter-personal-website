<h1>Write me</h1>
<p>
    You can write me smth here
</p>
<?php echo form_open('/writeme', 'class="form-horizontal"');?>
    <fieldset>
        <legend>
            Form
            <h3>
                <?php echo validation_errors(); ?>
            </h3>
        </legend>

        <div class="form-group">
          <label for="sender_name" class="col-lg-2 control-label">Имя <span style="color: #FF0000;">*</span></label>
          <div class="col-lg-10">
            <?php echo form_input($sender_name);?>
          </div>
        </div>

        <div class="form-group">
          <label for="sender_email" class="col-lg-2 control-label">Email &nbsp;</label>
          <div class="col-lg-10">
            <?php echo form_input($sender_email);?>
            <span class="help-block">If you need a response only</span>
          </div>
        </div>

        <div class="form-group">
          <label for="message_text" class="col-lg-2 control-label">Message <span style="color: #FF0000;">*</span></label>
          <div class="col-lg-10">
            <?php echo form_textarea($message_text);?>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-10 col-lg-offset-2">
            <?php echo form_submit($send_button);?>
          </div>
        </div>
    </fieldset>

<?php echo form_close();?>
