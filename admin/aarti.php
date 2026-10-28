<?php
$page_title = "દર્શન & આરતી સમય (Aarti Timings)";
require_once __DIR__ . '/header.php';

$edit_id = (int)($_GET['edit_id'] ?? 0);
$edit_item = null;

if ($edit_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM aarti_timings WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_item = $stmt->fetch();
}

// Handle Add / Update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('danger', 'સુરક્ષા ટોકન અમાન્ય છે!');
    } else {
        $aarti_name_gu = trim($_POST['aarti_name_gu'] ?? '');
        $time_str = trim($_POST['time_str'] ?? '');
        $significance_gu = trim($_POST['significance_gu'] ?? '');
        $post_id = (int)($_POST['aarti_id'] ?? 0);

        if (empty($aarti_name_gu) || empty($time_str)) {
            set_flash('danger', 'આરતીનું નામ અને સમય બંને અનિવાર્ય છે!');
        } else {
            try {
                if ($post_id > 0) {
                    $stmt = $pdo->prepare("UPDATE aarti_timings SET aarti_name_gu = ?, time_str = ?, significance_gu = ? WHERE id = ?");
                    $stmt->execute([$aarti_name_gu, $time_str, $significance_gu, $post_id]);
                    set_flash('success', "આરતી સમય '{$aarti_name_gu}' સફળતાપૂર્વક અપડેટ થઈ ગયો છે!");
                } else {
                    $stmt = $pdo->prepare("INSERT INTO aarti_timings (aarti_name_gu, time_str, significance_gu) VALUES (?, ?, ?)");
                    $stmt->execute([$aarti_name_gu, $time_str, $significance_gu]);
                    set_flash('success', "નવો આરતી સમય '{$aarti_name_gu}' સફળતાપૂર્વક ઉમેરાઈ ગયો છે!");
                }
                header('Location: aarti.php');
                exit;
            } catch (PDOException $e) {
                set_flash('danger', 'ડેટાબેઝ ભૂલ: ' . $e->getMessage());
            }
        }
    }
}

// Fetch all aarti timings
$aarti_list = $pdo->query("SELECT * FROM aarti_timings ORDER BY id ASC")->fetchAll();
?>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 24px;">
    <!-- Aarti Form (Add or Edit) -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid <?= $edit_item ? 'fa-pen-to-square' : 'fa-plus' ?>" style="color: var(--primary);"></i>
                <?= $edit_item ? 'આરતી સમય સુધારો (Edit Timing)' : 'નવી આરતી / દર્શન ઉમેરો' ?>
            </div>
            <?php if ($edit_item): ?>
                <a href="aarti.php" class="btn btn-outline btn-xs">
                    <i class="fa-solid fa-xmark"></i> રદ કરો
                </a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="aarti.php">
                <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
                <input type="hidden" name="aarti_id" value="<?= $edit_item['id'] ?? 0 ?>">

                <div class="form-group">
                    <label class="form-label" for="aarti_name_gu">આરતી અથવા દર્શનનું નામ *</label>
                    <input type="text" id="aarti_name_gu" name="aarti_name_gu" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['aarti_name_gu'] ?? '') ?>" 
                           placeholder="દા.ત. મંગળા આરતી (Mangla Aarti)" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="time_str">સમય (Timing) *</label>
                    <input type="text" id="time_str" name="time_str" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['time_str'] ?? '') ?>" 
                           placeholder="દા.ત. સવારે ૬:૩૦ વાગ્યે અથવા બપોરે ૧૨:૦૦ થી ૧૨:૩૦" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="significance_gu">ધાર્મિક મહત્વ અને વિગત</label>
                    <textarea id="significance_gu" name="significance_gu" class="form-control" rows="3" 
                              placeholder="દા.ત. પ્રભાત કાળે ભગવાનને જગાડીને કરવામાં આવતી પ્રથમ મંગલકારી દિવ્ય આરતી."><?= htmlspecialchars($edit_item['significance_gu'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-floppy-disk"></i> 
                    <?= $edit_item ? 'ફેરફારો સેવ કરો (Save Changes)' : 'આરતી સમય ઉમેરો (Add Timing)' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- Aarti Table List -->
    <div class="card" style="grid-column: span 1;">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-bell" style="color: var(--primary);"></i>
                હાલનું દર્શન & આરતી સમયપત્રક (કુલ: <?= count($aarti_list) ?>)
            </div>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>આરતી / દર્શન</th>
                            <th>સમય</th>
                            <th>મહત્વ</th>
                            <th style="text-align: right; width: 100px;">ક્રિયા</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($aarti_list)): ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-muted); padding: 30px;">કોઈ આરતી નોંધાયેલ નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($aarti_list as $a): ?>
                            <tr <?= ($edit_item && $edit_item['id'] == $a['id']) ? 'style="background: #fffbeb;"' : '' ?>>
                                <td><strong><?= htmlspecialchars($a['aarti_name_gu']) ?></strong></td>
                                <td>
                                    <span style="background: #fef3c7; color: #92400e; padding: 3px 8px; border-radius: 4px; font-size: 0.8rem; font-weight: 600;">
                                        <?= htmlspecialchars($a['time_str']) ?>
                                    </span>
                                </td>
                                <td style="font-size: 0.82rem; color: #475569; max-width: 250px;">
                                    <?= htmlspecialchars($a['significance_gu']) ?>
                                </td>
                                <td style="text-align: right;">
                                    <div class="action-buttons" style="justify-content: flex-end;">
                                        <a href="aarti.php?edit_id=<?= $a['id'] ?>" class="btn btn-outline btn-xs" title="સુધારો">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="delete.php?type=aarti&id=<?= $a['id'] ?>&token=<?= get_csrf_token() ?>" 
                                           class="btn btn-danger btn-xs" 
                                           onclick="return confirmDelete('શું તમે ખરેખર આ આરતી સમય કાઢી નાખવા માંગો છો?');" 
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
