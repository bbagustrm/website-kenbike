<?php

    include "../database.php";
    $id = $_GET["id"];
    $warna_barang = $_GET["warna"];


    if ($_SESSION["cart"][$id][$warna_barang]["jumlah"] == 1) {
        unset($_SESSION["cart"][$id][$warna_barang]);  
    }else{
        $_SESSION["cart"][$id][$warna_barang]["jumlah"]--;
    }

    header("location: ../keranjang.php");

