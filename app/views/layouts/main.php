<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Management Gudang  </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-flags.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-payments.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</head>

<body>
    <?php include_once __DIR__ . '/../components/alert.php'; ?>
    <div class="page">
        <!-- Sidebar -->
        <aside class="navbar navbar-vertical navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <h1 class="navbar-brand navbar-brand-autodark">
                    <a href="/">
                        <img src="assets/img/logo.png" width="150" height="150" alt="Gudang Management" class="navbar-brand-image">
                    </a>
                </h1>
                <div class="collapse navbar-collapse" id="sidebar-menu">
                    <ul class="navbar-nav pt-lg-3">
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=dashboard&action=index">
                                <i class="fas fa-tachometer-alt"></i>
                                <span class="nav-link-title ms-2">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=barang&action=index">
                                <i class="fas fa-box"></i>
                                <span class="nav-link-title ms-2">Barang</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=category&action=index">
                                <i class="fas fa-tags"></i>
                                <span class="nav-link-title ms-2">Category</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=supplier&action=index">
                                <i class="fas fa-truck"></i>
                                <span class="nav-link-title ms-2">Supplier</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=lorong&action=index">
                                <i class="fas fa-columns"></i>
                                <span class="nav-link-title ms-2">Lorong</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?controller=ruangan&action=index">
                                <i class="fas fa-warehouse"></i>
                                <span class="nav-link-title ms-2">Ruangan</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <!-- Page Content -->
        <div class="page-wrapper">
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <!-- Content will be inserted here dynamically -->
                        <?php include $view; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
