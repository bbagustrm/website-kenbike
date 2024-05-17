<?php

include "database.php";



if (isset($_POST["hapus_semua"])) {
    session_unset();
    session_destroy();
}





?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Document</title>
</head>

<body class="bg-background">
    <?php include "./html/navbar.html"; ?>

    <div class="container px-4 flex flex-col mx-auto my-6">
        <p class="font-subtitle py-4">Keranjang</p>
        <hr class="border-b-[1px] border-b-textun ">
        <div class="w-full flex justify-between gap-12 my-9">
            <div class="flex-1">
                <div class="w-full flex justify-between mb-2">
                    <h1 class="font-titlesmall">Produk</h1>
                    <form action="keranjang.php" method="POST">
                        <button name="hapus_semua" class="font-textbold text-textun">Hapus Semua</button>
                    </form>
                </div>
                <hr class="border-b-[1px] border-b-textun ">
                <div class="flex flex-col gap-6 py-6">
                    <?php
                    $total_semua = 0;
                    if (!empty($_SESSION["cart"])) {
                        foreach ($_SESSION["cart"] as $barang) {
                            foreach ($barang as $cart => $value) {
                                $sql_image = "SELECT * FROM gambar_produk WHERE id_produk =" . $value["id"];
                                $result = mysqli_query($con, $sql_image);
                                $image = mysqli_fetch_assoc($result);
                                $total_harga = $value["harga"] * $value["jumlah"];
                                $total_semua += $total_harga;
                    ?>
                                <div class="w-full flex justify-between">
                                    <div class="flex gap-4">
                                        <img src="<?= $image["file_gambar"] ?>" alt="img_produk" class="w-20 h-20 border-[1px] border-textun">
                                        <div class="flex flex-col gap-1">
                                            <h3 class="font-subtitle"><?= $value["nama"] ?></h3>
                                            <div class="flex gap-2">
                                                <p class="font-caption">Color:</p>
                                                <div class="bg-<?= $cart ?> w-4 h-4 rounded-full"></div>
                                            </div>
                                            <p class="font-subtitle">Rp <?= number_format($value["harga"], 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-end justify-end  gap-4">
                                        <p class="font-subtitle text-right">Rp <?= number_format($total_harga, 0, ',', '.') ?></p>
                                        <div class="flex gap-4 items-center">
                                            <a href="proses/do_hapus_cart.php?id=<?= $value["id"] ?>&warna=<?= $cart ?>"><img class="h-6" src="../src/image/icon/ic-trash.svg" alt="icon-trash"></a>
                                            <div class="flex w-fit px-3 py-1 gap-4 items-center border-[1px] border-textun">
                                                <a href="proses/do_kurang_jumlah.php?id=<?= $value["id"] ?>&warna=<?= $cart ?>">-</a>
                                                <p id="jumlah_barang"><?= $value["jumlah"] ?></p>
                                                <a href="proses/do_tambah_jumlah.php?id=<?= $value["id"] ?>&warna=<?= $cart ?>">+</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php
                            }
                        }
                    } else {
                        echo "keranjang kosong";
                    }
                    ?>
                </div>



            </div>
            <div class="flex-none w-[300px] flex flex-col gap-4 ">
                <h4 class="font-subtitle">Total Belanja</h4>
                <div class="flex justify-between items-center">
                    <p class="font-text">Subtotal</p>
                    <h3 id="subtotalElement" class="font-titlesmall"><?= number_format($total_semua, 0, ',', '.') ?></h3>
                </div>
                <hr class="border-b-[1px] border-b-textun ">
                <a href="form.php" class="w-full border-2 border-textun hover:bg-slate-100 flex justify-center px-6 py-3"><p class="font-text">Checkout</p></a>
            </div>
        </div>


    </div>



    <?php include "./html/footer.html"; ?>

</body>

</html>