<?php
// Memanggil atau membutuhkan file function.php
require 'function.php';
if (!isset($_SESSION['login'])) {
    header('location:login');
    exit;
}
// Menampilkan semua data dari table siswa berdasarkan nis secara Descending
$item = query("SELECT * FROM dagangan ORDER BY id_barang DESC");

// Membuat nama file
$filename = "data dagangan-" . date('Ymd') . ".xls";

// Kodingam untuk export ke excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Dagangan.xls");

?>
<table class="text-center" border="1">
    <thead class="text-center">
        <tr>
            <th>ID Kategori</th>
            <th>ID Barang</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="text-center">
        <?php $no = 1; ?>
        <?php foreach ($sitem as $row) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['id_kategori']; ?></td>
                <td><?= $row['id_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['jumlah_barang']; ?></td>
                <td><?= $row['harga_barang']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>