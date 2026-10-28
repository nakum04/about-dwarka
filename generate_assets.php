<?php
/**
 * Script to generate high quality visual SVG artworks for Dwarka places
 */

$assets = [
    'hero_dwarka.svg' => [
        'title' => 'શ્રી દ્વારકાધીશ જગત મંદિર',
        'sub' => 'મોક્ષપુરી દ્વારિકા - ચાર ધામ પૈકીનું પશ્ચિમ ધામ',
        'theme' => 'temple',
        'bg1' => '#0c2461',
        'bg2' => '#1e3799',
        'accent' => '#f6b93b',
        'icon' => 'dwarkadhish'
    ],
    'dwarkadhish.svg' => [
        'title' => 'શ્રી દ્વારકાધીશ જગત મંદિર',
        'sub' => '૫૨ ગજની ધજા અને ૭૨ સ્તંભોનું સ્થાપત્ય',
        'theme' => 'temple',
        'bg1' => '#b71540',
        'bg2' => '#e55039',
        'accent' => '#f6b93b',
        'icon' => 'flag'
    ],
    'gomti_ghat.svg' => [
        'title' => 'પવિત્ર ગોમતી ઘાટ & સંગમ',
        'sub' => 'અરબી સાગર અને ગોમતી નદીનો સંગમ ઘાટ',
        'theme' => 'water',
        'bg1' => '#079992',
        'bg2' => '#38ada9',
        'accent' => '#f8c291',
        'icon' => 'ghat'
    ],
    'sudama_setu.svg' => [
        'title' => 'સુદામા સેતુ (સસ્પેન્શન બ્રિજ)',
        'sub' => 'શ્રીકૃષ્ણ-સુદામા મૈત્રી સ્મારક કેબલ બ્રિજ',
        'theme' => 'bridge',
        'bg1' => '#1e272e',
        'bg2' => '#485460',
        'accent' => '#ffa801',
        'icon' => 'bridge'
    ],
    'bhadkeshwar.svg' => [
        'title' => 'ભડકેશ્વર મહાદેવ મંદિર',
        'sub' => 'અરબી સમુદ્ર વચ્ચે ટેકરી પર સ્થિત શિવ મંદિર',
        'theme' => 'shiva',
        'bg1' => '#4a154b',
        'bg2' => '#6b116b',
        'accent' => '#ffdd59',
        'icon' => 'trishul'
    ],
    'lighthouse.svg' => [
        'title' => 'દ્વારકા બીચ & દીવાદાંડી',
        'sub' => '૪૩ મીટર ઊંચી ઐતિહાસિક દીવાદાંડી & સાગર દર્શન',
        'theme' => 'beach',
        'bg1' => '#0a3d62',
        'bg2' => '#3c6382',
        'accent' => '#ffc048',
        'icon' => 'light'
    ],
    'gita_mandir.svg' => [
        'title' => 'ગીતા મંદિર & શારદા પીઠ',
        'sub' => 'આરસપહાણ પર ૭૦૦ શ્લોક & આદિ શંકરાચાર્ય મઠ',
        'theme' => 'temple',
        'bg1' => '#d35400',
        'bg2' => '#e67e22',
        'accent' => '#f1c40f',
        'icon' => 'book'
    ],
    'beyt_dwarka.svg' => [
        'title' => 'બેટ દ્વારકા & સુદર્શન સેતુ',
        'sub' => 'શ્રીકૃષ્ણનું પ્રાચીન રહેઠાણ અને સુદર્શન સેતુ બ્રિજ',
        'theme' => 'island',
        'bg1' => '#1b1464',
        'bg2' => '#0652DD',
        'accent' => '#FFC312',
        'icon' => 'krishna'
    ],
    'nageshwar.svg' => [
        'title' => 'શ્રી નાગેશ્વર જ્યોતિર્લિંગ',
        'sub' => '૧૨ જ્યોતિર્લિંગ પૈકીનું દારૂકાવન તીર્થ & ૮૨ ફૂટ શિવ પ્રતિમા',
        'theme' => 'shiva',
        'bg1' => '#2c2c54',
        'bg2' => '#474787',
        'accent' => '#34ace0',
        'icon' => 'om'
    ],
    'shivrajpur.svg' => [
        'title' => 'શિવરાજપુર બ્લુ ફ્લેગ બીચ',
        'sub' => 'આંતરરાષ્ટ્રીય બ્લુ ફ્લેગ બીચ & સ્કૂબા ડાઇવિંગ',
        'theme' => 'beach',
        'bg1' => '#006266',
        'bg2' => '#1289A7',
        'accent' => '#A3CB38',
        'icon' => 'wave'
    ],
    'rukmini_temple.svg' => [
        'title' => 'શ્રી રુક્ષ્મણી દેવી મંદિર',
        'sub' => '૧૨મી સદીનું બેજોડ શિલ્પકળા યુક્ત પ્રાચીન મંદિર',
        'theme' => 'temple',
        'bg1' => '#833471',
        'bg2' => '#B53471',
        'accent' => '#FDA7DF',
        'icon' => 'lotus'
    ],
    'gopi_talav.svg' => [
        'title' => 'પવિત્ર ગોપી તળાવ',
        'sub' => 'શ્રીકૃષ્ણ રાસલીલા સ્થળ અને પવિત્ર ગોપી ચંદન',
        'theme' => 'lake',
        'bg1' => '#3B3B98',
        'bg2' => '#5856d6',
        'accent' => '#EAB543',
        'icon' => 'chandan'
    ]
];

