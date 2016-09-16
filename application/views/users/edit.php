<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php
                $title = array('value' => $post->title);
                $description = array('value' => $post->description);
                echo form_open_multipart("article/update/{$post->id}", ['method' => 'post']);
                echo form_input_text('title','Title', $title);
                echo form_input_text('description','Description', $description);
            ?>
            <textarea id="ckeditor" name='content'><?= $post->content ?></textarea>
            <hr>
            <?php
                // echo form_input_file('upload');
                echo form_submit('Update Post');
                echo form_close();
            ?>
        </div>
    </div>
</div>
<script type="text/javascript">
     CKEDITOR.replace( 'ckeditor' );
</script>
