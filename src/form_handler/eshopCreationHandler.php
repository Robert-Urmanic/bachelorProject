<?php
/** Created by Robert Urmanič. Date: 26.03.2023 */

session_start();

use src\objects\eshop\Eshop;

include_once '../../vendor/autoload.php';
include_once '..\objects\eshop\Eshop.php';
require_once __DIR__ . '../../simple_html_dom.php';

unset($_SESSION["testVariableGet"]);
unset($_SESSION["testVariable"]);

$eshop = new Eshop($_GET['nazev'], $_GET['promennaCena'], $_GET['promennaPopis'], $_GET['promennaObrazek'], $_GET['promennaNadpis'], $_GET['link']);
$eshop->addEshop();

$_SESSION["message"] = 'Úspěšné uložení eshopu';
header('Location: http://localhost/bachelor4/src/objects/user/admin/adminSite.php');
