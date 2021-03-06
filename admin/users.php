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
                    Users
                    <small>Subheading</small>
                </h1>
                <p class="alert-success"><?php echo $message;?></p>
                <a href="add_user.php" class="btn btn-success"> ADD USERS</a>
                <div class="col-md-12">
                    <?php

                    $user = new User();
                    $user_user = $user->findAll();
                    ?>

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Id</th>
                            <th>Photo</th>
                            <th>UserName</th>
                            <th>FirstName</th>
                            <th>LastName</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($user_user as $user){ ?>
                            <tr>
                                <td><?php echo $user->id; ?></td>
                                <td><img class="admin-user-thumbnail user_image" src="<?php echo $user->imagePlaceholder(); ?>"></td>
                                <td>
                                    <?php echo $user->username; ?>
                                    <div class="action_link">
                                        <a href="delete_user.php?id=<?php echo $user->id;?>">Delete</a>
                                        <a href="edit_user.php?id=<?php echo $user->id;?>">Edit</a>
                                    </div>
                                </td>
                                <td><?php echo $user->first_name; ?></td>
                                <td><?php echo $user->last_name; ?></td>
                                <td><?php echo $user->user_image; ?></td>

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
