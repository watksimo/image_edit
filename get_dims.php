<?php
  $image_file = $_POST['image_name'];

  $image = new Imagick($image_file);
  $width = $image->getImageWidth();
  $height = $image->getImageHeight();

  $ret_data = array();

  $ret_data['width'] = $width;
  $ret_data['height'] = $height;

  echo json_encode($ret_data);
?>
