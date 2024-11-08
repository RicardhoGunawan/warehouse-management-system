<?php
$page_title = "Edit Ruangan"; // Judul halaman
?>

<div class="container">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=ruangan&action=edit&id=<?= $data['ruangan']['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" 
                   value="<?= htmlspecialchars($data['ruangan']['nama_ruangan']); ?>" required>
        </div>
        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" id="is_used" name="is_used" value="1" 
                   <?= $data['ruangan']['is_used'] ? 'checked' : ''; ?>>
            <label class="form-check-label" for="is_used">Ruangan sedang digunakan</label>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=ruangan&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>
