<?php
include("includes/header.php");
require_once("includes/init.php");


if($session->isSignedIn()){
    redirect('index.php');
}

if(isset($_POST['submit'])){
    $user = new User();

    $user->username = trim($_POST['username']);
    $user->password = trim($_POST['password']);
    $user->first_name = trim($_POST['first_name']);
    $user->last_name = trim($_POST['last_name']);

    $user_found = $user->verifyUser($user->username,$user->password);

    if($user_found) {
        $message = "<h4 class=\"bg-danger\">Your user already exists</h4>";
    } else {
        $user->create();
        redirect("login.php");
    }


} else {
    $user->username = "";
    $user->password = "";
    $user->first_name = "";
    $user->last_name = "";
    $message = "";
}
?>

<div id="login-overlay" class="modal-dialog">
    <div class="modal-content" style="margin-left:-225px;padding:10px 90px;background-color:#222">
        <div class="modal-body">
            <div class="row">
                <div class="col-xs-8 col-md-offset-2">
                    <div class="well">
                        <?php echo $message; ?>
                        <form id="loginForm" method="POST" action="" novalidate="novalidate">
                            <div class="form-group">
                                <label for="username" class="control-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlentities($user->username);?>"
                                       required="" title="Please enter you username" placeholder="example@gmail.com">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlentities($user->password);?>"
                                       required="" title="Please enter your password">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="firstname" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="first_name" value="<?php echo htmlentities($user->first_name);?>"
                                       required="" title="Please enter your First Name">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="lastname" class="control-label">Password</label>
                                <input type="text" class="form-control" id="lastname" name="last_name" value="<?php echo htmlentities($user->last_name);?>"
                                       required="" title="Please enter your password">
                                <span class="help-block"></span>
                            </div>
                            <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                                <br>
                            <button type="submit" name="submit" class="btn btn-success btn-block">Login</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
