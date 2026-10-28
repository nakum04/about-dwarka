<?php
$page_title = "ઇતિહાસ ટાઇમલાઇન (History Timeline)";
require_once __DIR__ . '/header.php';

$edit_id = (int)($_GET['edit_id'] ?? 0);
$edit_item = null;

if ($edit_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM history_timeline WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_item = $stmt->fetch();
}

// Handle Add / Update POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('danger', 'સુરક્ષા ટોકન અમાન્ય છે!');
    } else {
        $era_gu = trim($_POST['era_gu'] ?? '');
        $title_gu = trim($_POST['title_gu'] ?? '');
        $description_gu = trim($_POST['description_gu'] ?? '');
        $order_seq = (int)($_POST['order_seq'] ?? 1);
        $post_id = (int)($_POST['history_id'] ?? 0);

        if (empty($era_gu) || empty($title_gu) || empty($description_gu)) {
            set_flash('danger', 'યુગ, શીર્ષક અને વિગત ત્રણેય અનિવાર્ય છે!');
        } else {
            try {
                if ($post_id > 0) {
                    $stmt = $pdo->prepare("UPDATE history_timeline SET era_gu = ?, title_gu = ?, description_gu = ?, order_seq = ? WHERE id = ?");
                    $stmt->execute([$era_gu, $title_gu, $description_gu, $order_seq, $post_id]);
                    set_flash('success', "ઇતિહાસ પ્રસંગ '{$title_gu}' સફળતાપૂર્વક અપડેટ થઈ ગયો છે!");
                } else {
                    $stmt = $pdo->prepare("INSERT INTO history_timeline (era_gu, title_gu, description_gu, order_seq) VALUES (?, ?, ?, ?)");
                    $stmt->execute([$era_gu, $title_gu, $description_gu, $order_seq]);
                    set_flash('success', "નવો ઇતિહાસ પ્રસંગ સફળતાપૂર્વક ઉમેરાઈ ગયો છે!");
                }
                header("Location: history.php");
                exit;
            } catch (PDOException $e) {
                set_flash('danger', 'ડેટાબેઝ ભૂલ: ' . $e->getMessage());
            }
        }
    }
}

// Fetch history timeline items
$timeline = $pdo->query("SELECT * FROM history_timeline ORDER BY order_seq ASC, id ASC")->fetchAll();
?>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(380px, 1fr)); gap: 24px;">
    <!-- History Form -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid <?= $edit_item ? 'fa-pen-to-square' : 'fa-plus' ?>" style="color: var(--primary);"></i>
                <?= $edit_item ? 'પ્રસંગ સુધારો (Edit Milestone)' : 'નવો ઐતિહાસિક પ્રસંગ ઉમેરો' ?>
            </div>
            <?php if ($edit_item): ?>
                <a href="history.php" class="btn btn-outline btn-xs">
                    <i class="fa-solid fa-xmark"></i> રદ કરો
                </a>
            <?php endif; ?>
        </div>
        <div class="card-body">
            <form method="POST" action="history.php">
                <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
                <input type="hidden" name="history_id" value="<?= $edit_item['id'] ?? 0 ?>">

                <div class="form-grid" style="grid-template-columns: 2fr 1fr; margin-bottom: 0;">
                    <div class="form-group">
                        <label class="form-label" for="era_gu">યુગ / સમયગાળો (Era) *</label>
                        <input type="text" id="era_gu" name="era_gu" class="form-control" 
                               value="<?= htmlspecialchars($edit_item['era_gu'] ?? '') ?>" 
                               placeholder="દા.ત. દ્વાપર યુગ (૫૦૦૦+ વર્ષ પૂર્વે)" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="order_seq">ક્રમ (Order Seq) *</label>
                        <input type="number" id="order_seq" name="order_seq" class="form-control" 
                               value="<?= htmlspecialchars($edit_item['order_seq'] ?? (count($timeline) + 1)) ?>" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="title_gu">ઐતિહાસિક ઘટના શીર્ષક *</label>
                    <input type="text" id="title_gu" name="title_gu" class="form-control" 
                           value="<?= htmlspecialchars($edit_item['title_gu'] ?? '') ?>" 
                           placeholder="દા.ત. ભગવાન શ્રીકૃષ્ણ દ્વારા સ્વર્ણ દ્વારકાનું નિર્માણ" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description_gu">વિગતવાર ઐતિહાસિક વર્ણન *</label>
                    <textarea id="description_gu" name="description_gu" class="form-control" rows="4" 
                              placeholder="ઘટના, પુરાતત્વ આધાર કે પૌરાણિક કથા વિગતવાર લખો..." required><?= htmlspecialchars($edit_item['description_gu'] ?? '') ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-floppy-disk"></i> 
                    <?= $edit_item ? 'ફેરફારો સેવ કરો (Save Changes)' : 'પ્રસંગ ઉમેરો (Add Milestone)' ?>
                </button>
            </form>
        </div>
    </div>

    <!-- History Timeline List -->
    <div class="card" style="grid-column: span 1;">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-landmark" style="color: var(--primary);"></i>
                ઇતિહાસ ટાઇમલાઇન ક્રમ (કુલ: <?= count($timeline) ?>)
            </div>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 40px;">ક્રમ</th>
                            <th>યુગ & ઘટના</th>
                            <th style="text-align: right; width: 90px;">ક્રિયા</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($timeline)): ?>
                            <tr><td colspan="3" style="text-align: center; color: var(--text-muted); padding: 30px;">કોઈ ઇતિહાસ પ્રસંગ મળ્યો નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($timeline as $t): ?>
                            <tr <?= ($edit_item && $edit_item['id'] == $t['id']) ? 'style="background: #fffbeb;"' : '' ?>>
                                <td style="font-weight: 700; color: var(--primary);">
                                    #<?= $t['order_seq'] ?>
                                </td>
                                <td>
                                    <span style="font-size: 0.78rem; color: #0284c7; font-weight: 600; display: block;">
                                        <?= htmlspecialchars($t['era_gu']) ?>
                                    </span>
                                    <strong style="color: var(--navy);"><?= htmlspecialchars($t['title_gu']) ?></strong>
                                    <p style="font-size: 0.8rem; color: #64748b; margin-top: 3px;">
                                        <?= htmlspecialchars(mb_substr($t['description_gu'], 0, 100)) . (mb_strlen($t['description_gu']) > 100 ? '...' : '') ?>
                                    </p>
                                </td>
                                <td style="text-align: right;">
                                    <div class="action-buttons" style="justify-content: flex-end;">
                                        <a href="history.php?edit_id=<?= $t['id'] ?>" class="btn btn-outline btn-xs" title="સુધારો">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="delete.php?type=history&id=<?= $t['id'] ?>&token=<?= get_csrf_token() ?>" 
                                           class="btn btn-danger btn-xs" 
                                           onclick="return confirmDelete('શું તમે ખરેખર આ પ્રસંગ કાઢી નાખવા માંગો છો?');" 
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
