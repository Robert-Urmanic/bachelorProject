<?php
/** Created by Robert Urmanič. Date: 23.03.2023 */
session_start();
session_destroy();
header('location: ../index.php');