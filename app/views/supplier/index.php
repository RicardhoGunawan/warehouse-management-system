<?php
$page_title = "Daftar Supplier"; // Judul halaman
?>

<div class="container mt-3">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <div class="text-start mb-2">
        <a href="/?controller=supplier&action=create" class="btn btn-primary mb-3 mt-3">Tambah Supplier</a>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter mt-2" id="supplierTable">
            <thead>
                <!-- Form Pencarian di Sebelah Kanan -->
                <tr>
                    <th colspan="5">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" style="max-width: 250px;">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari Supplier..."
                                    aria-label="Cari Supplier" oninput="performSearch()" />
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Nama Supplier</th>
                    <th>Nama Perusahaan</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($suppliers)): ?>
                    <?php foreach ($suppliers as $supplier): ?>
                        <tr>
                            <td><?= htmlspecialchars($supplier['nama_supplier']); ?></td>
                            <td><?= htmlspecialchars($supplier['company_name']); ?></td>
                            <td><?= htmlspecialchars($supplier['alamat']); ?></td>
                            <td><?= htmlspecialchars($supplier['telepon']); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="/?controller=supplier&action=edit&id=<?= $supplier['id']; ?>"
                                        class="btn btn-sm btn-primary d-flex align-items-center justify-content-center">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="/?controller=supplier&action=delete&id=<?= $supplier['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Tidak ada supplier untuk ditampilkan.</td>
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
        const table = document.getElementById('supplierTable');
        const tr = table.getElementsByTagName('tr');

        // Loop through all table rows and hide those that don't match the search query
        for (let i = 2; i < tr.length; i++) { // Mulai dari 2 untuk melewati header dan baris pencarian
            const tdArray = tr[i].getElementsByTagName('td');
            let showRow = false;

            for (let j = 0; j < tdArray.length; j++) {
                const td = tdArray[j];
                if (td) {
                    const txtValue = td.textContent || td.innerText;
                    if (txtValue.toLowerCase().includes(filter)) {
                        showRow = true;
                        break;
                    }
                }
            }

            tr[i].style.display = showRow ? '' : 'none';
        }
    }
</script>
