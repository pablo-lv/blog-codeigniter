
<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php
                echo form_open_multipart('article/store');
                echo form_input_text('title','Title');
                echo form_input_textarea('description','Description');
            ?>
            <textarea id="ckeditor" name='content'></textarea>
            <hr>
            <?php
                echo form_input_file('upload');
                echo form_submit('Save Post');
                echo form_close();
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
     CKEDITOR.replace( 'ckeditor' );
</script>
