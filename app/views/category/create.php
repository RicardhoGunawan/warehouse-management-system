<?php
$page_title = "Tambah Kategori"; // Judul halaman
?>

<div class="container">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=category&action=create" method="POST">
        <div class="mb-3">
            <label for="category_name" class="form-label">Nama Kategori</label>
            <input type="text" class="form-control" id="category_name" name="category_name" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=category&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>
