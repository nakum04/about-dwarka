<?php
$page_title = "ડેશબોર્ડ (Dashboard)";
require_once __DIR__ . '/header.php';

// Fetch summary metrics
try {
    $count_places = $pdo->query("SELECT COUNT(*) FROM places")->fetchColumn();
    $count_aarti = $pdo->query("SELECT COUNT(*) FROM aarti_timings")->fetchColumn();
    $count_itineraries = $pdo->query("SELECT COUNT(*) FROM itineraries")->fetchColumn();
    $count_budget = $pdo->query("SELECT COUNT(*) FROM budget_rates")->fetchColumn();
    $count_reviews = $pdo->query("SELECT COUNT(*) FROM reviews")->fetchColumn();

    // Recent 5 places
    $recent_places = $pdo->query("SELECT * FROM places ORDER BY id DESC LIMIT 5")->fetchAll();

    // Recent 5 reviews
    $recent_reviews = $pdo->query("SELECT * FROM reviews ORDER BY id DESC LIMIT 5")->fetchAll();
} catch (PDOException $e) {
    echo "<div class='alert alert-danger'>ડેટા લોડ કરવામાં ક્ષતિ: " . htmlspecialchars($e->getMessage()) . "</div>";
}
?>

<!-- Metric Cards -->
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-icon orange">
            <i class="fa-solid fa-place-of-worship"></i>
        </div>
        <div class="stat-info">
            <h3><?= $count_places ?></h3>
            <p>જોવાલાયક સ્થળો (Places)</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon yellow">
            <i class="fa-solid fa-bell"></i>
        </div>
        <div class="stat-info">
            <h3><?= $count_aarti ?></h3>
            <p>દર્શન & આરતી સમય</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon blue">
            <i class="fa-solid fa-calendar-days"></i>
        </div>
        <div class="stat-info">
            <h3><?= $count_itineraries ?></h3>
            <p>ટૂર સમયપત્રક સ્લોટ્સ</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon green">
            <i class="fa-solid fa-comments"></i>
        </div>
        <div class="stat-info">
            <h3><?= $count_reviews ?></h3>
            <p>યાત્રી પ્રતિભાવો</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon purple">
            <i class="fa-solid fa-coins"></i>
        </div>
        <div class="stat-info">
            <h3><?= $count_budget ?></h3>
            <p>બજેટ દરો (Rates)</p>
        </div>
    </div>
</div>

<!-- Quick Actions Banner -->
<div class="card" style="background: linear-gradient(135deg, #0f172a, #1e293b); color: #fff;">
    <div class="card-body" style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
        <div>
            <h3 style="font-size: 1.3rem; color: #fbbf24; margin-bottom: 6px;">
                <i class="fa-solid fa-bolt"></i> ઝડપી ક્રિયાઓ (Quick Actions)
            </h3>
            <p style="color: #cbd5e1; font-size: 0.92rem; margin: 0;">
                અહીંથી તમે કોઈ પણ માહિતી ઉમેરી કે બદલી શકો છો, જે સીધી જ વેબસાઇટમાં લાઈવ થઈ જશે.
            </p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="place_edit.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> નવું સ્થળ ઉમેરો
            </a>
            <a href="aarti.php" class="btn btn-outline" style="color: #fff; border-color: rgba(255,255,255,0.3);">
                <i class="fa-solid fa-clock"></i> આરતી સમય બદલો
            </a>
            <a href="settings.php" class="btn btn-outline" style="color: #fff; border-color: rgba(255,255,255,0.3);">
                <i class="fa-solid fa-sliders"></i> બેનર & હેડિંગ બદલો
            </a>
            <a href="../index.php" target="_blank" class="btn btn-success">
                <i class="fa-solid fa-globe"></i> વેબસાઇટ જુઓ
            </a>
        </div>
    </div>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(450px, 1fr)); gap: 24px;">
    <!-- Recent Places Card -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-map-location-dot" style="color: var(--primary);"></i>
                તાજેતરના જોવાલાયક સ્થળો
            </div>
            <a href="places.php" class="btn btn-outline btn-xs">તમામ જુઓ</a>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>ફોટો</th>
                            <th>સ્થળનું નામ</th>
                            <th>કેટેગરી</th>
                            <th>વિસ્તાર</th>
                            <th>ક્રિયા</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_places)): ?>
                            <tr><td colspan="5" style="text-align: center; color: var(--text-muted);">કોઈ સ્થળ મળ્યું નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recent_places as $p): ?>
                            <tr>
                                <td>
                                    <img src="../<?= htmlspecialchars($p['image_url'] ?: 'images/hero_dwarka.jpg') ?>" 
                                         alt="" class="table-img" onerror="this.src='../images/dwarkadhish.jpg'">
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($p['name_gu']) ?></strong>
                                    <div style="font-size: 0.78rem; color: var(--text-muted);"><?= htmlspecialchars($p['name_en']) ?></div>
                                </td>
                                <td>
                                    <span class="badge badge-<?= htmlspecialchars($p['category']) ?>">
                                        <?= htmlspecialchars($p['category']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="badge badge-<?= htmlspecialchars($p['location_type']) ?>">
                                        <?= $p['location_type'] === 'in_dwarka' ? 'દ્વારકામાં' : 'આજુબાજુ' ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="place_edit.php?id=<?= $p['id'] ?>" class="btn btn-outline btn-xs" title="સંપાદિત કરો">
                                        <i class="fa-solid fa-pen"></i> એડિટ
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Recent Reviews Card -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-comments" style="color: #10b981;"></i>
                તાજેતરના યાત્રી પ્રતિભાવો
            </div>
            <a href="reviews.php" class="btn btn-outline btn-xs">તમામ જુઓ</a>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>યાત્રીનું નામ</th>
                            <th>શહેર</th>
                            <th>રેટિંગ</th>
                            <th>તારીખ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($recent_reviews)): ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-muted);">કોઈ પ્રતિભાવ મળ્યો નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($recent_reviews as $r): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($r['user_name']) ?></strong></td>
                                <td><?= htmlspecialchars($r['user_city'] ?: 'યાત્રાળુ') ?></td>
                                <td>
                                    <span style="color: #f59e0b;">
                                        <?= str_repeat('★', (int)$r['rating']) ?>
                                    </span>
                                </td>
                                <td style="font-size: 0.8rem; color: var(--text-muted);">
                                    <?= date('d-m-Y', strtotime($r['created_at'])) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
