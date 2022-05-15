<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Signature Pad</title>
</head>
<body>

<?php

$dir = './signatures/'; //the folder to place your signature files in
$file = $dir.'signature_'.time().'.png'; //the filename of your new signature

if (empty($_POST['signature'])) {
	echo '<p>Error: No signature submitted!</p>';
} else {
	$data = trim(strip_tags($_POST['signature']));
	if (substr($data,0,15) != 'data:image/png;') { echo '<p>Error: Invalid signature file!</p>'; }
	else {
		$encoded_image = explode(',',$data)[1];
		$decoded_image = base64_decode($encoded_image);
		file_put_contents($file,$decoded_image) or die('<p>Error: Could not save file.</p>');
		echo '<p style="color: black;">Your signature was saved successfully as '.$file.'.</p>';
	}
}

?>

</body>
</html>