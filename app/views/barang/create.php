<?php 
$page_title = "Tambah Barang"; // Judul halaman 
?>

<div class="container">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=barang&action=create" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" required>
        </div>
        <div class="mb-3">
            <label for="expire_date" class="form-label">Tanggal Kedaluwarsa</label>
            <input type="date" class="form-control" id="expire_date" name="expire_date" required>
        </div>
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-select" id="supplier_id" name="supplier_id" required>
                <option value="">Pilih Supplier</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= $supplier['id']; ?>"><?= htmlspecialchars($supplier['nama_supplier']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="lorong_id" class="form-label">Lorong</label>
            <select class="form-select" id="lorong_id" name="lorong_id" required>
                <option value="">Pilih Lorong</option>
                <?php foreach ($lorong as $l): ?>
                    <option value="<?= $l['id']; ?>"><?= htmlspecialchars($l['nama_lorong']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ruangan_id" class="form-label">Ruangan</label>
            <select class="form-select" id="ruangan_id" name="ruangan_id" required>
                <option value="">Pilih Ruangan</option>
                <?php foreach ($ruangan as $r): ?>
                    <option value="<?= $r['id']; ?>"><?= htmlspecialchars($r['nama_ruangan']); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=barang&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>
