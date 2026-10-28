<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../db.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Read input either from json or form post
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) {
        $input = $_POST;
    }

    $name = trim($input['user_name'] ?? '');
    $city = trim($input['user_city'] ?? '');
    $rating = (int)($input['rating'] ?? 5);
    $comment = trim($input['user_comment'] ?? '');

    if (empty($name) || empty($comment)) {
        echo json_encode([
            'success' => false,
            'message' => 'કૃપા કરીને તમારું નામ અને પ્રતિભાવ / પ્રશ્ન અવશ્ય લખો.'
        ]);
        exit;
    }

    if ($rating < 1 || $rating > 5) {
        $rating = 5;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO reviews (user_name, user_city, rating, user_comment) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $city ?: 'યાત્રાળુ', $rating, $comment]);
        $new_id = $pdo->lastInsertId();

        echo json_encode([
            'success' => true,
            'message' => 'જય દ્વારકાધીશ! તમારો પ્રતિભાવ સફળતાપૂર્વક નોંધાઈ ગયો છે.',
            'review' => [
                'id' => $new_id,
                'user_name' => htmlspecialchars($name),
                'user_city' => htmlspecialchars($city ?: 'યાત્રાળુ'),
                'rating' => $rating,
                'user_comment' => htmlspecialchars($comment),
                'created_at' => date('d M, Y')
            ]
        ]);
    } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'પ્રતિભાવ સેવ કરવામાં ક્ષતિ: ' . $e->getMessage()
        ]);
    }
    exit;
}

if ($method === 'GET') {
    $reviews = get_reviews($pdo, 10);
    echo json_encode([
        'success' => true,
        'reviews' => $reviews
    ]);
    exit;
}
