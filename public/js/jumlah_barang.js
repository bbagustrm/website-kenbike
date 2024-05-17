var jumlahBarangElement = document.getElementById('jumlah_barang')
var tambahButton = document.getElementById('tambah')
var kurangButton = document.getElementById('kurang')
var idProduk = document.getElementById('ini_id').innerText
var cartLink = document.getElementById('cart_link')

var subtotalElement = document.getElementById('subtotalElement')


var warna = document.querySelectorAll('.warna')
var preview_text = document.querySelectorAll('.preview_text')

var subtotal= parseInt(subtotalElement.innerText)
var jumlahBarang = parseInt(jumlahBarangElement.innerText)
var warna_produk = 'silver'

function updateBarang() {
    cartLink.href = `proses/do_tambah_cart.php?id=${idProduk}&jumlah=${jumlahBarang}&warna=${warna_produk}`;
}

warna[0].classList.toggle('border-[1px]')
warna[0].classList.toggle('border-textun')
warna[0].classList.toggle('selected')

warna.forEach(function(w){
    w.addEventListener('click', function(){
        warna[0].classList.toggle('border-[1px]')
        warna[0].classList.toggle('border-textun')
        warna[0].classList.toggle('selected')
        warna[1].classList.toggle('border-[1px]')
        warna[1].classList.toggle('border-textun')
        warna[1].classList.toggle('selected')
        if (w.classList.contains('selected')) {
            var p = w.querySelector('p');
            warna_produk = p.innerHTML;
            preview_text.forEach(function(text){
                text.innerHTML = warna_produk;
            })
            updateBarang();
        }
    })
})

tambahButton.addEventListener('click', function() {
    jumlahBarang++;
    jumlahBarangElement.innerText = jumlahBarang;
    subtotalElement.innerText = `${jumlahBarang * subtotal}.000`
    updateBarang();
});

kurangButton.addEventListener('click', function() {
    if(jumlahBarang > 1){
        jumlahBarang--;
        jumlahBarangElement.innerText = jumlahBarang;
        subtotalElement.innerText = `${jumlahBarang * subtotal}.000`
        updateBarang();
    }
});


updateBarang();



