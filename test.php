<?php
$koneksi = mysqli_connect("localhost", "root", "", "warungku");
$cart = mysqli_query($koneksi,"SELECT * FROM dagangan Where kode_barang='eeff'");
while ($barang = mysqli_fetch_array($cart)) {
	echo $barang['kode_barang'];
	echo " ";
};
?>