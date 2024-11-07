<?php
$page_title = "Edit Barang"; // Judul halaman
?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <form action="/?controller=barang&action=edit&id=<?= $data['barang']['id']; ?>" method="POST">
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select class="form-select" name="category_id" required>
                <option value="">Pilih Kategori</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id']; ?>" <?= ($category['id'] == $data['barang']['category_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($category['category_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama" name="nama"
                value="<?= htmlspecialchars($data['barang']['nama']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok"
                value="<?= htmlspecialchars($data['barang']['stok']); ?>" min="0" required>
        </div>
        <div class="mb-3">
            <label for="expire_date" class="form-label">Tanggal Kedaluwarsa</label>
            <input type="date" class="form-control" id="expire_date" name="expire_date"
                value="<?= htmlspecialchars($data['barang']['expire_date']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="supplier_id" class="form-label">Supplier</label>
            <select class="form-select" id="supplier_id" name="supplier_id" required>
                <option value="">Pilih Supplier</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?= htmlspecialchars($supplier['id']); ?>"
                        <?= ($supplier['id'] == $data['barang']['supplier_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($supplier['nama_supplier']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="lorong_id" class="form-label">Lorong</label>
            <select class="form-select" id="lorong_id" name="lorong_id" required>
                <option value="">Pilih Lorong</option>
                <?php foreach ($lorong as $l): ?>
                    <option value="<?= htmlspecialchars($l['id']); ?>" <?= ($l['id'] == $data['barang']['lorong_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($l['nama_lorong']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="ruangan_id" class="form-label">Ruangan</label>
            <select class="form-select" id="ruangan_id" name="ruangan_id" required>
                <option value="">Pilih Ruangan</option>
                <?php foreach ($ruangan as $r): ?>
                    <option value="<?= htmlspecialchars($r['id']); ?>" <?= ($r['id'] == $data['barang']['ruangan_id']) ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($r['nama_ruangan']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/?controller=barang&action=index" class="btn btn-secondary">Kembali</a>
    </form>
</div>