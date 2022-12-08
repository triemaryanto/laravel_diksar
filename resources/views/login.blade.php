<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KSP DIAN MANDIRI | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('template/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('template/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('template/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('template/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page" onload="getLocation()">
  <div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="{{ route('login') }}" class="h1"><b>DIKSAR</b>2022</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">KSP DIAN MANDIRI</p>

        <form action="{{ route('login.anggota') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control" name="username" placeholder="ID Anggota">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <div class="input-group date" id="reservationdate" data-target-input="nearest">
              <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="tgl" />
              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
              </div>
            </div>
          </div>
          <textarea name="latitude" id="latitude" hidden></textarea>
          <textarea name="longitude" id="longitude" hidden></textarea>
          @if (session('failed'))
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
            {{ session('failed') }}
          </div>

          @endif
          <div class="row">
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
          @php
          if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
          $ip = $_SERVER['HTTP_CLIENT_IP'];
          }
          //whether ip is from the proxy
          elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
          $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
          }
          //whether ip is from the remote address
          else{
          $ip = $_SERVER['REMOTE_ADDR'];
          }
          echo 'User IP Address - '.$ip;
          @endphp
          <textarea name="ip" hidden> @php echo $ip @endphp</textarea>
        </form>
      </div>
      <!-- /.card-body -->
    </div>

    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>
  <!-- Select2 -->
  <script src="{{ asset('template/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('template/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('template/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
  <!-- date-range-picker -->
  <script src="{{ asset('template/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <script>
    var x = document.getElementById("latitude");
    var y = document.getElementById("longitude");

    function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
    }

    function showPosition(position) {
      x.innerHTML = position.coords.latitude;
      y.innerHTML = position.coords.longitude;
    }
  </script>
  <script>
    $(function() {
      //Initialize Select2 Elements
      $('.select2').select2()

      //Initialize Select2 Elements
      $('.select2bs4').select2({
        theme: 'bootstrap4'
      })

      //Date picker
      $('#reservationdate').datetimepicker({
        format: "DD/MM/YYYY"
      });

      //Timepicker
      $('#timepicker').datetimepicker({
        format: 'LT'
      })

    })
  </script>
</body>

</html>