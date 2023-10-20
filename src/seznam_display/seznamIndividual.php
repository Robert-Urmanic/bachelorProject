<?php
/** Created by Robert Urmanič. Date: 19.04.2023 */

use src\objects\seznam\Seznam;

error_reporting(E_ERROR | E_PARSE);

include_once '../objects/seznam/Seznam.php';
include_once '../navbar/navbar.php';
include_once '../../vendor/autoload.php';
?>
<head>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
           integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
           crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
           integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
           crossorigin="anonymous"></script>

</head>
<body>
<br>
<?php
$seznam = new Seznam();
$seznamJmeno = $seznam->getSeznamByID($_POST['id_seznam'] ??= $_SESSION['id_seznam']);
?>

<div class="float-start" style="margin-left: 10px"><h2>Správa materiálů
      seznamu „<?php echo $seznamJmeno ?>"</h2><br><span>Pro vkládání materiálů můžete začít procházet materiály v horní liště</span>
</div>
<div style="margin-right: 10px">
<div class="float-end"><a href="<?php echo "seznamList.php"?>">
      <button class="btn btn-warning">Vrátit se na správu seznamů</button>
   </a>

   <br><br>
   <button type="button" class="btn btn-warning" value="' . <?php $_POST['id_seznam'] ??= $_SESSION['id_seznam'] ?> . '"
           name="smazat_seznam" data-toggle="modal" data-target="#exampleModal">Smazat seznam
   </button>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<form method="post" action="../form_handler/seznam_handler.php" style="margin-right: 10px; margin-left: 10px">
   <ul class="list-group">
      <div class="list-group">
         <?php
         $seznamList = $seznam->getSeznamMaterialByUser($_POST['id_seznam'] ??= $_SESSION['id_seznam']);
         foreach($seznamList as $item){
            echo '<a target="_blank" href="' . $item["odkaz"] . '" class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
            <h5 class="mb-1">' . $item["nazev"] . '</h5>
            <img src="' . $item["obrazek"] . '" height="60px" width="60px">
            </div>
            <small>' . $item["cena"] . ' kč/ks</small>
            <input type="hidden" value="' . $item['id_seznam'] . '" name="id_seznam">
            <span class="float-sm-end"><button class="btn btn-sm btn-warning" name="id_material" value="' . $item['id_material'] . '">Smazat materiál</button></span></a>';
         }
         echo '<input type="hidden" value="';
         echo $seznamJmeno;
         echo '" name="seznam_nazev">';
         ?>
      </div>
   </ul>
</form>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Smazání seznamu</h5>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
            </button>
         </div>
         <div class="modal-body">
            Opravdu chcete smazat seznam: <?php echo $seznamJmeno ?>?
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary btn-warning" data-dismiss="modal">Ne</button>
            <form action="../form_handler/seznam_handler.php" method="post">
               <button type="submit" class="btn btn-primary btn-danger" name="delete_seznam"
                       value="<?php echo $_POST['id_seznam'] ??= $_SESSION['id_seznam'] ?>">Ano
               </button>
            </form>
         </div>
      </div>
   </div>
</div>
<?php
unset($_SESSION['id_seznam']);
?>
</body>