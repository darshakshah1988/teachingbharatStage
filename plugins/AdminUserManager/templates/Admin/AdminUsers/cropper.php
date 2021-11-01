<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Datasource\EntityInterface $cropper
 */
$this->layout = "ajax";
?>
<style>
    .custom-file-control::before {
    content: "Browse";
}
.custom-file-control:empty::after {
    content: "Choose file...";
}
</style>
<div class="">
    <div class="cropping-top-sc">
        <div>
            <span>Upload a profile image with cropping option</span>
        </div>
        <div class="">
            <label class="btn btn-block btn-primary btn-lg mb-1 btn-upload" for="inputImage" title="Upload image file">
                <input type="file" class="sr-only" id="inputImage" name="file" accept="image/*">
                <span class="docs-tooltip spinloader" data-toggle="tooltip" title="" data-original-title="Import image with Blob URLs">
                    <span class="fa fa-upload"></span> Upload Profile Photo
                </span>
                </label>
        </div>
    </div>


<div class="row uploadContainer" style="">
    <div class="col-xl-10 col-lg-9">
        <div class="img-container">
          <?php echo $this->Html->image('no_image.gif', ['class' => '', 'id' => 'cropperImage']); ?>
        </div>
    </div>
<!-- /.Your image -->
<!-- .Croping image -->
    <div class="col-xl-2 col-lg-3">
        <div class="docs-preview clearfix">
            <span>Preview</span>
            <div class="img-preview preview-lg"></div>
        </div>
        <input type="hidden" name="image_type" class="form-control" id="uploadedImageType" value="image/jpeg">
    <!-- <h3>Data:</h3> -->
    </div>
    <div class="col-md-12">
        <hr class="mb-0">
    </div>
</div>
</div>
<!-- /.Croping functionality for image -->
<script>
    $(function () {
    var Cropper = window.Cropper;
    var URL = window.URL || window.webkitURL;
    var container = document.querySelector('.img-container');
    var image = container.getElementsByTagName('img').item(0);
    var options = {
        aspectRatio: 1 / 1,
        viewMode: 2,
        minCropBoxWidth: 200,
        minCropBoxHeight: 200,
        preview: '.img-preview',
        ready: function (e) {
        console.log(e.type);
        },
        cropstart: function (e) {
        console.log(e.type, e.detail.action);
        },
        cropmove: function (e) {
        console.log(e.type, e.detail.action);
        },
        cropend: function (e) {
        console.log(e.type, e.detail.action);
        },
        crop: function (e) {
            var data = e.detail;
        },
        zoom: function (e) {
        console.log(e.type, e.detail.ratio);
        }
  };
  cropperFx = new Cropper(image, options);
  var originalImageURL = image.src;
  var uploadedImageType = 'image/jpeg';
  var uploadedImageName = 'no-image-available.jpg';
  var uploadedImageURL;

  var inputImage = document.getElementById('inputImage');

  if (URL) {
    inputImage.onchange = function () {

      var files = this.files;
      var file;
        console.log(files);
      if (cropperFx && files && files.length) {
        crpConfirm.buttons.crop.disable();
        //var l = Ladda.create( document.querySelector( '.spinloader' ) );
        l.start();
        file = files[0];
        var a=(file.size);
        if(a > 5000000) {
            $.alert('Image size should be less than 5mb.');
            l.stop();
            return false;
        };

        if (/^image\/\w+/.test(file.type)) {
          uploadedImageType = file.type;
          uploadedImageName = file.name;
          $("#uploadedImageType").val(file.type);
          if (uploadedImageURL) {
            URL.revokeObjectURL(uploadedImageURL);
          }
          image.src = uploadedImageURL = URL.createObjectURL(file);
          l.stop();
          cropperFx.destroy();
          cropperFx = new Cropper(image, options);
          inputImage.value = null;
          //$("div.row.uploadContainer").addClass('d-block');
          crpConfirm.buttons.crop.show();
          crpConfirm.buttons.crop.enable();
        } else {
            $.alert('Please choose an image file.');
            l.stop();
          //window.alert('Please choose an image file.');
        }
      }
    };
  } else {
    inputImage.disabled = true;
    inputImage.parentNode.className += ' disabled';
  }
});
</script>
