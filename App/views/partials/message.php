<?php

use Framework\Session;

$success = Session::getFlashMessage('success_message');
$error = Session::getFlashMessage('error_message');
?>
<?php if ($success): ?>
    <div class="message bg-green-100 p-3 my-3">
        <?= htmlspecialchars($success) ?>
    </div>
<?php endif; ?>

<?php if ($error): ?>
    <div class="message bg-red-100 p-3 my-3">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>