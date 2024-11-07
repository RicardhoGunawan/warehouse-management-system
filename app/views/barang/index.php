<?php
$page_title = "Daftar Barang"; // Judul halaman
?>

<div class="container mt-3">
    <h2><?= htmlspecialchars($page_title); ?></h2>

    <!-- Tombol Tambah Barang di atas tabel -->
    <div class="text-start mb-2">
        <a href="/?controller=barang&action=create" class="btn btn-primary">Tambah Barang</a>
    </div>

    <!-- Tabel Responsif -->
    <div class="table-responsive">
        <table class="table table-vcenter mt-2" id="barangTable">
            <thead>
                <!-- Baris Pencarian di Dalam Thead -->
                <tr>
                    <th colspan="8">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" style="max-width: 250px;">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari Barang..."
                                    aria-label="Cari Barang" oninput="performSearch()" />
                            </div>
                        </div>
                    </th>
                </tr>

                <tr>
                    <th>Kategori</th>
                    <th>Nama</th>
                    <th>Stok</th>
                    <th>Expire Date</th>
                    <th>Supplier</th>
                    <th>Lorong</th>
                    <th>Ruangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($barang)): ?>
                    <?php foreach ($barang as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['category_name']); ?></td>
                            <td><?= htmlspecialchars($item['nama']); ?></td>
                            <td><?= htmlspecialchars($item['stok']); ?></td>
                            <td><?= htmlspecialchars($item['expire_date']); ?></td>
                            <td><?= htmlspecialchars($item['nama_suppliers']); ?></td>
                            <td><?= htmlspecialchars($item['nama_lorong']); ?></td>
                            <td><?= htmlspecialchars($item['nama_ruangan']); ?></td>
                            <td>
                                <div class="btn-group mb-3">
                                    <a href="/?controller=barang&action=edit&id=<?= $item['id']; ?>"
                                        class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/?controller=barang&action=delete&id=<?= $item['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada barang untuk ditampilkan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function performSearch() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('barangTable');
        const tr = table.getElementsByTagName('tr');

        // Loop through all table rows, and hide those that don't match the search query
        for (let i = 2; i < tr.length; i++) { // Start from 2 to skip header and search row
            let showRow = false; // Flag to check if the row should be shown

            const tdArray = tr[i].getElementsByTagName('td'); // Get all cells in the row
            for (let j = 0; j < tdArray.length; j++) {
                const td = tdArray[j];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().includes(filter)) {
                        showRow = true; // If any cell matches the filter, show the row
                        break; // No need to check further cells
                    }
                }
            }

            // Show or hide the row based on the search result
            tr[i].style.display = showRow ? '' : 'none';
        }
    }
</script>