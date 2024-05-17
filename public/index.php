<?php


include "database.php";
$sql = "SELECT * FROM produk";
$query = mysqli_query($con, $sql);





?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-background">
    <?php include "./html/navbar.html"; ?>

    <div class="container px-4 flex flex-col mx-auto ">
        <div class="w-full h-[400px]  my-6 bg-cover bg-left flex" style="background-image: url(../src/image/bikeee.jpg);">
            <div class="flex-1">
            </div>
            <div class="flex-1 flex flex-col justify-center">
                <h1 class="font-highlight text-background mb-3">Cari spare part terbaik dan <br> buat sepeda impianmu</h1>
                <p class="font-text text-surface font-light mb-7">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <a href="#" class="w-fit flex items-center gap-3 px-6 py-3 bg-background rounded-full">All Product <img class="h-4" src="../src/image/icon/ic-arrow-left.svg" alt="icon-arrow"></a>
            </div>
        </div>

        <div class="w-full  px-4 py-4 flex flex-col justify-center gap-4">
            <h1 class="font-subtitle">All Product</h1>
            <hr class="border-b-[1px] border-b-textun">
            <div class="w-full flex flex-row flex-wrap gap-[1vw]">
                <?php while ($hasil = mysqli_fetch_object($query)) { ?>
                    <div class="min-w-[200px] basis-[19%] flex flex-col gap-1">
                        <div class="w-full h-[200px] bg-[#f4f3f8] flex flex-col justify-center">
                            <?php
                            $sql_image = "SELECT * FROM gambar_produk WHERE id_produk = " . $hasil->id_produk;
                            $result = mysqli_query($con, $sql_image);
                            $image = mysqli_fetch_assoc($result);
                            ?>
                            <img class="w-full" src="<?= $image["file_gambar"] ?>" alt="gambar_produk">
                            <?php mysqli_free_result($result) ?>
                        </div>
                        <div class="px-2 py-1 flex flex-col gap-1">
                            <h3 class="font-subtitle"><?= $hasil->nama_produk ?></h3>
                            <div class="flex flex-row gap-1 items-center">
                                <p class="font-caption">Color:</p>
                                <?php
                                $sql_warna = "SELECT * FROM warna_produk WHERE id_produk = " . $hasil->id_produk;
                                $result_warna = mysqli_query($con, $sql_warna);
                                ?>
                                <?php while ($hasil_warna = mysqli_fetch_object($result_warna)) { ?>
                                    <div class="bg-<?= $hasil_warna->warna ?> w-5 h-5 rounded-full"></div>
                                <?php } ?>
                                <?php mysqli_free_result($result_warna) ?>
                            </div>
                            <h3 class="font-titlesmall">Rp <?= number_format($hasil->harga_produk, 0, ',', '.') ?></h3>
                            <p class="font-caption text-green-500">Terjual <?= round($hasil->terjual_produk, -2) ?>++</p>
                            <a href="detail_product.php?id=<?= $hasil->id_produk ?>" class="w-full border-2 border-textun hover:bg-slate-100 flex justify-center px-6 py-3">Add to Cart</a>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>

    <?php include "./html/footer.html"; ?>

</body>

</html>