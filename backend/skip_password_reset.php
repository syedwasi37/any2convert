<?php
require_once __DIR__ . '/auth_helpers.php';

unset($_SESSION['password_reset_verified_email']);
authSetFlash('success', 'Verification completed. You can continue without changing the password.');
authRedirect('../login.php');

