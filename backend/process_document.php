<?php
// backend/process_document.php
// API endpoint for converting documents securely
// Free Secret from convertapi.com (250 req/month)
define('CONVERTAPI_SECRET', 'YOUR_CONVERT_API_SECRET_HERE'); 

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request method']);
    exit;
}

$action = $_POST['action'] ?? '';

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['error' => 'File upload failed or missing.']);
    exit;
}

if (CONVERTAPI_SECRET === 'YOUR_CONVERT_API_SECRET_HERE') {
    echo json_encode(['error' => 'Backend API is not configured. The administrator needs to specify the CONVERTAPI_SECRET in backend/process_document.php.']);
    exit;
}

$file = $_FILES['file'];
$filePath = $file['tmp_name'];
$fileName = $file['name'];

$map = [
    'pdf_to_word' => ['from' => 'pdf', 'to' => 'docx'],
    'pdf_to_ppt'  => ['from' => 'pdf', 'to' => 'pptx'],
    'pdf_to_excel'=> ['from' => 'pdf', 'to' => 'xlsx'],
    'word_to_pdf' => ['from' => 'docx', 'to' => 'pdf'],
    'protect_pdf' => ['from' => 'pdf', 'to' => 'encrypt']
];

if (!array_key_exists($action, $map)) {
    echo json_encode(['error' => 'Unsupported action.']);
    exit;
}

$from = $map[$action]['from'];
$to   = $map[$action]['to'];

// Handle .doc format correctly to PDF
if ($action === 'word_to_pdf') {
    $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    if ($ext === 'doc') {
        $from = 'doc';
    }
}

$url = "https://v2.convertapi.com/convert/$from/to/$to?Secret=" . CONVERTAPI_SECRET;

$postFields = [
    'File' => new CURLFile($filePath, mime_content_type($filePath), $fileName)
];

if ($action === 'protect_pdf') {
    $password = $_POST['password'] ?? '1234';
    $postFields['PdfUserPassword'] = $password;
    $postFields['PdfOwnerPassword'] = $password;
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // For localhost environments
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    echo json_encode(['error' => 'Network error: ' . $error]);
    exit;
}

$data = json_decode($response, true);

if ($httpCode === 200 && isset($data['Files'][0]['FileData'])) {
    $fileData = $data['Files'][0]['FileData'];
    $outFileName = $data['Files'][0]['FileName'];
    echo json_encode([
        'success' => true,
        'fileName' => $outFileName,
        'fileData' => "data:application/octet-stream;base64," . $fileData
    ]);
} else {
    $msg = $data['Message'] ?? 'Unknown conversion error.';
    echo json_encode(['error' => $msg]);
}
?>
