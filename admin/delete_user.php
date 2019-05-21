<?php include("includes/header.php"); ?>
<?php
if(!$session->isSignedIn()) {
    redirect("login.php");
}


if(empty($_GET['id'])){
    redirect('users.php');

}

$user = User::findbyId($_GET['id']);

if($user) {
    $user->delete_user();
    redirect('users.php');

} else {
    redirect('users.php');
}






















?>
