<?php include("includes/header.php"); ?>
<?php
if(!$session->isSignedIn()) {
    redirect("login.php");
}
?>
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php");?>
    <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
    <?php include("includes/side_nav.php"); ?>
    <!-- /.navbar-collapse -->
</nav>
<div id="page-wrapper">
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Photos
                    <small>Subheading</small>
                </h1>
                <p class="alert-success"><?php echo $message;?></p>
                <div class="col-md-12">
                    <?php

                    $photo = new Photo();
                    $photo_data = $photo->findAll();
                    ?>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Id</th>
                                <th>File Name</th>
                                <th>Title</th>
                                <th>Size</th>
                                <th>Type</th>
                                <th>Comments</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($photo_data as $data){ ?>
                        <tr>
                            <td>
                                <img class="admin-photo-thumbnail" src="<?php echo $photo->picturePath($data->filename); ?>">
                                <div class="pictures_link">
                                    <a href="delete_photo.php?id=<?php echo $data->id;?>">Delete</a>
                                    <a href="edit_photo.php?id=<?php echo $data->id;?>">Edit</a>
                                    <a href="../photo.php?id=<?php echo $data->id;?>">View</a>
                                </div>
                            </td>
                            <td><?php echo $data->id; ?></td>
                            <td><?php echo $data->filename; ?></td>
                            <td><?php echo $data->photo_title; ?></td>
                            <td><?php echo $data->size/1000000; ?> MB</td>
                            <td><?php echo $data->type; ?></td>
                            <td><?php
                                $comment = Comment::findComments($data->id);
                                echo count($comment);
                                ?>
                                 <a href="photo_comment.php?id=<?php echo $data->id;?>"> View Comments</a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>

                    </table>

                </div>







            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
