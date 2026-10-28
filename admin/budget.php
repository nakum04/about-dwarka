<?php
$page_title = "બજેટ & ખર્ચ દરો (Budget Rates)";
require_once __DIR__ . '/header.php';

$edit_id = (int)($_GET['edit_id'] ?? 0);
$edit_item = null;

if ($edit_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM budget_rates WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_item = $stmt->fetch();
}

// Handle Add / Update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('danger', 'સુરક્ષા ટોકન અમાન્ય છે!');
    } else {
        $category = $_POST['category'] ?? 'stay';
        $tier = $_POST['tier'] ?? 'normal';
        $title_gu = trim($_POST['title_gu'] ?? '');
        $approx_price = (int)($_POST['approx_price'] ?? 0);
        $unit_gu = trim($_POST['unit_gu'] ?? '');
        $details_gu = trim($_POST['details_gu'] ?? '');
        $post_id = (int)($_POST['rate_id'] ?? 0);

        if (empty($title_gu) || $approx_price <= 0) {
            set_flash('danger', 'દર શીર્ષક અને યોગ્ય રકમ (Price) અનિવાર્ય છે!');
        } else {
            try {
                if ($post_id > 0) {
                    $stmt = $pdo->prepare("UPDATE budget_rates SET category = ?, tier = ?, title_gu = ?, approx_price = ?, unit_gu = ?, details_gu = ? WHERE id = ?");
                    $stmt->execute([$category, $tier, $title_gu, $approx_price, $unit_gu, $details_gu, $post_id]);
                    set_flash('success', "બજેટ દર '{$title_gu}' સફળતાપૂર્વક અપડેટ થઈ ગયો છે!");
                } else {
                    $stmt = $pdo->prepare("INSERT INTO budget_rates (category, tier, title_gu, approx_price, unit_gu, details_gu) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$category, $tier, $title_gu, $approx_price, $unit_gu, $details_gu]);
                    set_flash('success', "નવો બજેટ દર સફળતાપૂર્વક ઉમેરાઈ ગયો છે!");
                }
                header("Location: budget.php");
                exit;
            } catch (PDOException $e) {
                set_flash('danger', 'ડેટાબેઝ ભૂલ: ' . $e->getMessage());
            }
        }
    }
}

