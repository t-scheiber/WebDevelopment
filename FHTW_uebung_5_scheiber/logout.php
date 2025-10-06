<?php
session_start();
setcookie('user', 'admin', time() - 3600);
session_destroy();
header("Location: index.php?menu=Home");
?>