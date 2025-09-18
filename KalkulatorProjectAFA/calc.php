<?php
// calc.php
header('Content-Type: application/json; charset=utf-8');
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

$a = isset($data['a']) ? (float)$data['a'] : 0;
$b = isset($data['b']) ? (float)$data['b'] : null;
$op = $data['operator'] ?? null;

$result = null;
$ok = true;
$error = null;

try {
    switch ($op) {
        case '+':
            $result = $a + $b;
            break;
        case '-':
            $result = $a - $b;
            break;
        case '*':
            $result = $a * $b;
            break;
        case '/':
            if ($b == 0) throw new Exception('Division by zero');
            $result = $a / $b;
            break;
        case '%':
            $result = fmod($a, $b);
            break;
        case 'pow':
            $result = pow($a, $b);
            break;

        // fungsi tunggal
        case 'sqrt':
            if ($a < 0) throw new Exception('Invalid sqrt');
            $result = sqrt($a);
            break;
        case 'sin':
            $result = sin(deg2rad($a));
            break;
        case 'cos':
            $result = cos(deg2rad($a));
            break;
        case 'tan':
            $result = tan(deg2rad($a));
            break;
        case 'log':
            if ($a <= 0) throw new Exception('Invalid log');
            $result = log($a);
            break;
        case 'exp':
            $result = exp($a);
            break;

        default:
            throw new Exception('Unknown operator');
    }
} catch (Exception $e) {
    $ok = false;
    $error = $e->getMessage();
}

echo json_encode([
    'ok' => $ok,
    'result' => $result,
    'error' => $error
]);