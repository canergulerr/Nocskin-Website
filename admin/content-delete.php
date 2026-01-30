<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
require_once 'includes/auth_check.php';
require_once 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Validate ID is numeric to prevent simple injections or errors
    if (is_numeric($id)) {
        try {
            // Optional: Delete image file as well if you want complete cleanup
            // $stmt_img = $pdo->prepare("SELECT image FROM contents WHERE id = ?");
            // $stmt_img->execute([$id]);
            // $img = $stmt_img->fetchColumn();
            // if ($img && file_exists("../uploads/" . $img)) { unlink("../uploads/" . $img); }

            $sql = "DELETE FROM contents WHERE id = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                header("Location: contents.php?msg=deleted");
            } else {
                echo "Silme işlemi başarısız.";
            }
        } catch (PDOException $e) {
            die("Hata: " . $e->getMessage());
        }
    } else {
        header("Location: contents.php");
    }
} else {
    header("Location: contents.php");
}
exit;
?>
