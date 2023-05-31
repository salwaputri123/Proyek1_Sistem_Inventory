<?php
session_start();
//Membuat koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "stockbarang");

//Menambah barang baru
if (isset($_POST['addnewbarang'])) {
    $namabarang = $_POST['namaJenisBarang'];
    $deskripsi = $_POST['stock'];
    $stock = $_POST['stock'];
    $merek = $_POST['merek'];

    $addtotable = mysqli_query($conn, "insert into data_ (idBarang, idJenis, namaJenisBarang, stock, merek) values ('$namabarang', '$deskripsi', '$stock','$merek')");
    if ($addtotable) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

//Menambah barang masuk
if (isset($_POST['barangmasuk'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['desc'];
    $qty = $_POST['stock'];
    $ukuran = $_POST['ukuran'];
    if ($_FILES["image"]["error"] === 4) {
        echo
        "<script> alert ('Image Does Not Exist'); </script>"
        ;
    }
    $merk = $_POST['merk'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

    $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
    
        $validImageExtension = ['jpg','jpeg','png'];
        $imageExtension = explode('.',$fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "<script> alert ('Image Does Not Exist'); </script>"
            ;
        } else if ($fileSize > 1000000) {
            echo
            "<script> alert ('Image Size is Too Large'); </script>"
            ;
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
    
            move_uploaded_file($tmpName,'img/'. $newImageName);
            $addtomasuk = mysqli_query($conn, "insert into masuk (idbarang, keterangan, qty, ukuran, merk, gambar) values('$barangnya', '$penerima', '$qty', '$ukuran', '$merk','$newImageName')");
            $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
        }
    if ($addtomasuk) {
        header('location:index.php');
    } else {
        echo "<script> alert ('Gagal'); </script>";
        header('location:index.php');
    }
};

//Menambah barang keluar
if (isset($_POST['addbarangkeluar'])) {
    $barangnya = $_POST['barangnya'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];
    $ukuran = $_POST['ukuran'];
    $merk = $_POST['merk'];

    $cekstocksekarang = mysqli_query($conn, "select * from stock where idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang - $qty;

    $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];
    
        $validImageExtension = ['jpg','jpeg','png'];
        $imageExtension = explode('.',$fileName);
        $imageExtension = strtolower(end($imageExtension));
        if (!in_array($imageExtension, $validImageExtension)) {
            echo
            "<script> alert ('Image Does Not Exist'); </script>"
            ;
        } else if ($fileSize > 1000000) {
            echo
            "<script> alert ('Image Size is Too Large'); </script>"
            ;
        } else {
            $newImageName = uniqid();
            $newImageName .= '.' . $imageExtension;
            move_uploaded_file($tmpName,'penerima/'. $newImageName);

            $addtokeluar = mysqli_query($conn, "insert into keluar (idbarang, penerima, qty, ukuran, merk, gambarPenerima) values('$barangnya', '$penerima', '$qty', '$ukuran', '$merk', '$newImageName')");
            $updatestockmasuk = mysqli_query($conn, "update stock set stock='$tambahkanstocksekarangdenganquantity' where idbarang='$barangnya'");
        }if ($addtokeluar && $updatestockmasuk) {
        header('location:keluar.php');
    } else {
        echo 'Gagal';
        header('location:keluar.php');
    }
};
$tanggal = date('d');
$bulan = date('m');
$tahun = date('Y');

$complete = date('Y-m-d');
//update info barang
if (isset($_POST['updatebarang'])) {
    $idb = $_POST['idb'];
    $idbarang = $_POST['barangnya'];
    $stock = $_POST['stock'];
    $desc = $_POST['desc'];
    $ukuran = $_POST['ukuran'];
    $merk = $_POST['merk'];

    $update = mysqli_query($conn, "update masuk set idbarang='$idbarang', qty='$stock', keterangan='$desc', ubah='$complete' , ukuran='$ukuran', merk='$merk' where idmasuk='$idb'");
    if ($update) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

//Menghapus barang dari stock
if (isset($_POST['hapusbarang'])) {
    $idb = $_POST['idb'];

    $hapus = mysqli_query($conn, "delete from masuk where idmasuk='$idb'");
    if ($hapus) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
};

if (isset($_POST['barangkeluar'])) {
    $idmasuk = $_POST['idmasuk'];
    $idbarang = $_POST['idbarang'];

    $penerima = $_POST['penerima'];

    $sisa = $_POST['sisa'];
    $out = $_POST['keluar'];

    if ($_FILES["image"]["error"] === 4) {
        echo
        "<script> alert ('Image Does Not Exist'); </script>"
        ;
    }
    $fileName = $_FILES["image"]["name"];
    $fileSize = $_FILES["image"]["size"];
    $tmpName = $_FILES["image"]["tmp_name"];

    $validImageExtension = ['jpg','jpeg','png'];
    $imageExtension = explode('.',$fileName);
    $imageExtension = strtolower(end($imageExtension));
    if (!in_array($imageExtension, $validImageExtension)) {
        echo
        "<script> alert ('Image Does Not Exist'); </script>"
        ;
    } else if ($fileSize > 1000000) {
        echo
        "<script> alert ('Image Size is Too Large'); </script>"
        ;
    } else {
        $newImageName = uniqid();
        $newImageName .= '.' . $imageExtension;
        move_uploaded_file($tmpName,'penerima/'. $newImageName);

    $update = mysqli_query($conn, "update masuk set qty = qty - $out where idbarang='$idbarang'");
    $ambilki = mysqli_query($conn, "insert into barang_keluar (idmasuk, idbarang, keluar, penerima, gambarPenerima, tanggalKeluar) values('$idmasuk', '$idbarang', '$out','$penerima','$newImageName', '$complete')");
    }if ($update && $ambilki) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

if (isset($_POST['updatebarangkeluar'])) {
    $idmasuk = $_POST['idmasuk'];
    $idbarang = $_POST['idbarang'];
    $idkeluar = $_POST['idkeluar'];

    $penerima = $_POST['penerima'];

    $sisa = $_POST['sisa'];
    $out = $_POST['keluar'];

    $update = mysqli_query($conn, "update masuk set qty = qty - $out where idbarang='$idbarang'");
    $ambilki = mysqli_query($conn, "update barang_keluar set idbarang='$idbarang',idmasuk='$idmasuk', keluar='$out', penerima='$penerima', tanggalKeluar='$complete' where idkeluar='$idkeluar'");
    if ($update && $ambilki) {
        header('location:index.php');
    } else {
        echo 'Gagal';
        header('location:index.php');
    }
}

#Mengubah data barang masuk
if (isset($_POST['updatebarangmasuk'])) {
    $idb = $_POST['idb'];
    $idm = $_POST['idm'];
    $deskripsi = $_POST['keterangan'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select *from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from masuk where idmasuk='$idm'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update masuk set qty='$qty', keterangan='$deskripsi' where idmasuk='$idm'");
        if ($kurangistocknya && $updatenya) {
            header('location:masuk.php');
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }
}

//Menghapus barang masuk
if (isset($_POST['hapusbarangmasuk'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idm = $_POST['idm'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok - $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from masuk where idmasuk='$idm'");

    if ($update && $hapusdata) {
        header('location:masuk.php');
    } else {
        header('location:masuk.php');
    }
}

//Mengubah data barang keluar
if (isset($_POST['updatebarangkeluar'])) {
    $idb = $_POST['idb'];
    $idk = $_POST['idk'];
    $penerima = $_POST['penerima'];
    $qty = $_POST['qty'];

    $lihatstock = mysqli_query($conn, "select *from stock where idbarang='$idb'");
    $stocknya = mysqli_fetch_array($lihatstock);
    $stockskrng = $stocknya['stock'];

    $qtyskrg = mysqli_query($conn, "select * from keluar where idkeluar='$idk'");
    $qtynya = mysqli_fetch_array($qtyskrg);
    $qtyskrg = $qtynya['qty'];

    if ($qty > $qtyskrg) {
        $selisih = $qty - $qtyskrg;
        $kurangin = $stockskrg - $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    } else {
        $selisih = $qtyskrg - $qty;
        $kurangin = $stockskrg + $selisih;
        $kurangistocknya = mysqli_query($conn, "update stock set stock='$kurangin' where idbarang='$idb'");
        $updatenya = mysqli_query($conn, "update keluar set qty='$qty', penerima='$penerima' where idkeluar='$idk'");
        if ($kurangistocknya && $updatenya) {
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
    }
}

//Menghapus barang keluar
if (isset($_POST['hapusbarangkeluar'])) {
    $idb = $_POST['idb'];
    $qty = $_POST['kty'];
    $idk = $_POST['idk'];

    $getdatastock = mysqli_query($conn, "select * from stock where idbarang='$idb'");
    $data = mysqli_fetch_array($getdatastock);
    $stok = $data['stock'];

    $selisih = $stok + $qty;

    $update = mysqli_query($conn, "update stock set stock='$selisih' where idbarang='$idb'");
    $hapusdata = mysqli_query($conn, "delete from keluar where idkeluar='$idk'");

    if ($update && $hapusdata) {
        header('location:keluar.php');
    } else {
        header('location:keluar.php');
    }
}

//Menambah barang baru pada data barang
if (isset($_POST['databarang'])) {
    $idbarang = $_POST['idbarang'];
    $namaJenisBarang = $_POST['namaJenisBarang'];

    $addtotable = mysqli_query($conn, "insert into jenis_barang (idbarang, namaJenisBarang) values( '$idbarang','$namaJenisBarang')");
    if ($addtotable) {
        header('location:data.php');
    } else {
        echo 'Gagal';
        header('location:data.php');
    }
};
