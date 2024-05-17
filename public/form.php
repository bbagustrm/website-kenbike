<?php


include "database.php";

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
        <p class="font-subtitle py-4">Checkout</p>
        <hr class="border-b-[1px] border-b-textun ">
        <form class="w-full flex justify-between gap-12 my-9" onsubmit="sendMessage()">
            <div class="flex-1 flex flex-col gap-4">
                <label for="nama_pembeli" class="font-subtitle">Nama Lengkap</label>
                <input type="text" id="nama_pembeli" placeholder="masukan nama anda.." class="w-full px-4 py-2 border-[1px] border-textun">
                <label for="email_pembeli" class="font-subtitle">Email</label>
                <input type="text" id="email_pembeli" placeholder="masukan email anda.." class="w-full px-4 py-2 border-[1px] border-textun">
                <label for="nohp_pembeli" class="font-subtitle">No hp</label>
                <input type="text" id="nohp_pembeli" placeholder="masukan no hp anda.." class="w-[300px] px-4 py-2 border-[1px] border-textun">
                <label for="alamat_pembeli" class="font-subtitle">Alamat</label>
                <textarea id="alamat_pembeli" rows="7" class="w-full px-4 py-2 border-[1px] border-textun" placeholder="masukan alamat anda.."></textarea>
            </div>

            <div class="flex-none w-[360px] flex flex-col gap-4 ">
                <h4 class="font-subtitle">Ringkasan Belanja</h4>

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

                            <div class="produk flex gap-4 py-2 justify-between items-center">
                                <div class="flex gap-4">
                                    <img src="<?= $image["file_gambar"] ?>" alt="img_produk" class="w-12 h-12 border-[1px] border-textun">
                                    <div class="flex flex-col gap-1">
                                        <h3 class="font-subtitle" id="nama_produk"><?= $value["nama"] ?></h3>
                                        <div class="flex gap-1">
                                            <p class="font-caption">Color:</p>
                                            <div class="bg-<?= $cart ?> w-4 h-4 rounded-full"></div>
                                            <p class="font-caption" id="warna_produk"><?= $cart ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex flex-col items-end">
                                    <div class="flex gap-2">
                                        <p class="font-text" id="jumlah_produk"><?= $value["jumlah"] ?></p>
                                        <p class="font-text">x</p>
                                        <p class="font-text" id="harga_produk"><?= number_format($value["harga"], 0, ',', '.') ?></p>
                                    </div>
                                    <p class="font-subtitle" id="total_harga"><?= number_format($total_harga, 0, ',', '.') ?></p>
                                </div>
                            </div>

                <?php
                        }
                    }
                } else {
                    echo "keranjang kosong";
                }
                ?>
                <hr class="border-b-[1px] border-b-textun ">
                <div class="flex justify-between items-center">
                    <p class="font-text">Total</p>
                    <h3 id="subtotalElement" class="font-titlesmall"><?= number_format($total_semua, 0, ',', '.') ?></h3>
                </div>
                <button type="submit" class="w-full bg-primary hover:bg-text flex justify-center px-6 py-4">
                    <p class="font-text text-background">Checkout</p>
                </button>

            </div>
        </form>

    </div>

    <?php include "./html/footer.html"; ?>

    <script src="js/pemesanan.js"></script>

</body>

</html>