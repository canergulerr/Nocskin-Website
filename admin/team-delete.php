<?php
require_once 'includes/db.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM team_members WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: team.php");
exit;
