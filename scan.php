
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php include 'dist/includes/title.php';?> | Scanner</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <script src="dist/js/html5-qrcode.min.js"></script>
</head>
<body class="hold-transition login-page" style="height:85vh">
<!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <a href="index.php" class="h1"><b>QR Scanner</b></a>
    </div>
    <div class="card-body">
      <div id="reader"></div>
        <form name="result" id="result" method="post" action="scan_save.php">
          <input type="hidden" name="display" id="display">
        </form>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript">
        jQuery(document).ready(function() {
            Layout.init();    
            Layout.initTwitter();
        });

        var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 10, qrbox: 500 });
            
            function onScanSuccess(decodedText, decodedResult) {
                // Handle on success condition with the decoded text or result.
                document.result.display.value = decodedText;
                //console.log(`Scan result: ${decodedText}`, decodedResult);
                document.getElementById("result").submit();

                // ...
                html5QrcodeScanner.clear();
                // ^ this will stop the scanner (video feed) and clear the scan area.
            }

            html5QrcodeScanner.render(onScanSuccess);


    window.onload = maxWindow;

    function maxWindow() {
        window.moveTo(0, 0);

        if (document.all) {
            top.window.resizeTo(screen.availWidth, screen.availHeight);
        }

        else if (document.layers || document.getElementById) {
            if (top.window.outerHeight < screen.availHeight || top.window.outerWidth < screen.availWidth) {
                top.window.outerHeight = screen.availHeight;
                top.window.outerWidth = screen.availWidth;
            }
        }
    }
</script> 
    </script>
</body>
</html>
