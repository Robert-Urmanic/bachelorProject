<head>
   <?php session_start() ?>
   <style>
      a {
         color: #FFC312 !important;
      }

      .dropdown-item:hover {
         background-color: black !important;
      }
      .dropdown-menu {
         background-color: #555555 !important;
      }
      .btn-circle {
         width: 50px !important;
         height: 50px !important;
         padding: 10px 16px !important;
         font-size: 18px !important;
         line-height: 1.33 !important;
         border-radius: 25px !important;
      }
   </style>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php if(basename($_SERVER["SCRIPT_FILENAME"], '.php') != 'adminSite'){
      echo '<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
           integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
           crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
           integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
           crossorigin="anonymous"></script>';
   }
   ?>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
           integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
           crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary" style="background-color: #555555 !important;">
   <div class="container-fluid">
      <a class="navbar-brand" href="http://stavar.online/" id="indexHref">Stavař</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
         <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
               <strong>&nbsp&nbsp&nbsp&nbsp</strong>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Cihly
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item"
                         href="mhttp://stavar.online/material_display/cihly/cihelneZdivo.php">Cihelné zdivo</a>
                  </li>
                  <li><a class="dropdown-item" href="http://stavar.online/material_display/cihly/plneCihly.php">Plné
                        cihly</a></li>
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/cihly/tvarnice.php">Tvárnice</a></li>
               </ul>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Dřevo
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="http://stavar.online/material_display/drevo/osbDesky.php">OSB
                        desky</a></li>
               </ul>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Suché směsi
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/suchaSmes/malty.php">Malty</a></li>
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/suchaSmes/omitky.php">Omítky</a></li>
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/suchaSmes/sterky.php">Stěrky</a></li>
               </ul>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Hydroizolace
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/hydroizolace/nopoveFolie.php">Nopové fólie</a></li>
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/hydroizolace/asfaltovePasy.php">Asfaltové pásy</a>
                  </li>
               </ul>
            </li>
            <li class="nav-item active">
               <a class="nav-link" href="http://stavar.online/material_display/tmely/lepiciTmely.php">Lepicí tmely</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Sádrokarton
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item"
                         href="http://stavar.online/material_display/sadrokarton/protipozarSadro.php">Protipožární</a>
                  </li>
                  <li><a class="dropdown-item" href="http://stavar.online/material_display/sadrokarton/koupelSadro.php">Koupelnový</a>
                  </li>
                  <li><a class="dropdown-item" href="http://stavar.online/material_display/sadrokarton/klasSadro.php">Klasický</a>
                  </li>
               </ul>
            </li>
            <li class="nav-item active">
               <a class="nav-link" href="http://stavar.online/material_display/izolVata/izolVata.php">Izolační vata</a>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Polystyren
               </a>
               <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="http://stavar.online/material_display/polystyren/fasPolys.php">Fasádní
                        polystyren</a></li>
                  <li><a class="dropdown-item" href="http://stavar.online/material_display/polystyren/podlahPolys.php">Podlahový
                        polystyren</a></li>
               </ul>
            </li>
            <?php if(isset($_SESSION['jmeno'])){
               echo '<strong>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</strong>
            <a class="nav-link" href="http://localhost/bachelor4/src/seznam_display/seznamList.php">Seznam stavebnin</a>';
            }
            ?>
         </ul>
         <?php if(isset($_SESSION['jmeno'])){
            echo '<a class="nav-link" href="http://localhost/bachelor4/src/form_handler/logout.php">Odhlásit se</a>
            ';
            echo '<strong>&nbsp&nbsp&nbsp&nbsp</strong>
            <ul class="navbar-nav mr-right">
            <input id="adminCheck" type="hidden" value="' . $_SESSION['isAdmin'] . '"
               <h4 ><a style="color: white !important; font-size: x-large !important;" id="adminLink">' . $_SESSION['jmeno'] . ' ' . $_SESSION['prijmeni'] . '</a></h4>
            </ul>';

         } else{
            echo '
         <ul class="navbar-nav mr-right">
         <a href="http://stavar.online/user_forms/login.php" id="loginHref">
            <button class="btn btn-outline-warning">Přihlásit se</button>
         </a>
         <strong>&nbsp</strong>
         <a href="http://stavar.online/user_forms/register.php" id="registerHref">
            <button class="btn btn-outline-warning">Registrovat</button>
         </a>
         </ul>';
         }
         ?>
      </div>
   </div>
</nav>
</div>
<?php if(isset($_SESSION['id_uzivatel']))
   echo '<div class="position-absolute" style="right: 10px; bottom: 10px">
            <button type="button" class="btn btn-warning btn-circle" data-toggle="modal" data-target="#modalHlaseni"><i class="bi bi-chat"></i></button>
         </div>'; ?>
<div class="modal fade" id="modalHlaseni" tabindex="-1" role="dialog" aria-labelledby="modalHlaseniTitle"
     aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Hlášení správci</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            </button>
            </button>
         </div>
         <form action="http://localhost/bachelor4/src/form_handler/komentar_handler.php" method="post">
            <div class="modal-body">
               <div class="form-group">
                  <label for="hlaseni">Kontaktovat administrátora</label>
                  <textarea name="hlaseni" id="hlaseni" rows="3" cols="60"></textarea>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Zavřít okno</button>
               <button class="btn btn-primary btn-warning" name="submitHlaseni"
                       value="<?php echo $_SESSION['id_uzivatel'] ?>">Odeslat hlášení
               </button>
               <input type="hidden" name="url"
                      value="<?php echo 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
            </div>
         </form>
      </div>
   </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
<script>
   let adminLink = document.getElementById('adminLink');
   let adminCheck = document.getElementById('adminCheck').value;
   if(adminCheck === '1'){
      adminLink.setAttribute('href', 'http://localhost/bachelor4/src/objects/user/admin/adminSite.php');
   }
</script>

