<?php include("includes/header.php"); ?>
<?php
if(!$session->isSignedIn()) {
    redirect("login.php");
}




if(empty($_GET['id'])){
    redirect('photos.php');
}
$display_users = User::findById($_GET['id']);

$user = new User();

if(isset($_POST['submit'])) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if(empty($_FILES['file_upload'])){
            $user->save();
        } else {

            $user->setFile($_FILES['file_upload']);

            $user->saveUserAndImage();
            $user->save();

            redirect('edit_user.php?id='.$user->id);
        }

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
                    Add USer
                    <small>Subheading</small>
                </h1>

                <div class="col-md-6">
                    <img class="img-responsive" src="<?php echo $display_users->upload_directory.DS.$display_users->user_image;?>">
                </div>


                <?php echo $display_users->id; ?>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_upload">Image Upload</label>

                            <input type="file" name="file_upload" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                           <input type="text" name="username" class="form-control" value="<?php echo $display_users->username;?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $display_users->password;?>">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $display_users->first_name;?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $display_users->last_name;?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update the Motherfucker" name="submit" class="btn btn-primary pull-right" >
                        </div>

                    </div>

                </form>


<hr>




            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>
