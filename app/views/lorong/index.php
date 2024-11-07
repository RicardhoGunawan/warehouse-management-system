<?php
$page_title = "Daftar Lorong";
?>

<div class="container mt-3">
    <h2><?= htmlspecialchars($page_title); ?></h2>
    <div class="text-start mb-3">
        <a href="/?controller=lorong&action=create" class="btn btn-primary">Tambah Lorong</a>
    </div>
    <div class="table-responsive">
        <table class="table table-vcenter mt-3" id="lorongTable">
            <thead>
                <!-- Form Pencarian di Sebelah Kanan -->
                <tr>
                    <th colspan="5">
                        <div class="d-flex justify-content-end">
                            <div class="input-group" style="max-width: 250px;">
                                <input type="text" class="form-control" id="searchInput" placeholder="Cari lorong..."
                                    aria-label="Cari Supplier" oninput="performSearch()" />
                            </div>
                        </div>
                    </th>
                </tr>
                <tr>
                    <th>Nama Lorong</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($lorong)): ?>
                    <?php foreach ($lorong as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['nama_lorong']); ?></td>
                            <td>
                                <div class="btn-group">
                                    <a href="/?controller=lorong&action=edit&id=<?= $item['id']; ?>"
                                        class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                    <a href="/?controller=lorong&action=delete&id=<?= $item['id']; ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus lorong ini?');">
                                        <i class="fas fa-trash"></i></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2" class="text-center">Tidak ada lorong untuk ditampilkan.</td>
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
        const table = document.getElementById('lorongTable');
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