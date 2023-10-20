<?php
/** Created by Robert Urmanič. Date: 15.02.2023 */
error_reporting(E_ERROR | E_PARSE);
include_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/objects/material/Material.php';

use src\objects\material\Material;
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Title</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <style>
      h1, h3 {
         color: white;
         -webkit-text-stroke: 1.5px black;
      }
      .parallax {
         /* The image used */
         background-image: url(https://2b5d8ab12d.clvaw-cdnwnd.com/4307aedbb48d97e8d1a7693b2f3c3193/200000004-d2f34d2f35/20210406_064508.jpg);

         /* Set a specific height */
         min-height: 420px;

         /* Create the parallax scrolling effect */
         background-attachment: fixed;
         background-position: center;
         background-repeat: no-repeat;
         background-size: cover;
      }

      .container-login {
         height: 100%;
         align-content: center;
      }

      .card-login {
         height: 115px;
         margin-top: 5%;
         margin-bottom: auto;
         width: 460px;
         background-color: rgba(0, 0, 0, 0.5) !important;
      }
   </style>
</head>
<body>
<?php
include_once 'navbar/navbar.php';
?>
<div class="parallax" style="margin-bottom: 20px;">
   <div class="container-login">
      <div class="d-flex justify-content-center h-100">
         <h1 style="margin-bottom: 20px; margin-top: 20px;" >S aplikací Stavař, vysokým cenám zavař</h1>
      </div>
      <div class="d-flex justify-content-center h-100">
         <h1>S námi vyhledáte vždy nejlevnější ceny</h1>
      </div>
      <?php
      if(!isset($_SESSION['email'])) echo '<div class="d-flex justify-content-center h-100">
         <div class="card-login">
            <div class="card-header">
               <h3 class="text-center">
                  Přihlaste se, abyste mohli využívat veškerých funkcí webu
               </h3>
            </div>
            <div class="card-body">
               <div class="float-start">
                  <a href="http://localhost/bachelor4/src/user_forms/login.php" id="loginHref">
                     <button class="btn btn-outline-warning" style="margin-left: 50px">Přihlásit se</button>
                  </a>
               </div>
               <div class="float-end">
                  <a href="http://localhost/bachelor4/src/user_forms/register.php" id="loginHref">
                     <button class="btn btn-outline-warning" style="margin-right: 50px">Registrovat se</button>
                  </a>
               </div>
            </div>
         </div>
      </div>';
      ?>
   </div>
</div>
<div class="d-flex justify-content-center h-100">
   <h1>Podívejte se, co zajímá ostatní stavaře</h1>
</div>
<div class="py-5">
   <div class="container">
      <div class="row hidden-md-up">
         <?php
         $materialInstance = new Material();
         $resultSetIndex = $materialInstance->getLatestSeznamMaterial();
         foreach($resultSetIndex as $material){
            $obrazek = $material["obrazek"];
            $nazev = $material["nazev"];
            $odkaz = $material["odkaz"];
            echo '<div class="card" style="width: 25%; margin-bottom: 20px;">
                     <img class="card-img-top" style="height: 15vw;" src="' . $obrazek . '" alt="' . $nazev . '">
                     <div class="card-body">
                       <h5 class="card-title"><a href=' . $odkaz . ' target=”_blank”>' . $material["nazev"] . '</a></h5>
                       <p class="card-text">Cena: ' . $material["cena"] . ' Kč za kus</p>
                     </div>
                     <div class="card-body">
                     </div>
                  </div>';
         }
         ?>

      </div>
   </div>
</div>
<?php
?>
</html>