foreach ($assets as $filename => $item) {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 500" width="100%" height="100%">
    <defs>
        <linearGradient id="grad_' . md5($filename) . '" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="' . $item['bg1'] . '"/>
            <stop offset="100%" stop-color="' . $item['bg2'] . '"/>
        </linearGradient>
        <linearGradient id="gold" x1="0%" y1="0%" x2="100%" y2="100%">
            <stop offset="0%" stop-color="#ffeaa7"/>
            <stop offset="50%" stop-color="#fdcb6e"/>
            <stop offset="100%" stop-color="#e17055"/>
        </linearGradient>
        <filter id="shadow" x="-10%" y="-10%" width="120%" height="120%">
            <feDropShadow dx="0" dy="4" stdDeviation="8" flood-opacity="0.4"/>
        </filter>
    </defs>
    <!-- Background -->
    <rect width="800" height="500" fill="url(#grad_' . md5($filename) . ')"/>
    
    <!-- Decorative Stars/Aura -->
    <circle cx="400" cy="220" r="160" fill="' . $item['accent'] . '" opacity="0.12"/>
    <circle cx="400" cy="220" r="220" fill="' . $item['accent'] . '" opacity="0.06"/>
    
    <!-- Stylized Architectural Artwork -->
    <g transform="translate(400, 210)" text-anchor="middle">
        <!-- Mandir / Shikhara silhouette -->
        <path d="M-80,90 L-80,40 L-40,-30 L0,-110 L40,-30 L80,40 L80,90 Z" fill="' . $item['accent'] . '" opacity="0.85" filter="url(#shadow)"/>
        <!-- Amalaka and Kalash -->
        <circle cx="0" cy="-115" r="12" fill="#fff" opacity="0.95"/>
        <!-- 52 Gaj Dhwaja (Flag) -->
        <path d="M0,-125 L0,-165 L45,-145 L0,-135" fill="#ff7675" stroke="#ffeaa7" stroke-width="2"/>
        <!-- Inner Sanctum Door -->
        <path d="M-25,90 L-25,50 Q0,30 25,50 L25,90 Z" fill="#2d3436" opacity="0.5"/>
        <!-- Side mini Shikharas -->
        <path d="M-130,90 L-130,60 L-100,10 L-80,50 L-80,90 Z" fill="' . $item['accent'] . '" opacity="0.6"/>
        <path d="M80,90 L80,50 L100,10 L130,60 L130,90 Z" fill="' . $item['accent'] . '" opacity="0.6"/>
        <!-- Base steps -->
        <rect x="-180" y="90" width="360" height="15" rx="4" fill="#dfe6e9" opacity="0.9"/>
        <rect x="-210" y="105" width="420" height="12" rx="3" fill="#b2bec3" opacity="0.8"/>
    </g>

    <!-- Water Ripples / Base Landscape -->
    <path d="M0,380 Q200,350 400,380 T800,380 L800,500 L0,500 Z" fill="#000" opacity="0.35"/>
    <path d="M0,400 Q200,370 400,400 T800,400 L800,500 L0,500 Z" fill="#000" opacity="0.4"/>

    <!-- Gujarati Title & Tagline Card -->
    <rect x="50" y="380" width="700" height="95" rx="12" fill="#0b1b36" opacity="0.9" stroke="' . $item['accent'] . '" stroke-width="1.5" filter="url(#shadow)"/>
    
    <text x="400" y="420" font-family="\'Noto Sans Gujarati\', \'Segoe UI\', sans-serif" font-size="24" font-weight="bold" fill="#ffffff" text-anchor="middle">
        ' . htmlspecialchars($item['title']) . '
    </text>
    <text x="400" y="452" font-family="\'Noto Sans Gujarati\', \'Segoe UI\', sans-serif" font-size="14" fill="' . $item['accent'] . '" text-anchor="middle">
        ' . htmlspecialchars($item['sub']) . '
    </text>
    
    <!-- Top badge -->
    <rect x="290" y="25" width="220" height="32" rx="16" fill="' . $item['accent'] . '" opacity="0.95"/>
    <text x="400" y="46" font-family="\'Noto Sans Gujarati\', \'Segoe UI\', sans-serif" font-size="14" font-weight="bold" fill="#0b1b36" text-anchor="middle">
        જય શ્રી દ્વારકાધીશ
    </text>
</svg>';

    file_put_contents(__DIR__ . '/images/' . $filename, $svg);
    // Also save .jpg reference fallback copy
    $jpg_alias = str_replace('.svg', '.jpg', $filename);
    file_put_contents(__DIR__ . '/images/' . $jpg_alias, $svg);
}

echo "Created " . count($assets) . " images successfully!\n";
