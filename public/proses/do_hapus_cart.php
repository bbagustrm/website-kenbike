<?php

include "../database.php";

$id = $_GET["id"];
$warna_barang = $_GET["warna"];

unset($_SESSION["cart"][$id][$warna_barang]);

header("location: ../keranjang.php");