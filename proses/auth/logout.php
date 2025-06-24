<?php
session_start();
session_unset(); // Hapus semua data session
session_destroy(); // Hancurkan session aktif

// Arahkan ke halaman login
header("Location: ../../pages/public/login.php");
exit;
?>
