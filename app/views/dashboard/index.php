<?php
$page_title = "Dashboard";
?>

<style>
    .dashboard-container {
        padding: 20px;
        background-color: #f7f9fc;
    }

    .stat-card {
        border-left: 5px solid #4CAF50;
        border-radius: 8px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .stat-card h6 {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .stat-card h3 {
        font-weight: bold;
    }

    .stat-icon {
        font-size: 2rem;
        opacity: 0.7;
    }

    .table-card,
    .dashboard-chart {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .dashboard-chart {
        padding: 20px;
        margin-bottom: 20px;
    }

    .table-card .card-header {
        background-color: #ffc107;
        color: #fff;
        border-radius: 8px 8px 0 0;
    }
</style>

<div class="container-fluid dashboard-container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><?= htmlspecialchars($page_title); ?></h2>
        <div class="btn-group">
            <button type="button" class="btn btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown"
                aria-expanded="false">
                Pengaturan
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="/?controller=login&action=logout">Logout</a></li>
            </ul>
        </div>
    </div>

    <!-- Stat Cards -->
    <div class="row mt-3 mb-3">
        <?php
        $stats = [
            ["label" => "Total Barang", "value" => $total_barang, "icon" => "fa-box", "color" => "text-success"],
            ["label" => "Total Suppliers", "value" => $total_suppliers, "icon" => "fa-dolly", "color" => "text-primary"],
            ["label" => "Total Lorong", "value" => $total_lorong, "icon" => "fa-road", "color" => "text-warning"],
            ["label" => "Total Ruangan", "value" => $total_ruangan, "icon" => "fa-warehouse", "color" => "text-danger"],
        ];
        ?>

        <?php foreach ($stats as $stat): ?>
            <div class="col-md-3 mb-3">
                <div class="card stat-card shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <h6><?= htmlspecialchars($stat["label"]); ?></h6>
                            <h3><?= $stat["value"]; ?></h3>
                        </div>
                        <div class="<?= $stat["color"]; ?> stat-icon">
                            <i class="fas <?= $stat["icon"]; ?>"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Barang Mendekati Expire Date (sebelah kiri) -->
        <div class="col-md-8 mb-4">
            <div class="card table-card shadow-sm">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">Barang Mendekati Expire Date</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
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
                                        <td colspan="3" class="text-center">Tidak ada barang yang mendekati tanggal
                                            kadaluarsa.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Stok per Kategori dan Penggunaan Ruangan -->
        <div class="col-md-4 mb-4">
            <div class="dashboard-chart mb-4">
                <h5>Stok per Kategori</h5>
                <canvas id="stockByCategoryChart"></canvas>
            </div>
            <div class="dashboard-chart">
                <h5>Penggunaan Ruangan</h5>
                <canvas id="ruanganUsageChart"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        new Chart(document.getElementById('stockByCategoryChart'), {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($stock_by_category['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($stock_by_category['data']) ?>,
                    backgroundColor: ['#4CAF50', '#2196F3', '#FFC107', '#9C27B0', '#FF5722']
                }]
            },
        });

        new Chart(document.getElementById('ruanganUsageChart'), {
            type: 'doughnut',
            data: {
                labels: <?= json_encode($ruangan_usage['labels']) ?>,
                datasets: [{
                    data: <?= json_encode($ruangan_usage['data']) ?>,
                    backgroundColor: [
                        '#2196F3',  // Warna untuk "Used"
                        '#E0E0E0'   // Warna untuk "Unused"
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                let label = context.label || '';
                                let roomNames = <?= json_encode($ruangan_usage['room_names']) ?>; // Daftar nama ruangan

                                if (label) {
                                    label += ': ';
                                }

                                // Tambahkan daftar ruangan yang digunakan/tidak digunakan dengan baris baru
                                if (label.includes("Used")) {
                                    label += "\nRuangan:\n" + roomNames.used.join("\n");
                                } else if (label.includes("Unused")) {
                                    label += "\nRuangan:\n" + roomNames.unused.join("\n");
                                }

                                return label;
                            }
                        }
                    }
                }
            }
        });
    });
</script>