<?php
$page_title = "Register"; // Judul halaman
?>

<!-- Memuat CSS dari Tabler (pastikan Anda sudah menambahkannya sebelumnya) -->
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
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($_SESSION['error']); ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form class="card card-md" method="POST" action="/?controller=register&action=register">
            <div class="card-body">
                <h2 class="card-title text-center mb-4">Register</h2>

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input id="username" type="text" class="form-control" name="username" required autofocus>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input id="password" type="password" class="form-control" name="password" required>
                </div>

                <div class="mb-3">
                    <label for="password-confirm" class="form-label">Confirm Password</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </div>
        </form>

        <div class="text-center text-muted mt-3">
            Already have an account? <a href="/?controller=login&action=showLoginForm">Login</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
