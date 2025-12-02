<?php
header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['banglishText'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$banglish = strtolower(trim($_POST['banglishText']));

// --- Banglish to Bangla Mapping ---
// Note: This is a basic example. A real-world converter would need thousands of rules
// and complex logic to handle the 'a' sound (implicit 'o/ɔ' in many Bengali words)
$mapping = [
    // Longer combinations must come first for correct replacement
    'kh' => 'খ', 'gh' => 'ঘ', 'ch' => 'চ', 'chh' => 'ছ', 'jh' => 'ঝ', 'th' => 'থ',
    'dh' => 'ধ', 'ph' => 'ফ', 'bh' => 'ভ', 'sh' => 'শ', 'au' => 'ঔ', 'ou' => 'ঔ',
    'ei' => 'ঐ', 'aa' => 'আ', 'ee' => 'ঈ', 'oo' => 'ঊ', 'T' => 'ট', 'D' => 'ড',
    'r' => 'র', 'l' => 'ল', 'm' => 'ম', 'n' => 'ন', 's' => 'স', 'h' => 'হ', 'y' => 'য়',
    'k' => 'ক', 'g' => 'গ', 'j' => 'জ', 't' => 'ত', 'd' => 'দ', 'p' => 'প', 'b' => 'ব',
    'o' => 'ও', 'i' => 'ই', 'u' => 'উ', 'e' => 'এ', 'a' => 'অ',
];

// PHP's str_replace is not ideal for transliteration as it can replace part of an already replaced string.
// A better approach is often a custom loop or regular expressions, but for simplicity:
// We use array_keys and array_values for the replacements.

$bangla = str_replace(array_keys($mapping), array_values($mapping), $banglish);

echo json_encode(['banglaText' => $bangla]);
?>