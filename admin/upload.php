<?php include("includes/header.php"); ?>
<?php
if(!$session->isSignedIn()) {
    redirect("login.php");
}
?>

<?php
$message = '';
if(isset($_FILES['file_upload'])){
    $photo = new Photo();
    $photo->photo_title = $_POST['photo_title'];
    $photo->caption = $_POST['caption'];
    $photo->alt_text = $_POST['alt_text'];
    $photo->photo_desc = $_POST['description'];
    $photo->setFile($_FILES['file_upload']);

    if($photo->save()) {
        $message = "Photo was uploaded succesfull". $_FILES['file_upload']['name'];
    } else {
        $message = join("<br>", $photo->errors);
    }
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
                    Upload
                    <small>Subheading</small>
                </h1>
                <div class="col-md-7 col-md-offset-2 ">
                    <?php echo $message; ?>
                    <?php echo SITE_ROOT . DS . 'admin' . DS . 'images' . DS ;?>
                    <form method="post" enctype="multipart/form-data" action="upload.php">
                        <div class="form-group">
                            <label for="photo_title">Photo Title</label>
                            <input type="text" name="photo_title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="alt_text">SEO alt text</label>
                            <input type="text" name="alt_text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="file_upload">Photo file</label>
                           <input type="file" name="file_upload"  class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" cols="30" rows="10"></textarea>

                        </div>
                        <input type="submit" name="submit" value="Upload" class="btn btn-success">
                    </form>
                </div>

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
