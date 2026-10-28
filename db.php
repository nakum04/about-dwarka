<?php
/**
 * Database Connection & Auto-Setup for Dwarka Portal
 * Host: localhost | User: root | Password: "" | DB: dwarka_guide
 */

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'dwarka_guide';
$charset = 'utf8mb4';

try {
    // 1. Initial connection (without DB) to check and create if not exists
    $dsn_no_db = "mysql:host=$host;charset=$charset";
    $pdo_temp = new PDO($dsn_no_db, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    // Create DB if missing
    $pdo_temp->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

    // 2. Main Connection
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
    $pdo->exec("SET NAMES utf8mb4");

    // Check if places table exists, if not run SQL seed file
    $check_table = $pdo->query("SHOW TABLES LIKE 'places'")->fetch();
    if (!$check_table) {
        $sql_file = __DIR__ . '/dwarka_db.sql';
        if (file_exists($sql_file)) {
            $sql_content = file_get_contents($sql_file);
            $pdo->exec($sql_content);
        }
    }

    // Auto-create admins table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS `admins` (
        `id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(100) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL,
        `full_name` VARCHAR(150) NOT NULL,
        `email` VARCHAR(150) NULL,
        `last_login` DATETIME NULL,
        `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Seed default admin (admin / admin123) if none exists
    $admin_count = $pdo->query("SELECT COUNT(*) FROM admins")->fetchColumn();
    if ($admin_count == 0) {
        $hashed_pass = password_hash('admin123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO admins (username, password, full_name, email) VALUES (?, ?, ?, ?)");
        $stmt->execute(['admin', $hashed_pass, 'એડમિનિસ્ટ્રેટર (Admin)', 'admin@dwarkaguide.com']);
    }

    // Auto-create site_settings table if not exists
    $pdo->exec("CREATE TABLE IF NOT EXISTS `site_settings` (
        `setting_key` VARCHAR(100) PRIMARY KEY,
        `setting_value` TEXT NULL,
        `label_gu` VARCHAR(255) NULL,
        `setting_group` VARCHAR(50) DEFAULT 'general'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;");

    // Seed initial site_settings if empty
    $settings_count = $pdo->query("SELECT COUNT(*) FROM site_settings")->fetchColumn();
    if ($settings_count == 0) {
        $default_settings = [
            ['site_title', 'પવિત્ર દ્વારકા યાત્રા માર્ગદર્શિકા | Shree Dwarka Pilgrimage Guide', 'વેબસાઇટ શીર્ષક (Site Title)', 'general'],
            ['announcement_text', 'જય શ્રી દ્વારકાધીશ! પવિત્ર મોક્ષપુરી અને ચાર ધામ પૈકીનું પશ્ચિમ ધામ.', 'ટોપ જાહેરાત પટ્ટી (Top Announcement)', 'general'],
            ['hero_badge', 'હિન્દુ ધર્મના પવિત્ર ચાર ધામ પૈકીનું પશ્ચિમ ધામ', 'હીરો બેનર બેજ (Hero Badge)', 'hero'],
            ['hero_title', 'ભગવાન શ્રીકૃષ્ણની પવિત્ર <span>સુવર્ણ નગરી દ્વારિકા</span>', 'હીરો મુખ્ય શીર્ષક (Hero Title)', 'hero'],
            ['hero_desc', 'દ્વારકાધીશ જગત મંદિર, ૫૨ ગજની ધજાનું આધ્યાત્મિક રહસ્ય, ગોમતી ઘાટ, બેટ દ્વારકા, શિવરાજપુર બીચ, નાગેશ્વર જ્યોતિર્લિંગ, સંપૂર્ણ પ્રવાસ સમયપત્રક, નોર્મલ હોટેલ અને ગુજરાતી કાઠિયાવાડી ભોજન બજેટની અધિકૃત માર્ગદર્શિકા.', 'હીરો વર્ણન (Hero Description)', 'hero'],
            ['stat_1_val', 'ચાર ધામ', 'આંકડાકીય વિગત ૧ - મૂલ્ય', 'hero'],
            ['stat_1_desc', 'બદ્રીનાથ, પુરી, રામેશ્વરમ સાથે મોક્ષદાયી', 'આંકડાકીય વિગત ૧ - વર્ણન', 'hero'],
            ['stat_2_val', '૫૨ ગજ', 'આંકડાકીય વિગત ૨ - મૂલ્ય', 'hero'],
            ['stat_2_desc', 'શિખર પર દિવસમાં ૬ વખત ચઢાવવામાં આવતી ધજા', 'આંકડાકીય વિગત ૨ - વર્ણન', 'hero'],
            ['stat_3_val', '૫૦૦૦+ વર્ષ', 'આંકડાકીય વિગત ૩ - મૂલ્ય', 'hero'],
            ['stat_3_desc', 'મહાભારત કાળ અને સમુદ્ર તળેના અવશેષો', 'આંકડાકીય વિગત ૩ - વર્ણન', 'hero'],
            ['stat_4_val', '૨૫ લાખ+', 'આંકડાકીય વિગત ૪ - મૂલ્ય', 'hero'],
            ['stat_4_desc', 'વાર્ષિક દર્શનાર્થીઓ અને શ્રદ્ધાળુઓ', 'આંકડાકીય વિગત ૪ - વર્ણન', 'hero'],
            ['best_season_title', 'ઓક્ટોબર થી માર્ચ:', 'શ્રેષ્ઠ ઋતુ શીર્ષક', 'general'],
            ['best_season_desc', 'આહલાદક શિયાળાની ઋતુ. ઉપરાંત જન્માષ્ટમી (શ્રાવણ વદ આઠમ) નો મહોત્સવ દ્વારકામાં અતિ ભવ્યતાથી ઉજવાય છે.', 'શ્રેષ્ઠ ઋતુ વર્ણન', 'general'],
            ['best_season_temp', '૨૦°C - ૨૮°C', 'તાપમાન દર્શક', 'general'],
            ['underwater_title', 'દરિયામાં ડૂબેલી દ્વારકાનું રહસ્ય (Underwater Submerged Dwarka)', 'જળમગ્ન દ્વારકા શીર્ષક', 'general'],
            ['underwater_desc', 'પ્રખ્યાત પુરાતત્વશાસ્ત્રી ડૉ. એસ. આર. રાવ (Marine Archaeology Unit, NIO) દ્વારા દ્વારકાના દરિયાકિનારે ૧૯૮૩ થી ૧૯૯૦ દરમિયાન ઉત્ખનન કરવામાં આવ્યું હતું. સમુદ્રના તળિયેથી વિશાળ પથ્થરના કિલ્લાના અવશેષો, ત્રિકોણાકાર પથ્થરના લંગર (Ship Anchors), માટીના વાસણો અને ગોળ સ્તંભો મળી આવ્યા હતા જે ૫૦૦૦ વર્ષ જૂની સભ્યતા સાબિત કરે છે. ફેબ્રુઆરી ૨૦૨૪માં ભારતના વડાપ્રધાન શ્રી નરેન્દ્ર મોદીજીએ દ્વારકાના દરિયામાં સ્કૂબા ડાઇવિંગ કરીને પ્રાચીન જળમગ્ન દ્વારકા નગરીના દર્શન કર્યા હતા અને મોરપીંછ અર્પણ કરીને પૂજા કરી હતી.', 'જળમગ્ન દ્વારકા વર્ણન', 'general'],
            ['footer_about', 'પવિત્ર દ્વારકાધામ અંગે શ્રદ્ધાળુઓ અને પ્રવાસીઓને સાચી, સચોટ અને ઉપયોગી માહિતી આપતું અધિકૃત પોર્ટલ. જગત મંદિર દર્શન, સમયપત્રક અને બજેટનું વિશ્વસનીય માર્ગદર્શન.', 'ફૂટર પરિચય (Footer About)', 'footer'],
            ['footer_shloka', "કૃષ્ણાય વાસુદેવાય હરયે પરમાત્મને ।\nપ્રણત ક્લેશનાશાય ગોવિંદાય નમો નમઃ ॥", 'ફૂટર શ્લોક (Footer Shloka)', 'footer']
        ];
        $insert_setting = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value, label_gu, setting_group) VALUES (?, ?, ?, ?)");
        foreach ($default_settings as $st) {
            $insert_setting->execute($st);
        }
    }
} catch (PDOException $e) {
    die("ડેટાબેઝ જોડાણમાં ક્ષતિ (Database Connection Error): " . $e->getMessage() . 
        "<br>કૃપા કરીને ખાતરી કરો કે XAMPP માં MySQL સર્વિસ શરૂ છે.");
}

/**
 * Helper to fetch all places
 */
function get_places($pdo = null, $location_type = null) {
    global $pdo;
    $db = $pdo;
    if ($location_type) {
        $stmt = $db->prepare("SELECT * FROM places WHERE location_type = ? ORDER BY id ASC");
        $stmt->execute([$location_type]);
        return $stmt->fetchAll();
    }
    return $db->query("SELECT * FROM places ORDER BY id ASC")->fetchAll();
}

/**
 * Helper to fetch aarti timings
 */
function get_aarti_timings($pdo = null) {
    global $pdo;
    return $pdo->query("SELECT * FROM aarti_timings ORDER BY id ASC")->fetchAll();
}

/**
 * Helper to fetch itineraries by day plan
 */
function get_itineraries($pdo = null, $plan_days = null) {
    global $pdo;
    if ($plan_days) {
        $stmt = $pdo->prepare("SELECT * FROM itineraries WHERE plan_days = ? ORDER BY day_number ASC, id ASC");
        $stmt->execute([$plan_days]);
        return $stmt->fetchAll();
    }
    return $pdo->query("SELECT * FROM itineraries ORDER BY plan_days ASC, day_number ASC, id ASC")->fetchAll();
}

/**
 * Helper to fetch budget rates
 */
function get_budget_rates($pdo = null) {
    global $pdo;
    return $pdo->query("SELECT * FROM budget_rates ORDER BY category ASC, id ASC")->fetchAll();
}

/**
 * Helper to fetch history milestones
 */
function get_history_timeline($pdo = null) {
    global $pdo;
    return $pdo->query("SELECT * FROM history_timeline ORDER BY order_seq ASC")->fetchAll();
}

/**
 * Helper to fetch latest reviews
 */
function get_reviews($pdo = null, $limit = 6) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM reviews ORDER BY id DESC LIMIT ?");
    $stmt->bindValue(1, (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
}

/**
 * Helper to fetch all site settings as key-value array
 */
function get_all_settings($pdo = null) {
    global $pdo;
    $rows = $pdo->query("SELECT setting_key, setting_value FROM site_settings")->fetchAll();
    $settings = [];
    foreach ($rows as $row) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
    return $settings;
}

/**
 * Helper to get a single site setting with default fallback
 */
function get_setting($key, $default = '', $pdo = null) {
    global $pdo;
    static $cached_settings = null;
    if ($cached_settings === null) {
        $cached_settings = get_all_settings($pdo);
    }
    return $cached_settings[$key] ?? $default;
}

/**
 * Helper to save/update a site setting
 */
function save_setting($key, $value, $pdo = null) {
    global $pdo;
    $stmt = $pdo->prepare("INSERT INTO site_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    return $stmt->execute([$key, $value, $value]);
}

