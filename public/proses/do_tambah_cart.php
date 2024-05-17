<?php 
    include "../database.php";

    $id = $_GET["id"];
    $banyak_barang = $_GET["jumlah"];
    $warna_barang = $_GET["warna"];


    $sql = "SELECT * FROM produk WHERE id_produk = ". $id;
    $query = mysqli_query($con,$sql);

    if($query -> num_rows > 0){
        $result = mysqli_fetch_object($query);

        if($_SESSION["cart"][$id][$warna_barang]["jumlah"] > 0){
            $_SESSION["cart"][$id][$warna_barang]["jumlah"] += $banyak_barang;
        }else{
            $_SESSION["cart"][$id][$warna_barang] = [
                "id" => $result -> id_produk,
                "nama" => $result -> nama_produk,
                "harga" => $result -> harga_produk,
                "jumlah" => $banyak_barang
            ];
        }
        header("location: ../keranjang.php");
    }
