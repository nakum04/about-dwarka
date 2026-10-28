<?php
/** 
 * Dwarka Tourism & Pilgrimage Portal
 * Language: Gujarati (ગુજરાતી) with English labels
 * Tech: PHP, MySQL, HTML5, CSS3, JavaScript
 */

require_once __DIR__ . '/db.php';

// Fetch data from MySQL
$site_settings = get_all_settings();
$places_all = get_places();
$aarti_list = get_aarti_timings();
$itineraries_1 = get_itineraries(null, 1);
$itineraries_2 = get_itineraries(null, 2);
$itineraries_3 = get_itineraries(null, 3);
$budget_rates = get_budget_rates();
$history_timeline = get_history_timeline();
$reviews = get_reviews(null, 6);

// Group budget rates by category
$rates_by_cat = ['stay' => [], 'food' => [], 'transport' => []];
foreach ($budget_rates as $br) {
    if (isset($rates_by_cat[$br['category']])) {
        $rates_by_cat[$br['category']][] = $br;
    }
}
?>
<!DOCTYPE html>
<html lang="gu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($site_settings['site_title'] ?? 'પવિત્ર દ્વારકા યાત્રા માર્ગદર્શિકા | Shree Dwarka Pilgrimage Guide') ?></title>
    <!-- Meta tags for SEO & Gujarati support -->
    <meta name="description" content="દ્વારકા શું છે, દ્વારકામાં કયા ભગવાનનું મંદિર છે, જોવાલાયક સ્થળો, આજુબાજુના સ્થળો, સમયપત્રક, નોર્મલ હોટેલ અને ગુજરાતી ભોજન બજેટ તથા ઇતિહાસની સંપૂર્ણ માહિતી.">
    <!-- PWA & Mobile Web App Meta -->
    <link rel="manifest" href="manifest.json">
    <meta name="theme-color" content="#e65100">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="દ્વારકા ગાઇડ">
    <link rel="apple-touch-icon" href="images/icons/icon-192.png">
    <link rel="icon" type="image/png" href="favicon.png">
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css') ?>">
</head>
<body id="top">

    <!-- 1. Top Announcement Bar -->
    <div class="top-bar">
        <div class="container">
            <div>
                <i class="fa-solid fa-om" style="color: #fde047;"></i> 
                <?= htmlspecialchars($site_settings['announcement_text'] ?? 'જય શ્રી દ્વારકાધીશ! પવિત્ર મોક્ષપુરી અને ચાર ધામ પૈકીનું પશ્ચિમ ધામ.') ?>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <select class="top-lang-select lang-select-sync" onchange="setLanguage(this.value)" title="ભાષા પસંદ કરો (Select Language)">
                    <option value="gu">ગુજરાતી (Gujarati)</option>
                    <option value="hi">हिन्दी (Hindi)</option>
                    <option value="en">English (અંગ્રેજી)</option>
                </select>
                <button id="templeBellBtn" class="bell-btn" title="મંદિરનો દિવ્ય ઘંટનાદ વગાડો">
                    <i class="fa-solid fa-bell"></i> ઘંટનાદ (Temple Bell)
                </button>
                <div class="live-clock" id="liveClock">
                    સમય: ગણતરી ચાલુ છે...
                </div>
                <a href="admin/index.php" style="color: #fde047; text-decoration: none; font-size: 0.82rem; font-weight: 600; padding: 3px 8px; background: rgba(255,255,255,0.15); border-radius: 4px; display: inline-flex; align-items: center; gap: 5px;" title="એડમિન પેનલ ખોલો">
                    <i class="fa-solid fa-user-gear"></i> એડમિન
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Header & Navigation -->
    <header class="header">
        <div class="container navbar">
            <div class="header-brand-wrap">
                <div class="logo-wrapper">
                    <div class="logo-icon">
                        <i class="fa-solid fa-gopuram"></i>
                    </div>
                    <div class="logo-text">
                        <h1>દ્વારકા દર્શન</h1>
                        <span>DWARKA TOURISM GUIDE</span>
                    </div>
                </div>

                <!-- PWA Install Button beside Website Title -->
                <button id="pwaInstallBtn" class="btn-pwa-install" type="button" title="આ વેબસાઇટ એપ તરીકે તમારા ડિવાઇસ પર ઇન્સ્ટોલ કરો">
                    <i class="fa-solid fa-cloud-arrow-down pwa-icon"></i>
                    <span class="pwa-btn-label">ઇન્સ્ટોલ એપ</span>
                </button>
            </div>

            <ul class="nav-links" id="navLinks">
                <li><a href="#about">દ્વારકા શું છે?</a></li>
                <li><a href="#temple">મુખ્ય મંદિર & આરતી</a></li>
                <li><a href="#history">ઇતિહાસ</a></li>
                <li><a href="#places">જોવાલાયક સ્થળો</a></li>
                <li><a href="#itinerary">સમયપત્રક</a></li>
                <li><a href="#budget">બજેટ & ભોજન</a></li>
                <li><a href="#reach">કેવી રીતે પહોંચવું</a></li>
                <li><a href="#feedback" class="btn-nav">યાત્રી પ્રતિભાવ</a></li>
            </ul>

            <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
    </header>

    <!-- 3. Hero Banner Section -->
    <section class="hero">
        <div class="container hero-content">
            <div class="hero-badge">
                <i class="fa-solid fa-dharmachakra"></i> <?= htmlspecialchars($site_settings['hero_badge'] ?? 'હિન્દુ ધર્મના પવિત્ર ચાર ધામ પૈકીનું પશ્ચિમ ધામ') ?>
            </div>
            <h2 class="hero-title">
                <?= $site_settings['hero_title'] ?? 'ભગવાન શ્રીકૃષ્ણની પવિત્ર <span>સુવર્ણ નગરી દ્વારિકા</span>' ?>
            </h2>
            <p class="hero-description">
                <?= htmlspecialchars($site_settings['hero_desc'] ?? 'દ્વારકાધીશ જગત મંદિર, ૫૨ ગજની ધજાનું આધ્યાત્મિક રહસ્ય, ગોમતી ઘાટ, બેટ દ્વારકા, શિવરાજપુર બીચ, નાગેશ્વર જ્યોતિર્લિંગ, સંપૂર્ણ પ્રવાસ સમયપત્રક, નોર્મલ હોટેલ અને ગુજરાતી કાઠિયાવાડી ભોજન બજેટની અધિકૃત માર્ગદર્શિકા.') ?>
            </p>

            <div class="hero-actions">
                <a href="#budget-calculator" class="btn btn-primary">
                    <i class="fa-solid fa-calculator"></i> લાઈવ બજેટ ગણો
                </a>
                <a href="#itinerary" class="btn btn-outline">
                    <i class="fa-solid fa-calendar-days"></i> ટૂર સમયપત્રક જુઓ
                </a>
                <a href="#places" class="btn btn-outline">
                    <i class="fa-solid fa-map-location-dot"></i> જોવાલાયક સ્થળો
                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <h3><?= htmlspecialchars($site_settings['stat_1_val'] ?? 'ચાર ધામ') ?></h3>
                    <p><?= htmlspecialchars($site_settings['stat_1_desc'] ?? 'બદ્રીનાથ, પુરી, રામેશ્વરમ સાથે મોક્ષદાયી') ?></p>
                </div>
                <div class="stat-item">
                    <h3><?= htmlspecialchars($site_settings['stat_2_val'] ?? '૫૨ ગજ') ?></h3>
                    <p><?= htmlspecialchars($site_settings['stat_2_desc'] ?? 'શિખર પર દિવસમાં ૬ વખત ચઢાવવામાં આવતી ધજા') ?></p>
                </div>
                <div class="stat-item">
                    <h3><?= htmlspecialchars($site_settings['stat_3_val'] ?? '૫૦૦૦+ વર્ષ') ?></h3>
                    <p><?= htmlspecialchars($site_settings['stat_3_desc'] ?? 'મહાભારત કાળ અને સમુદ્ર તળેના અવશેષો') ?></p>
                </div>
                <div class="stat-item">
                    <h3><?= htmlspecialchars($site_settings['stat_4_val'] ?? '૨૫ લાખ+') ?></h3>
                    <p><?= htmlspecialchars($site_settings['stat_4_desc'] ?? 'વાર્ષિક દર્શનાર્થીઓ અને શ્રદ્ધાળુઓ') ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Section: દ્વારકા શું છે? (What is Dwarka?) -->
    <section class="section" id="about">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">પરિચય અને મહત્વ</span>
                <h3 class="section-title">દ્વારકા શું છે? (What is Dwarka?)</h3>
                <p class="section-subtitle">
                    દ્વારકા એટલે "મોક્ષનું દ્વાર" — ભગવાન શ્રીકૃષ્ણની કર્મભૂમિ, સુવર્ણ રાજધાની અને સનાતન સંસ્કૃતિનું પરમ પવિત્ર કેન્દ્ર.
                </p>
            </div>

            <div class="about-grid">
                <div class="about-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-place-of-worship"></i>
                    </div>
                    <h3>પવિત્ર ચાર ધામ પૈકીનું એક</h3>
                    <p>
                        આદિ શંકરાચાર્ય દ્વારા નિર્ધારિત ભારતના ચાર પરમ પવિત્ર ધામોમાં દ્વારકા પશ્ચિમ દિશાનું મુખ્ય ધામ છે. 
                        જીવનમાં એકવાર દ્વારકા યાત્રા કરવાથી જન્મ-મરણના ફેરામાંથી મુક્તિ મળે છે તેવી અતૂટ ધાર્મિક માન્યતા છે.
                    </p>
                </div>

                <div class="about-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-hands-praying"></i>
                    </div>
                    <h3>સપ્ત મોક્ષદાયી પુરી</h3>
                    <p>
                        પુરાણો અનુસાર ભારતમાં ૭ નગરીઓ મોક્ષ આપનારી છે: અયોધ્યા, મથુરા, માયા (હરિદ્વાર), કાશી, કાંચી, 
                        અવંતિકા (ઉજ્જૈન) અને <strong>દ્વારાવતી (દ્વારકા)</strong>. આ સપ્તપુરીઓમાં દ્વારકાનું સ્થાન અદ્વિતીય છે.
                    </p>
                </div>

                <div class="about-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-crown"></i>
                    </div>
                    <h3>શ્રીકૃષ્ણની સુવર્ણ નગરી</h3>
                    <p>
                        મથુરા છોડ્યા બાદ ભગવાન શ્રીકૃષ્ણએ યાદવ સેના અને પ્રજાના રક્ષણ માટે સૌરાષ્ટ્રના પશ્ચિમ સાગરકાંઠે 
                        દેવશિલ્પી વિશ્વકર્મા પાસે સ્વર્ણ દ્વારકાનું નિર્માણ કરાવ્યું હતું, જ્યાં શ્રીકૃષ્ણ રાજાધિરાજ તરીકે પૂજાયા.
                    </p>
                </div>

                <div class="about-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-water"></i>
                    </div>
                    <h3>ગોમતી-સાગર સંગમ</h3>
                    <p>
                        દ્વારકામાં પવિત્ર ગોમતી નદી અને અરબી સમુદ્રનો અદ્ભુત સંગમ થાય છે. ગોમતી ઘાટ પર સ્નાન કરી ૫૬ પગથિયાં ચઢી 
                        સ્વર્ગ દ્વારથી મંદિરમાં દર્શન કરવા જવાની પૌરાણિક પરંપરા વર્ષોથી ચાલી આવે છે.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 5. Section: દ્વારકામાં કયા ભગવાનનું મંદિર છે? (Which Deity?) -->
    <section class="section alt-bg" id="temple">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">મુખ્ય આરાધ્ય દેવ</span>
                <h3 class="section-title">દ્વારકામાં કયા ભગવાનનું મંદિર છે?</h3>
                <p class="section-subtitle">
                    દ્વારકામાં મુખ્ય મંદિર <strong>શ્રી દ્વારકાધીશ જગત મંદિર</strong> છે, જ્યાં ભગવાન શ્રીકૃષ્ણ "રાજાધિરાજ" સ્વરૂપે બિરાજમાન છે.
                </p>
            </div>

            <!-- Featured Temple Box -->
            <div class="mandir-feature-box">
                <div class="mandir-grid">
                    <div class="mandir-image">
                        <img src="images/dwarkadhish_temple_real.jpg" alt="શ્રી દ્વારકાધીશ જગત મંદિર">
                        <div class="mandir-badge-float">
                            <i class="fa-solid fa-certificate"></i> મૂળ નિર્માણ: શ્રીકૃષ્ણના પ્રપૌત્ર વજ્રનાભ દ્વારા
                        </div>
                    </div>
                    <div class="mandir-details">
                        <div class="mandir-deity-pill">
                            <i class="fa-solid fa-sparkles"></i> મુખ્ય દેવ: ભગવાન શ્રીકૃષ્ણ (દ્વારકાધીશ - ચતુર્ભુજ રૂપ)
                        </div>
                        <h3>શ્રી દ્વારકાધીશ જગત મંદિર (ત્રિલોક સુંદર)</h3>
                        <p>
                            આ મંદિર ૫ માળનું ભવ્ય સ્થાપત્ય છે જે ચૂનાના પથ્થરોથી બનેલું છે અને ૭૨ કલાત્મક સ્તંભો પર ટકેલું છે. 
                            ગર્ભગૃહમાં કાળા કસોટીના પથ્થરથી કંડારેલી ભગવાન શ્રીકૃષ્ણની ચતુર્ભુજ શ્યામ મૂર્તિ બિરાજમાન છે, 
                            જેમના ચાર હાથમાં શંખ, સુદર્શન ચક્ર, ગદા અને પદ્મ (કમળ) સુશોભિત છે.
                        </p>

                        <div class="mandir-highlights-list">
                            <div class="mandir-highlight-item">
                                <i class="fa-solid fa-flag"></i> 
                                <span><strong>૫૨ ગજની ધ્વજા:</strong> સૂર્ય-ચંદ્ર અંકિત ધજા શિખર પર દિવસમાં ૬ વખત ચઢાવવામાં આવે છે.</span>
                            </div>
                            <div class="mandir-highlight-item">
                                <i class="fa-solid fa-door-open"></i> 
                                <span><strong>બે મુખ્ય દ્વાર:</strong> સ્વર્ગ દ્વાર (પ્રવેશ) અને મોક્ષ દ્વાર (નિકાસ).</span>
                            </div>
                            <div class="mandir-highlight-item">
                                <i class="fa-solid fa-monument"></i> 
                                <span><strong>શિખર ઊંચાઈ:</strong> આશરે ૭૮ મીટર (૨૫૬ ફૂટ) ઊંચું ભવ્ય શિખર.</span>
                            </div>
                            <div class="mandir-highlight-item">
                                <i class="fa-solid fa-hands"></i> 
                                <span><strong>અન્ય મૂર્તિઓ:</strong> બલરામજી, પ્રદ્યુમ્નજી, અનિરુદ્ધજી અને રુક્ષ્મણીજી.</span>
                            </div>
                        </div>

                        <div>
                            <a href="#aarti-schedule" class="btn btn-primary" style="padding: 9px 20px; font-size: 0.9rem;">
                                <i class="fa-solid fa-clock"></i> દર્શન & આરતી સમયપત્રક જુઓ
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Aarti Timings Table -->
            <div class="aarti-card" id="aarti-schedule">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; flex-wrap: wrap; gap: 10px;">
                    <div>
                        <h4 style="font-size: 1.4rem; color: var(--dark-navy);">
                            <i class="fa-solid fa-bell" style="color: var(--primary-kesari);"></i> 
                            દ્વારકાધીશ મંદિર દર્શન અને આરતીનો દૈનિક સમય
                        </h4>
                        <p style="font-size: 0.9rem; color: var(--text-muted);">
                            મંદિર સવારે ૬:૩૦ થી બપોરે ૧:૦૦ અને સાંજે ૫:૦૦ થી રાત્રે ૯:૩૦ વાગ્યા સુધી દર્શન માટે ખુલ્લું રહે છે.
                        </p>
                    </div>
                    <span class="badge-tag" style="margin: 0; background: #e0f2fe; color: #0369a1;">દૈનિક પૂજા ક્રમ</span>
                </div>

                <div class="aarti-table-responsive">
                    <table class="aarti-table">
                        <thead>
                            <tr>
                                <th>આરતી / દર્શનનું નામ</th>
                                <th>સમય (Timing)</th>
                                <th>ધાર્મિક મહત્વ અને વિગત</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($aarti_list as $aarti): ?>
                            <tr>
                                <td><strong><?= htmlspecialchars($aarti['aarti_name_gu']) ?></strong></td>
                                <td><span class="time-badge"><?= htmlspecialchars($aarti['time_str']) ?></span></td>
                                <td><?= htmlspecialchars($aarti['significance_gu']) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Section: દ્વારકાનો ઇતિહાસ (History of Dwarka) -->
    <section class="section" id="history">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">પૌરાણિક અને વૈજ્ઞાનિક વારસો</span>
                <h3 class="section-title">દ્વારકાનો ઇતિહાસ (History of Dwarka)</h3>
                <p class="section-subtitle">
                    દ્વાપર યુગમાં વિશ્વકર્મા દ્વારા સોનાની નગરીના નિર્માણથી લઈને અરબી સમુદ્રના પેટાળમાં ડૂબેલી દ્વારકાના આધુનિક સંશોધન સુધીનો રોમાંચક પ્રવાસ.
                </p>
            </div>

            <div class="timeline-container">
                <?php foreach ($history_timeline as $item): ?>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-card">
                        <span class="timeline-era"><?= htmlspecialchars($item['era_gu']) ?></span>
                        <h4><?= htmlspecialchars($item['title_gu']) ?></h4>
                        <p><?= htmlspecialchars($item['description_gu']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Deep Ocean Underwater Archeology Highlight Card -->
            <div style="background: linear-gradient(135deg, #0b1a30, #0f2b48); color: #fff; border-radius: var(--radius-md); padding: 30px; margin-top: 30px; border: 1px solid rgba(255,255,255,0.15);">
                <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 14px;">
                    <i class="fa-solid fa-water-ladder" style="font-size: 2rem; color: #38bdf8;"></i>
                    <h4 style="font-size: 1.4rem; color: #fbbf24; margin: 0;"><?= htmlspecialchars($site_settings['underwater_title'] ?? 'દરિયામાં ડૂબેલી દ્વારકાનું રહસ્ય (Underwater Submerged Dwarka)') ?></h4>
                </div>
                <p style="color: #cbd5e1; font-size: 0.96rem; line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($site_settings['underwater_desc'] ?? 'પ્રખ્યાત પુરાતત્વશાસ્ત્રી ડૉ. એસ. આર. રાવ (Marine Archaeology Unit, NIO) દ્વારા દ્વારકાના દરિયાકિનારે ૧૯૮૩ થી ૧૯૯૦ દરમિયાન ઉત્ખનન કરવામાં આવ્યું હતું.')) ?>
                </p>
            </div>
        </div>
    </section>

    <!-- 7. Section: જોવાલાયક સ્થળો (Places to Visit) -->
    <section class="section alt-bg" id="places">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">પ્રવાસન અને દર્શન</span>
                <h3 class="section-title">દ્વારકા અને આજુબાજુના જોવાલાયક સ્થળો</h3>
                <p class="section-subtitle">
                    દ્વારકા શહેરમાં આવેલા પવિત્ર તીર્થો તથા આજુબાજુના આકર્ષક સ્થળો જેમ કે બેટ દ્વારકા, નાગેશ્વર અને શિવરાજપુર બીચ.
                </p>
            </div>

            <!-- Filter & Search Toolbar -->
            <div class="places-filter-bar">
                <div class="filter-btn-group">
                    <button class="filter-btn active" data-filter="all">તમામ સ્થળો (All)</button>
                    <button class="filter-btn" data-filter="in_dwarka">દ્વારકા શહેરમાં (In City)</button>
                    <button class="filter-btn" data-filter="nearby">આજુબાજુના સ્થળો (Nearby)</button>
                    <button class="filter-btn" data-filter="temple">મંદિરો (Temples)</button>
                    <button class="filter-btn" data-filter="beach">દરિયાકિનારો / બીચ (Beach)</button>
                </div>
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="placeSearch" placeholder="સ્થળ અથવા મંદિર શોધો...">
                </div>
            </div>

            <!-- Places Cards Grid -->
            <div class="places-grid" id="placesGrid">
                <?php foreach ($places_all as $place): ?>
                <div class="place-card" 
                     data-location="<?= htmlspecialchars($place['location_type']) ?>"
                     data-category="<?= htmlspecialchars($place['category']) ?>">
                    
                    <div class="place-img-holder">
                        <img src="<?= htmlspecialchars($place['image_url']) ?>" alt="<?= htmlspecialchars($place['name_gu']) ?>">
                        <span class="place-tag <?= htmlspecialchars($place['location_type']) ?>">
                            <?= $place['location_type'] === 'in_dwarka' ? 'દ્વારકા શહેરમાં' : 'દ્વારકા નજીક (' . htmlspecialchars($place['distance_km']) . ')' ?>
                        </span>
                    </div>

                    <div class="place-body">
                        <h4 class="place-title"><?= htmlspecialchars($place['name_gu']) ?></h4>
                        <?php if ($place['deity_gu']): ?>
                        <div class="place-deity">
                            <i class="fa-solid fa-om"></i> <?= htmlspecialchars($place['deity_gu']) ?>
                        </div>
                        <?php endif; ?>
                        
                        <p class="place-desc"><?= htmlspecialchars($place['short_desc']) ?></p>

                        <div class="place-meta">
                            <div class="place-meta-item">
                                <i class="fa-regular fa-clock"></i>
                                <span><?= htmlspecialchars($place['timings']) ?></span>
                            </div>
                            <div class="place-meta-item">
                                <i class="fa-solid fa-ticket"></i>
                                <span>ટિકિટ: <?= htmlspecialchars($place['entry_fee']) ?></span>
                            </div>
                            <div class="place-meta-item">
                                <i class="fa-solid fa-location-arrow"></i>
                                <span>અંતર: <?= htmlspecialchars($place['distance_km']) ?></span>
                            </div>
                        </div>

                        <button class="btn-place-details" onclick='openPlaceModal(<?= json_encode($place, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE) ?>)'>
                            <i class="fa-solid fa-circle-info"></i> સંપૂર્ણ માહિતી જુઓ
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- 8. Section: દ્વારકા ફરવા માટેનું સમયપત્રક (Tour Timetable / Itinerary) -->
    <section class="section" id="itinerary">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">ટૂર પ્લાન & આઈટિનરરી</span>
                <h3 class="section-title">દ્વારકા ફરવા માટેનું સમયપત્રક (Time Table)</h3>
                <p class="section-subtitle">
                    તમારા પ્રવાસના દિવસો મુજબ સુવ્યવસ્થિત કલાક-દર-કલાકનો ટૂર પ્લાન જેથી તમારા સમય અને પૈસાની બચત થાય.
                </p>
            </div>

            <!-- Itinerary Switcher Tabs -->
            <div class="itinerary-tabs">
                <button class="itinerary-tab-btn active" data-plan="1">૧ દિવસીય એક્સપ્રેસ ટૂર (1 Day)</button>
                <button class="itinerary-tab-btn" data-plan="2">૨ દિવસીય શ્રેષ્ઠ પ્રવાસ (2 Days - ભલામણ કરેલ)</button>
                <button class="itinerary-tab-btn" data-plan="3">૩ દિવસીય આરામદાયક ટૂર (3 Days + બીચ)</button>
            </div>

            <!-- Plan 1 Day Box -->
            <div class="itinerary-schedule-box itinerary-plan-content" id="itinerary-plan-1">
                <div class="schedule-day-title">
                    <span>૧ દિવસીય સુપર એક્સપ્રેસ દર્શન પ્લાન</span>
                    <span style="font-size: 0.9rem; color: var(--primary-kesari);"><i class="fa-solid fa-bolt"></i> સમય બચત પ્લાન</span>
                </div>
                <div class="schedule-timeline">
                    <?php foreach ($itineraries_1 as $step): ?>
                    <div class="schedule-slot-card">
                        <span class="slot-time"><i class="fa-regular fa-clock"></i> <?= htmlspecialchars($step['time_slot']) ?></span>
                        <h4><?= htmlspecialchars($step['title_gu']) ?></h4>
                        <p><?= htmlspecialchars($step['description_gu']) ?></p>
                        <div class="spots-pill">
                            <i class="fa-solid fa-location-dot"></i> આવરી લીધેલ સ્થળો: <?= htmlspecialchars($step['spots_covered']) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="itinerary-footer-actions">
                    <button class="btn btn-outline" style="color: var(--dark-navy); border-color: #cbd5e1;" onclick="printItinerary()">
                        <i class="fa-solid fa-print"></i> સમયપત્રક પ્રિન્ટ / સેવ કરો
                    </button>
                </div>
            </div>

            <!-- Plan 2 Days Box -->
            <div class="itinerary-schedule-box itinerary-plan-content" id="itinerary-plan-2" style="display: none;">
                <div class="schedule-day-title">
                    <span>૨ દિવસીય સંપૂર્ણ દ્વારકા & બેટ દ્વારકા યાત્રા</span>
                    <span style="font-size: 0.9rem; color: #10b981;"><i class="fa-solid fa-star"></i> સૌથી લોકપ્રિય આઈટિનરરી</span>
                </div>
                <div class="schedule-timeline">
                    <?php foreach ($itineraries_2 as $step): ?>
                    <div class="schedule-slot-card">
                        <span class="slot-time"><i class="fa-regular fa-calendar-check"></i> <?= htmlspecialchars($step['time_slot']) ?></span>
                        <h4><?= htmlspecialchars($step['title_gu']) ?></h4>
                        <p><?= htmlspecialchars($step['description_gu']) ?></p>
                        <div class="spots-pill">
                            <i class="fa-solid fa-location-dot"></i> આવરી લીધેલ સ્થળો: <?= htmlspecialchars($step['spots_covered']) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="itinerary-footer-actions">
                    <button class="btn btn-outline" style="color: var(--dark-navy); border-color: #cbd5e1;" onclick="printItinerary()">
                        <i class="fa-solid fa-print"></i> સમયપત્રક પ્રિન્ટ / સેવ કરો
                    </button>
                </div>
            </div>

            <!-- Plan 3 Days Box -->
            <div class="itinerary-schedule-box itinerary-plan-content" id="itinerary-plan-3" style="display: none;">
                <div class="schedule-day-title">
                    <span>૩ દિવસીય આરામદાયક દર્શન & શિવરાજપુર બીચ ટૂર</span>
                    <span style="font-size: 0.9rem; color: var(--ocean-teal);"><i class="fa-solid fa-umbrella-beach"></i> ફેમિલી વેકેશન પ્લાન</span>
                </div>
                <div class="schedule-timeline">
                    <?php foreach ($itineraries_3 as $step): ?>
                    <div class="schedule-slot-card">
                        <span class="slot-time"><i class="fa-regular fa-calendar-check"></i> <?= htmlspecialchars($step['time_slot']) ?></span>
                        <h4><?= htmlspecialchars($step['title_gu']) ?></h4>
                        <p><?= htmlspecialchars($step['description_gu']) ?></p>
                        <div class="spots-pill">
                            <i class="fa-solid fa-location-dot"></i> આવરી લીધેલ સ્થળો: <?= htmlspecialchars($step['spots_covered']) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="itinerary-footer-actions">
                    <button class="btn btn-outline" style="color: var(--dark-navy); border-color: #cbd5e1;" onclick="printItinerary()">
                        <i class="fa-solid fa-print"></i> સમયપત્રક પ્રિન્ટ / સેવ કરો
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- 9. Section: બજેટ અને ખર્ચ (Budget, Normal Hotel & Gujarati Food) -->
    <section class="section alt-bg" id="budget">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">ખર્ચ અને બજેટ વિશ્લેષણ</span>
                <h3 class="section-title">દ્વારકા પ્રવાસનું બજેટ કેટલું થાય?</h3>
                <p class="section-subtitle">
                    સામાન્ય હોટેલ, ધર્મશાળા, નોર્મલ ગુજરાતી અને કાઠિયાવાડી ભોજન તથા લોકલ વાહન વ્યવહારના વાસ્તવિક દરો.
                </p>
            </div>

            <!-- 3 Category Overview Cards -->
            <?php
            $stay_min = !empty($rates_by_cat['stay']) ? min(array_column($rates_by_cat['stay'], 'approx_price')) : 500;
            $stay_max = !empty($rates_by_cat['stay']) ? max(array_column($rates_by_cat['stay'], 'approx_price')) : 2600;

            $food_min = !empty($rates_by_cat['food']) ? min(array_column($rates_by_cat['food'], 'approx_price')) : 70;
            $food_max = !empty($rates_by_cat['food']) ? max(array_column($rates_by_cat['food'], 'approx_price')) : 220;

            $trans_min = !empty($rates_by_cat['transport']) ? min(array_column($rates_by_cat['transport'], 'approx_price')) : 150;
            $trans_max = !empty($rates_by_cat['transport']) ? max(array_column($rates_by_cat['transport'], 'approx_price')) : 2200;
            ?>
            <div class="budget-overview-grid">
                <!-- Stay / Hotel Card -->
                <div class="budget-tier-card">
                    <span class="budget-tier-badge" style="background: #0284c7;">રોકાણ વિકલ્પો</span>
                    <h3>સામાન્ય હોટેલ / ધર્મશાળા</h3>
                    <div class="budget-tier-price">₹ <?= number_format($stay_min) ?> - <?= number_format($stay_max) ?></div>
                    <div class="budget-tier-unit">પ્રતિ રૂમ / રાત્રિ (૨-૩ વ્યક્તિ)</div>
                    <ul class="tier-list">
                        <?php if (!empty($rates_by_cat['stay'])): ?>
                            <?php foreach ($rates_by_cat['stay'] as $r): ?>
                            <li><i class="fa-solid fa-check"></i> <strong><?= htmlspecialchars($r['title_gu']) ?>:</strong> ₹<?= number_format($r['approx_price']) ?> <?= htmlspecialchars($r['unit_gu']) ?> (<?= htmlspecialchars($r['details_gu']) ?>).</li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><i class="fa-solid fa-check"></i> <strong>ધર્મશાળા / આશ્રમ:</strong> ₹૫૦૦ થી ₹૭૦૦</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Food / Thali Card -->
                <div class="budget-tier-card featured">
                    <span class="budget-tier-badge">સૌથી લોકપ્રિય</span>
                    <h3>નોર્મલ ગુજરાતી ભોજન</h3>
                    <div class="budget-tier-price">₹ <?= number_format($food_min) ?> - <?= number_format($food_max) ?></div>
                    <div class="budget-tier-unit">પ્રતિ થાળી (અમર્યાદિત ભોજન)</div>
                    <ul class="tier-list">
                        <?php if (!empty($rates_by_cat['food'])): ?>
                            <?php foreach ($rates_by_cat['food'] as $r): ?>
                            <li><i class="fa-solid fa-check"></i> <strong><?= htmlspecialchars($r['title_gu']) ?>:</strong> ₹<?= number_format($r['approx_price']) ?> <?= htmlspecialchars($r['unit_gu']) ?> (<?= htmlspecialchars($r['details_gu']) ?>).</li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><i class="fa-solid fa-check"></i> <strong>કાઠિયાવાડી / ગુજરાતી થાળી:</strong> ₹૧૩૦ પ્રતિ થાળી</li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Transport Card -->
                <div class="budget-tier-card">
                    <span class="budget-tier-badge" style="background: #10b981;">વાહન વ્યવહાર</span>
                    <h3>સ્થાનિક મુસાફરી ખર્ચ</h3>
                    <div class="budget-tier-price">₹ <?= number_format($trans_min) ?> - <?= number_format($trans_max) ?></div>
                    <div class="budget-tier-unit">બસ / ઓટો / ટેક્સી ભાડું</div>
                    <ul class="tier-list">
                        <?php if (!empty($rates_by_cat['transport'])): ?>
                            <?php foreach ($rates_by_cat['transport'] as $r): ?>
                            <li><i class="fa-solid fa-check"></i> <strong><?= htmlspecialchars($r['title_gu']) ?>:</strong> ₹<?= number_format($r['approx_price']) ?> <?= htmlspecialchars($r['unit_gu']) ?> (<?= htmlspecialchars($r['details_gu']) ?>).</li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li><i class="fa-solid fa-check"></i> <strong>પ્રાઇવેટ ઓટો રિક્ષા:</strong> ₹૮૦૦ પ્રતિ દિવસ</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- 10. Live Interactive Budget Calculator -->
            <div class="calculator-box" id="budget-calculator">
                <div class="calc-grid">
                    <!-- Calculator Inputs Form -->
                    <div class="calc-form">
                        <h3><i class="fa-solid fa-calculator" style="color: var(--primary-kesari);"></i> લાઈવ બજેટ કેલ્ક્યુલેટર</h3>
                        <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 24px;">
                            તમારા દિવસો અને વ્યક્તિઓની સંખ્યા પસંદ કરીને તમારા પ્રવાસનો અંદાજિત લાઈવ ખર્ચ ગણો.
                        </p>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 18px;">
                            <!-- Days Stepper -->
                            <div class="calc-form-group">
                                <label>દિવસોની સંખ્યા (Days):</label>
                                <div class="number-stepper">
                                    <button class="step-btn" id="btnDaysMinus" type="button">-</button>
                                    <span class="stepper-val" id="daysVal">2</span>
                                    <button class="step-btn" id="btnDaysPlus" type="button">+</button>
                                </div>
                            </div>

                            <!-- Persons Stepper -->
                            <div class="calc-form-group">
                                <label>વ્યક્તિઓની સંખ્યા (Persons):</label>
                                <div class="number-stepper">
                                    <button class="step-btn" id="btnPersonsMinus" type="button">-</button>
                                    <span class="stepper-val" id="personsVal">2</span>
                                    <button class="step-btn" id="btnPersonsPlus" type="button">+</button>
                                </div>
                            </div>
                        </div>

                        <!-- Stay Select -->
                        <div class="calc-form-group">
                            <label><i class="fa-solid fa-hotel" style="color: var(--primary-kesari);"></i> રોકાણ પ્રકાર (Stay Preference):</label>
                            <select class="calc-select" id="stayTier">
                                <option value="budget">સામાન્ય ધર્મશાળા / આશ્રમ (₹૫૦૦/રાત્રિ)</option>
                                <option value="normal" selected>નોર્મલ બજેટ હોટેલ (₹૧,૨૦૦/રાત્રિ)</option>
                                <option value="deluxe">પ્રીમિયમ હોટેલ / રિસોર્ટ (₹૨,૬૦૦/રાત્રિ)</option>
                            </select>
                        </div>

                        <!-- Food Select -->
                        <div class="calc-form-group">
                            <label><i class="fa-solid fa-utensils" style="color: var(--primary-kesari);"></i> ભોજન પ્રકાર (Food Preference):</label>
                            <select class="calc-select" id="foodTier">
                                <option value="budget">અન્નક્ષેત્ર / સાદું સાત્વિક ભોજન (₹૭૦/થાળી)</option>
                                <option value="normal" selected>નોર્મલ કાઠિયાવાડી / ગુજરાતી અનલિમિટેડ થાળી (₹૧૩૦/થાળી)</option>
                                <option value="deluxe">સ્પેશિયલ કાઠિયાવાડી + સ્વીટ / મિઠાઈ (₹૨૨૦/થાળી)</option>
                            </select>
                        </div>

                        <!-- Transport Select -->
                        <div class="calc-form-group" style="margin-bottom: 0;">
                            <label><i class="fa-solid fa-car" style="color: var(--primary-kesari);"></i> મુસાફરી વાહન (Travel Preference):</label>
                            <select class="calc-select" id="transportTier">
                                <option value="budget">લોકલ GSRTC બસ / શેરિંગ છકડો (₹૧૫૦/દિવસ/વ્યક્તિ)</option>
                                <option value="normal" selected>પ્રાઇવેટ ઓટો રિક્ષા (₹૮૦૦/દિવસ)</option>
                                <option value="deluxe">પ્રાઇવેટ AC ટેક્સી / કાર (₹૨,૨૦૦/દિવસ)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Calculator Output Panel -->
                    <div class="calc-result-panel">
                        <div>
                            <h4><i class="fa-solid fa-receipt"></i> અંદાજિત ખર્ચનું વિભાજન</h4>
                            <div class="breakdown-list">
                                <div class="breakdown-row">
                                    <span>હોટેલ / ધર્મશાળા ખર્ચ:</span>
                                    <span id="calcStayCost">₹ ૧,૨૦૦</span>
                                </div>
                                <div class="breakdown-row">
                                    <span>જમવાનો ખર્ચ (૨ ટંક + નાસ્તો):</span>
                                    <span id="calcFoodCost">₹ ૧,૨૦૦</span>
                                </div>
                                <div class="breakdown-row">
                                    <span>સ્થાનિક ફરવાનો વાહન ખર્ચ:</span>
                                    <span id="calcTransCost">₹ ૧,૬૦૦</span>
                                </div>
                                <div class="breakdown-row">
                                    <span>પૂજા, પ્રસાદ, એન્ટ્રી ફી & પરચૂરણ:</span>
                                    <span id="calcMiscCost">₹ ૬૦૦</span>
                                </div>
                            </div>
                        </div>

                        <div class="total-budget-box">
                            <div class="label">કુલ અંદાજિત બજેટ (Total Budget)</div>
                            <div class="grand-price" id="calcGrandTotal">₹ ૪,૬૦૦</div>
                            <div class="per-person" id="calcPerPerson">પ્રતિ વ્યક્તિ અંદાજિત ખર્ચ: ₹ ૨,૩૦૦</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 11. Section: કેવી રીતે પહોંચવું (How to Reach & Best Time) -->
    <section class="section" id="reach">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">યાત્રા માર્ગદર્શન</span>
                <h3 class="section-title">દ્વારકા કેવી રીતે પહોંચવું? (How to Reach)</h3>
                <p class="section-subtitle">
                    દ્વારકા રેલવે, હવાઈ અને સડક માર્ગે સમગ્ર ગુજરાત અને દેશના મુખ્ય શહેરો સાથે સુગમ રીતે જોડાયેલું છે.
                </p>
            </div>

            <div class="reach-grid">
                <div class="reach-card">
                    <div class="reach-icon">
                        <i class="fa-solid fa-train"></i>
                    </div>
                    <h4>રેલવે માર્ગ (By Train)</h4>
                    <p>
                        <strong>દ્વારકા રેલવે સ્ટેશન (DWK)</strong> મંદિરથી માત્ર ૨.૫ કિ.મી. દૂર છે. અમદાવાદ, રાજકોટ, સુરત, 
                        મુંબઈ, દિલ્હી, વારાણસી અને પુણેથી સીધી એક્સપ્રેસ અને સુપરફાસ્ટ ટ્રેનો ઉપલબ્ધ છે. સ્ટેશન બહારથી સતત રિક્ષાઓ મળે છે.
                    </p>
                </div>

                <div class="reach-card">
                    <div class="reach-icon">
                        <i class="fa-solid fa-plane-departure"></i>
                    </div>
                    <h4>હવાઈ માર્ગ (By Air)</h4>
                    <p>
                        સૌથી નજીકનું ડોમેસ્ટિક એરપોર્ટ <strong>જામનગર (Jamnagar - ૧૩૫ કિ.મી.)</strong> અને <strong>પોરબંદર (૧૦૦ કિ.મી.)</strong> છે. 
                        મોટા આંતરરાષ્ટ્રીય જોડાણ માટે <strong>રાજકોટ ઇન્ટરનેશનલ એરપોર્ટ (Hirasar - ૨૩૦ કિ.મી.)</strong> શ્રેષ્ઠ વિકલ્પ છે.
                    </p>
                </div>

                <div class="reach-card">
                    <div class="reach-icon">
                        <i class="fa-solid fa-bus"></i>
                    </div>
                    <h4>સડક માર્ગ (By Road)</h4>
                    <p>
                        ગુજરાત રાજ્ય પરિવહન (GSRTC) ની વોલ્વો, સ્લીપર અને એક્સપ્રેસ બસો અમદાવાદ, રાજકોટ, જામનગર, સોમનાથ, 
                        જૂનાગઢથી સીધી દ્વારકા આવે છે. ફોર-લેન હાઇવે હોવાથી પોતાની કાર દ્વારા મુસાફરી પણ ખૂબ આરામદાયક છે.
                    </p>
                </div>
            </div>

            <!-- Best Season Advice Banner -->
            <div style="background: #fff; border-radius: var(--radius-md); padding: 24px 30px; margin-top: 35px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
                <div>
                    <h4 style="font-size: 1.15rem; color: var(--dark-navy); margin-bottom: 6px;">
                        <i class="fa-solid fa-cloud-sun" style="color: var(--primary-kesari);"></i> દ્વારકા મુલાકાત માટે શ્રેષ્ઠ સમય:
                    </h4>
                    <p style="font-size: 0.92rem; color: var(--text-muted); margin: 0;">
                        <strong><?= htmlspecialchars($site_settings['best_season_title'] ?? 'ઓક્ટોબર થી માર્ચ:') ?></strong> <?= htmlspecialchars($site_settings['best_season_desc'] ?? 'આહલાદક શિયાળાની ઋતુ. ઉપરાંત જન્માષ્ટમી (શ્રાવણ વદ આઠમ) નો મહોત્સવ દ્વારકામાં અતિ ભવ્યતાથી ઉજવાય છે.') ?>
                    </p>
                </div>
                <div style="font-size: 1.6rem; color: var(--primary-kesari);">
                    <i class="fa-solid fa-temperature-half"></i> <span id="bestSeasonTemp"><?= htmlspecialchars($site_settings['best_season_temp'] ?? '૨૦°C - ૨૮°C') ?></span>
                </div>
            </div>
        </div>
    </section>

    <!-- 12. Section: યાત્રી પ્રતિભાવ અને પૂછપરછ (Reviews & Inquiries) -->
    <section class="section alt-bg" id="feedback">
        <div class="container">
            <div class="section-header">
                <span class="badge-tag">સંપર્ક & પ્રતિભાવ</span>
                <h3 class="section-title">યાત્રી પ્રતિભાવ અને પૂછપરછ</h3>
                <p class="section-subtitle">
                    તમારો દ્વારકા યાત્રાનો અનુભવ શેર કરો અથવા કોઈ પ્રશ્ન હોય તો પૂછો (ડેટાબેઝમાં સેવ થાય છે).
                </p>
            </div>

            <div class="feedback-container">
                <!-- Submit Form -->
                <div class="feedback-form-box">
                    <h3>તમારો પ્રતિભાવ અથવા પ્રશ્ન લખો</h3>
                    <form id="reviewForm">
                        <div class="form-group">
                            <label for="userName">તમારું પૂરું નામ *</label>
                            <input type="text" id="userName" class="form-control" placeholder="દા.ત. રમેશભાઈ પટેલ" required>
                        </div>

                        <div class="form-group">
                            <label for="userCity">તમારું શહેર / ગામ</label>
                            <input type="text" id="userCity" class="form-control" placeholder="દા.ત. અમદાવાદ, સુરત, રાજકોટ...">
                        </div>

                        <div class="form-group">
                            <label>રેટિંગ (તમારો અનુભવ):</label>
                            <div class="star-rating-select" id="starRatingSelect">
                                <span class="star selected" data-val="1">★</span>
                                <span class="star selected" data-val="2">★</span>
                                <span class="star selected" data-val="3">★</span>
                                <span class="star selected" data-val="4">★</span>
                                <span class="star selected" data-val="5">★</span>
                            </div>
                            <input type="hidden" id="ratingInput" value="5">
                        </div>

                        <div class="form-group">
                            <label for="userComment">તમારો પ્રતિભાવ અથવા પ્રશ્ન *</label>
                            <textarea id="userComment" class="form-control" rows="4" placeholder="દ્વારકા યાત્રા અંગે તમારો અનુભવ અથવા કોઈ સલાહ-સૂચન..." required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            <i class="fa-solid fa-paper-plane"></i> પ્રતિભાવ સબમિટ કરો
                        </button>

                        <div id="formMsg"></div>
                    </form>
                </div>

                <!-- Existing Reviews List (From MySQL) -->
                <div>
                    <h3 style="font-size: 1.4rem; color: var(--dark-navy); margin-bottom: 20px;">
                        <i class="fa-solid fa-comments" style="color: var(--primary-kesari);"></i> તાજેતરના યાત્રી પ્રતિભાવો
                    </h3>

                    <div class="reviews-list" id="reviewsList">
                        <?php foreach ($reviews as $rev): ?>
                        <div class="review-item">
                            <div class="review-header">
                                <div>
                                    <span class="reviewer-name"><?= htmlspecialchars($rev['user_name']) ?></span>
                                    <span class="reviewer-city"> (<?= htmlspecialchars($rev['user_city'] ?: 'યાત્રાળુ') ?>)</span>
                                </div>
                                <div class="review-stars">
                                    <?= str_repeat('★', (int)$rev['rating']) ?><?= str_repeat('☆', 5 - (int)$rev['rating']) ?>
                                </div>
                            </div>
                            <p class="review-text"><?= htmlspecialchars($rev['user_comment']) ?></p>
                            <small style="color: #94a3b8; font-size: 0.78rem;">
                                <?= date('d M, Y', strtotime($rev['created_at'])) ?>
                            </small>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 13. Place Details Modal Dialog -->
    <div class="modal" id="placeModal" onclick="if(event.target === this) closePlaceModal()">
        <div class="modal-content">
            <button class="modal-close" onclick="closePlaceModal()" aria-label="Close modal">&times;</button>
            <div style="height: 240px; border-radius: var(--radius-sm); overflow: hidden; margin-bottom: 18px; background: #0f2b48;">
                <img id="modalImg" src="" alt="" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <h3 id="modalTitle" style="font-size: 1.5rem; color: var(--dark-navy); margin-bottom: 4px;"></h3>
            <div id="modalEnglishTitle" style="font-size: 0.9rem; color: #64748b; margin-bottom: 8px;"></div>
            <div id="modalDeity" style="color: var(--primary-kesari); font-weight: 600; margin-bottom: 14px;"></div>
            
            <div style="background: #f8fafc; border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 12px; display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 16px; font-size: 0.88rem;">
                <div><strong><i class="fa-regular fa-clock"></i> સમય:</strong> <span id="modalTiming"></span></div>
                <div><strong><i class="fa-solid fa-ticket"></i> ટિકિટ:</strong> <span id="modalEntry"></span></div>
                <div><strong><i class="fa-solid fa-location-arrow"></i> અંતર:</strong> <span id="modalDistance"></span></div>
            </div>

            <h4 style="font-size: 1.05rem; color: var(--dark-navy); margin-bottom: 6px;">વિગતવાર વર્ણન:</h4>
            <p id="modalDesc" style="color: #475569; font-size: 0.95rem; line-height: 1.7; margin-bottom: 14px;"></p>

            <h4 style="font-size: 1.05rem; color: var(--dark-navy); margin-bottom: 6px;">મુખ્ય આકર્ષણો:</h4>
            <div id="modalHighlights" style="color: #0284c7; font-weight: 500; font-size: 0.92rem;"></div>
        </div>
    </div>

    <!-- 14. Floating Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fa-solid fa-arrow-up"></i>
    </button>

    <!-- 15. Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <div class="footer-brand">
                    <h2>શ્રી દ્વારકા દર્શન</h2>
                    <p>
                        <?= nl2br(htmlspecialchars($site_settings['footer_about'] ?? 'પવિત્ર દ્વારકાધામ અંગે શ્રદ્ધાળુઓ અને પ્રવાસીઓને સાચી, સચોટ અને ઉપયોગી માહિતી આપતું અધિકૃત પોર્ટલ. જગત મંદિર દર્શન, સમયપત્રક અને બજેટનું વિશ્વસનીય માર્ગદર્શન.')) ?>
                    </p>
                    <div class="footer-shloka">
                        <?= nl2br(htmlspecialchars($site_settings['footer_shloka'] ?? "કૃષ્ણાય વાસુદેવાય હરયે પરમાત્મને ।\nપ્રણત ક્લેશનાશાય ગોવિંદાય નમો નમઃ ॥")) ?>
                    </div>
                </div>

                <div>
                    <h4 class="footer-title">મુખ્ય વિભાગો</h4>
                    <ul class="footer-links">
                        <li><a href="#about"><i class="fa-solid fa-angle-right"></i> દ્વારકા શું છે?</a></li>
                        <li><a href="#temple"><i class="fa-solid fa-angle-right"></i> જગત મંદિર & દર્શન</a></li>
                        <li><a href="#history"><i class="fa-solid fa-angle-right"></i> દ્વારકાનો ઇતિહાસ</a></li>
                        <li><a href="#places"><i class="fa-solid fa-angle-right"></i> જોવાલાયક સ્થળો</a></li>
                        <li><a href="#itinerary"><i class="fa-solid fa-angle-right"></i> સમયપત્રક (Itinerary)</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">બજેટ & મુસાફરી</h4>
                    <ul class="footer-links">
                        <li><a href="#budget"><i class="fa-solid fa-angle-right"></i> સામાન્ય હોટેલ દરો</a></li>
                        <li><a href="#budget"><i class="fa-solid fa-angle-right"></i> કાઠિયાવાડી ભોજન</a></li>
                        <li><a href="#budget-calculator"><i class="fa-solid fa-angle-right"></i> લાઈવ બજેટ કેલ્ક્યુલેટર</a></li>
                        <li><a href="#reach"><i class="fa-solid fa-angle-right"></i> કેવી રીતે પહોંચવું</a></li>
                        <li><a href="#feedback"><i class="fa-solid fa-angle-right"></i> યાત્રી પ્રતિભાવ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="footer-title">મહત્વના સ્થળો</h4>
                    <ul class="footer-links">
                        <li><a href="#places"><i class="fa-solid fa-angle-right"></i> બેટ દ્વારકા (સુદર્શન સેતુ)</a></li>
                        <li><a href="#places"><i class="fa-solid fa-angle-right"></i> નાગેશ્વર જ્યોતિર્લિંગ</a></li>
                        <li><a href="#places"><i class="fa-solid fa-angle-right"></i> શિવરાજપુર બ્લુ ફ્લેગ બીચ</a></li>
                        <li><a href="#places"><i class="fa-solid fa-angle-right"></i> ભડકેશ્વર મહાદેવ</a></li>
                        <li><a href="#places"><i class="fa-solid fa-angle-right"></i> ગોમતી ઘાટ & સુદામા સેતુ</a></li>
                    </ul>
                </div>
            </div>

            <div class="footer-bottom" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px;">
                <p>© <?= date('Y') ?> પવિત્ર દ્વારકા યાત્રા માર્ગદર્શિકા (About Dwarka Guide). સર્વ હક સુરક્ષિત. જય શ્રી દ્વારકાધીશ!</p>
                <div>
                    <a href="admin/index.php" style="color: #cbd5e1; font-size: 0.85rem; text-decoration: none; opacity: 0.85;">
                        <i class="fa-solid fa-lock"></i> એડમિન પેનલ (Admin Login)
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Mobile Bottom Navigation Bar (m1.jpg Style) -->
    <nav class="mobile-bottom-nav" id="mobileBottomNav" aria-label="Mobile Navigation">
        <a href="#top" class="bottom-nav-item active" data-target="top">
            <div class="nav-icon-wrap">
                <i class="fa-solid fa-house"></i>
            </div>
            <span class="nav-label">હોમ</span>
        </a>
        <a href="#aarti-schedule" class="bottom-nav-item" data-target="aarti-schedule">
            <div class="nav-icon-wrap">
                <i class="fa-solid fa-bell"></i>
            </div>
            <span class="nav-label">દર્શન-આરતી</span>
        </a>
        <a href="#places" class="bottom-nav-item" data-target="places">
            <div class="nav-icon-wrap">
                <i class="fa-solid fa-map-location-dot"></i>
            </div>
            <span class="nav-label">સ્થળો</span>
        </a>
        <a href="#itinerary" class="bottom-nav-item" data-target="itinerary">
            <div class="nav-icon-wrap">
                <i class="fa-solid fa-route"></i>
            </div>
            <span class="nav-label">ટૂર પ્લાન</span>
        </a>
        <a href="#budget-calculator" class="bottom-nav-item" data-target="budget-calculator">
            <div class="nav-icon-wrap">
                <i class="fa-solid fa-calculator"></i>
            </div>
            <span class="nav-label">બજેટ</span>
        </a>
    </nav>

    <!-- PWA Toast Notification -->
    <div id="pwaToast" class="pwa-toast" role="alert" aria-live="polite"></div>

    <!-- Scripts -->
    <script src="js/lang.js?v=<?= filemtime(__DIR__ . '/js/lang.js') ?>"></script>
    <script src="js/main.js?v=<?= filemtime(__DIR__ . '/js/main.js') ?>"></script>
</body>
</html>
