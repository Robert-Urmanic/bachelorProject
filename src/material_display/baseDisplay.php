<?php
/** Created by Robert Urmanič. Date: 03.04.2023 */
include_once __DIR__ . '/../navbar/navbar.php';
include_once __DIR__ . '/../../vendor/autoload.php';
include_once __DIR__ . '/../objects/material/Material.php';

error_reporting(E_ERROR | E_PARSE | E_NOTICE);
error_reporting(E_ALL & ~E_NOTICE);

use src\objects\material\Material;

$materialDisplay = new Material();

$materialDisplay->updateMaterial(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
?>
<head>
   <meta charset="UTF-8">
   <title>Title</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <style>
      .nav-pills {
         background-color: grey !important;
      }
   </style>
</head>
<body>
<div class="py-5">
   <div class="container">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" style="color: #FFC312 !important;" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Doporučená nabídka</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" style="color: #FFC312 !important;" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Nejnižší cena</button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="rating-tab" style="color: #FFC312 !important;" data-bs-toggle="tab" data-bs-target="#rating" type="button" role="tab" aria-controls="rating" aria-selected="false">Nejlepší hodnocení</button>
         </li>
      </ul>
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row hidden-md-up">
               <?php
               $resultSet = $materialDisplay->getMaterialByTypPodmaterialu(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
               foreach($resultSet as $material){
                  $obrazek = $material["obrazek"];
                  $nazev = $material["nazev"];
                  $formLink = basename($_SERVER["SCRIPT_FILENAME"], '.php') . 'Eshopy.php';
                  echo '<div class="card" style="width: 20rem; margin: 5px">
                     <img class="card-img-top" src="' . $obrazek . '" alt="' . $nazev . '">
                     <div class="card-body">
                       <h5 class="card-title">' . $material["nazev"] . '</h5>
                       <p class="card-text">Průměrná cena u eshopů: ' . $material["AVG(cena)"] . ' korun za kus</p>
                     </div>
                     <div class="card-body">
                     <form method="get" action="' . $formLink . '">
                     <input type="hidden" name="idIdenticky" id="idIdenticky" value=' . $material["id_identicky"] . '>
                     <button type="submit" class="btn btn-warning">Otevřít nabídku všech eshopů</button>
                     </form>
                     </div>
                  </div>';
               }
               ?>
            </div>
         </div>
         <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="row hidden-md-up">
               <?php
               $resultSetCheapest = $materialDisplay->getMaterialByTypPodmaterialuCheapest(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
               foreach($resultSetCheapest as $material){
                  $obrazek = $material["obrazek"];
                  $nazev = $material["nazev"];
                  $formLink = basename($_SERVER["SCRIPT_FILENAME"], '.php') . 'Eshopy.php';
                  echo '<div class="card" style="width: 20rem; margin: 5px">
                     <img class="card-img-top" src="' . $obrazek . '" alt="' . $nazev . '">
                     <div class="card-body">
                       <h5 class="card-title">' . $material["nazev"] . '</h5>
                       <p class="card-text">Průměrná cena u eshopů: ' . $material["AVG(cena)"] . ' korun za kus</p>
                     </div>
                     <div class="card-body">
                     <form method="get" action="' . $formLink . '">
                     <input type="hidden" name="idIdenticky" id="idIdenticky" value=' . $material["id_identicky"] . '>
                     <button type="submit" class="btn btn-warning">Otevřít nabídku všech eshopů</button>
                     </form>
                     </div>
                  </div>';
               }
               ?>
            </div>
         </div>
         <div class="tab-pane fade" id="rating" role="tabpanel" aria-labelledby="rating-tab">
            <div class="row hidden-md-up">
               <?php
               $resultSetBestRating = $materialDisplay->getMaterialByTypPodmaterialuBestRating(basename($_SERVER["SCRIPT_FILENAME"], '.php'));
               foreach($resultSetBestRating as $material){
                  $obrazek = $material["obrazek"];
                  $nazev = $material["nazev"];
                  $formLink = basename($_SERVER["SCRIPT_FILENAME"], '.php') . 'Eshopy.php';
                  echo '<div class="card" style="width: 20rem; margin: 5px">
                     <img class="card-img-top" src="' . $obrazek . '" alt="' . $nazev . '">
                     <div class="card-body">
                       <h5 class="card-title">' . $material["nazev"] . '</h5>
                       <p class="card-text">Průměrná cena u eshopů: ' . $material["AVG(cena)"] . ' korun za kus</p>
                     </div>
                     <div class="card-body">
                     <form method="get" action="' . $formLink . '">
                     <input type="hidden" name="idIdenticky" id="idIdenticky" value=' . $material["id_identicky"] . '>
                     <button type="submit" class="btn btn-warning">Otevřít nabídku všech eshopů</button>
                     </form>
                     </div>
                  </div>';
               }
               ?>
            </div>
         </div>
      </div>

   </div>
</div>
</body>