<?php
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/../db.php';

$id = (int)($_GET['id'] ?? 0);
$is_edit = ($id > 0);

$place = [
    'name_gu' => '',
    'name_en' => '',
    'category' => 'temple',
    'location_type' => 'in_dwarka',
    'deity_gu' => '',
    'timings' => 'સવારે ૬:૦૦ થી રાત્રે ૯:૦૦',
    'entry_fee' => 'મફત (Free)',
    'distance_km' => 'શહેરમાં',
    'image_url' => 'images/dwarkadhish.jpg',
    'short_desc' => '',
    'full_desc' => '',
    'highlights' => ''
];

if ($is_edit) {
    $stmt = $pdo->prepare("SELECT * FROM places WHERE id = ?");
    $stmt->execute([$id]);
    $existing = $stmt->fetch();
    if (!$existing) {
        set_flash('danger', 'સ્થળ મળ્યું નથી!');
        header('Location: places.php');
        exit;
    }
    $place = $existing;
}

$page_title = $is_edit ? "સ્થળ સંપાદિત કરો: " . htmlspecialchars($place['name_gu']) : "નવું જોવાલાયક સ્થળ ઉમેરો";

// Predefined available stock images
$stock_images = [
    'images/dwarkadhish.jpg' => 'દ્વારકાધીશ જગત મંદિર',
    'images/gomti_ghat.jpg' => 'ગોમતી ઘાટ & સંગમ',
    'images/sudama_setu.jpg' => 'સુદામા સેતુ',
    'images/bhadkeshwar.jpg' => 'ભડકેશ્વર મહાદેવ',
    'images/lighthouse.jpg' => 'દ્વારકા બીચ & લાઈટહાઉસ',
    'images/gita_mandir.jpg' => 'ગીતા મંદિર & શારદા પીઠ',
    'images/beyt_dwarka.jpg' => 'બેટ દ્વારકા',
    'images/nageshwar.jpg' => 'નાગેશ્વર જ્યોતિર્લિંગ',
    'images/shivrajpur.jpg' => 'શિવરાજપુર બીચ',
    'images/rukmini_temple.jpg' => 'રુક્ષ્મણી મંદિર',
    'images/gopi_talav.jpg' => 'ગોપી તળાવ',
    'images/hero_dwarka.jpg' => 'દ્વારકા હીરો વ્યૂ'
];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $errors[] = 'સુરક્ષા ટોકન અમાન્ય છે!';
    } else {
        $name_gu = trim($_POST['name_gu'] ?? '');
        $name_en = trim($_POST['name_en'] ?? '');
        $category = $_POST['category'] ?? 'temple';
        $location_type = $_POST['location_type'] ?? 'in_dwarka';
        $deity_gu = trim($_POST['deity_gu'] ?? '');
        $timings = trim($_POST['timings'] ?? 'સવારે ૬:૦૦ થી રાત્રે ૯:૦૦');
        $entry_fee = trim($_POST['entry_fee'] ?? 'મફત (Free)');
        $distance_km = trim($_POST['distance_km'] ?? 'શહેરમાં');
        $short_desc = trim($_POST['short_desc'] ?? '');
        $full_desc = trim($_POST['full_desc'] ?? '');
        $highlights = trim($_POST['highlights'] ?? '');

        // Determine image URL
        $image_url = trim($_POST['existing_image'] ?? $place['image_url']);
        if (!empty($_POST['custom_image_url'])) {
            $image_url = trim($_POST['custom_image_url']);
        }

        // Handle File Upload if user provided an image file
        if (!empty($_FILES['image_file']['name']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $file_tmp = $_FILES['image_file']['tmp_name'];
            $file_name = basename($_FILES['image_file']['name']);
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'webp', 'svg'];

            if (!in_array($file_ext, $allowed_exts)) {
                $errors[] = 'ઇમેજ ફોર્મેટ માન્ય નથી (JPG, PNG, WebP, SVG વાપરો).';
            } else {
                $new_file_name = 'place_' . time() . '_' . rand(100, 999) . '.' . $file_ext;
                $target_dir = __DIR__ . '/../uploads/places/';
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $target_path = $target_dir . $new_file_name;

                if (move_uploaded_file($file_tmp, $target_path)) {
                    $image_url = 'uploads/places/' . $new_file_name;
                } else {
                    $errors[] = 'ઇમેજ ફાઇલ અપલોડ કરવામાં નિષ્ફળતા મળી.';
                }
            }
        }

        if (empty($name_gu)) {
            $errors[] = 'સ્થળનું ગુજરાતી નામ અનિવાર્ય છે.';
        }
        if (empty($name_en)) {
            $errors[] = 'સ્થળનું અંગ્રેજી નામ અનિવાર્ય છે.';
        }
        if (empty($short_desc)) {
            $errors[] = 'ટૂંકી વિગત અનિવાર્ય છે.';
        }

        if (empty($errors)) {
            try {
                if ($is_edit) {
                    $stmt = $pdo->prepare("UPDATE places SET 
                        name_gu = ?, name_en = ?, category = ?, location_type = ?,
                        deity_gu = ?, timings = ?, entry_fee = ?, distance_km = ?,
                        image_url = ?, short_desc = ?, full_desc = ?, highlights = ?
                        WHERE id = ?");
                    $stmt->execute([
                        $name_gu, $name_en, $category, $location_type,
                        $deity_gu, $timings, $entry_fee, $distance_km,
                        $image_url, $short_desc, $full_desc, $highlights, $id
                    ]);
                    set_flash('success', "સ્થળ '{$name_gu}' સફળતાપૂર્વક અપડેટ થઈ ગયું છે અને વેબસાઇટ પર લાઈવ છે!");
                } else {
                    $stmt = $pdo->prepare("INSERT INTO places 
                        (name_gu, name_en, category, location_type, deity_gu, timings, entry_fee, distance_km, image_url, short_desc, full_desc, highlights) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $name_gu, $name_en, $category, $location_type,
                        $deity_gu, $timings, $entry_fee, $distance_km,
                        $image_url, $short_desc, $full_desc, $highlights
                    ]);
                    set_flash('success', "નવું સ્થળ '{$name_gu}' સફળતાપૂર્વક ઉમેરાઈ ગયું છે અને વેબસાઇટ પર લાઈવ થઈ ગયું છે!");
                }

                header('Location: places.php');
                exit;
            } catch (PDOException $e) {
                $errors[] = 'ડેટાબેઝ ભૂલ: ' . $e->getMessage();
            }
        }
    }
}

