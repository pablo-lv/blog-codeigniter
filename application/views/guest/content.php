<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php foreach ($posts as $post): ?>
                <div class="post-preview">
                    <?php
                        $year = DateTime::createFromFormat("Y-m-d H:i:s", $post->date)->format("Y");
                        $title = strtolower(str_replace(" ", "-", $post->title));
                    ?>
                    <a href="<?= base_url()?>article/post/<?= $year ?>/<?= $title?>">
                        <h2 class="post-title">
                            <?= $post->title ?>
                        </h2>
                        <h3 class="post-subtitle">
                            <?= $post->description?>
                        </h3>
                    </a>
                    <p class="post-meta">Posted by <a href="#">Start Bootstrap</a> on September 24, 2014</p>
                </div>
                <hr>
            <?php endforeach; ?>
            <!-- Pager -->
            <?= $pagination ?>
        </div>
    </div>
</div>

<hr>
