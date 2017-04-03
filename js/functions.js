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
      if(sel_img_width > sel_img_max_width) {
        sel_img_width = sel_img_max_width;
        $('#new_width').val(sel_img_width);
      }
      sel_img_height = Math.round(sel_img_width * sel_img_ratio);
      $('#new_height').val(sel_img_height);
    }
  });

  $('#new_height').keyup(function(event) {
    if($('#new_height').is(":focus")) {
      sel_img_height = $('#new_height').val();
      if(sel_img_height > sel_img_max_height) {
        sel_img_height = sel_img_max_height;
        $('#new_height').val(sel_img_height);
      }
      sel_img_width = Math.round(sel_img_height / sel_img_ratio);
      $('#new_width').val(sel_img_width);
    }
  });

});