require_once __DIR__ . '/header.php';
?>

<div class="card">
    <div class="card-header">
        <div class="card-title">
            <i class="fa-solid <?= $is_edit ? 'fa-pen-to-square' : 'fa-plus' ?>" style="color: var(--primary);"></i>
            <?= $is_edit ? 'સ્થળ સંપાદિત કરો (Edit Place)' : 'નવું સ્થળ ઉમેરો (Add New Place)' ?>
        </div>
        <a href="places.php" class="btn btn-outline btn-sm">
            <i class="fa-solid fa-arrow-left"></i> યાદી પર પાછા જાઓ
        </a>
    </div>

    <div class="card-body">
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger">
                <div>
                    <strong>કૃપા કરીને ભૂલો સુધારો:</strong>
                    <ul style="margin-top: 6px; padding-left: 20px;">
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">

            <div class="form-grid">
                <!-- Name Gujarati -->
                <div class="form-group">
                    <label class="form-label" for="name_gu">
                        સ્થળનું નામ (ગુજરાતીમાં) *
                    </label>
                    <input type="text" id="name_gu" name="name_gu" class="form-control" 
                           value="<?= htmlspecialchars($place['name_gu']) ?>" 
                           placeholder="દા.ત. શ્રી દ્વારકાધીશ જગત મંદિર" required>
                </div>

                <!-- Name English -->
                <div class="form-group">
                    <label class="form-label" for="name_en">
                        સ્થળનું નામ (English) *
                    </label>
                    <input type="text" id="name_en" name="name_en" class="form-control" 
                           value="<?= htmlspecialchars($place['name_en']) ?>" 
                           placeholder="e.g. Shree Dwarkadhish Jagat Mandir" required>
                </div>

                <!-- Category -->
                <div class="form-group">
                    <label class="form-label" for="category">કેટેગરી (Category) *</label>
                    <select id="category" name="category" class="form-control">
                        <option value="temple" <?= $place['category'] === 'temple' ? 'selected' : '' ?>>મંદિર (Temple)</option>
                        <option value="beach" <?= $place['category'] === 'beach' ? 'selected' : '' ?>>દરિયાકિનારો / બીચ (Beach)</option>
                        <option value="nature" <?= $place['category'] === 'nature' ? 'selected' : '' ?>>પ્રકૃતિ / ઘાટ / તળાવ (Nature)</option>
                        <option value="bridge" <?= $place['category'] === 'bridge' ? 'selected' : '' ?>>બ્રિજ / પુલ (Bridge)</option>
                        <option value="historical" <?= $place['category'] === 'historical' ? 'selected' : '' ?>>ઐતિહાસિક સ્થળ (Historical)</option>
                    </select>
                </div>

                <!-- Location Type -->
                <div class="form-group">
                    <label class="form-label" for="location_type">વિસ્તાર / સ્થાન (Location Type) *</label>
                    <select id="location_type" name="location_type" class="form-control">
                        <option value="in_dwarka" <?= $place['location_type'] === 'in_dwarka' ? 'selected' : '' ?>>દ્વારકા શહેરમાં (In Dwarka City)</option>
                        <option value="nearby" <?= $place['location_type'] === 'nearby' ? 'selected' : '' ?>>દ્વારકા નજીક / આજુબાજુ (Nearby)</option>
                    </select>
                </div>

                <!-- Deity -->
                <div class="form-group">
                    <label class="form-label" for="deity_gu">મુખ્ય આરાધ્ય દેવ / દેવી</label>
                    <input type="text" id="deity_gu" name="deity_gu" class="form-control" 
                           value="<?= htmlspecialchars($place['deity_gu'] ?? '') ?>" 
                           placeholder="દા.ત. ભગવાન શ્રીકૃષ્ણ (રાજાધિરાજ)">
                </div>

                <!-- Timings -->
                <div class="form-group">
                    <label class="form-label" for="timings">દર્શન / મુલાકાત સમય (Timings)</label>
                    <input type="text" id="timings" name="timings" class="form-control" 
                           value="<?= htmlspecialchars($place['timings']) ?>" 
                           placeholder="દા.ત. સવારે ૬:૩૦ થી બપોરે ૧:૦૦ અને સાંજે ૫:૦૦ થી ૯:૩૦">
                </div>

                <!-- Entry Fee -->
                <div class="form-group">
                    <label class="form-label" for="entry_fee">પ્રવેશ ફી / ટિકિટ દર (Entry Fee)</label>
                    <input type="text" id="entry_fee" name="entry_fee" class="form-control" 
                           value="<?= htmlspecialchars($place['entry_fee']) ?>" 
                           placeholder="દા.ત. મફત (Free) અથવા ₹૫૦ પ્રતિ વ્યક્તિ">
                </div>

                <!-- Distance -->
                <div class="form-group">
                    <label class="form-label" for="distance_km">દ્વારકાથી અંતર (Distance)</label>
                    <input type="text" id="distance_km" name="distance_km" class="form-control" 
                           value="<?= htmlspecialchars($place['distance_km']) ?>" 
                           placeholder="દા.ત. દ્વારકા શહેર કેન્દ્ર અથવા દ્વારકાથી ૧૬ કિ.મી.">
                </div>

                <!-- Image Selection & Upload (Full Width) -->
                <div class="form-group full-width" style="background: #f8fafc; padding: 18px; border-radius: var(--radius-sm); border: 1px solid var(--border);">
                    <label class="form-label"><i class="fa-solid fa-image" style="color: var(--primary);"></i> સ્થળનો ફોટો (Place Image)</label>
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 16px; margin-top: 10px;">
                        <div>
                            <label style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">
                                ૧. સ્ટોક ઇમેજમાંથી પસંદ કરો:
                            </label>
                            <select id="existing_image" name="existing_image" class="form-control" onchange="previewStockImage(this.value)">
                                <?php foreach ($stock_images as $path => $label): ?>
                                    <option value="<?= $path ?>" <?= $place['image_url'] === $path ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($label) ?> (<?= $path ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">
                                ૨. અથવા તમારા કોમ્પ્યુટર/મોબાઈલમાંથી નવો ફોટો અપલોડ કરો:
                            </label>
                            <input type="file" name="image_file" id="image_file" class="form-control" accept="image/*" onchange="previewUploadImage(this)">
                            <div class="form-hint">મહત્તમ સાઈઝ: 5MB (JPG, PNG, WebP)</div>
                        </div>

                        <div>
                            <label style="font-size: 0.82rem; font-weight: 600; color: var(--text-muted); display: block; margin-bottom: 4px;">
                                ૩. અથવા કસ્ટમ URL / પાથ દાખલ કરો:
                            </label>
                            <input type="text" name="custom_image_url" id="custom_image_url" class="form-control" 
                                   placeholder="https://... અથવા images/photo.jpg" oninput="previewCustomUrl(this.value)">
                        </div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 16px; margin-top: 14px;">
                        <span style="font-size: 0.85rem; font-weight: 600;">હાલનો પ્રિવ્યૂ:</span>
                        <div class="img-preview-box" style="width: 160px; height: 100px;">
                            <img id="imagePreview" src="../<?= htmlspecialchars($place['image_url'] ?: 'images/hero_dwarka.jpg') ?>" 
                                 alt="Preview" onerror="this.src='../images/dwarkadhish.jpg'">
                        </div>
                    </div>
                </div>

                <!-- Short Description -->
                <div class="form-group full-width">
                    <label class="form-label" for="short_desc">
                        ટૂંકી માહિતી (Short Description - કાર્ડ પર દેખાશે) *
                    </label>
                    <textarea id="short_desc" name="short_desc" class="form-control" rows="2" 
                              placeholder="મુલાકાતીઓને એક-બે વાક્યમાં સ્થળની મુખ્ય વિશેષતા સમજાવો..." required><?= htmlspecialchars($place['short_desc']) ?></textarea>
                </div>

                <!-- Full Description -->
                <div class="form-group full-width">
                    <label class="form-label" for="full_desc">
                        સંપૂર્ણ વિગતવાર વર્ણન (Full Description - 'સંપૂર્ણ માહિતી જુઓ' પર ક્લિક કરતાં દેખાશે)
                    </label>
                    <textarea id="full_desc" name="full_desc" class="form-control" rows="5" 
                              placeholder="મંદિરનો ઇતિહાસ, કથા, વાસ્તુ સ્થાપત્ય અને ધાર્મિક મહત્વ વિગતવાર લખો..."><?= htmlspecialchars($place['full_desc']) ?></textarea>
                </div>

                <!-- Highlights -->
                <div class="form-group full-width">
                    <label class="form-label" for="highlights">
                        મુખ્ય આકર્ષણો (Highlights - અલ્પવિરામ વડે અલગ કરો)
                    </label>
                    <input type="text" id="highlights" name="highlights" class="form-control" 
                           value="<?= htmlspecialchars($place['highlights'] ?? '') ?>" 
                           placeholder="દા.ત. ૫૨ ગજની ધજા, સ્વર્ગ દ્વાર, મોક્ષ દ્વાર, ચતુર્ભુજ શ્યામ મૂર્તિ">
                </div>
            </div>

            <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border); display: flex; gap: 12px;">
                <button type="submit" class="btn btn-primary" style="padding: 11px 28px; font-size: 1rem;">
                    <i class="fa-solid fa-floppy-disk"></i> <?= $is_edit ? 'ફેરફારો સેવ કરો (Save Changes)' : 'સ્થળ ઉમેરો (Add Place)' ?>
                </button>
                <a href="places.php" class="btn btn-outline" style="padding: 11px 20px;">
                    રદ કરો (Cancel)
                </a>
            </div>
        </form>
    </div>
</div>

<script>
function previewStockImage(path) {
    document.getElementById('imagePreview').src = '../' + path;
}

function previewUploadImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('imagePreview').src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function previewCustomUrl(url) {
    if (url.trim()) {
        document.getElementById('imagePreview').src = url;
    }
}
</script>

<?php require_once __DIR__ . '/footer.php'; ?>
