<?php
include_once("../_sys/check_login_status.php");

if (isset($_FILES["avatar"]["name"]) && $_FILES["avatar"]["tmp_name"] != ""){
	$fileName = $_FILES["avatar"]["name"];
    $fileTmpLoc = $_FILES["avatar"]["tmp_name"];
	$fileType = $_FILES["avatar"]["type"];
	$fileSize = $_FILES["avatar"]["size"];
	$fileErrorMsg = $_FILES["avatar"]["error"];
	$kaboom = explode(".", $fileName);
	$fileExt = end($kaboom);
	list($width, $height) = getimagesize($fileTmpLoc);
	if($width < 10 || $height < 10){
		echo "That image has no dimensions or the file size is probably too big. Choose a file with size below 3MB and try again";
        exit();	
	}
	$db_file_name = rand(10000,99999).".".$fileExt;
	if($fileSize > 3048576) {
		echo "Your image file was larger than 3mb";
		exit();	
	} else if (!preg_match("/\.(gif|jpg|png)$/i", $fileName) ) {
		echo "Your image file was not jpg, gif or png type";
		exit();
	} else if ($fileErrorMsg == 1) {
		echo "An unknown error occurred";
		exit();
	}
	$sql = "SELECT avatartemp FROM user_account WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	$row = mysqli_fetch_row($query);
	$avatar = $row[0];
	if($avatar != ""){
		$picurl = "../_USER/$log_email/$avatar"; 
	    if (file_exists($picurl)) { unlink($picurl); }
	}
	$moveResult = move_uploaded_file($fileTmpLoc, "../_USER/$log_email/$db_file_name");
	if ($moveResult != true) {
		echo "File upload failed";
		exit();
	}
	include_once("../_sys/image_resize.php");
	$target_file = "../_USER/$log_email/$db_file_name";
	$resized_file = "../_USER/$log_email/$db_file_name";
	$wmax = 600;
	$hmax = 600;
	img_resize($target_file, $resized_file, $wmax, $hmax, $fileExt);
	$sql = "UPDATE user_account SET avatartemp='$db_file_name' WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	mysqli_close($db_connection);

if($moveResult) {
$targetDisplay = "_USER/$log_email/$db_file_name";
?>
<img id="cropbox" class="span5" style="margin-top: 10px;" src="<?php echo $targetDisplay;?>" alt="<?php echo $log_email;?>">
<?php
	}
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "dp_update"){
	if(!isset($_POST['x']) || $_POST['x'] == ""){
		mysqli_close($db_connection);
		exit();
	}
	$myimage = "";
	$sql = "SELECT * FROM user_account WHERE e_hash='$log_email'";
	$thumbquery = mysqli_query($db_connection, $sql);
	while ($row = mysqli_fetch_array($thumbquery, MYSQLI_ASSOC)) {
		$avatartemp = $row["avatartemp"];
		
		$kaboom = explode(".", $avatartemp);
		$fileExt = end($kaboom);
		$db_file_name = "dp".rand(100000,999999).".".$fileExt;
		$targ_w = 150;
		$targ_h = 150;
		$jpeg_quality = 90;

		$src = "../_USER/$log_email/$avatartemp"; 
		$newcopy = "../_USER/$log_email/$db_file_name"; 
		$img_r = imagecreatefromjpeg($src);
		list($w_orig, $h_orig) = getimagesize($src);
		$dst_r = ImageCreateTrueColor( $targ_w, $targ_h );
		
		imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$targ_w,$targ_h,$_POST['w'],$_POST['h']);
		imagejpeg($dst_r,$newcopy,$jpeg_quality);
		
		$sql = "SELECT user_image FROM user_account WHERE e_hash='$log_email'";
		$query = mysqli_query($db_connection, $sql);
		$row = mysqli_fetch_row($query);
		$old_dp = $row[0];
		if($old_dp != ""){
			$picurl = "../_USER/$log_email/$old_dp"; 
			if (file_exists($picurl)) { unlink($picurl); }
		}
		$sql = "UPDATE user_account SET user_image='$db_file_name' WHERE e_hash='$log_email'";
		$query = mysqli_query($db_connection, $sql);
		mysqli_close($db_connection);
	}
	$targetDpDisplay = "_USER/$log_email/$db_file_name";
	$myimage = '<img src="'.$targetDpDisplay.'" class="img-circle" alt="'.$log_email.'">';
	echo $myimage;
	exit();
}
?><?php
if (isset($_POST['action']) && $_POST['action'] == "delete_dp"){
	$sql = "SELECT user_image FROM user_account WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	$row = mysqli_fetch_row($query);
	$old_dp = $row[0];
	if($old_dp != ""){
		$picurl = "../_USER/$log_email/$old_dp"; 
		if (file_exists($picurl)) { unlink($picurl); }
	}
	$sql = "UPDATE user_account SET user_image=NULL WHERE e_hash='$log_email'";
	$query = mysqli_query($db_connection, $sql);
	mysqli_close($db_connection);
	echo "remove_ok";
	exit();
}
?>
<script src="_js/_query.js"></script>
<script src="_js/rcrop.js"></script>
<script>
$(document).ready(function(){
	$('#cropbox').rcrop({
		minSize : [200,200],
		preserveAspectRatio : true,
		grid : true,

		preview : {
		display: true,
		size : [100,100],
		}
	});

	var $cropbox = $('#cropbox'),
	inputs = {
	x : $('#x'),
	y : $('#y'),
	width : $('#w'),
	height : $('#h')
	},
	fill = function(){
		var values = $cropbox.rcrop('getValues');
		for(var coord in inputs){
		inputs[coord].val(values[coord]);
		}
	}
	$cropbox.rcrop();    
	$cropbox.on('rcrop-changed rcrop-ready', fill);
                  
});
</script>