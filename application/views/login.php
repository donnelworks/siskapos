
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SISKAPOS | Login</title>

  <link rel="shortcut icon" href="<?= base_url() ?>assets/dist/img/favicon.ico" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Boxicons -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/boxicons/css/boxicons.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() ?>assets/dist/css/adminlte.css">
</head>
<body class="hold-transition">

  <div class="login-page" style="background: url(<?= base_url() ?>assets/dist/img/bg/bg-login.svg) center center no-repeat; background-size: cover;">
    <div class="col-xl-8 col-11">
      <div class="card-group">
        <div class="card p-2 bg-primary d-md-block d-none shadow-lg">
          <img class="brand-image m-2" style="width: 25%" src="<?= base_url() ?>assets/dist/img/logo/logo-full-white.svg">
          <div class="text-center">
            <img class="img-fluid" style="width: 80%" src="<?= base_url() ?>assets/dist/img/illust/login.svg">
          </div>
        </div>

        <div class="card p-4 shadow-lg">
          <div class="card-body">
            <div class="text-center d-sm-block d-md-none">
              <img class="brand-image mb-5" style="width: 60%" src="<?= base_url() ?>assets/dist/img/logo/logo-full-color.svg">
            </div>
            <h3 class="text-primary"><b>Login</b></h3>
            <hr>
            <form id="formLogin" autocomplete="off">
              <div class="form-group">
                <div class="input-group">
                  <input type="text" name="no_hp" class="form-control form-control-lg" placeholder="No. Hp." id="noHp" autofocus>
                </div>
              </div>
              <div class="form-group">
                <div class="input-group">
                  <input type="password" name="pass" class="form-control form-control-lg" placeholder="Password" id="pass">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-eye" id="showPass"></span>
                      <span class="fas fa-eye-slash" style="display: none" id="hidePass"></span>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="form-group">
                <select class="form-control" name="level" id="level">
                  <option value="1">Admin</option>
                  <option value="2">DB</option>
                  <option value="3">Sales</option>
                  <option value="4">Kolektor</option>
                </select>
              </div> -->
              <div class="row">
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-lg btn-block shadow" id="btnLogin">Login</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>assets/dist/js/adminlte.min.js"></script>
<!-- App -->
<script src="<?= base_url() ?>assets/dist/js/app.js"></script>

<script type="text/javascript">
  $(document).ready(function() {

    $('#showPass').click(function(){
      $(this).hide();
      $('#hidePass').show();
      $('#pass').prop('type', "text");
    });

    $('#hidePass').click(function(){
      $(this).hide();
      $('#showPass').show();
      $('#pass').prop('type', "password");
    });


    // Login
    $('#formLogin').submit(function(e){
      e.preventDefault();
      loadingBtnOn('#btnLogin');
      $.ajax({
        url: '<?= site_url('auth/proses') ?>',
        type: 'post',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(data){
          if(data.sukses == true){
            $('.form-control').removeClass('is-invalid');
            $('.invalid-message').remove();
            // document.cookie = "login=true";
            window.location.href="<?= site_url('dashboard') ?>";
          }else{
            loadingBtnOff('#btnLogin');
            $.each(data.error,function(key, value){
              var el = $('[name="'+key+'"]');
              el.closest('.form-control')
              .removeClass('is-invalid')
              .addClass(value.length > 0 ? 'is-invalid' : '');
              el.closest('.form-group')
              .find('.invalid-message')
              .remove();
              el.parents(".form-group")
              .append(value);
            });
          }
        }
      });
    });

  })
</script>
</body>
</html>
