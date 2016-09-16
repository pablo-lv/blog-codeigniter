<!-- Main Content -->
<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <a href="<?= base_url()?>article/create">Add New Post</a>
        </div>
        <hr>
        <div class="col-md-12">
            <h3>Your Posts</h3>
            <?php
            $content  = "<div class='table-responsive'>";
            $content .= "<table id='tbPosts' class='table table-hover table-bordered table-condensed'>";
            $content .=    "<thead>";
            $content .=    "<tr>";
            $content .=    "<th style='text-align: center;'>Title</th>";
            $content .=    "<th style='text-align: center;'>Edit</th>";
            $content .=    "<th style='text-align: center;'>Delete</th>";
            $content .=    "</tr>";
            $content .=    "</thead>";
            $content .=    "<tbody>";
                foreach ($posts as $post) {
                    $content .= "<tr id='td$post->id'>";
                        $content .= "<td style='text-align: center;'>" . $post->title . "</td>";
                        $content .= "<td style='text-align: center;'>
                            <a href='". base_url('article/edit/'). "$post->id' class='btn btn-xs btn-primary'>Edit</a>
                        </td>";
                        $content .= "<td style='text-align: center;'>
                            <button id='{$post->id}' class='delete btn btn-xs btn-danger'>Delete</button>
                        </td>";
                    $content .= "</tr>";
                }
            $content .=    "</tbody>";
            $content .=    "</table>";
            $content .= "</div>";
            echo $content;
            ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function (){
        // $("#tbPosts").on('click','.delete',function(){
        //   $(this).closest('tr').remove();
        // });


        $('.delete').on('click',function (e) {
            e.preventDefault();
            var title = $(this).attr('name');
            var id = $(this).attr('id');

            var conf = confirm("Are you sure!");
            if (conf == true) {
                var request;

                if (request) {
                    request.abort();
                }

                request = $.ajax({
                    url: "<?= base_url('article/delete')?>",
                    type: 'POST',
                    data: "id=" + id,
                });

                request.done(function (response, textStatus, jqXHR) {
                    console.log("response: " + response);
                    $('#td'+response).remove();
                });

                request.fail(function (jqXHR, textStatus, thrown) {
                    console.log("ERROR " + textStatus);
                });

                request.always(function () {
                    console.log("Finish ajax");
                });
            } else {

            }
        });
    });
</script>

<hr>
