<?php
/**
 * Generic Secure Delete Handler
 */
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/../db.php';

$type = $_GET['type'] ?? '';
$id = (int)($_GET['id'] ?? 0);
$token = $_GET['token'] ?? '';

if (!verify_csrf_token($token)) {
    set_flash('danger', 'સુરક્ષા ટોકન અમાન્ય છે (Invalid Security Token).');
    header('Location: index.php');
    exit;
}

if ($id <= 0) {
    set_flash('danger', 'અમાન્ય ID.');
    header('Location: index.php');
    exit;
}

$valid_types = [
    'place' => ['table' => 'places', 'redirect' => 'places.php', 'label' => 'સ્થળ'],
    'aarti' => ['table' => 'aarti_timings', 'redirect' => 'aarti.php', 'label' => 'આરતી સમય'],
    'itinerary' => ['table' => 'itineraries', 'redirect' => 'itineraries.php', 'label' => 'સમયપત્રક સ્લોટ'],
    'history' => ['table' => 'history_timeline', 'redirect' => 'history.php', 'label' => 'ઇતિહાસ પ્રસંગ'],
    'review' => ['table' => 'reviews', 'redirect' => 'reviews.php', 'label' => 'પ્રતિભાવ'],
    'budget' => ['table' => 'budget_rates', 'redirect' => 'budget.php', 'label' => 'બજેટ દર'],
];

if (!isset($valid_types[$type])) {
    set_flash('danger', 'અમાન્ય રિક્વેસ્ટ પ્રકાર.');
    header('Location: index.php');
    exit;
}

$config = $valid_types[$type];

try {
    $stmt = $pdo->prepare("DELETE FROM `{$config['table']}` WHERE id = ?");
    $stmt->execute([$id]);
    set_flash('success', "સફળતા: {$config['label']} સફળતાપૂર્વક કાઢી નાખવામાં આવ્યું છે!");
} catch (PDOException $e) {
    set_flash('danger', 'ડેટાબેઝ ભૂલ: ' . $e->getMessage());
}

header("Location: {$config['redirect']}");
exit;
