function sendMessage(){
    var produkElements = document.querySelectorAll(".produk")

    var rincianProduk = ``;
    var total = 0;

    produkElements.forEach(function(produkElement){
        var namaProduk = produkElement.querySelector("#nama_produk").innerText
        var warnaProduk = produkElement.querySelector("#warna_produk").innerText
        var jumlahProduk = produkElement.querySelector("#jumlah_produk").innerText
        var hargaProduk = produkElement.querySelector("#harga_produk").innerText
        var totalHarga = parseInt(produkElement.querySelector("#total_harga").innerText) * 1000
        
        rincianProduk += `${namaProduk}-${warnaProduk} ${jumlahProduk}x \n`
        total += totalHarga
    
    })


    var text = ` Pemesanan \n
Nama Lengkap : ${nama_pembeli.value}
Email : ${email_pembeli.value}
NoHp : ${nohp_pembeli.value}
Alamat :
${alamat_pembeli.value}\n
Dengan rincian Pemesanan:
${rincianProduk}
`
    var encodedText = encodeURIComponent(text);
    const urlToWhatsapp = `https://wa.me/62895361078490?text=${encodedText}`

    window.open(urlToWhatsapp, "_blank")


}