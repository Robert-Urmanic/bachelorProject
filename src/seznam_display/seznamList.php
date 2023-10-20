<?php
/** Created by Robert Urmanič. Date: 19.04.2023 */

use src\objects\seznam\Seznam;

error_reporting(E_ERROR | E_PARSE);

include_once '../objects/seznam/Seznam.php';
include_once '../navbar/navbar.php';
include_once __DIR__ . '/../../vendor/autoload.php';
?>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<form action="../form_handler/seznam_handler.php" method="post" class="col-md-3" style="margin-left: 10px">
   <h2>Správa seznamů</h2>
   <label for="jmenoSeznamu">Jméno seznamu: </label>
   <div class="input-group">
      <input class="form-control" type="text" required id="jmenoSeznamu" name="jmenoSeznamu">
      <button type="submit" class="btn btn-warning">Vytvořit seznam</button>
   </div>
</form>
<form action="seznamIndividual.php" method="post">
      <?php
      $seznam = new Seznam();
      $seznamList = $seznam->getSeznamListByUser($_SESSION['id_uzivatel']);
      foreach($seznamList as $item){
         echo '<div class="container">
                 <div class="row form-control d-flex justify-content-between align-items-center" style="margin-bottom: 10px">
                   <div class="col">' . $item['nazev'] . '</div>
                   <div class="col">
                     Počet materiálů v seznamu: ' . $item['countMaterial'] . '
                   </div>
                   <div class="col">
                     <input type="hidden" name="seznam_nazev" value="' . $item['nazev'] . '">
                     <button class="btn btn-warning" style="margin-left: 257px" value="' . $item['id_seznam'] . '" name="id_seznam">Zobrazit seznam</button>
                   </div>
                 </div>
               </div>
               ';
      }
      ?>
</form>
</body>
