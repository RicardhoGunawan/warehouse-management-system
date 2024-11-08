<?php
// app/views/components/alert.php

if (isset($_SESSION['success']) || isset($_SESSION['error'])) {
    $alertType = isset($_SESSION['success']) ? 'success' : 'danger';
    $alertMessage = isset($_SESSION['success']) ? $_SESSION['success'] : $_SESSION['error'];
?>
    <div id="alertNotification" class="alert alert-<?= $alertType ?> alert-dismissible fade show position-fixed top-0 end-0 m-3" role="alert">
        <div class="d-flex">
            <div class="alert-icon me-2">
                <?php if ($alertType === 'success'): ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M5 12l5 5l10 -10" />
                    </svg>
                <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-danger" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
                        <path d="M12 8l0 4" />
                        <path d="M12 16l.01 0" />
                    </svg>
                <?php endif; ?>
            </div>
            <div class="alert-message">
                <?= htmlspecialchars($alertMessage) ?>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto hide alert after 3 seconds
        setTimeout(function() {
            var alert = document.getElementById('alertNotification');
            if (alert) {
                var bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 3000);
    });
    </script>
<?php
    // Clear the messages
    unset($_SESSION['success']);
    unset($_SESSION['error']);
}
?>