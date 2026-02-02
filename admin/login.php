<?php include dirname(__DIR__) . '/config.php'; ?>
<?php
session_start();
require_once 'includes/db.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Lütfen kullanıcı adı ve şifre girin.";
    } else {
        $sql = "SELECT id, username, password FROM admin_users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row['id'];
                        $hashed_password = $row['password'];

                        // Verify password (modern hash)
                        if (password_verify($password, $hashed_password)) {
                            // Password is correct, start a new session
                            $_SESSION['admin_logged_in'] = true;
                            $_SESSION['admin_id'] = $id;
                            $_SESSION['admin_username'] = $username;

                            header("Location: index.php");
                            exit;
                        }
                        // Fallback: Check for MD5 (Legacy)
                        elseif (md5($password) === $hashed_password) {
                            // Password matches MD5. Upgrade to Bcrypt for security.
                            $new_hash = password_hash($password, PASSWORD_DEFAULT);
                            $update_sql = "UPDATE admin_users SET password = :new_hash WHERE id = :id";
                            $update_stmt = $pdo->prepare($update_sql);
                            $update_stmt->execute([':new_hash' => $new_hash, ':id' => $id]);

                            // Log in
                            $_SESSION['admin_logged_in'] = true;
                            $_SESSION['admin_id'] = $id;
                            $_SESSION['admin_username'] = $username;

                            header("Location: index.php");
                            exit;
                        } else {
                            $error = "Geçersiz şifre.";
                        }
                    }
                } else {
                    $error = "Bu kullanıcı adı ile kayıt bulunamadı.";
                }
            } else {
                $error = "Bir hata oluştu. Lütfen daha sonra tekrar deneyin.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Noc | Yönetim Paneli Giriş</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --text-dark: #111827;
            --text-muted: #6b7280;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fff;
            height: 100vh;
            overflow: hidden;
        }

        .login-container {
            height: 100vh;
        }

        .login-left {
            background-image: url('https://nocskin.com.tr/assets/images/noc-anasayfa-4.jpg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 100%);
        }

        .login-right {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #fff;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: inline-block;
        }

        .form-control {
            padding: 0.8rem 1rem;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            font-size: 0.95rem;
            transition: all 0.2s;
        }

        .form-control:focus {
            display: flex;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }

        .form-label {
            font-weight: 500;
            color: #374151;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .btn-primary {
            background-color: #212529 !important;
            border: none;
            padding: 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary:hover {
            background-color: #000000 !important;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .testimonial-quote {
            position: absolute;
            bottom: 3rem;
            left: 3rem;
            right: 3rem;
            color: white;
            z-index: 2;
        }

        .testimonial-quote p {
            font-size: 1.5rem;
            font-weight: 600;
            line-height: 1.4;
            margin-bottom: 1rem;
        }

        .testimonial-quote span {
            font-size: 0.9rem;
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container-fluid login-container">
        <div class="row h-100">
            <!-- Left Side: Image & Branding -->
            <div class="col-lg-7 d-none d-lg-block login-left">
                <div class="testimonial-quote">
                    <p>New Outstanding Care</p>
                    <span>Noc Yönetim Paneli v2.0</span>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="col-lg-5 col-12 login-right">
                <div class="login-form-wrapper">
                    <div class="mb-5">
                        <img src="<?= BASE_URL ?>/on/demandware.static/Sites-deciem-us-Site/-/default/dwbf417386/images/brands-logo/noc-logo.png"
                            alt="Noc Admin" class="brand-logo" style="height: 40px; width: auto;">
                        <h2 class="fw-bold text-dark mb-2">Tekrar Hoşgeldiniz</h2>
                        <p class="text-muted">Hesabınıza erişmek için bilgilerinizi girin.</p>
                    </div>

                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger d-flex align-items-center mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <div><?php echo $error; ?></div>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="mb-4">
                            <label for="username" class="form-label">Kullanıcı Adı</label>
                            <input type="text" name="username" class="form-control" id="username"
                                placeholder="Örn: admin" required>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label">Şifre</label>
                            </div>
                            <input type="password" name="password" class="form-control" id="password"
                                placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Giriş Yap</button>
                    </form>

                    <div class="mt-4 text-center">
                        <p class="text-muted small">Sorun mu yaşıyorsunuz? <a href="#"
                                class="text-decoration-none fw-semibold" style="color:#212529 !important;">Destek
                                Ekibi</a> ile iletişime geçin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>