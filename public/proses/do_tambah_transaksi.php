<?php

include "../database.php";

$sql = "INSERT INTO header_transaksi (created_at) VALUES ('" . date("Y-m-d") . "')";
$query = mysqli_query($con, $sql);
$id_transaksi = mysqli_insert_id($con);

$sql = "INSERT INTO pembeli (nama_pembeli, email_pembeli, nohp_pembeli, alamat_pembeli) VALUES ('" . $_SESSION["pembeli"]["nama_pembeli"] ."', '" . $_SESSION["pembeli"]["email_pembeli"] ."', '" . $_SESSION["pembeli"]["nohp_pembeli"] ."' , '" . $_SESSION["pembeli"]["alamat_pembeli"] ."')";
$query = mysqli_query($con,$sql);
$id_pembeli = mysqli_insert_id($con);

foreach ($_SESSION["cart"] as $barang) {
    foreach ($barang as $cart => $value) {
        $sql = "INSERT INTO detail_transaksi (id_header_transaksi, id_pembeli, id_produk, warna_produk, jumlah_produk, jumlah_harga) VALUES (" . $id_transaksi . ", " . $id_pembeli . ", " . $value["id"] . ", '" . $cart . "', " . $value["jumlah"] . ", " . $value["jumlah"] * $value["harga"] . ")";
        $query = mysqli_query($con, $sql);
    }
}

unset($_SESSION["cart"]);

header("location:../thanks.php");