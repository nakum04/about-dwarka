<?php
/**
 * Admin Login Page
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// If already logged in, redirect to dashboard
if (!empty($_SESSION['admin_logged_in'])) {
    header('Location: index.php');
    exit;
}

require_once __DIR__ . '/../db.php';

$error = '';
$success = '';

// One-click Reset Handler
if (isset($_GET['reset']) && $_GET['reset'] === 'default') {
    try {
        $hashed = password_hash('admin123', PASSWORD_DEFAULT);
        $pdo->exec("DELETE FROM admins");
        $stmt_reset = $pdo->prepare("INSERT INTO admins (username, password, full_name, email) VALUES (?, ?, ?, ?)");
        $stmt_reset->execute(['admin', $hashed, 'એડમિનિસ્ટ્રેટર (Admin)', 'admin@dwarkaguide.com']);
        $success = 'સફળતા: એડમિન આઈડી અને પાસવર્ડ ડિફોલ્ટ (admin / admin123) પર રીસેટ થઈ ગયા છે! હવે લૉગિન કરો.';
    } catch (PDOException $e) {
        $error = 'રીસેટ કરવામાં ક્ષતિ: ' . $e->getMessage();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'કૃપા કરીને યુઝરનેમ અને પાસવર્ડ બંને દાખલ કરો.';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();

            $auth_success = false;

            // Master fallback: if credentials are admin / admin123, always allow & auto-repair
            if ($username === 'admin' && $password === 'admin123') {
                $auth_success = true;
                if (!$admin) {
                    $hashed = password_hash('admin123', PASSWORD_DEFAULT);
                    $stmt_insert = $pdo->prepare("INSERT INTO admins (username, password, full_name, email) VALUES (?, ?, ?, ?)");
                    $stmt_insert->execute(['admin', $hashed, 'એડમિનિસ્ટ્રેટર (Admin)', 'admin@dwarkaguide.com']);
                    $admin = [
                        'id' => $pdo->lastInsertId(),
                        'username' => 'admin',
                        'full_name' => 'એડમિનિસ્ટ્રેટર (Admin)'
                    ];
                }
            } elseif ($admin) {
                // Check both password_verify and plain match (if someone stored plain password)
                if (password_verify($password, $admin['password']) || $password === $admin['password']) {
                    $auth_success = true;
                }
            }

            if ($auth_success) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['full_name'];

                // Update last login
                $update_login = $pdo->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?");
                $update_login->execute([$admin['id']]);

                header('Location: index.php');
                exit;
            } else {
                $error = 'ખોટું યુઝરનેમ અથવા પાસવર્ડ! કૃપા કરીને તપાસો અથવા નીચે આપેલ બટનથી ડિફોલ્ટ રીસેટ કરો.';
            }
        } catch (PDOException $e) {
            $error = 'ડેટાબેઝ ભૂલ: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>એડમિન લૉગિન | Dwarka Admin Portal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="login-body">

    <div class="login-card">
        <div class="login-header">
            <div class="icon">
                <i class="fa-solid fa-gopuram"></i>
            </div>
            <h1>દ્વારકા એડમિન પેનલ</h1>
            <p>Dwarka Tourism Content Management System</p>
        </div>

        <div class="login-form">
            <?php if (!empty($success)): ?>
                <div class="alert alert-success" style="margin-bottom: 20px;">
                    <i class="fa-solid fa-circle-check"></i>
                    <span><?= htmlspecialchars($success) ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger" style="margin-bottom: 20px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span><?= htmlspecialchars($error) ?></span>
                </div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label class="form-label" for="username">
                        <i class="fa-solid fa-user"></i> એડમિન યુઝરનેમ (Username)
                    </label>
                    <input type="text" id="username" name="username" class="form-control" 
                           placeholder="admin દાખલ કરો" value="admin" required autofocus>
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label class="form-label" for="password">
                        <i class="fa-solid fa-lock"></i> પાસવર્ડ (Password)
                    </label>
                    <input type="password" id="password" name="password" class="form-control" 
                           placeholder="પાસવર્ડ દાખલ કરો" value="admin123" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 12px; font-size: 1rem;">
                    <i class="fa-solid fa-right-to-bracket"></i> લૉગિન કરો (Login)
                </button>
            </form>

            <!-- Reset to Default Button Box -->
            <div style="margin-top: 20px; padding: 14px; background: #fffbeb; border: 1px solid #fde68a; border-radius: var(--radius-sm); text-align: center;">
                <div style="font-size: 0.88rem; color: #92400e; font-weight: 600; margin-bottom: 6px;">
                    <i class="fa-solid fa-key"></i> ડિફોલ્ટ આઈડી & પાસવર્ડ:
                </div>
                <div style="font-size: 0.84rem; color: #451a03; margin-bottom: 10px;">
                    User: <code>admin</code> &nbsp;|&nbsp; Pass: <code>admin123</code>
                </div>
                <a href="login.php?reset=default" class="btn btn-outline btn-xs" style="background: #fff; border-color: #d97706; color: #b45309; text-decoration: none;" onclick="return confirm('શું તમે આઈડી અને પાસવર્ડ ડિફોલ્ટ (admin / admin123) પર રીસેટ કરવા માંગો છો?');">
                    <i class="fa-solid fa-rotate-left"></i> ડિફોલ્ટ પાસવર્ડ રીસેટ કરો (Reset to Default)
                </a>
            </div>

            <div style="text-align: center; margin-top: 18px;">
                <a href="../index.php" style="color: var(--text-muted); text-decoration: none; font-size: 0.88rem;">
                    <i class="fa-solid fa-arrow-left"></i> મુખ્ય વેબસાઇટ પર પાછા જાઓ
                </a>
            </div>
        </div>
    </div>

</body>
</html>
