<?php
$page_title = "Dashboard"; // Judul halaman
?>

<div class="container mt-3">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <!-- Stat Cards -->
    <div class="row">
        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Barang</h6>
                            <h3 class="mb-0"><?= $total_barang; ?></h3>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-box fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Suppliers</h6>
                            <h3 class="mb-0"><?= $total_suppliers; ?></h3>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-truck fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Lorong</h6>
                            <h3 class="mb-0"><?= $total_lorong; ?></h3>
                        </div>
                        <div class="text-warning">
                            <i class="fas fa-road fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card stat-card shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Ruangan</h6>
                            <h3 class="mb-0"><?= $total_ruangan; ?></h3>
                        </div>
                        <div class="text-danger">
                            <i class="fas fa-warehouse fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h3 class="mt-3">Barang yang Mendekati Expire Date</h3>
        <div class="table-responsive">
            <table class="table table-vcenter mt-3">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Expire Date</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($barang_expiring_soon)): ?>
                        <?php foreach ($barang_expiring_soon as $item): ?>
                            <tr>
                                <td><?= htmlspecialchars($item['nama']); ?></td>
                                <td><?= htmlspecialchars($item['expire_date']); ?></td>
                                <td><?= htmlspecialchars($item['stok']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Tidak ada barang yang mendekati tanggal kadaluarsa.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>