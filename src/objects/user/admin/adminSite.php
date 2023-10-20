<html lang="cz">
<head>
   <meta charset="UTF-8">
   <title>Admin site</title>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include_once '../../../navbar/navbar.php';
include_once '../../../../vendor/autoload.php';
include_once __DIR__ . '/../../komentar/Komentar.php';
include_once __DIR__ . '/../../hlaseni/Hlaseni.php';
include_once __DIR__ . '/../../material/Material.php';

use src\objects\komentar\Komentar;
use src\objects\hlaseni\Hlaseni;
use src\objects\material\Material;

/** Created by Robert Urmanič. Date: 23.03.2023 */
if($_SESSION['isAdmin'] != 1){
   echo '<h1>Nemáte přístup</h1>';
   die();
}
?>
<br>
<div class="row">
   <div class="span6 col-md-2" style="margin-left: 10px">
      <form method="get" action="../../../form_handler/eshopCreationHandler.php">
         <h3>Tvorba eshopu</h3>
         <div class="form-group">
            <label for="nazev">Název: </label>
            <input type="text" name="nazev" id="nazev" class="form-control"><br>
         </div>
         <div class="form-group">
            <label for="promennaCena">Proměnná cena: </label>
            <input type="text" name="promennaCena" id="promennaCena" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaCena'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="promennaPopis">Proměnná popis: </label>
            <input type="text" name="promennaPopis" id="promennaPopis" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaPopis'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="promennaObrazek">Proměnná obrázek: </label>
            <input type="text" name="promennaObrazek" id="promennaObrazek" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaObrazek'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="promennaNadpis">Proměnná název: </label>
            <input type="text" name="promennaNadpis" id="promennaNadpis" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaNadpis'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="link">Link: </label>
            <input type="text" name="link" id="link" class="form-control">
         </div>
         <br>
         <button type="submit" class="btn btn-primary">Vytvořit eshop</button>
      </form>
   </div>
   <div class="span6 col-md-2">
      <form method="get" action="../../../form_handler/materialCreationHandler.php">
         <h3>Vložení materiálu</h3>
         <div class="form-group">
            <label for="odkaz">Odkaz: </label>
            <input type="text" name="odkaz" id="odkaz" class="form-control"><br>
         </div>
         <div class="form-group">
            <label for="materialSelect">Typ materiálu:</label>
            <select name="materialSelect" id="materialSelect" class="form-control">
               <option></option>
               <optgroup label="Cihly">
                  <option value="cihla|cihelneZdivo">Cihelné zdivo</option>
                  <option value="cihla|plneCihly">Plné cihly</option>
                  <option value="cihla|tvarnice">Tvárnice</option>
               </optgroup>
               <optgroup label="Dřevo">
                  <option value="drevo|osbDesky">OSB desky</option>
               </optgroup>
               <optgroup label="Suché směsi">
                  <option value="suchaSmes|malty">Malty</option>
                  <option value="suchaSmes|omitky">Omítky</option>
                  <option value="suchaSmes|sterky">Stěrky</option>
               </optgroup>
               <optgroup label="Hydroizolace">
                  <option value="hydroizolace|nopoveFolie">Nopové fólie</option>
                  <option value="hydroizolace|asfaltovePasy">Asfaltové pásy</option>
               </optgroup>
               <optgroup label="Tmely">
                  <option value="tmely|lepiciTmely">Lepící tmely</option>
               </optgroup>
               <optgroup label="Sádrokarton">
                  <option value="sadrokarton|protipozSadro">Protipožární sádrokarton</option>
                  <option value="sadrokarton|koupelSadro">Koupelnový sádrokarton</option>
                  <option value="sadrokarton|klasSadro">Klasický sádrokarton</option>
               </optgroup>
               <optgroup label="Izolační vata">
                  <option value="izolVata|izolVata">Izolační vata</option>
               </optgroup>
               <optgroup label="Polystyren">
                  <option value="polystyren|fasPolys">Fasádní polystyren</option>
                  <option value="polystyren|podlahPolys">Podlahový polystyren</option>
               </optgroup>
            </select>
            <br>
            <br>
            <label for="checkForDuplicates">Duplikát:</label>
            <select class="checkForDuplicates form-control " name="materialDuplicate" id="materialDuplicate">
               <option value="0" disabled selected>Najít identickou stavebninu</option>
               <?php
               $materialGroupIdenticky = new Material();
               $resultSet = $materialGroupIdenticky->getMaterialGroupByIdenticky();
               foreach($resultSet as $material){
                  echo '<option value="' . $material['id_material'] . '">' . $material['nazev'] . '</option>';
               }
               ?>
            </select>
         </div>
         <br>
         <button type="submit" class="btn btn-primary" name="insertMaterial">Vložit materiál</button>
      </form>
   </div>
   <div class="span6 col-md-3">
      <form method="get" action="../../../form_handler/checkTags.php">
         <h3>Testování tagů</h3>
         <div class="form-group">
            <label for="promennaCena">Proměnná cena: </label>
            <input type="text" name="promennaCena" id="promennaCena" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaCena'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="promennaPopis">Proměnná popis: </label>
            <input type="text" name="promennaPopis" id="promennaPopis" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaPopis'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="promennaObrazek">Proměnná obrázek: </label>
            <input type="text" name="promennaObrazek" id="promennaObrazek" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaObrazek'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="promennaNadpis">Proměnná název: </label>
            <input type="text" name="promennaNadpis" id="promennaNadpis" class="form-control"
                   value="<?php echo $_SESSION['testVariableGet']['promennaNadpis'] ??= '' ?>""><br>
         </div>
         <div class="form-group">
            <label for="link">Odkaz na materiál: </label>
            <input type="text" name="link" id="link" class="form-control">
         </div>
         <br>
         <button type="submit" class="btn btn-primary">Otestovat tagy</button>
      </form>
   </div>
   <div class="span6 col-md-4">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
         <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Nahlášené komentáře
            </button>
         </li>
         <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Hlášení uživatelů
            </button>
         </li>
      </ul>
      <div class="tab-content" id="myTabContent">
         <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <?php
            $komentar = new Komentar('asd', 0, 0, 0);
            $vlozenyKomentar = $komentar->getKomentareHlasene();
            foreach($vlozenyKomentar as $item){
               echo '<div class="card mb-4">
                                    <div class="card-body">
                                      <p>' . $item['komentar'] . '</p>
                                       <div class="d-flex justify-content-between">
                                          <div class="d-flex flex-row align-items-center">
                                             <p class="small mb-0 ms-2">' . $item['jmeno'] . '</p>
                                          </div>
                                             <div class="d-flex flex-row align-items-center">';
               if($item['hodnoceni'] == 1){
                  echo '<p class="small text-muted mb-0" style="color: green !important;">Doporučuje produkt</p>';
               } else{
                  echo '<p class="small text-muted mb-0" style="color: red !important;">Nedoporučuje produkt</p>';
               }
               echo '                        </div>
                                       </div>
                                    </div>
                                    <div class="card-footer">
                        <form action="../../../form_handler/komentar_handler.php" method="post">
                                    <input type="hidden" name="uzivatelHlaseni" name="uzivatelHlaseni" value="' . $_SESSION['id_uzivatel'] . '">
                                    <input type="hidden" name="url" value="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '">
                                       <button class="btn btn-warning float-start" name="odebratHlaseni" id="odebratHlaseni" value="' . $item['id'] . '">Zanechat komentář</button>';
               if($_SESSION['isAdmin'] == 1){
                  echo '<button class="btn btn-danger float-end" name="mazaniKomentar" id="mazaniKomentar" value="' . $item['id'] . '">Smazat komentář</button>';
               }
               echo '</form>
                                    </div>
                  </div>';
            }

            ?>
         </div>
         <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <?php
            $hlaseni = new Hlaseni(0, 0, 'asd');
            $vlozeneHlaseni = $hlaseni->getHlaseni();
            foreach($vlozeneHlaseni as $item){
               echo '<div class="card mb-4">
                                    <div class="card-body">
                                      <p>' . $item['komentar'] . '</p>
                                       <div class="d-flex justify-content-between">
                                          <div class="d-flex flex-row align-items-center">
                                             <p class="small mb-0 ms-2">' . $item['jmeno'] . '</p>
                                          </div>
                                          <div class="d-flex flex-row align-items-center">';
               echo '                        </div>
                                       </div>
                                    </div>
                                    <div class="card-footer">
                        <form action="../../../form_handler/komentar_handler.php" method="post">
                                    <input type="hidden" name="url" value="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '">';
               if($_SESSION['isAdmin'] == 1){
                  echo '<button class="btn btn-danger float-end" name="mazaniHlaseni" id="mazaniHlaseni" value="' . $item['id_hlaseni'] . '">Smazat hlášení</button>';
               }
               echo '</form>
                                    </div>
                    </div>';
            }

            ?>
         </div>
      </div>
   </div>
</div>
<?php
if(isset($_SESSION['testVariable'])){
   echo 'Výsledek: <br>';
   echo 'Cena: ' . $_SESSION['testVariable']['promennaCena'] . '<br>';
   echo 'Název: ' . $_SESSION['testVariable']['promennaNadpis'] . '<br>';
   echo 'Popis: ' . $_SESSION['testVariable']['promennaPopis'] . '<br>';
   echo 'Obrázek: ' . $_SESSION['testVariable']['promennaObrazek'] . '<br>';
}
if(isset($_SESSION["errorMessage"])){
   echo '<div class="alert alert-warning" role="alert">' . $_SESSION["errorMessage"] . '
</div>';
}
unset($_SESSION["message"]);
unset($_SESSION["errorMessage"]);
?>
<select class="js-example-basic-single" name="state">
   <option value="AL">Alabama</option>
   ...
   <option value="WY">Wyoming</option>
</select>
</body>
</html>
<script>
   $(document).ready(function() {
      $('.js-example-basic-single').select2();
   });
   $(document).ready(function() {
      $('.checkForDuplicates').select2({
         placeholder: 'Najít identickou stavebninu',
      });
      $('#materialSelect').select2({
         placeholder: 'Najít typ materiálu',
      });
   });
</script>