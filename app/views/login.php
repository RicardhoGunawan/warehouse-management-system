<?php
$page_title = "Login"; // Judul halaman
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
<style>
    /* Tambahkan CSS untuk memusatkan form */
    .page-single {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh; /* Mengatur tinggi minimal halaman penuh */
    }
    /* Responsif: Form menjadi lebih lebar di perangkat mobile */
    @media (max-width: 480px) {
        .container-tight {
            padding: 15px;
            max-width: 100%;
        }
    }
</style>

<div class="page-single">
    <div class="container-tight py-6">
        <!-- Menampilkan pesan status jika ada -->
        <?php if (isset($_SESSION['status'])): ?>
            <div class="alert alert-success text-center"><?= htmlspecialchars($_SESSION['status']); ?></div>
            <?php unset($_SESSION['status']); ?>
        <?php endif; ?>

        <form class="card card-md" method="POST" action="/?controller=login&action=login">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Login</h2>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="mb-3">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember">
                        <span class="form-check-label">Remember Me</span>
                    </label>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </div>
        </form>

        <div class="text-center text-muted mt-3">
            Don't have an account? <a href="/?controller=register&action=showRegisterForm">Register</a>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
