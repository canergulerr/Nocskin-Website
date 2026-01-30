<?php
header('Content-Type: application/json');

$q = isset($_GET['q']) ? $_GET['q'] : '';

// Return structure matching what main.js likely expects (from search.js analysis)
// It usually expects HTML or JSON. Based on main.js `ae` function: 
// `if ("object" !== typeof e) { s.append(e).show() ... } else { s.hide(), $(".no-query-content").show() }`
// So if we return a STRING (HTML), it renders it. If we return JSON/Object, it might treat it as "no suggestions".
// Let's return a simple HTML list for testing.

if (strlen($q) < 2) {
    echo '';
    exit;
}

// Dummy suggestions
$suggestions = [
    'Serum',
    'Moisturizer',
    'Cleanser'
];

$html = '<div class="suggestions"><ul class="list-unstyled">';
foreach ($suggestions as $s) {
    if (stripos($s, $q) !== false) {
        $html .= '<li class="item"><a href="#" class="name">' . htmlspecialchars($s) . '</a></li>';
    }
}
$html .= '</ul></div>';

// If specifically asked for JSON (some implementations):
// echo json_encode(['suggestions' => $suggestions]);

// But main.js seems to handle HTML response for checking string type.
echo $html;
?>