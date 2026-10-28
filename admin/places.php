<?php
$page_title = "જોવાલાયક સ્થળો (Places to Visit)";
require_once __DIR__ . '/header.php';

$filter_location = $_GET['location'] ?? 'all';
$filter_cat = $_GET['cat'] ?? 'all';
$search = trim($_GET['q'] ?? '');

$query = "SELECT * FROM places WHERE 1=1";
$params = [];

if ($filter_location !== 'all' && in_array($filter_location, ['in_dwarka', 'nearby'])) {
    $query .= " AND location_type = ?";
    $params[] = $filter_location;
}

if ($filter_cat !== 'all') {
    $query .= " AND category = ?";
    $params[] = $filter_cat;
}

if (!empty($search)) {
    $query .= " AND (name_gu LIKE ? OR name_en LIKE ? OR deity_gu LIKE ?)";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
    $params[] = "%{$search}%";
}

$query .= " ORDER BY id ASC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$places = $stmt->fetchAll();
?>

<div class="card">
    <div class="card-header" style="flex-wrap: wrap; gap: 12px;">
        <div class="card-title">
            <i class="fa-solid fa-map-location-dot" style="color: var(--primary);"></i>
            દ્વારકા અને આજુબાજુના જોવાલાયક સ્થળો (કુલ: <?= count($places) ?>)
        </div>
        <div style="display: flex; gap: 10px;">
            <a href="place_edit.php" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> નવું સ્થળ ઉમેરો (Add Place)
            </a>
        </div>
    </div>

    <!-- Filters & Search Toolbar -->
    <div style="padding: 16px 22px; background: #f8fafc; border-bottom: 1px solid var(--border); display: flex; flex-wrap: wrap; gap: 12px; align-items: center; justify-content: space-between;">
        <form method="GET" action="places.php" style="display: flex; flex-wrap: wrap; gap: 10px; align-items: center; flex: 1;">
            <div style="min-width: 180px;">
                <select name="location" class="form-control" onchange="this.form.submit()" style="padding: 8px 12px;">
                    <option value="all" <?= $filter_location === 'all' ? 'selected' : '' ?>>બધા વિસ્તારો (All Locations)</option>
                    <option value="in_dwarka" <?= $filter_location === 'in_dwarka' ? 'selected' : '' ?>>દ્વારકા શહેરમાં</option>
                    <option value="nearby" <?= $filter_location === 'nearby' ? 'selected' : '' ?>>આજુબાજુના સ્થળો</option>
                </select>
            </div>

            <div style="min-width: 160px;">
                <select name="cat" class="form-control" onchange="this.form.submit()" style="padding: 8px 12px;">
                    <option value="all" <?= $filter_cat === 'all' ? 'selected' : '' ?>>બધી કેટેગરી (All Categories)</option>
                    <option value="temple" <?= $filter_cat === 'temple' ? 'selected' : '' ?>>મંદિર (Temple)</option>
                    <option value="beach" <?= $filter_cat === 'beach' ? 'selected' : '' ?>>બીચ (Beach)</option>
                    <option value="nature" <?= $filter_cat === 'nature' ? 'selected' : '' ?>>પ્રકૃતિ / તળાવ (Nature)</option>
                    <option value="bridge" <?= $filter_cat === 'bridge' ? 'selected' : '' ?>>બ્રિજ (Bridge)</option>
                    <option value="historical" <?= $filter_cat === 'historical' ? 'selected' : '' ?>>ઐતિહાસિક (Historical)</option>
                </select>
            </div>

            <div style="display: flex; gap: 6px; flex: 1; max-width: 320px;">
                <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" class="form-control" 
                       placeholder="સ્થળ અથવા ભગવાનનું નામ શોધો..." style="padding: 8px 12px;">
                <button type="submit" class="btn btn-outline" style="padding: 8px 14px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>

            <?php if ($filter_location !== 'all' || $filter_cat !== 'all' || !empty($search)): ?>
                <a href="places.php" class="btn btn-outline btn-sm" style="color: #64748b;">
                    <i class="fa-solid fa-xmark"></i> ફિલ્ટર હટાવો
                </a>
            <?php endif; ?>
        </form>
    </div>

    <div class="card-body" style="padding: 0;">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 80px;">ફોટો</th>
                        <th>સ્થળનું નામ (ગુજરાતી / English)</th>
                        <th>મુખ્ય દેવ / દેવી</th>
                        <th>કેટેગરી & વિસ્તાર</th>
                        <th>સમય & ટિકિટ</th>
                        <th>અંતર</th>
                        <th style="text-align: right; width: 140px;">ક્રિયાઓ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($places)): ?>
                        <tr>
                            <td colspan="8" style="text-align: center; padding: 40px; color: var(--text-muted);">
                                <i class="fa-solid fa-triangle-exclamation" style="font-size: 2rem; color: #f59e0b; margin-bottom: 10px; display: block;"></i>
                                કોઈ સ્થળ મળ્યું નથી. ફિલ્ટર બદલો અથવા નવું સ્થળ ઉમેરો.
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($places as $p): ?>
                        <tr>
                            <td style="color: var(--text-muted); font-weight: 600;">#<?= $p['id'] ?></td>
                            <td>
                                <img src="../<?= htmlspecialchars($p['image_url'] ?: 'images/hero_dwarka.jpg') ?>" 
                                     alt="" class="table-img" onerror="this.src='../images/dwarkadhish.jpg'">
                            </td>
                            <td>
                                <strong><?= htmlspecialchars($p['name_gu']) ?></strong>
                                <div style="font-size: 0.8rem; color: var(--text-muted);"><?= htmlspecialchars($p['name_en']) ?></div>
                            </td>
                            <td>
                                <?= htmlspecialchars($p['deity_gu'] ?: '-') ?>
                            </td>
                            <td>
                                <span class="badge badge-<?= htmlspecialchars($p['category']) ?>" style="display: block; margin-bottom: 4px; width: fit-content;">
                                    <?= htmlspecialchars($p['category']) ?>
                                </span>
                                <span class="badge badge-<?= htmlspecialchars($p['location_type']) ?>">
                                    <?= $p['location_type'] === 'in_dwarka' ? 'દ્વારકામાં' : 'આજુબાજુ' ?>
                                </span>
                            </td>
                            <td style="font-size: 0.82rem;">
                                <div><i class="fa-regular fa-clock" style="color: var(--primary);"></i> <?= htmlspecialchars($p['timings']) ?></div>
                                <div style="color: var(--text-muted); margin-top: 2px;"><i class="fa-solid fa-ticket"></i> <?= htmlspecialchars($p['entry_fee']) ?></div>
                            </td>
                            <td style="font-size: 0.84rem; font-weight: 500;">
                                <?= htmlspecialchars($p['distance_km']) ?>
                            </td>
                            <td style="text-align: right;">
                                <div class="action-buttons" style="justify-content: flex-end;">
                                    <a href="place_edit.php?id=<?= $p['id'] ?>" class="btn btn-outline btn-xs" title="સંપાદિત કરો (Edit)">
                                        <i class="fa-solid fa-pen-to-square"></i> એડિટ
                                    </a>
                                    <a href="delete.php?type=place&id=<?= $p['id'] ?>&token=<?= get_csrf_token() ?>" 
                                       class="btn btn-danger btn-xs" 
                                       onclick="return confirmDelete('શું તમે ખરેખર \'<?= addslashes($p['name_gu']) ?>\' સ્થળ કાઢી નાખવા માંગો છો?');" 
                                       title="કાઢી નાખો (Delete)">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
