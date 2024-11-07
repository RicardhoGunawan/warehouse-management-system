<?php
$page_title = "Tambah Supplier"; // Judul halaman
?>

<div class="container">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=supplier&action=create" method="POST">
        <div class="mb-3">
            <label for="company_name" class="form-label">Company</label>
            <input type="text" class="form-control" id="company_name" name="company_name"
                value="<?= htmlspecialchars($data['supplier']['company_name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama_supplier" class="form-label">Nama Supplier</label>
            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" required>
        </div>
        <div class="mb-3">
            <label for="telepon" class="form-label">Telepon</label>
            <input type="text" class="form-control" id="telepon" name="telepon" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=supplier&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>