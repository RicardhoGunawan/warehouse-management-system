<?php
$page_title = "Edit Lorong"; // Judul halaman
?>

<div class="container">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=lorong&action=edit&id=<?= $data['lorong']['id']; ?>" method="POST">
        <div class="mb-3">
            <label for="nama_lorong" class="form-label">Nama Lorong</label>
            <input type="text" class="form-control" id="nama_lorong" name="nama_lorong" value="<?= htmlspecialchars($data['lorong']['nama_lorong']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=lorong&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>
