<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../db.php';

// Accept GET or POST
$days = max(1, min(10, (int)($_REQUEST['days'] ?? 2)));
$persons = max(1, min(30, (int)($_REQUEST['persons'] ?? 2)));
$stay_tier = $_REQUEST['stay_tier'] ?? 'normal'; // budget, normal, deluxe
$food_tier = $_REQUEST['food_tier'] ?? 'normal'; // budget, normal, deluxe
$transport_tier = $_REQUEST['transport_tier'] ?? 'normal'; // budget, normal, deluxe

// Rates definitions with fallback defaults
$stay_rates = [
    'budget' => ['rate' => 500, 'label' => 'સામાન્ય ધર્મશાળા / આશ્રમ'],
    'normal' => ['rate' => 1200, 'label' => 'નોર્મલ બજેટ હોટેલ (AC/Non-AC)'],
    'deluxe' => ['rate' => 2600, 'label' => 'પ્રીમિયમ / ૩-સ્ટાર હોટેલ']
];

$food_rates = [
    'budget' => ['rate' => 70, 'label' => 'અન્નક્ષેત્ર / સાદું સાત્વિક ભોજન (૨ ટંક)'],
    'normal' => ['rate' => 130, 'label' => 'નોર્મલ ગુજરાતી / કાઠિયાવાડી થાળી (૨ ટંક + નાસ્તો)'],
    'deluxe' => ['rate' => 220, 'label' => 'સ્પેશિયલ કાઠિયાવાડી થાળી + સ્વીટ / રેસ્ટોરન્ટ']
];

$transport_rates = [
    'budget' => ['rate' => 150, 'label' => 'લોકલ બસ / શેરિંગ છકડો રિક્ષા', 'per_person' => true],
    'normal' => ['rate' => 800, 'label' => 'પ્રાઇવેટ ઓટો રિક્ષા (આખો દિવસ)', 'per_person' => false],
    'deluxe' => ['rate' => 2200, 'label' => 'પ્રાઇવેટ AC ટેક્સી / કાર (આખો દિવસ)', 'per_person' => false]
];

// Fetch dynamic rates from database
try {
    $db_rates = $pdo->query("SELECT category, tier, approx_price, title_gu FROM budget_rates")->fetchAll();
    foreach ($db_rates as $dr) {
        $c = $dr['category'];
        $t = $dr['tier'];
        if ($c === 'stay' && isset($stay_rates[$t])) {
            $stay_rates[$t]['rate'] = (int)$dr['approx_price'];
            $stay_rates[$t]['label'] = $dr['title_gu'];
        } elseif ($c === 'food' && isset($food_rates[$t])) {
            $food_rates[$t]['rate'] = (int)$dr['approx_price'];
            $food_rates[$t]['label'] = $dr['title_gu'];
        } elseif ($c === 'transport' && isset($transport_rates[$t])) {
            $transport_rates[$t]['rate'] = (int)$dr['approx_price'];
            $transport_rates[$t]['label'] = $dr['title_gu'];
        }
    }
} catch (Exception $e) {
    // Graceful fallback to default arrays
}

$stay_info = $stay_rates[$stay_tier] ?? $stay_rates['normal'];
$food_info = $food_rates[$food_tier] ?? $food_rates['normal'];
$transport_info = $transport_rates[$transport_tier] ?? $transport_rates['normal'];

// Stay calculation: assume 2 persons per room (rounded up)
$rooms_needed = ceil($persons / 2);
$nights = max(1, $days - 1); // 2 days trip = 1 night stay, 1 day = 0 nights if day trip, or 1 night
if ($days === 1) {
    // day visitor might need a day room / freshen up or 1 night
    $stay_cost = (int)($rooms_needed * ($stay_info['rate'] * 0.6));
} else {
    $stay_cost = (int)($rooms_needed * $stay_info['rate'] * $nights);
}

// Food calculation: 2 main meals per person per day + morning tea/farsan (approx 40 INR)
$meal_cost_per_day = ($food_info['rate'] * 2) + 40;
$total_food_cost = (int)($meal_cost_per_day * $persons * $days);

// Transport calculation:
if (!empty($transport_info['per_person'])) {
    $total_transport_cost = (int)($transport_info['rate'] * $persons * $days);
} else {
    // vehicle needed: 1 auto fits 3-4 persons, 1 car fits 4-5 persons
    $vehicle_capacity = ($transport_tier === 'normal') ? 4 : 5;
    $vehicles_needed = ceil($persons / $vehicle_capacity);
    $total_transport_cost = (int)($vehicles_needed * $transport_info['rate'] * $days);
}

// Miscellaneous (Sudama Setu entry, water, prasad, puja): approx 150 INR per person per day
$misc_cost = (int)(150 * $persons * $days);

$grand_total = $stay_cost + $total_food_cost + $total_transport_cost + $misc_cost;
$per_person_total = (int)round($grand_total / $persons);

echo json_encode([
    'success' => true,
    'days' => $days,
    'persons' => $persons,
    'breakdown' => [
        'stay' => [
            'label' => $stay_info['label'],
            'cost' => $stay_cost,
            'rooms' => $rooms_needed,
            'nights' => $nights
        ],
        'food' => [
            'label' => $food_info['label'],
            'cost' => $total_food_cost,
            'daily_per_person' => $meal_cost_per_day
        ],
        'transport' => [
            'label' => $transport_info['label'],
            'cost' => $total_transport_cost
        ],
        'misc' => [
            'label' => 'પૂજા, પ્રસાદ, એન્ટ્રી ફી અને પરચૂરણ ખર્ચ',
            'cost' => $misc_cost
        ]
    ],
    'grand_total' => $grand_total,
    'per_person_total' => $per_person_total
]);
