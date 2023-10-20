<?php
/** Created by Robert Urmanič. Date: 03.04.2023 */

error_reporting(E_ERROR | E_PARSE);

use src\objects\komentar\Komentar;
use src\objects\seznam\Seznam;
use src\objects\material\Material;

include_once __DIR__ . '/../navbar/navbar.php';
include_once __DIR__ . '/../../vendor/autoload.php';
include_once __DIR__ . '/../objects/komentar/Komentar.php';
include_once __DIR__ . '/../objects/seznam/Seznam.php';
include_once __DIR__ . '/../objects/material/Material.php';

$materialClass= new Material();

$resultSet = $materialClass->defaultMaterialSelect($_GET['idIdenticky']);
$resultSetCheap = $materialClass->cheapestMaterialSelect($_GET['idIdenticky']);
?>

<head>
   <title>Detail</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
           integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
           crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
           integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
           crossorigin="anonymous"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
           integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
           crossorigin="anonymous"></script>
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <style>
      .nav-pills {
         background-color: grey !important;
      }
   </style>
</head>
<body>
<br>
<div class="container">
   <div class="card">
      <div class="container-fluid">
         <div class="wrapper row">
            <div class="preview col-md-6">

               <img src="<?php echo $resultSet[0]['obrazek'] ?>" class="rounded d-block" alt="Obrázek materiálu"
                    style="max-height: 100%; max-width: 100%">

            </div>
            <div class="details col-md-6">

               <h1><?php echo $resultSet[0]['matnazev'] ?></h1>
               <br>
               <ul class="nav nav-tabs  mb-3" id="pills-tab" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                        aria-controls="pills-home" aria-selected="true">Nabídky eshopů</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                        aria-controls="pills-profile" aria-selected="false">Popis produktu</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                        aria-controls="pills-contact" aria-selected="false">Komentáře</a>
                  </li>
               </ul>
               <div class="tab-content" id="pills-tabContent">
                  <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                       aria-labelledby="pills-home-tab">
                     <ul class="nav nav-tabs mb-3" id="pills-tab-1" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="pills-home-tab-1" data-toggle="pill" href="#pills-home-1"
                              role="tab"
                              aria-controls="pills-home-1" aria-selected="true">Doporučená nabídka</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="pills-home-tab-2" data-toggle="pill" href="#pills-home-2" role="tab"
                              aria-controls="pills-home-2" aria-selected="false">Nejnižší cena</a>
                        </li>
                     </ul>

                     <div class="tab-content" id="pills-tab-1Content">
                        <div class="tab-pane fade show active" id="pills-home-1" role="tabpanel"
                             aria-labelledby="pills-home-1"
                             style="width: 250% !important;">
                           <?php
                           $i = 1;
                           foreach($resultSet as $material){
                              echo '
                           <div class="row col-md-5" style="margin-bottom: 10px !important;">
                               <div class="col">
                                   <div class="card card-topic">
                                       <div class="card-body">
                                           <h3 class="card-title float-start"><a href=" ' . $material["odkaz"] . '">' . $material["eshnazev"] . '</a></h3> <img src="' . $material["logo"] . '" style="height: 20%; width: 20%; margin-top: 10px" class="float-end">
                                           <br>
                                           <br>
                                           <p>' . $material["matnazev"] . '</p>
                                       </div>
                                       <div class="card-footer">
                                           <div class="row">
                                               <div class="col-6 pl-0">
                                                   <button name="vybratMaterial' . $i . '"  id="vybratMaterial' . $i . '"  type="button" value="' . $material["id_material"] . '" class="btn btn-warning" data-toggle="modal" data-target="#seznamModalCenter" onclick="changeValue(' . $i . ')">Uložit materiál do seznamu</button> 
                                               </div>
                                               <div class="col-6 btn btn-block">' . $material["cena"] . ' Kč za kus 
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                            </div>
    ';

                              $i++;
                           }
                           ?>
                        </div>
                        <div class="tab-pane fade show" id="pills-home-2" role="tabpanel" aria-labelledby="pills-home-2"
                             style="width: 250% !important;">
                           <?php
                           foreach($resultSetCheap as $material){
                              {
                                 echo '
                           <div class="row col-md-5" style="margin-bottom: 10px !important;">
                               <div class="col">
                                   <div class="card card-topic">
                                       <div class="card-body">
                                           <h3 class="card-title float-start"><a href=" ' . $material["odkaz"] . '">' . $material["eshnazev"] . '</a></h3> <img src="' . $material["logo"] . '" style="height: 20%; width: 20%; margin-top: 10px" class="float-end">
                                           <br>
                                           <br>
                                           <p>' . $material["matnazev"] . '</p>
                                       </div>
                                       <div class="card-footer">
                                           <div class="row">
                                               <div class="col-6 pl-0">
                                                   <button name="vybratMaterial' . $i . '"  id="vybratMaterial' . $i . '"  type="button" value="' . $material["id_material"] . '" class="btn btn-warning" data-toggle="modal" data-target="#seznamModalCenter" onclick="changeValue(' . $i . ')">Uložit materiál do seznamu</button> 
                                               </div>
                                               <div class="col-6 btn btn-block">' . $material["cena"] . ' Kč za kus 
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                            </div>
    ';

                                 $i++;
                              }
                           }
                           ?>
                        </div>
                     </div>
                  </div>
                  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                     <?php echo '
                        <div class="col-xl-10">' .
                        $resultSet[0]['popis'] .
                        '</div>' ?>
                  </div>
                  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                     <?php
                     if(isset($_SESSION['email'])){
                        echo '<div class="form-group col-md-10">
               <form method="post" action="../../form_handler/komentar_handler.php">
                  <label for="komentar" class="float-start" style="margin-bottom: 25px">Přidejte komentář</label>
                  <div class="float-end">
                     Doporučuji:
                  <input type="radio" id="doporucuje" name="doporuceni" value="1" required>
                  <label for="doporucuje">Ano</label>
                  <input type="radio" id="nedoporucuje" name="doporuceni" value="0">
                  <label class="carousel-control-next-icon" for="nedoporucuje">Ne</label>
                  </div>
                  <textarea class="form-control" style="margin-bottom: 10px" id="komentar" name="komentar" rows="3" required></textarea>
                  <input type="hidden" name="id_identicky" value="' . $_GET['idIdenticky'] . '">
                  <input type="hidden" name="url" value="' . "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '">
                  <button class="btn btn-warning float-end">Odeslat komentář</button>
               </form>
         </div>
               ';
                     }
                     ?>

                     <div class="form-group col-md-10" <?php if(isset($_SESSION['email'])){
                        echo 'style="margin-top: 60px"';} ?>>
                        <h3>Komentáře a hodnocení uživatelů</h3>
                        <?php
                        $komentar = new Komentar('asd', $_SESSION['id_uzivatel'] ??= 0, $_GET['idIdenticky'], 0);
                        $vlozenyKomentar = $komentar->getKomentare();
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
                           echo '            </div>
                                       </div>
                                    </div>
                                    <div class="card-footer">
                                    <form action="../../form_handler/komentar_handler.php" method="post">
                                    <input type="hidden" name="uzivatelHlaseni" name="uzivatelHlaseni" value="' . $_SESSION['id_uzivatel'] . '">
                                    <input type="hidden" name="url" value="http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . '">
                                       <button class="btn btn-warning float-start" name="hlaseniKomentar" id="hlaseniKomentar" value="' . $item['id'] . '">Nahlásit komentář</button>';
                                          if($_SESSION['isAdmin'] == 1){
                                             echo '<button class="btn btn-danger float-end" name="mazaniKomentar" id="mazaniKomentar" value="' . $item['id'] . '">Smazat komentář</button>';
                                          }
                              echo'</form>
                        </div>
                     </div>';
                        }
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Modal -->
         <div class="modal fade" id="seznamModalCenter" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalCenterTitle"
              aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLabel">Uložení materiálu</h5>
                     <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                     </button>
                  </div>
                  <form action="../../form_handler/seznam_handler.php" method="post">
                     <input type="hidden" name="url"
                            value="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] ?>">
                     <div class="modal-body">
                        <label for="seznamSelect">Volba seznamu:</label>
                        <select class="form-control" id="seznamSelect" name="seznamSelect" required>
                           <option value="" disabled selected class="placeholder"><?php if(isset($_SESSION['email'])){
                                 echo 'Zvolte seznam';
                              } else{
                                 echo 'Přihlaste se pro tuto funkci';
                              } ?></option>
                           <?php
                           $seznamGet = new Seznam();
                           foreach($seznamGet->getSeznamListByUser($_SESSION['id_uzivatel']) as $item){
                              echo '<option value="' . $item['id_seznam'] . '">' . $item['nazev'] . '</option>';
                           }
                           ?>
                        </select>
                     </div>
                     <div class="modal-footer">
                        <?php if(isset($_SESSION['email'])){
                           echo '
               <a class="btn btn-warning" style="margin-right: 31%; color: black !important;" role="button" target="_blank" href="http://localhost/bachelor4/src/seznam_display/seznamList.php">Vytvořit seznam</a>';
                        } ?>
                        <button type="button" class="btn btn-secondary btn-warning" data-dismiss="modal">Neukládat
                        </button>
                        <button type="submit" class="btn btn-primary btn-success">Vložit
                        </button>
                        <input type="hidden" name="material_id" id="material_id" value="">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</body>
<script type="text/javascript">
   function changeValue(p1) {
      document.getElementById('material_id').value = $('#vybratMaterial' + p1).val();
      console.log('#vybratMaterial' + p1);
   }
</script>