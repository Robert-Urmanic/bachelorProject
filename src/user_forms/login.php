<!DOCTYPE html>
<html>
<head>
   <title>
      <?php
      if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'login'){
         echo 'Přihlášení';
      } else echo 'Registrace';
      ?>
   </title>

   <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
         integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
   <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <style>
      html, body {
         background-image: url('https://2b5d8ab12d.clvaw-cdnwnd.com/4307aedbb48d97e8d1a7693b2f3c3193/200000004-d2f34d2f35/20210406_064508.jpg');
         background-size: cover;
         background-repeat: no-repeat;
         height: 90%;
      }

      .container {
         height: 100%;
         align-content: center;
      }

      .card {
      <?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'login'){
      echo 'height:300px;';
      } else echo 'height: 390px;';
      ?> margin-top: auto;
         margin-bottom: auto;
         width: 400px;
         background-color: rgba(0, 0, 0, 0.5) !important;
      }

      .card-header h3 {
         color: white;
      }

      .input-group-prepend span {
         width: 50px;
         background-color: #FFC312;
         color: black;
         border: 0 !important;
      }

      .login_btn {
         color: black;
         background-color: #FFC312;
         width: 100px;
      }

      .login_btn:hover {
         color: black;
         background-color: white;
      }

      .links {
         color: white;
      }

      .links a {
         margin-left: 4px;
      }
   </style>
</head>
<body>
<?php
include_once '../navbar/navbar.php';
if(isset($_SESSION['jmeno'])){
   echo '<h1 style="margin-top: 50px; margin-left: 50px">Jste již přihlášen</h1>';
   die();
}
?>
<div class="container">
   <div class="d-flex justify-content-center h-100">
      <div class="card">
         <div class="card-header">
            <h3>
               <?php
               if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'login'){
                  echo 'Přihlaste se';
               } else echo 'Registrujte se'
               ?>
            </h3>
         </div>
         <div class="card-body">
            <form method="post" action="
            <?php
            if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'login'){
               echo '..\form_handler\login_handler.php';
            } else echo '..\form_handler\registration_handler.php';
            ?>">
               <?php
               if(basename($_SERVER["SCRIPT_FILENAME"], '.php') != 'login'){
                  echo '
                     <div class="input-group form-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="jmeno" id="jmeno" class="form-control" placeholder="Petr" maxlength="55" required value ="';
                  echo $_SESSION["temp_post_form"]['jmeno'] ??= null;
                  echo '">';
                  echo '
                     </div>
                     <div class="input-group form-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" id="prijmeni" name="prijmeni" class="form-control" placeholder="Novák" maxlength="55" required value="';
                  echo $_SESSION["temp_post_form"]['prijmeni'] ??= null;
                  echo '">';
                  echo '
                     </div>';
               }
               ?>
               <div class="input-group form-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" id="email" name="email" class="form-control" placeholder="petr.novak@email.com"
                         maxlength="255" required value="<?php
                  echo $_SESSION["temp_post_form"]['email'] ??= null;
                  echo '">'
                  ?>

               </div>
               <div class=" input-group form-group">
                  <div class="input-group-prepend">
                     <span class="input-group-text"><i class="fas fa-key"></i></span>
                  </div>
                  <input type="password" id="heslo" name="heslo" class="form-control" placeholder="heslo"
                         maxlength="255" required <?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') != 'login'){
                     echo 'value = "';
                     echo $_SESSION["temp_post_form"]['heslo'] ??= null;
                     echo '"';
                  } ?>>
               </div>
               <div class="form-group">
                  <input type="submit" value=
                  <?php
                  if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'login'){
                     echo 'Přihlásit';
                  } else echo 'Registrovat'
                  ?> class="btn float-right login_btn">
               </div>
            </form>
         </div>
         <div class="card-footer">
            <?php
            if(basename($_SERVER["SCRIPT_FILENAME"], '.php') == 'login'){
               echo '<div class="d-flex justify-content-center links">
               Nemáte účet?<a href="register.php">Registrujte se</a>
            </div>';
            } else echo '<div class="d-flex justify-content-center links">
               Máte účet?<a href="login.php">Přihlaste se</a>
            </div>'
            ?>
         </div>
      </div>
   </div>
</div>
<?php
if(isset($_SESSION["temp_post_form"]["errorMessageRegistration"])){
   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Duplikát uživatele</strong>! ' . $_SESSION["temp_post_form"]["errorMessageRegistration"] .
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else if(isset($_SESSION["temp_post_form"]["successMessageLogin"])){
   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Úspěšná registrace</strong>! ' . $_SESSION["temp_post_form"]["successMessageLogin"] .
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
} else if(isset($_SESSION["temp_post_form"]["errorMessageLogin"])){
   //TODO make notifications unclickable or fix javascript to amke then clickable
   echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Neúspěšné přihlášení</strong>! ' . $_SESSION["temp_post_form"]["errorMessageLogin"] .
      '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
unset($_SESSION["temp_post_form"]);
?>
</body>
</html>
<script>
   let registerHref = document.getElementById('registerHref');
   let loginHref = document.getElementById('loginHref');
   let indexHref = document.getElementById('indexHref');

   registerHref.setAttribute('href', 'register.php');
   loginHref.setAttribute('href', 'login.php');
   indexHref.setAttribute('href', '../index.php');

</script>

