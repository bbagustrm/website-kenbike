<?php

    include "../database.php";
    $id = $_GET["id"];
    $warna_barang = $_GET["warna"];

    $_SESSION["cart"][$id][$warna_barang]["jumlah"]++;

    header("location: ../keranjang.php");

