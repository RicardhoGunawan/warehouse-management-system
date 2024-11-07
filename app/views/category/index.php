<?php
$page_title = "Daftar Kategori"; // Judul halaman
?>

<div class="container mt-3">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <a href="/?controller=category&action=create" class="btn btn-primary mb-3">Tambah Kategori</a>

    <div class="table-responsive">
        <table class="table table-vcenter table-bordered mt-3" id="categoryTable">
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
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($categories)): ?>
                    <?php foreach ($categories as $category): ?>
                        <tr>
                            <td><?= htmlspecialchars($category['category_name']); ?></td>
                            <td><?= htmlspecialchars($category['description']); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="/?controller=category&action=edit&id=<?= $category['id']; ?>"
                                        class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/?controller=category&action=delete&id=<?= $category['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada kategori untuk ditampilkan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Search Functionality (Optional) -->
<script>
    function performSearch() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('categoryTable');
        const tr = table.getElementsByTagName('tr');

        // Loop through all table rows and hide those that don't match the search query
        for (let i = 1; i < tr.length; i++) { // Skip header row
            const tdArray = tr[i].getElementsByTagName('td');
            let showRow = false;

            for (let j = 0; j < tdArray.length; j++) {
                const td = tdArray[j];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().indexOf(filter) > -1) {
                        showRow = true; // If found, show the row
                        break;
                    }
                }
            }
            tr[i].style.display = showRow ? '' : 'none'; // Show or hide row
        }
    }
</script>