// Fetch rates grouped by category
$all_rates = $pdo->query("SELECT * FROM budget_rates ORDER BY category ASC, id ASC")->fetchAll();
?>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 24px;">
    <!-- Budget Rate Form -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid <?= $edit_item ? 'fa-pen-to-square' : 'fa-plus' ?>" style="color: var(--primary);"></i>
                <?= $edit_item ? 'બજેટ દર સુધારો (Edit Rate)' : 'નવો બજેટ દર ઉમેરો' ?>
            </div>
            <?php if ($edit_item): ?>
                <a href="budget.php" class="btn btn-outline btn-xs">
                    <i class="fa-solid fa-xmark"></i> રદ કરો
                </a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="budget.php">
                <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
                <input type="hidden" name="rate_id" value="<?= $edit_item['id'] ?? 0 ?>">

                <div class="form-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                    <div class="form-group">
                        <label class="form-label" for="category">કેટેગરી (Category) *</label>
                        <select name="category" id="category" class="form-control">
                            <option value="stay" <?= ($edit_item['category'] ?? '') === 'stay' ? 'selected' : '' ?>>રોકાણ / હોટેલ (Stay)</option>
                            <option value="food" <?= ($edit_item['category'] ?? '') === 'food' ? 'selected' : '' ?>>ભોજન / જમણવાર (Food)</option>
                            <option value="transport" <?= ($edit_item['category'] ?? '') === 'transport' ? 'selected' : '' ?>>વાહન વ્યવહાર (Transport)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="tier">લેવલ / પ્રકાર (Tier) *</label>
                        <select name="tier" id="tier" class="form-control">
                            <option value="budget" <?= ($edit_item['tier'] ?? '') === 'budget' ? 'selected' : '' ?>>બજેટ / સામાન્ય (Budget)</option>
                            <option value="normal" <?= ($edit_item['tier'] ?? 'normal') === 'normal' ? 'selected' : '' ?>>નોર્મલ / મધ્યમ (Normal)</option>
                            <option value="deluxe" <?= ($edit_item['tier'] ?? '') === 'deluxe' ? 'selected' : '' ?>>ડીલક્સ / પ્રીમિયમ (Deluxe)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="title_gu">દર શીર્ષક (Title) *</label>
                    <input type="text" id="title_gu" name="title_gu" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['title_gu'] ?? '') ?>" 
                           placeholder="દા.ત. નોર્મલ ગુજરાતી / કાઠિયાવાડી અનલિમિટેડ થાળી" required>
                </div>

                <div class="form-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                    <div class="form-group">
                        <label class="form-label" for="approx_price">અંદાજિત ભાવ (₹ INR) *</label>
                        <input type="number" id="approx_price" name="approx_price" class="form-control" 
                               value="<?= htmlspecialchars($edit_item['approx_price'] ?? 100) ?>" 
                               placeholder="દા.ત. 130" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="unit_gu">એકમ (Unit) *</label>
                        <input type="text" id="unit_gu" name="unit_gu" class="form-control" 
                               value="<?= htmlspecialchars($edit_item['unit_gu'] ?? 'પ્રતિ થાળી') ?>" 
                               placeholder="દા.ત. પ્રતિ રૂમ / રાત્રિ અથવા પ્રતિ થાળી" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="details_gu">વિગતવાર વર્ણન (Details)</label>
                    <textarea id="details_gu" name="details_gu" class="form-control" rows="3" 
                              placeholder="સુવિધાઓ, વાનગીઓ કે સેવાઓની વિગતો લખો..."><?= htmlspecialchars($edit_item['details_gu'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-floppy-disk"></i> 
                    <?= $edit_item ? 'ફેરફારો સેવ કરો (Save Changes)' : 'દર ઉમેરો (Add Rate)' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Rates Table List -->
    <div class="card" style="grid-column: span 1;">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-coins" style="color: var(--primary);"></i>
                બજેટ દરો યાદી (કુલ: <?= count($all_rates) ?>)
            </div>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>કેટેગરી & ટિયર</th>
                            <th>શીર્ષક & વિગત</th>
                            <th>ભાવ</th>
                            <th style="text-align: right; width: 90px;">ક્રિયા</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($all_rates)): ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-muted); padding: 30px;">કોઈ દર મળ્યો નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($all_rates as $r): ?>
                            <tr <?= ($edit_item && $edit_item['id'] == $r['id']) ? 'style="background: #fffbeb;"' : '' ?>>
                                <td style="width: 140px;">
                                    <?php 
                                        $cat_name = [
                                            'stay' => 'રોકાણ (Stay)',
                                            'food' => 'ભોજન (Food)',
                                            'transport' => 'વાહન (Transport)'
                                        ][$r['category']] ?? $r['category'];
                                    ?>
                                    <strong style="font-size: 0.82rem; display: block;"><?= $cat_name ?></strong>
                                    <span class="badge" style="background: #f1f5f9; color: #475569; margin-top: 3px;">
                                        <?= htmlspecialchars($r['tier']) ?>
                                    </span>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($r['title_gu']) ?></strong>
                                    <p style="font-size: 0.8rem; color: #64748b; margin-top: 2px;">
                                        <?= htmlspecialchars(mb_substr($r['details_gu'], 0, 80)) . (mb_strlen($r['details_gu']) > 80 ? '...' : '') ?>
                                    </p>
                                </td>
                                <td>
                                    <span style="font-size: 1rem; font-weight: 700; color: #059669;">
                                        ₹ <?= number_format($r['approx_price']) ?>
                                    </span>
                                    <div style="font-size: 0.72rem; color: var(--text-muted);"><?= htmlspecialchars($r['unit_gu']) ?></div>
                                </td>
                                <td style="text-align: right;">
                                    <div class="action-buttons" style="justify-content: flex-end;">
                                        <a href="budget.php?edit_id=<?= $r['id'] ?>" class="btn btn-outline btn-xs" title="સુધારો">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="delete.php?type=budget&id=<?= $r['id'] ?>&token=<?= get_csrf_token() ?>" 
                                           class="btn btn-danger btn-xs" 
                                           onclick="return confirmDelete('શું તમે ખરેખર આ બજેટ દર કાઢી નાખવા માંગો છો?');" 
                                           title="કાઢી નાખો">
                                            <i class="fa-solid fa-trash"></i>
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
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
