
// Initial
$(document).ready(function(){
  cropPreview();
  modalCrop();


  $('.img-upload').on('click', '#btnEditImg', function(){
    $('.img-upload-input').click();
  });

  $('.img-upload-input').change(function () {
    if (this.files[0] == undefined)
    return;
    $('#mdlCropImg').modal();
    let reader = new FileReader();
    reader.addEventListener("load", function () {
      window.src = reader.result;
      $('.img-upload-input').val(null);
    }, false);
    if (this.files[0]) {
      reader.readAsDataURL(this.files[0]);
    }
  });

  let imgCrop;
  $('#mdlCropImg').on('shown.bs.modal', function () {
    imgCrop = $('#imgCrop').croppie({
      enableExif: true,
      viewport: {
        width: 150,
        height: 150,
        type:'square'
      },
      boundary:{
        width: 200,
        height: 200
      }
    });
    imgCrop.croppie('bind', {
      url: window.src,
    }).then(function () {
      imgCrop.croppie('setZoom', 0);
    });
  });
  $('#mdlCropImg').on('hidden.bs.modal', function () {
    imgCrop.croppie('destroy');
  });

  $("#mdlCropImg").on('click', '#btnCrop', function(){
    imgCrop.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(res){
      $('.img-upload-crop').val(res);
      $('#imgPreview').attr('src', res);
      $('.btn-delete-img').css('display', 'flex');
      $('#mdlCropImg').modal('hide');
    });
  });

  $("#btnDeleteImg").click(function(){
    $('.img-upload-crop').val("");
    $('#imgPreview').attr('src', '../assets/dist/img/foto-default.jpg');
    $('.btn-delete-img').css('display', 'none');
    $('.img-upload-input').val(null);
  });


});

// Function
function cropPreview()
{
  var htmlPreview = `<input type="file" class="img-upload-input">
  <img src="../assets/dist/img/foto-default.jpg" class="img-fluid rounded img-thumbnail mb-3" style="width: 150px; height: 150px;" id="imgPreview">
  <a href="javascript:void(0)" id="btnEditImg">
    <div class="btn-edit-img">
      <i class="bx bx-pencil"></i>
    </div>
  </a>
  <a href="javascript:void(0)" id="btnDeleteImg">
    <div class="btn-delete-img">
      <i class="bx bx-trash"></i>
    </div>
  </a>
  <div class="upload-form" hidden>
    <input type="text" name="hapus_foto" value="0" id="imgStatus" readonly>
  </div>`;
  $('.img-upload').append(htmlPreview);
}

function modalCrop()
{
  var htmlModalCrop = `<div class="modal fade" id="mdlCropImg">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-muted">Crop Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="imgCrop"></div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" id="btnCrop">Crop</button>
        </div>
      </div>
    </div>
  </div>`;
  $('section.content').append(htmlModalCrop);
}

function imgCrop(opsi, nameFile, path)
{
  if (opsi == 'load') {
    if (nameFile != null && path != null) {
      $('.img-upload-crop').val(nameFile);
      $('#imgPreview').attr('src', path + nameFile);
      $('.btn-delete-img').css('display', 'flex');
    } else {
      $('.img-upload-crop').val("");
      $('#imgPreview').attr('src', '../assets/dist/img/foto-default.jpg');
      $('.btn-delete-img').css('display', 'none');
    }
  }

  if (opsi == 'reset') {
    $('.img-upload-crop').val("");
    $('#imgPreview').attr('src', '../assets/dist/img/foto-default.jpg');
    $('.btn-delete-img').css('display', 'none');
    $('.img-upload-input').val(null);
  }

}




// (function( $ ){
//    $.fn.imageUpload = function(props) {
//
//       // Initial
//       $(this).croppie({
//         viewport: {
//           width: props.width,
//           height: props.height,
//           type: props.type
//         },
//         boundary:{
//           width: props.widthContainer,
//           height: props.heightContainer
//         }
//       });
//       $(this).croppie('bind', {
//         url: props.path,
//       });
//
//       // Method Change
//       this.change = function(props) {
//         $('#imgStatus').val(props.status);
//         $('.img-crop').prop('hidden', props.crop);
//         $('#imgUpload').prop('hidden', props.upload);
//         $('#btnImgDelete').prop('hidden', props.delete);
//       };
//
//       return this;
//    };
// })( jQuery );
