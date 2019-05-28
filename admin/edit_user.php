<?php include("includes/header.php"); ?>
<?php include("includes/photo_lib_modal.php"); ?>
<?php
if(!$session->isSignedIn()) {
    redirect("login.php");
}




if(empty($_GET['id'])){
    redirect('users.php');
}
$user = User::findById($_GET['id']);


if(isset($_POST['update'])) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->password = $_POST['password'];
        $user->first_name = $_POST['first_name'];
        $user->last_name = $_POST['last_name'];

        if(empty($_FILES['file_upload'])){
            $user->save();
            redirect("users.php");
            $session->message("The user has been updated");
        } else {

            $user->setFile($_FILES['file_upload']);

            $user->saveImage();
            $user->save();
            $session->message("The user has been updated");

            //redirect('edit_user.php?id='.$user->id);
            redirect('users.php');
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
                    <span class="test">Edit User</span>
                    <small>Subheading</small>
                </h1>

                <div class="col-md-6 user_image_box">
                    <a href="" data-toggle="modal" data-target="#photo_modal"><img class="img-responsive" src="<?php echo $user->upload_directory.DS.$user->user_image;?>"></a>
                </div>


                <?php echo $user->id; ?>
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="file_upload">Image Upload</label>

                            <input type="file" name="file_upload" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                           <input type="text" name="username" class="form-control" value="<?php echo $user->username;?>">
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $user->password;?>">
                        </div>
                        <div class="form-group">
                            <label for="first_name">First name</label>
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name;?>">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name;?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Update the Motherfucker" name="update" class="btn btn-primary pull-right" >
                        </div>
                        <div class="form-group">
                            <a href="delete_user.php?id=<?php echo $user->id;?>" id="user_id" class="btn btn-danger">Delete the Motherfucker</a>
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
