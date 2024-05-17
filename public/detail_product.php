<?php

include "database.php";

$id = $_GET["id"];

$sql = "SELECT * FROM produk WHERE id_produk = " . $id;
$query = mysqli_query($con, $sql);
$result = mysqli_fetch_object($query);

$sql_image = "SELECT file_gambar FROM gambar_produk WHERE id_produk = " . $id;
$query_gambar = mysqli_query($con, $sql_image);


$gambar_array = array();

while ($row = mysqli_fetch_array($query_gambar)) {
    $gambar_array[] = $row['file_gambar'];

}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Detail Product</title>
</head>

<body class="bg-background">
    <?php include "./html/navbar.html"; ?>

    <div class="container px-4 flex flex-col mx-auto my-6">
        <div class="flex gap-3 items-center py-4">
            <p class="font-subtitle">Product</p>
            <img class="h-3" src="../src/image/icon/ic-arrow-left.svg" alt="icon-arrow">
            <p class="font-subtitle"><?= $result->nama_produk ?></p>
        </div>
        <hr class="border-b-[1px] border-b-textun ">

        <div class="container flex justify-between gap-12 my-9">
            <div class="flex-none w-[400px] ">
                <div class="w-full h-[400px] bg-[#f4f3f8] flex flex-col justify-center mb-4 border-[1px] border-textun">
                    <img id="preview" class="w-full" src="<?= $gambar_array[0] ?>" alt="gambar_produk">
                </div>
                <div class="w-full flex flex-wrap gap-2">
                    <?php for ($i = 0; $i < count($gambar_array); $i++) { ?>
                        <div class="w-20 h-20 bg-[#f4f3f8] flex flex-col justify-center border-[1px] border-textun">
                            <img di="<?= $gambar_array[$i] ?>" class="w-full" src="<?= $gambar_array[$i] ?>" alt="gambar_produk">
                        </div>
                    <?php } ?>
                </div>
            </div>
            <div class="grow flex flex-col gap-3">
                <h1 class="font-title "><?= $result->nama_produk ?></h1>
                <p class="font-text text-green-500">Terjual <?= round($result->terjual_produk, -2) ?>++</p>
                <h3 class="font-title">Rp <?= number_format($result->harga_produk, 0, ',', '.') ?></h3>
                <hr class="border-b-[1px] border-b-textun my-3">
                <h4 class="font-subtitle">Pilih Warna : <span class="preview_text text-textun">silver</span>
                </h4>
                <?php
                $sql_warna = "SELECT * FROM warna_produk WHERE id_produk = " . $id;
                $result_warna = mysqli_query($con, $sql_warna);
                ?>
                <div class="flex gap-4">
                    <?php while ($hasil_warna = mysqli_fetch_object($result_warna)) { ?>
                        <div class="warna bg-surface flex gap-2 items-center px-3 py-[6px] rounded-full cursor-pointer">
                            <div class="bg-<?= $hasil_warna->warna ?> w-5 h-5 rounded-full"></div>
                            <p class="font-text"><?= $hasil_warna->warna ?></p>
                        </div>
                    <?php } ?>
                </div>
                <?php mysqli_free_result($result_warna) ?>
                <hr class="border-b-[1px] border-b-textun my-3">
                <h4 class="font-subtitle">Detail :</h4>
                <div class="mt-4 font-text"><?= $result->deskripsi_produk ?></div>
            </div>
            <div class="flex-none w-[300px] flex flex-col gap-4 ">
                <h4 class="font-subtitle">Atur Jumlah</h4>
                <div class="flex gap-4 items-center">
                    <img class="w-16 h-16 border-[1px] border-textun" src="<?= $gambar_array[0] ?>" alt="gambar_produk">
                    <p class="preview_text">silver</p>
                </div>
                <hr class="border-b-[1px] border-b-textun ">
                <div class="flex w-fit px-3 py-1 gap-4 items-center border-[1px] border-textun">
                    <button id="kurang">-</button>
                    <p id="jumlah_barang">1</p>
                    <button id="tambah">+</button>
                </div>
                <div class="w-full flex gap-4 items-center justify-between"> 
                    <p class="font-text">Subtotal</p>
                    <h3 id="subtotalElement" class="font-titlesmall"><?= number_format($result->harga_produk, 0, ',', '.') ?></h3>
                </div>
                <p id="ini_id" class="hidden"><?= $id ?></p>
                <a id="cart_link" href="proses/do_tambah_cart.php?id=<?= $id ?>&jumlah=0&warna=silver" class="w-full border-2 border-textun hover:bg-slate-100 flex justify-center px-6 py-3">Add to Cart</a>
            </div>
        </div>



    </div>



    <?php include "./html/footer.html"; ?>
    <script src="js/jumlah_barang.js"></script>
</body>

</html>