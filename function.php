<?php
// Koneksi Database
$koneksi = mysqli_connect("localhost", "root", "", "warungku");
//$koneksi = mysqli_connect('localhost','mytelkom_admin','telkomsanskuy','mytelkom_warungku');

// membuat fungsi query dalam bentuk array
function query($query)
{
    // Koneksi database
    global $koneksi;

    $result = mysqli_query($koneksi, $query);

    // membuat varibale array
    $rows = [];

    // mengambil semua data dalam bentuk array
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

// Membuat fungsi tambah user
function regis($data)
{
    global $koneksi;
    $name = htmlspecialchars($data['name']);
    $email = $data['email'];
    $password = md5($data["password"]);
    $repassword = md5($data["repassword"]);
    $level=1;
    $gambar="fotolaki.png";

    if($password==$repassword){
        $sql= "select * from users where email='$email'";
        $hasil = mysqli_query($koneksi, $sql);
        if(!$result -> num_rows > 0){
            $sql = "INSERT INTO users (level,name,email,password,foto) values ('$level','$name','$email','$password','$gambar')";
            $hasil = mysqli_query($koneksi, $sql);
            if($hasil){
                echo "<script>alert('Registrasi berhasil')</script>";  
            } else {
                echo "<script>alert('Terdapat Kesalahan')</script>"; 
            }
        } else {
            echo "<script>alert('Email sudah dipakai')</script>"; 
        }
    } else {
        echo "<script>alert('Password harus sama')</script>"; 
    }
    
    return mysqli_affected_rows($koneksi);
}

function login($data)
{
    global $koneksi;
    $email = $data['emaillogin'];
    $password = md5($_POST["Passwordlogin"]);

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email' AND password='$password'");
	$cek = mysqli_num_rows($result);
    if ($cek > 0) {
		$row = mysqli_fetch_assoc($result);
        $_SESSION['login'] = true;
        $_SESSION['id'] = $row['id'];
		$_SESSION['name'] = $row['name'];
        $_SESSION['title'] = "WarungKu";
        $_SESSION['level'] = $row['level'];
        $level=$row['level'];
        if($level == 0){
            header("Location: dagangan");
        }
        else{
            header("Location: index");
        }
		
	} else {
		echo "<script>alert('Woops! Email Atau Password anda Salah.')</script>";
	}
    
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi tambah
function tambah($data)
{
    global $koneksi;
    $id_kategori = $data['id_kategori'];
    $pilih = mysqli_query($koneksi, "SELECT * FROM dagangan where id_kategori=$id_kategori order by id_kategori DESC LIMIT 1");
    $nilai = mysqli_fetch_array($pilih);
    $jumlah =mysqli_num_rows($pilih);
    if($jumlah > 0){
        $a = $nilai['id_barang'];
        $b = 1;
        $id= $a + $b;
    } else{
        $a = $id_kategori;
        $b = 1;
        $id = "$a$b";
    }
    // echo "<script>alert('$a $b $id')</script>"; 
    $id_barang = $id; 
    $nama_barang = htmlspecialchars($data['nama']);
    $kode_barang = htmlspecialchars($data['kode']);
    $deskripsi_barang = htmlspecialchars($data['deskripsi']);
    $jumlah_barang = $data['jumlah'];
    $harga_barang = $data['harga'];
    $gambar = upload();

    if (!$gambar) {
        return false;
    }

    $sql = "INSERT INTO dagangan VALUES ('$id_barang','$id_kategori','$kode_barang','$nama_barang','$gambar','$deskripsi_barang','$jumlah_barang','$harga_barang')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi tambah keranjang
function add($id_barang)
{
    global $koneksi;
     
    $db = mysqli_query($koneksi, "SELECT * FROM dagangan where id_barang=$id_barang");
    $pilih = mysqli_fetch_array($db);
    $id_user=$_SESSION['id'];
    // echo "<script>alert('$a $b $id')</script>";  
    $nama_barang = $pilih['nama_barang'];
    $jumlah_barang = 1;
    $kode_barang = $pilih['kode_barang'];
    $harga_barang = $pilih['harga_barang'];
    $gambar=$pilih['gambar_barang'];
    $id_keranjang="";
    $sql = "INSERT INTO keranjang VALUES ('$id_keranjang','$id_user','$kode_barang','$nama_barang','$jumlah_barang','$harga_barang','$gambar')";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi tambah keranjang
function delete($id_keranjang)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_keranjang = $id_keranjang");
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi tambah
function checkout($id)
{
    global $koneksi;
    $pilih = mysqli_query($koneksi, "SELECT * FROM riwayat_pembayaran order by id_bayar DESC");
    $nilai = mysqli_fetch_array($pilih);
    $jumlah =mysqli_num_rows($pilih);
    if($jumlah > 0){
        $a = $nilai['id_bayar'];
        $b = 1;
        $id2= $a + $b; 
    }
    // echo "<script>alert('$a $b $id2')</script>"; 
    $pilih2 = mysqli_query($koneksi, "SELECT * FROM keranjang WHERE id_user=$id");
    $item = mysqli_fetch_array($pilih2);
    $id_barang = $item['id_user'];
    $list_barang = $item['barang'];
    $jumlah_barang = $item['jumlah'];
    $harga_barang = $item['harga'];
    $kode = $item['kode_barang'];

    $pilih3 = mysqli_query($koneksi, "SELECT * FROM dagangan WHERE kode_barang='$kode'");
    $barang = mysqli_fetch_array($pilih3);
    $jml = $barang['jumlah_barang'];
    $sisa = $jml-$jumlah_barang;
    
    $sql = "INSERT INTO riwayat_pembayaran VALUES ('$id2','$list_barang','$jumlah_barang','$harga_barang')";
    $sql2 = "UPDATE dagangan SET  jumlah_barang = '$sisa' WHERE kode_barang='$kode'";

    mysqli_query($koneksi, $sql);
    mysqli_query($koneksi, $sql2);

    return mysqli_affected_rows($koneksi); 
}


// Membuat fungsi Hapus setelah pembelian
function deleted($id)
{
    global $koneksi;
    mysqli_query($koneksi, "DELETE FROM keranjang WHERE id_user = $id");
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi hapus
function hapus($id_barang)
{
    global $koneksi;
    $pilih = mysqli_query($koneksi, "SELECT * FROM dagangan WHERE id_barang= $id_barang");
    $datafoto = mysqli_fetch_array($pilih);
    $foto = $datafoto['gambar_barang'];
    unlink("asset/images/produk/".$foto);
    mysqli_query($koneksi, "DELETE FROM dagangan WHERE id_barang = $id_barang");
    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi ubah
function ubah($data)
{
    global $koneksi;

    $id_kategori = $data['id_kt'];
    $id_barang = $data['id_br'];
    $nama_barang = htmlspecialchars($data['nama']);
    $deskripsi_barang = htmlspecialchars($data['deskripsi']);
    $kode_barang = htmlspecialchars($data['kode']);
    $jumlah_barang = $data['jumlah'];
    $harga_barang = $data['harga'];
    $gambarLama = $data['gambarLama'];

    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }
    unlink("asset/images/produk/".$gambarLama);

    $sql = "UPDATE dagangan SET nama_barang = '$nama_barang',kode_barang = '$kode_barang', gambar_barang = '$gambar', deskripsi_barang = '$deskripsi_barang', jumlah_barang = '$jumlah_barang', harga_barang = '$harga_barang' WHERE id_barang = $id_barang";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi ubah
function ubahitem($data)
{
    global $koneksi;
    $id_keranjang=$data['id_keranjang'];
    $jumlah = $data['jumlah'];
    $harga = $data['harga'];
    $hargabaru = $harga*$jumlah;

    $sql = "UPDATE keranjang SET jumlah = '$jumlah',harga = '$hargabaru' WHERE id_keranjang = $id_keranjang";

    mysqli_query($koneksi, $sql);

    return mysqli_affected_rows($koneksi);
}

// Membuat fungsi upload gambar
function upload()
{
    // Syarat
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika tidak mengupload gambar atau tidak memenuhi persyaratan diatas maka akan menampilkan alert dibawah
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // format atau ekstensi yang diperbolehkan untuk upload gambar adalah
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    // Jika format atau ekstensi bukan gambar maka akan menampilkan alert dibawah
    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    // Jika ukuran gambar lebih dari 3.000.000 byte maka akan menampilkan alert dibawah
    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    // nama gambar akan berubah angka acak/unik jika sudah berhasil tersimpan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    // memindahkan file ke dalam folde img dengan nama baru
    move_uploaded_file($tmpName, 'asset/images/produk/' . $namaFileBaru);

    return $namaFileBaru;
}

function profile()
{
    // Syarat
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // Jika tidak mengupload gambar atau tidak memenuhi persyaratan diatas maka akan menampilkan alert dibawah
    if ($error === 4) {
        echo "<script>alert('Pilih gambar terlebih dahulu!');</script>";
        return false;
    }

    // format atau ekstensi yang diperbolehkan untuk upload gambar adalah
    $extValid = ['jpg', 'jpeg', 'png'];
    $ext = explode('.', $namaFile);
    $ext = strtolower(end($ext));

    // Jika format atau ekstensi bukan gambar maka akan menampilkan alert dibawah
    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda upload bukanlah gambar!');</script>";
        return false;
    }

    // Jika ukuran gambar lebih dari 3.000.000 byte maka akan menampilkan alert dibawah
    if ($ukuranFile > 3000000) {
        echo "<script>alert('Ukuran gambar anda terlalu besar!');</script>";
        return false;
    }

    // nama gambar akan berubah angka acak/unik jika sudah berhasil tersimpan
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ext;

    // memindahkan file ke dalam folde img dengan nama baru
    move_uploaded_file($tmpName, 'asset/images/profile/' . $namaFileBaru);

    return $namaFileBaru;
}