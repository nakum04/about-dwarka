<?php
$page_title = "ટૂર સમયપત્રક (Itineraries)";
require_once __DIR__ . '/header.php';

$selected_plan = (int)($_GET['plan'] ?? 1);
if (!in_array($selected_plan, [1, 2, 3])) {
    $selected_plan = 1;
}

$edit_id = (int)($_GET['edit_id'] ?? 0);
$edit_item = null;

if ($edit_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM itineraries WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_item = $stmt->fetch();
    if ($edit_item) {
        $selected_plan = $edit_item['plan_days'];
    }
}

// Handle Add / Update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('danger', 'સુરક્ષા ટોકન અમાન્ય છે!');
    } else {
        $plan_days = (int)($_POST['plan_days'] ?? 1);
        $day_number = (int)($_POST['day_number'] ?? 1);
        $time_slot = trim($_POST['time_slot'] ?? '');
        $title_gu = trim($_POST['title_gu'] ?? '');
        $description_gu = trim($_POST['description_gu'] ?? '');
        $spots_covered = trim($_POST['spots_covered'] ?? '');
        $post_id = (int)($_POST['itinerary_id'] ?? 0);

        if (empty($time_slot) || empty($title_gu) || empty($description_gu)) {
            set_flash('danger', 'સમય સ્લોટ, શીર્ષક અને વિગત અનિવાર્ય છે!');
        } else {
            try {
                if ($post_id > 0) {
                    $stmt = $pdo->prepare("UPDATE itineraries SET plan_days = ?, day_number = ?, time_slot = ?, title_gu = ?, description_gu = ?, spots_covered = ? WHERE id = ?");
                    $stmt->execute([$plan_days, $day_number, $time_slot, $title_gu, $description_gu, $spots_covered, $post_id]);
                    set_flash('success', "સમયપત્રક સ્લોટ સફળતાપૂર્વક અપડેટ થઈ ગયો છે!");
                } else {
                    $stmt = $pdo->prepare("INSERT INTO itineraries (plan_days, day_number, time_slot, title_gu, description_gu, spots_covered) VALUES (?, ?, ?, ?, ?, ?)");
                    $stmt->execute([$plan_days, $day_number, $time_slot, $title_gu, $description_gu, $spots_covered]);
                    set_flash('success', "નવો સમયપત્રક સ્લોટ સફળતાપૂર્વક ઉમેરાઈ ગયો છે!");
                }
                header("Location: itineraries.php?plan={$plan_days}");
                exit;
            } catch (PDOException $e) {
                set_flash('danger', 'ડેટાબેઝ ભૂલ: ' . $e->getMessage());
            }
        }
    }
}

// Fetch items for selected plan
$stmt = $pdo->prepare("SELECT * FROM itineraries WHERE plan_days = ? ORDER BY day_number ASC, id ASC");
$stmt->execute([$selected_plan]);
$items = $stmt->fetchAll();
?>

