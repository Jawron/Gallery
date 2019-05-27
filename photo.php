
<?php
include("includes/header.php");
require_once("admin/includes/init.php");

if(empty($_GET['id'])){
   redirect('index.php');
}

$photo = Photo::findById($_GET['id']);


if(isset($_POST['submit'])){

    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    //$photo_id = $_GET['id'];

    $new_comment = Comment::createComment($photo->id,$author,$body);

    if($new_comment && $new_comment->save()){

        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "There are save problems saving this";
    }

} else {
    $author = '';
    $body = '';
}

$comments = Comment::findComments($photo->id);


?>






            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->photo_title ;?></h1>
                <!-- Author -->
                <p class="lead">
                    by <a href="#">Start Bootstrap</a>
                </p>

                <hr>
                <img class="img-responsive" src="admin/<?php echo $photo->picturePath($photo->filename) ;?>" alt="">
                <hr>
                <!-- Date/Time -->
                <p class="lead">Details:</p>
                <p><span class="glyphicon glyphicon-time"></span> Posted: August 24, 2013 at 9:00 PM</p>
                <p><span class="glyphicon glyphicon-time"></span> Title: <?php echo $photo->photo_title ;?></p>
                <p><span class="glyphicon glyphicon-time"></span> SEO alt: <?php echo $photo->alt_text ;?></p>
                <p><span class="glyphicon glyphicon-time"></span> Type: <?php echo $photo->type ;?></p>
                <p><span class="glyphicon glyphicon-time"></span> Size: <?php echo $photo->size/1000000 ;?> MB</p>
                <p><span class="glyphicon glyphicon-time"></span> File name: <?php echo $photo->filename ;?></p>

                <hr>

                <!-- Preview Image -->

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption ;?></p>
                <p class="lead"><?php echo $photo->photo_desc ;?></p>
                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" >
                        </div>
                        <div class="form-group">
                            <label for="body">Write something nice:)</label>
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Leave a comment</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <!-- Comment -->


                <!-- Comment -->

                <?php foreach ($comments as $comment){ ?>


                    <!-- Comment -->
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object" src="http://placehold.it/64x64" alt="">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading"><?php echo $comment->author; ?>
                                <small>August 25, 2030 at 9:30 PM</small>
                            </h4>
                            <?php echo $comment->body; ?>
                        </div>
                    </div>


                <?php } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">


                <?php include("includes/sidebar.php"); ?>



            </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; Your Website 2014</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
