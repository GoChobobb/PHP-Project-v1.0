<?php
$title = 'Detail Mahasiswa';

include 'layout/header.php';
// Mengambil id mahasiswa dari URL
$id_mahasiswa = (int)$_GET['id_mahasiswa'];

// Menampilkan data mahasiswa
$mahasiswa = select("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id_mahasiswa")[0];
?>

<div class="container mt-5">
    <h1>Data <?= htmlspecialchars($mahasiswa['nama']); ?></h1>
    <hr>

    <table class="table table-bordered table-striped mt-3">
        <tr>
            <td>Nama</td>
            <td>: <?= htmlspecialchars($mahasiswa['nama']); ?></td>
        </tr>
        <tr>
            <td>Program Studi</td>
            <td>: <?= htmlspecialchars($mahasiswa['prodi']); ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>: <?= htmlspecialchars($mahasiswa['jk']); ?></td>
        </tr>
        <tr>
            <td>Telepon</td>
            <td>: <?= htmlspecialchars($mahasiswa['telepon']); ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: <?= htmlspecialchars($mahasiswa['email']); ?></td>
        </tr>
        <tr>
            <td width="50%">Foto</td>
            <td>
                <a href="assets/img/<?= htmlspecialchars($mahasiswa['foto']); ?>">
                    <img src="assets/img/<?= htmlspecialchars($mahasiswa['foto']); ?>" alt="foto" width="50%">
                </a>
            </td>
        </tr>
    </table>
    <a href="mahasiswa.php" class="btn btn-secondary btn-sm" style="float: right;">Kembali</a>
</div>

<?php include 'layout/footer.php'; ?>
