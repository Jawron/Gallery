<?php
include("includes/header.php");
require_once("includes/init.php");

if($session->isSignedIn()){
   redirect('index.php');
}

if(isset($_POST['submit'])){
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $user_found = User::verifyUser($username,$password);

    if($user_found) {
        $session->login($user_found);
        redirect("index.php");
    } else {
        $message = "<h4 class=\"bg-danger\">Credentials Wrong!</h4>";
    }
} else {
    $username = "";
    $password = "";
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
                                <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlentities($username);?>" required="" title="Please enter you username" placeholder="example@gmail.com">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <label for="password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlentities($password);?>" required="" title="Please enter your password">
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
