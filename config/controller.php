<?php

//fungsi menampilkan data barang
function select($query) 
{
    //panggil koneksi database
    global $db;

    $result = mysqli_query($db, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

//fungsi menambahkan data barang
function create_barang($post)
{
    global $db;

    $nama   = $post['nama'];
    $jumlah = $post['jumlah'];
    $harga  = $post['harga'];

    //query tambah data
    $query = "INSERT INTO barang VALUES(null, '$nama', '$jumlah', '$harga', CURRENT_TIMESTAMP())";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi mengubah data barang
function update_barang($post)
{
    global $db;

    $id_barang  = $post['id_barang'];
    $nama       = $post['nama'];
    $jumlah     = $post['jumlah'];
    $harga      = $post['harga'];

    //query tambah data
    $query = "UPDATE barang SET nama= '$nama', jumlah='$jumlah', harga='$harga' WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}

//fungsi menghapus data barang
function delete_barang($id_barang)
{
    global $db;

    //query hapus data
    $query = "DELETE FROM barang WHERE id_barang = $id_barang";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
//fungsi menambah data mahasiswa
function create_mahasiswa($post)
{
    global $db;

    $nama   = $post['nama'];
    $prodi  = $post['prodi'];
    $jk     = $post['jk'];
    $telepon= $post['telepon'];
    $email  = $post['email'];
    $foto   = upload_file();


    // check upload foto
    if (!$foto) {
        return false;
    }

    //query tambah data
    $query = "INSERT INTO mahasiswa VALUES(null, '$nama', '$prodi', '$jk','$telepon','$email','$foto')";

    mysqli_query($db, $query);

    return mysqli_affected_rows($db);
}
function upload_file()
{
    $namaFile = $_FILES['foto']['name'];
    $ukuranFile = $_FILES['foto']['size'];
    $error = $_FILES['foto']['error'];
    $tmpName = $_FILES['foto']['tmp_name'];

    // Check file yang di upload
    $extensifileValid = ['jpg', 'jpeg', 'png'];
    $extensifile = explode('.', $namaFile);
    $extensifile = strtolower(end($extensifile));

    if (!in_array($extensifile, $extensifileValid)) {
        // Pesan gagal
        echo "<script>
        alert('Format File Tidak Valid');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // Check ukuran file 2 MB
    if ($ukuranFile > 2048000) {
        // Pesan gagal
        echo "<script>
        alert('Ukuran File Melebihi 2 MB');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }

    // Generate nama file baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extensifile;

    // Pindahkan ke folder lokal
    if (move_uploaded_file($tmpName, 'assets/img/' . $namaFileBaru)) {
        return $namaFileBaru;
    } else {
        // Pesan gagal jika file tidak berhasil dipindahkan
        echo "<script>
        alert('Gagal mengunggah file');
        document.location.href = 'tambah-mahasiswa.php';
        </script>";
        die();
    }
    
        // Pindahkan file ke folder lokal
        $uploadPath = 'assets/img/' . $namaFileBaru;
        if (!move_uploaded_file($tmpName, $uploadPath)) {
            echo "<script>
            alert('Gagal Mengupload File');
            document.location.href = 'tambah-mahasiswa.php';
            </script>";
            die();
        }
    
        return $namaFileBaru;
}      