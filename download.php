<?php
$image_file = $_GET['image_file'];
$new_width = $_GET['new_width'];
$new_height = $_GET['new_height'];

$image = new Imagick($image_file);
$width = $image->getImageWidth();
$height = $image->getImageHeight();
$image->resizeImage($new_width, $new_height, 0, 1);
$ext = "";
switch ($image->getImageFormat()) {
  case 'JPEG':
    $ext = 'jpg';
    break;
  case 'PNG':
    $ext = 'png';
    break;
  case 'TIFF':
    $ext = 'tiff';
    break;
  case 'PDF':
    $ext = 'pdf';
    break;
}

$dload_path = 'images/new_image.' . $ext;
$image->writeImage($dload_path);

if (file_exists($dload_path)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($dload_path).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($dload_path));
    readfile($dload_path);
}

$file_path = realpath($dload_path);

if(is_writable($file_path)) {
  unlink($file_path);
}

exit(0);
?>
