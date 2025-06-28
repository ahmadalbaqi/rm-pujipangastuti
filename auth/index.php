<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <link rel="shortcut icon" type="image/x-icon" href="../assets/img/icon.png" />
  <title>RM Puji Pangastuti - Login</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/modules/fontawesome/css/all.min.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">

  <?php
  session_start();
  if(isset($_SESSION['id_pegawai'])){
    header('location:../');
  }else{
    include 'connect.php';
    if(isset($_POST['submit'])){
      @$user = mysqli_real_escape_string($conn, $_POST['username']);
      @$pass = mysqli_real_escape_string($conn, $_POST['password']);

      $login = mysqli_query($conn, "SELECT * FROM user WHERE username='$user' AND password='$pass'");
      $cek = mysqli_num_rows($login);
      $userid = mysqli_fetch_array($login);

      if($cek == 0){
        echo '
        <script>
        setTimeout(function() {
          swal({
            title: "Login Gagal",
            text: "Username atau Password Anda Salah. Mohon periksa kembali form anda!",
            icon: "error"
            });
            }, 500);
            </script>
            ';
          }else{
            header('location:../');
            $_SESSION['id_pegawai'] = $userid['id'];
          }
        }
        ?>
      </head>
      <body>
        <div class="header finisher-header" style="width: 100%; height: 100vh;">
        <div id="app">
          <section class="section">
            <div class="container mt-5">
              <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                  <div class="login-brand">
                    <img src="../assets/img/icon.png" alt="logo" width="100" class="shadow-light rounded-circle">
                  </div>

                  <div class="card card-primary">
                    <div class="card-header">
                      <h3>Rekam Medis Puji Pangastuti</h3>
                    </div>
                  </div>

                  <div class="card card-primary">
                    <div class="card-header"><h4>Login</h4></div>

                    <div class="card-body">
                      <form method="POST" action="" class="needs-validation" novalidate="" autocomplete="off">
                        <div class="form-group">
                          <label for="username">Username</label>
                            <div class="input-group-login">
                              <i class="fa-solid fa-user"></i>
                              <input id="username" type="text" class="form-control" minlength="2" name="username" tabindex="1" required autofocus>
                            </div>
                          <div class="invalid-feedback">
                            Mohon isi username anda dengan benar!
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="d-block">
                           <label for="password" class="control-label">Password</label>
                         </div>
                         <div class="input-group-login">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                         </div>
                         <div class="invalid-feedback">
                          Mohon isi password anda!
                        </div>
                      </div>

                      <div class="form-group">

                        <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                          Login
                        </button>
                      </div>
                    </form>

                  </div>
                </div>
                <div class="simple-footer">
                  Copyright &copy; 2025 Rekam Medis Puji Pangastuti.
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

      <style>
        .input-group-login {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .input-group-login i {
            width: 30px;
            text-align: center;
            color: #34395e;
            font-size: 18px;
        }
      </style>

      <script src="../assets/js/finisher-header.es5.min.js" type="text/javascript"></script>
      <script type="text/javascript">
        new FinisherHeader({
            "count": 10,
            "size": {
              "min": 100,
              "max": 100,
              "pulse": 0
            },
            "speed": {
              "x": {
                "min": 0,
                "max": 0.2
              },
              "y": {
                "min": 0,
                "max": 0.2
              }
            },
            "colors": {
              "background": "#fdfdff",
              "particles": [
                "#ff926b",
                "#87ddfe",
                "#acaaff",
                "#1bffc2",
                "#f9a5fe"
              ]
            },
            "blending": "screen",
            "opacity": {
              "center": 1,
              "edge": 1
            },
            "skew": 0,
            "shapes": [
              "c",
              "s",
              "t"
            ]
          });
      </script>

      <!-- General JS Scripts -->
      <script src="../assets/modules/jquery.min.js"></script>
      <script src="../assets/modules/popper.js"></script>
      <script src="../assets/modules/tooltip.js"></script>
      <script src="../assets/modules/bootstrap/js/bootstrap.min.js"></script>
      <script src="../assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
      <script src="../assets/modules/moment.min.js"></script>
      <script src="../assets/js/stisla.js"></script>

      <!-- Template JS File -->
      <script src="../assets/js/scripts.js"></script>
      <script src="../assets/js/custom.js"></script>
      
      <!-- Sweet Alert -->
      <script src="../assets/modules/sweetalert/sweetalert.min.js"></script>
      <script src="../assets/js/page/modules-sweetalert.js"></script>
      </div>
    </body>
  <?php } ?>
  </html>