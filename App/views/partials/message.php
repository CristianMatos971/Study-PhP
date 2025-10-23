<?php if (isset($_SESSION['success-message'])): ?>
    <div class="message bg-green-100 p-3 my-3">
        <?= $_SESSION['success-message'] ?>
    </div>
    <?php unset($_SESSION['success-message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error-message'])): ?>
    <div class="message bg-red-100 p-3 my-3">
        <?= $_SESSION['error-message'] ?>
    </div>
    <?php unset($_SESSION['error-message']); ?>
<?php endif; ?>