<!-- Plan Selection Tabs -->
<div style="display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap;">
    <a href="itineraries.php?plan=1" class="btn <?= $selected_plan === 1 ? 'btn-primary' : 'btn-outline' ?>">
        <i class="fa-solid fa-bolt"></i> ૧ દિવસીય પ્લાન (1 Day)
    </a>
    <a href="itineraries.php?plan=2" class="btn <?= $selected_plan === 2 ? 'btn-primary' : 'btn-outline' ?>">
        <i class="fa-solid fa-star"></i> ૨ દિવસીય પ્લાન (2 Days - ભલામણ કરેલ)
    </a>
    <a href="itineraries.php?plan=3" class="btn <?= $selected_plan === 3 ? 'btn-primary' : 'btn-outline' ?>">
        <i class="fa-solid fa-umbrella-beach"></i> ૩ દિવસીય પ્લાન (3 Days)
    </a>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 24px;">
    <!-- Itinerary Form -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid <?= $edit_item ? 'fa-pen-to-square' : 'fa-plus' ?>" style="color: var(--primary);"></i>
                <?= $edit_item ? 'સ્લોટ સુધારો (Edit Slot)' : "નવો સ્લોટ ઉમેરો ({$selected_plan} દિવસીય પ્લાનમાં)" ?>
            </div>
            <?php if ($edit_item): ?>
                <a href="itineraries.php?plan=<?= $selected_plan ?>" class="btn btn-outline btn-xs">
                    <i class="fa-solid fa-xmark"></i> રદ કરો
                </a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="itineraries.php">
                <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
                <input type="hidden" name="itinerary_id" value="<?= $edit_item['id'] ?? 0 ?>">

                <div class="form-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                    <div class="form-group">
                        <label class="form-label" for="plan_days">પ્લાન પ્રકાર</label>
                        <select name="plan_days" id="plan_days" class="form-control">
                            <option value="1" <?= ($edit_item['plan_days'] ?? $selected_plan) == 1 ? 'selected' : '' ?>>૧ દિવસીય (1 Day)</option>
                            <option value="2" <?= ($edit_item['plan_days'] ?? $selected_plan) == 2 ? 'selected' : '' ?>>૨ દિવસીય (2 Days)</option>
                            <option value="3" <?= ($edit_item['plan_days'] ?? $selected_plan) == 3 ? 'selected' : '' ?>>૩ દિવસીય (3 Days)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="day_number">કયો દિવસ? (Day Number)</label>
                        <select name="day_number" id="day_number" class="form-control">
                            <option value="1" <?= ($edit_item['day_number'] ?? 1) == 1 ? 'selected' : '' ?>>દિવસ ૧ (Day 1)</option>
                            <option value="2" <?= ($edit_item['day_number'] ?? 1) == 2 ? 'selected' : '' ?>>દિવસ ૨ (Day 2)</option>
                            <option value="3" <?= ($edit_item['day_number'] ?? 1) == 3 ? 'selected' : '' ?>>દિવસ ૩ (Day 3)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="time_slot">સમય સ્લોટ / તબક્કો *</label>
                    <input type="text" id="time_slot" name="time_slot" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['time_slot'] ?? '') ?>" 
                           placeholder="દા.ત. સવાર (૦૬:૦૦ થી ૧૧:૦૦) અથવા દિવસ ૧: દ્વારકા નગરી દર્શન" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="title_gu">મુખ્ય શીર્ષક (Title) *</label>
                    <input type="text" id="title_gu" name="title_gu" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['title_gu'] ?? '') ?>" 
                           placeholder="દા.ત. મંગળા આરતી, ગોમતી સ્નાન અને જગત મંદિર દર્શન" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description_gu">વિગતવાર કાર્યક્રમ (Description) *</label>
                    <textarea id="description_gu" name="description_gu" class="form-control" rows="3" 
                              placeholder="મુલાકાતીઓએ શું કરવું અને કેવી રીતે ફરવું તે લખો..." required><?= htmlspecialchars($edit_item['description_gu'] ?? '') ?></textarea>
                </div>

                <div class="form-group">
                    <label class="form-label" for="spots_covered">આવરી લીધેલ સ્થળો (Spots Covered)</label>
                    <input type="text" id="spots_covered" name="spots_covered" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['spots_covered'] ?? '') ?>" 
                           placeholder="દા.ત. ગોમતી ઘાટ, જગત મંદિર, સુદામા સેતુ">
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-floppy-disk"></i> 
                    <?= $edit_item ? 'ફેરફારો સેવ કરો (Save Changes)' : 'સ્લોટ ઉમેરો (Add Slot)' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Itinerary Items List -->
    <div class="card" style="grid-column: span 1;">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-list-check" style="color: var(--primary);"></i>
                <?= $selected_plan ?> દિવસીય પ્લાનના સ્લોટ્સ (કુલ: <?= count($items) ?>)
            </div>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>દિવસ / સમય</th>
                            <th>શીર્ષક & વિગત</th>
                            <th style="text-align: right; width: 100px;">ક્રિયા</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)): ?>
                            <tr><td colspan="3" style="text-align: center; color: var(--text-muted); padding: 30px;">આ પ્લાનમાં કોઈ સ્લોટ ઉમેરેલ નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($items as $it): ?>
                            <tr <?= ($edit_item && $edit_item['id'] == $it['id']) ? 'style="background: #fffbeb;"' : '' ?>>
                                <td style="width: 160px;">
                                    <span class="badge" style="background: #e0f2fe; color: #0369a1; margin-bottom: 4px; display: block; width: fit-content;">
                                        દિવસ <?= $it['day_number'] ?>
                                    </span>
                                    <strong style="font-size: 0.82rem; color: var(--navy);"><?= htmlspecialchars($it['time_slot']) ?></strong>
                                </td>
                                <td>
                                    <strong style="color: var(--primary);"><?= htmlspecialchars($it['title_gu']) ?></strong>
                                    <p style="font-size: 0.82rem; color: #475569; margin: 4px 0;"><?= htmlspecialchars($it['description_gu']) ?></p>
                                    <?php if ($it['spots_covered']): ?>
                                        <div style="font-size: 0.78rem; color: #059669;">
                                            <i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($it['spots_covered']) ?>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;">
                                    <div class="action-buttons" style="justify-content: flex-end;">
                                        <a href="itineraries.php?plan=<?= $selected_plan ?>&edit_id=<?= $it['id'] ?>" class="btn btn-outline btn-xs" title="સુધારો">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="delete.php?type=itinerary&id=<?= $it['id'] ?>&token=<?= get_csrf_token() ?>" 
                                           class="btn btn-danger btn-xs" 
                                           onclick="return confirmDelete('શું તમે ખરેખર આ સ્લોટ કાઢી નાખવા માંગો છો?');" 
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
