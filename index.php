<?php
  if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size =$_FILES['image']['size'];
    $file_tmp =$_FILES['image']['tmp_name'];
    $file_type=$_FILES['image']['type'];
    $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

    $expensions= array("jpeg","jpg","png");

    if(in_array($file_ext,$expensions)=== false){
      $errors[]="extension not allowed, please choose a JPEG or PNG file.";
    }

    if($file_size > 5242880){
     $errors[]='File size must be less than 5 MB';
    }

    if(empty($errors)==true){
     move_uploaded_file($file_tmp,"images/".$file_name);
    } else {
     print_r($errors);
    }
  }


?>
<html>
  <head>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  </head>
  <body>

    <div class="container-fluid">

      <div class="header row">
        <div class="col-sm-12">
            <h1>Image Resizer</h1>
        </div>
      </div>

      <div class="content row">

        <div class="program_details_panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Image Uploader</h3>
            </div>
            <div class="panel-body">
              <form action="" method="POST" enctype="multipart/form-data">
               <input type="file" name="image" />
               <input type="submit"/>
              </form>
            </div>
            <div class="panel-footer">

            </div>
        </div>





        <select name="image_list" id="image_list">
          <option></option>
    <?php
          foreach(glob(dirname(__FILE__) . '/images/*') as $filename){
             $filename = basename($filename);
             echo "<option value='images/" . $filename . "'>".$filename."</option>";
          }
    ?>

        </select>

        <div class="form-group">
          <label for="new_width">New Width</label>
          <input type='text' name='new_width' id='new_width'/>
        </div>

        <div class="form-group">
          <label for="new_height">New Height</label>
          <input type='text' name='new_height' id='new_height'/>
        </div>

        <button type="button" id="dload">Download New Image</button>

      </div>
    </div>

  </body>

  <footer>
    <script type='text/javascript'>
        $(function() {
          var sel_img_ratio = 0;
          var sel_img_width = 0;
          var sel_img_height = 0;
          var sel_img_max_width = 0;
          var sel_img_max_height = 0;

          $('#dload').on('click', function() {
            var image_file = $('#image_list').val();
            var new_width = $('#new_width').val();
            var new_height = $('#new_height').val();
            window.open('download.php?image_file=' + image_file + '&new_width='
                          + new_width + '&new_height=' + new_height);
          });

          $('#image_list').on('change', function() {
            var image_file = $('#image_list').val();
            console.log(image_file);

            $.ajax({
                type: "POST",
                url: "get_dims.php",
                data: {
                  image_name: image_file
                }
            })
            .done(function (dim_array) {
                json_dim_array = JSON.parse(dim_array);
                sel_img_max_width = json_dim_array['width'];
                sel_img_max_height = json_dim_array['height'];
                sel_img_width = json_dim_array['width'];
                sel_img_height = json_dim_array['height'];
                sel_img_ratio = sel_img_height/sel_img_width;

                $('#new_width').val(sel_img_width);
                $('#new_height').val(sel_img_height);
            });
          });

          $('#new_width').keyup(function(event) {
            if($('#new_width').is(":focus")) {
              sel_img_width = $('#new_width').val();
              sel_img_height = Math.round(sel_img_width * sel_img_ratio);
              $('#new_height').val(sel_img_height);
              console.log(sel_img_height);
            }
          });

          $('#new_height').keyup(function(event) {
            if($('#new_height').is(":focus")) {
              sel_img_height = $('#new_height').val();
              sel_img_width = Math.round(sel_img_height / sel_img_ratio);
              $('#new_width').val(sel_img_width);
              console.log(sel_img_width);
            }
          });

        });

    </script>
  </footer>
</html>
