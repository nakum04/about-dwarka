<?php
$page_title = "યાત્રી પ્રતિભાવો (Reviews & Feedback)";
require_once __DIR__ . '/header.php';

// Handle Manual Add Review POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        set_flash('danger', 'સુરક્ષા ટોકન અમાન્ય છે!');
    } else {
        $user_name = trim($_POST['user_name'] ?? '');
        $user_city = trim($_POST['user_city'] ?? '');
        $rating = max(1, min(5, (int)($_POST['rating'] ?? 5)));
        $user_comment = trim($_POST['user_comment'] ?? '');

        if (empty($user_name) || empty($user_comment)) {
            set_flash('danger', 'યાત્રીનું નામ અને પ્રતિભાવ બંને અનિવાર્ય છે!');
        } else {
            try {
                $stmt = $pdo->prepare("INSERT INTO reviews (user_name, user_city, rating, user_comment) VALUES (?, ?, ?, ?)");
                $stmt->execute([$user_name, $user_city ?: 'યાત્રાળુ', $rating, $user_comment]);
                set_flash('success', "પ્રતિભાવ સફળતાપૂર્વક ઉમેરાઈ ગયો છે અને વેબસાઇટ પર લાઈવ થઈ ગયો છે!");
                header("Location: reviews.php");
                exit;
            } catch (PDOException $e) {
                set_flash('danger', 'ડેટાબેઝ ભૂલ: ' . $e->getMessage());
            }
        }
    }
}

// Fetch all reviews
$reviews = $pdo->query("SELECT * FROM reviews ORDER BY id DESC")->fetchAll();
?>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(360px, 1fr)); gap: 24px;">
    <!-- Manual Review Form -->
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-plus" style="color: var(--primary);"></i>
                નવો પ્રતિભાવ ઉમેરો (Add Testimonial)
            </div>
        </div>
        <div class="card-body">
            <form method="POST" action="reviews.php">
                <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">

                <div class="form-group">
                    <label class="form-label" for="user_name">યાત્રીનું પૂરું નામ *</label>
                    <input type="text" id="user_name" name="user_name" class="form-control" 
                           placeholder="દા.ત. મુકેશભાઈ શાહ" required>
                </div>

                <div class="form-grid" style="grid-template-columns: 1fr 1fr; margin-bottom: 0;">
                    <div class="form-group">
                        <label class="form-label" for="user_city">શહેર / ગામ</label>
                        <input type="text" id="user_city" name="user_city" class="form-control" 
                               placeholder="દા.ત. સુરત, અમદાવાદ">
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="rating">રેટિંગ (Stars)</label>
                        <select name="rating" id="rating" class="form-control">
                            <option value="5" selected>★★★★★ (૫ સ્ટાર)</option>
                            <option value="4">★★★★☆ (૪ સ્ટાર)</option>
                            <option value="3">★★★☆☆ (૩ સ્ટાર)</option>
                            <option value="2">★★☆☆☆ (૨ સ્ટાર)</option>
                            <option value="1">★☆☆☆☆ (૧ સ્ટાર)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="user_comment">પ્રતિભાવ / અનુભવ *</label>
                    <textarea id="user_comment" name="user_comment" class="form-control" rows="3" 
                              placeholder="યાત્રીનો અનુભવ અથવા પ્રશંસા લખો..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    <i class="fa-solid fa-paper-plane"></i> પ્રતિભાવ ઉમેરો
                </button>
            </form>
        </div>
    </div>

    <!-- Reviews List -->
    <div class="card" style="grid-column: span 1;">
        <div class="card-header">
            <div class="card-title">
                <i class="fa-solid fa-comments" style="color: var(--primary);"></i>
                વેબસાઇટ પરના તમામ પ્રતિભાવો (કુલ: <?= count($reviews) ?>)
            </div>
        </div>
        <div class="card-body" style="padding: 0;">
            <div class="table-responsive">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>યાત્રી & શહેર</th>
                            <th>રેટિંગ & પ્રતિભાવ</th>
                            <th>તારીખ</th>
                            <th style="text-align: right; width: 60px;">ક્રિયા</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($reviews)): ?>
                            <tr><td colspan="4" style="text-align: center; color: var(--text-muted); padding: 30px;">કોઈ પ્રતિભાવ મળ્યો નથી.</td></tr>
                        <?php else: ?>
                            <?php foreach ($reviews as $r): ?>
                            <tr>
                                <td style="width: 140px;">
                                    <strong><?= htmlspecialchars($r['user_name']) ?></strong>
                                    <div style="font-size: 0.78rem; color: var(--text-muted);"><?= htmlspecialchars($r['user_city'] ?: 'યાત્રાળુ') ?></div>
                                </td>
                                <td>
                                    <div style="color: #f59e0b; font-size: 0.85rem; margin-bottom: 2px;">
                                        <?= str_repeat('★', (int)$r['rating']) ?><?= str_repeat('☆', 5 - (int)$r['rating']) ?>
                                    </div>
                                    <p style="font-size: 0.82rem; color: #334155;">
                                        <?= htmlspecialchars($r['user_comment']) ?>
                                    </p>
                                </td>
                                <td style="font-size: 0.78rem; color: var(--text-muted); white-space: nowrap;">
                                    <?= date('d-m-Y', strtotime($r['created_at'])) ?>
                                </td>
                                <td style="text-align: right;">
                                    <a href="delete.php?type=review&id=<?= $r['id'] ?>&token=<?= get_csrf_token() ?>" 
                                       class="btn btn-danger btn-xs" 
                                       onclick="return confirmDelete('શું તમે ખરેખર આ પ્રતિભાવ કાઢી નાખવા માંગો છો?');" 
                                       title="કાઢી નાખો">
                                        <i class="fa-solid fa-trash"></i>
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
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
