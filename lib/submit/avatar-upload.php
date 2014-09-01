<?php session_start();
include('../class-db.php');
include('../objects/class-user.php');

$ez_user = new ezLeague_User();

if( isset( $_SESSION['ez_username'] ) ) { 

$profile = $ez_user->get_user( $_SESSION['ez_username'] );
	$rand = rand('100', '5000');
	$now = strtotime('now');
	$new_file = $now . '-' . $rand;
	$allowedExts = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
	$temp = explode(".", $_FILES["file"]["name"]);
	$extension = end($temp);
	
	if ((($_FILES["file"]["type"] == "image/gif")
	|| ($_FILES["file"]["type"] == "image/jpeg")
	|| ($_FILES["file"]["type"] == "image/jpg")
	|| ($_FILES["file"]["type"] == "image/pjpeg")
	|| ($_FILES["file"]["type"] == "image/x-png")
	|| ($_FILES["file"]["type"] == "image/png"))
	&& ($_FILES["file"]["size"] < 1000000)
	&& in_array($extension, $allowedExts)) {
	  if ($_FILES["file"]["error"] > 0) {
	    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	  } else {
	    if (file_exists("../../avatars/" . $now . "-" . $_FILES["file"]["name"])) {
	      echo $now . "-" . $_FILES["file"]["name"] . " already exists. ";
	    } else {
	      move_uploaded_file($_FILES["file"]["tmp_name"],
	      "../../avatars/" . $now . "-" . $_FILES["file"]["name"]);
	      $filename = $now . "-" . $_FILES["file"]["name"];
	      $ez_user->update_avatar($filename, $profile['id']);
	      header('Location: ' . $_POST['from']);
	    }
	  }
	} else {
	  echo "Invalid file";
	}
	
} else {
	echo "users only.";
}
?>