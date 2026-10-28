<?php
/**
 * Admin Panel Layout Header
 */
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/../db.php';

$current_page = basename($_SERVER['PHP_SELF']);
$admin_name = $_SESSION['admin_name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'એડમિન પેનલ' ?> | Dwarka Tourism Admin</title>
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Admin Stylesheet -->
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="admin-wrapper">
    <!-- Sidebar -->
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="sidebar-header">
            <div class="logo-badge">
                <i class="fa-solid fa-gopuram"></i>
            </div>
            <div>
                <h2>દ્વારકા એડમિન</h2>
                <span>CMS PORTAL</span>
            </div>
        </div>

        <nav class="sidebar-nav">
            <span class="nav-section-title">મુખ્ય મેનુ</span>
            <a href="index.php" class="<?= $current_page === 'index.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-gauge-high"></i> ડેશબોર્ડ (Dashboard)
            </a>

            <span class="nav-section-title">કન્ટેન્ટ મેનેજમેન્ટ</span>
            <a href="places.php" class="<?= in_array($current_page, ['places.php', 'place_edit.php']) ? 'active' : '' ?>">
                <i class="fa-solid fa-map-location-dot"></i> જોવાલાયક સ્થળો (Places)
            </a>
            <a href="aarti.php" class="<?= $current_page === 'aarti.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-bell"></i> દર્શન & આરતી સમય
            </a>
            <a href="itineraries.php" class="<?= $current_page === 'itineraries.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-calendar-days"></i> ટૂર સમયપત્રક (Itinerary)
            </a>
            <a href="budget.php" class="<?= $current_page === 'budget.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-coins"></i> બજેટ & ખર્ચ દરો
            </a>
            <a href="history.php" class="<?= $current_page === 'history.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-landmark"></i> ઇતિહાસ ટાઇમલાઇન
            </a>

            <span class="nav-section-title">વાતચીત & સેટિંગ્સ</span>
            <a href="reviews.php" class="<?= $current_page === 'reviews.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-comments"></i> યાત્રી પ્રતિભાવો (Reviews)
            </a>
            <a href="settings.php" class="<?= $current_page === 'settings.php' ? 'active' : '' ?>">
                <i class="fa-solid fa-sliders"></i> વેબસાઇટ લાઈવ સેટિંગ્સ
            </a>

            <span class="nav-section-title">વેબસાઇટ શોર્ટકટ</span>
            <a href="../index.php" target="_blank" style="color: #38bdf8;">
                <i class="fa-solid fa-arrow-up-right-from-square" style="color: #38bdf8;"></i> લાઈવ વેબસાઇટ જુઓ
            </a>
            <a href="logout.php" style="color: #f87171; margin-top: 10px;">
                <i class="fa-solid fa-right-from-bracket" style="color: #f87171;"></i> લૉગઆઉટ (Logout)
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    <i class="fa-solid fa-user-shield"></i>
                </div>
                <div class="user-text">
                    <strong><?= htmlspecialchars($admin_name) ?></strong>
                    <span style="color: #94a3b8; font-size: 0.72rem;">Online • Admin</span>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <header class="admin-topbar">
            <div class="topbar-left">
                <button class="mobile-menu-btn" id="sidebarToggle" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div class="topbar-title">
                    <?= $page_title ?? 'ડેશબોર્ડ' ?>
                </div>
            </div>

            <div class="topbar-actions">
                <a href="../index.php" target="_blank" class="btn btn-outline btn-sm" title="મુખ્ય વેબસાઇટ નવી ટેબમાં ખોલો">
                    <i class="fa-solid fa-globe"></i> વેબસાઇટ લાઈવ જુઓ
                </a>
                <a href="settings.php" class="btn btn-primary btn-sm">
                    <i class="fa-solid fa-gear"></i> સેટિંગ્સ
                </a>
            </div>
        </header>

        <main class="admin-content">
            <?php display_flash(); ?>
