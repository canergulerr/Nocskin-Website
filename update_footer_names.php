<?php
require 'admin/includes/db.php';
// Rename Hızlı Erişim -> Bize Ulaşın
$pdo->exec("UPDATE menus SET title='Bize Ulaşın' WHERE id=69");
// Delete the child "Bize Ulaşın" link if it's redundant under the "Bize Ulaşın" header
$pdo->exec("DELETE FROM menus WHERE id=70");
echo "Updated.";
