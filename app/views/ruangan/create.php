<?php
$page_title = "Tambah Ruangan"; // Judul halaman
?>

<div class="container">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=ruangan&action=create" method="POST">
        <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=ruangan&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>
