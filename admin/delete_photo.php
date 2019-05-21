<?php include("includes/header.php"); ?>
<?php
if(!$session->isSignedIn()) {
    redirect("login.php");
}


if(empty($_GET['id'])){
    redirect('photos.php');

}

$photo = Photo::findbyId($_GET['id']);

if($photo) {
    $photo->delete_photo();
    redirect('photos.php');

} else {
    redirect('photos.php');
}






















?>
