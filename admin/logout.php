<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
session_start();
$_SESSION = array();
session_destroy();
header("Location: login.php");
exit;
?>
