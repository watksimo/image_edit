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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Image Resizer</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  </head>
  <body>

    <div id="top_container" class="container-fluid">

      <div class="header row">
        <div id="page_title" class="col-sm-12" align="center">
            <h1>Image Resizer</h1>
        </div>
      </div>

      <div class="content">
        <div class="row">
          <div class="col-sm-4">

            <div class="row">
              <div class="col-sm-12">

                <div class="program_details_panel panel panel-default">
                    <div class="panel-heading" align="center">
                        <h3 class="panel-title">Image Uploader</h3>
                    </div>
                    <div class="panel-body">
                      <form id="uload_form" method="POST" enctype="multipart/form-data">
                       <input type="file" name="image" />
                      </form>
                    </div>
                    <div class="panel-footer" align="center">
                      <button type="button" id="uload">Upload New Image</button>
                    </div>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">

                <div class="program_details_panel panel panel-default">
                  <div id="img_prev_heading" class="panel-heading" align="center">
                      <h3 class="panel-title">Image Downloader</h3>
                  </div>
                  <div class="panel-body">
                    <div class="form-group">
                      <label for="new_width">Image</label>
                      <select name="image_list" id="image_list">
                        <option></option>
            <?php
                        foreach(glob(dirname(__FILE__) . '/images/*') as $filename) {
                           $filename = basename($filename);
                           echo "<option value='images/" . $filename . "'>".$filename."</option>";
                        }
            ?>

                      </select>
                    </div>

                    <div class="form-group">
                      <label for="new_width">New Width</label>
                      <input type='text' name='new_width' id='new_width'/>
                    </div>

                    <div class="form-group">
                      <label for="new_height">New Height</label>
                      <input type='text' name='new_height' id='new_height'/>
                    </div>
                  </div>

                  <div id="img_prev_footer" class="panel-footer" align="center">
                    <button type="button" id="dload">Download New Image</button>
                  </div>

                </div>

              </div>
            </div>
          </div>

          <div class="col-sm-8">
            <div id="preview_panel" class="panel panel-default">
                <div class="panel-heading" align="center">
                    <h3 class="panel-title">Preview</h3>
                </div>
                <div class="panel-body">
                  <div id="img_prev" align="center">
                  </div>
                </div>
                <div class="panel-footer" align="center">
                  <div id="max_dims">
                  </div>
                </div>
            </div>
          </div>

        </div>

      </div>
    </div>

  </body>

  <footer>
    <script type="text/javascript" src="js/functions.js"></script>
    <link rel="stylesheet" type="text/css" href="css/main.css">
  </footer>
</html>
