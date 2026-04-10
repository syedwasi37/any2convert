<?php

if (!function_exists('envLoad')) {
    function envLoad(string $path): void
    {
        static $loaded = [];

        if (isset($loaded[$path]) || !is_file($path) || !is_readable($path)) {
            return;
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        if ($lines === false) {
            return;
        }

        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            if ($key === '') {
                continue;
            }

            if (
                (str_starts_with($value, '"') && str_ends_with($value, '"')) ||
                (str_starts_with($value, "'") && str_ends_with($value, "'"))
            ) {
                $value = substr($value, 1, -1);
            }

            if (getenv($key) === false) {
                putenv($key . '=' . $value);
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
            }
        }

        $loaded[$path] = true;
    }
}

if (!function_exists('envValue')) {
    function envValue(string $key, ?string $default = null): ?string
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
        if ($value === false || $value === null || $value === '') {
            return $default;
        }

        return $value;
    }
}

envLoad(dirname(__DIR__) . DIRECTORY_SEPARATOR . '.env');
envLoad(__DIR__ . DIRECTORY_SEPARATOR . '.env');

function pdfServiceJsonError(string $message, int $status = 400, array $extra = []): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=UTF-8');
    echo json_encode(array_merge(['error' => $message], $extra));
    exit;
}

function pdfServiceBaseName(string $fileName, string $fallback = 'converted'): string
{
    $baseName = pathinfo($fileName, PATHINFO_FILENAME);
    $baseName = preg_replace('/[^A-Za-z0-9._ -]/', '', (string) $baseName);
    $baseName = trim((string) $baseName);
    return $baseName !== '' ? $baseName : $fallback;
}

function pdfServiceDetectExtension(string $fileName): string
{
    return strtolower((string) pathinfo($fileName, PATHINFO_EXTENSION));
}

function pdfServiceFindExecutable(array $candidates): ?string
{
    $pathEntries = array_filter(array_map('trim', explode(PATH_SEPARATOR, (string) getenv('PATH'))));
    $pathExt = array_filter(array_map('trim', explode(PATH_SEPARATOR, (string) getenv('PATHEXT') ?: '.EXE;.BAT;.CMD')));

    foreach ($candidates as $candidate) {
        if ($candidate === '') {
            continue;
        }

        if (str_contains($candidate, DIRECTORY_SEPARATOR) || preg_match('/^[A-Za-z]:\\\\/', $candidate)) {
            if (is_file($candidate)) {
                return $candidate;
            }
            continue;
        }

        foreach ($pathEntries as $dir) {
            $base = rtrim($dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $candidate;
            if (is_file($base)) {
                return $base;
            }
            foreach ($pathExt as $ext) {
                $withExt = $base . $ext;
                if (is_file($withExt)) {
                    return $withExt;
                }
            }
        }
    }

    return null;
}

function pdfServiceTempDir(): string
{
    $dir = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'any2convert_pdf_local';
    if (!is_dir($dir)) {
        @mkdir($dir, 0777, true);
    }
    return $dir;
}

function pdfServiceCreateTempFile(string $suffix): string
{
    $base = tempnam(pdfServiceTempDir(), 'a2c_');
    if ($base === false) {
        pdfServiceJsonError('Could not create a temporary working file.', 500);
    }

    $target = $base . $suffix;
    @rename($base, $target);
    return $target;
}

function pdfServiceStoreUpload(array $file): string
{
    $extension = pdfServiceDetectExtension($file['name'] ?? '');
    $suffix = $extension !== '' ? '.' . $extension : '.bin';
    $target = pdfServiceCreateTempFile($suffix);
    if (!@copy($file['tmp_name'], $target)) {
        pdfServiceJsonError('Uploaded file could not be staged for processing.', 500);
    }
    return $target;
}

function pdfServiceRunCommand(array $parts): array
{
    $escaped = array_map(static fn(string $part): string => escapeshellarg($part), $parts);
    $command = implode(' ', $escaped) . ' 2>&1';
    $output = [];
    $exitCode = 0;
    exec($command, $output, $exitCode);
    return [
        'exit_code' => $exitCode,
        'output' => trim(implode(PHP_EOL, $output)),
    ];
}

function pdfServiceLocalCapabilities(): array
{
    static $capabilities = null;
    if ($capabilities !== null) {
        return $capabilities;
    }

    $qpdf = pdfServiceFindExecutable(['qpdf', 'C:\\Program Files\\qpdf\\bin\\qpdf.exe']);
    $ghostscript = pdfServiceFindExecutable([
        'gswin64c',
        'gs',
        'C:\\Program Files\\gs\\gs10.05.0\\bin\\gswin64c.exe',
        'C:\\Program Files\\gs\\gs10.04.0\\bin\\gswin64c.exe',
    ]);
    $tesseract = pdfServiceFindExecutable(['tesseract', 'C:\\Program Files\\Tesseract-OCR\\tesseract.exe']);
    $libreoffice = pdfServiceFindExecutable([
        'soffice',
        'libreoffice',
        'C:\\Program Files\\LibreOffice\\program\\soffice.exe',
    ]);

    $capabilities = [
        'binaries' => [
            'qpdf' => $qpdf,
            'ghostscript' => $ghostscript,
            'tesseract' => $tesseract,
            'libreoffice' => $libreoffice,
        ],
        'actions' => [
            'merge_pdf' => $qpdf !== null,
            'protect_pdf' => $qpdf !== null,
            'unlock_pdf' => $qpdf !== null,
            'compress_pdf' => $ghostscript !== null,
            'ocr_pdf' => $tesseract !== null,
            'word_to_pdf' => $libreoffice !== null,
            'pdf_to_word' => false,
            'pdf_to_excel' => false,
            'pdf_to_ppt' => false,
            'redact_pdf' => false,
            'add_watermark' => false,
            'sign_pdf' => false,
        ],
    ];

    return $capabilities;
}

function pdfServiceLocalActionSupported(string $action): bool
{
    $capabilities = pdfServiceLocalCapabilities();
    return !empty($capabilities['actions'][$action]);
}

function pdfServiceLocalActionReason(string $action): string
{
    $capabilities = pdfServiceLocalCapabilities();
    $missing = [];
    switch ($action) {
        case 'merge_pdf':
        case 'protect_pdf':
        case 'unlock_pdf':
            if (empty($capabilities['binaries']['qpdf'])) {
                $missing[] = 'qpdf';
            }
            break;
        case 'compress_pdf':
            if (empty($capabilities['binaries']['ghostscript'])) {
                $missing[] = 'ghostscript';
            }
            break;
        case 'ocr_pdf':
            if (empty($capabilities['binaries']['tesseract'])) {
                $missing[] = 'tesseract';
            }
            break;
        case 'word_to_pdf':
            if (empty($capabilities['binaries']['libreoffice'])) {
                $missing[] = 'libreoffice';
            }
            break;
    }

    if ($missing) {
        return 'Local PDF engine is not ready for this tool yet. Missing binary: ' . implode(', ', $missing) . '.';
    }

    return 'Local PDF engine does not support this action yet.';
}

function pdfServiceEmitFile(string $downloadName, string $contentType, string $binaryBody, string $engine): never
{
    header('Content-Type: ' . $contentType);
    header('Content-Length: ' . strlen($binaryBody));
    header('Content-Disposition: attachment; filename="' . rawurlencode($downloadName) . '"; filename*=UTF-8\'\'' . rawurlencode($downloadName));
    header('X-File-Name: ' . rawurlencode($downloadName));
    header('X-Tool-Engine: ' . $engine);
    echo $binaryBody;
    exit;
}

function pdfServiceHandleLocalAction(string $action, array $files): never
{
    $downloadName = pdfServiceDownloadName($action, $files);
    $capabilities = pdfServiceLocalCapabilities();

    switch ($action) {
        case 'merge_pdf': {
            $qpdf = $capabilities['binaries']['qpdf'] ?? null;
            if (!$qpdf) {
                pdfServiceJsonError(pdfServiceLocalActionReason($action), 503);
            }

            $localFiles = array_map('pdfServiceStoreUpload', $files);
            $output = pdfServiceCreateTempFile('.pdf');
            $args = [$qpdf, '--empty', '--pages'];
            foreach ($localFiles as $localFile) {
                $args[] = $localFile;
            }
            $args[] = '--';
            $args[] = $output;

            $result = pdfServiceRunCommand($args);
            foreach ($localFiles as $localFile) {
                @unlink($localFile);
            }
            if ($result['exit_code'] !== 0 || !is_file($output)) {
                @unlink($output);
                pdfServiceJsonError('Local merge failed. ' . ($result['output'] ?: 'qpdf did not produce an output file.'), 502);
            }

            $binary = (string) file_get_contents($output);
            @unlink($output);
            pdfServiceEmitFile($downloadName, 'application/pdf', $binary, 'local-qpdf');
        }
        case 'protect_pdf': {
            $qpdf = $capabilities['binaries']['qpdf'] ?? null;
            if (!$qpdf) {
                pdfServiceJsonError(pdfServiceLocalActionReason($action), 503);
            }

            $userPassword = trim((string) ($_POST['user_password'] ?? ''));
            $ownerPassword = trim((string) ($_POST['owner_password'] ?? $userPassword));
            if ($userPassword === '') {
                pdfServiceJsonError('Please provide a PDF password.');
            }

            $input = pdfServiceStoreUpload($files[0]);
            $output = pdfServiceCreateTempFile('.pdf');
            $printSetting = !empty($_POST['allow_print']) ? 'full' : 'none';
            $extractSetting = !empty($_POST['allow_copy']) ? 'y' : 'n';
            $result = pdfServiceRunCommand([
                $qpdf,
                '--encrypt',
                $userPassword,
                $ownerPassword !== '' ? $ownerPassword : $userPassword,
                '256',
                '--print=' . $printSetting,
                '--extract=' . $extractSetting,
                '--',
                $input,
                $output,
            ]);

            @unlink($input);
            if ($result['exit_code'] !== 0 || !is_file($output)) {
                @unlink($output);
                pdfServiceJsonError('Local PDF protection failed. ' . ($result['output'] ?: 'qpdf did not produce an output file.'), 502);
            }

            $binary = (string) file_get_contents($output);
            @unlink($output);
            pdfServiceEmitFile($downloadName, 'application/pdf', $binary, 'local-qpdf');
        }
        case 'unlock_pdf': {
            $qpdf = $capabilities['binaries']['qpdf'] ?? null;
            if (!$qpdf) {
                pdfServiceJsonError(pdfServiceLocalActionReason($action), 503);
            }

            $password = trim((string) ($_POST['password'] ?? ''));
            if ($password === '') {
                pdfServiceJsonError('Please enter the current PDF password.');
            }

            $input = pdfServiceStoreUpload($files[0]);
            $output = pdfServiceCreateTempFile('.pdf');
            $result = pdfServiceRunCommand([
                $qpdf,
                '--password=' . $password,
                '--decrypt',
                '--',
                $input,
                $output,
            ]);

            @unlink($input);
            if ($result['exit_code'] !== 0 || !is_file($output)) {
                @unlink($output);
                pdfServiceJsonError('Local PDF unlock failed. ' . ($result['output'] ?: 'qpdf did not produce an output file.'), 502);
            }

            $binary = (string) file_get_contents($output);
            @unlink($output);
            pdfServiceEmitFile($downloadName, 'application/pdf', $binary, 'local-qpdf');
        }
        default:
            pdfServiceJsonError(pdfServiceLocalActionReason($action), 503, [
                'engine' => 'local',
            ]);
    }
}

function pdfServiceDownloadName(string $action, array $files): string
{
    $firstName = $files[0]['name'] ?? 'converted';
    $base = pdfServiceBaseName($firstName);

    return match ($action) {
        'pdf_to_word' => $base . '.docx',
        'pdf_to_excel' => $base . '.xlsx',
        'pdf_to_ppt' => $base . '.pptx',
        'word_to_pdf' => $base . '.pdf',
        'protect_pdf' => $base . '-protected.pdf',
        'unlock_pdf' => $base . '-unlocked.pdf',
        'ocr_pdf' => $base . '-ocr.pdf',
        'redact_pdf' => $base . '-redacted.pdf',
        'add_watermark' => $base . '-watermarked.pdf',
        'sign_pdf' => $base . '-signed.pdf',
        'compress_pdf' => $base . '-compressed.pdf',
        'merge_pdf' => count($files) > 1 ? 'merged.pdf' : ($base . '-merged.pdf'),
        default => $base . '.bin',
    };
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    pdfServiceJsonError('Only POST requests are allowed.', 405);
}

$action = trim((string) ($_POST['action'] ?? ''));

$actionConfig = [
    'pdf_to_word' => [
        'mode' => 'single',
        'output' => 'docx',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/docx',
        'extra_fields' => static fn(): array => [
            'StoreFile' => 'false',
        ],
    ],
    'pdf_to_excel' => [
        'mode' => 'single',
        'output' => 'xlsx',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/xlsx',
        'extra_fields' => static fn(): array => [
            'StoreFile' => 'false',
        ],
    ],
    'pdf_to_ppt' => [
        'mode' => 'single',
        'output' => 'pptx',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/pptx',
        'extra_fields' => static function (): array {
            return [
                'StoreFile' => 'false',
                'OcrMode' => trim((string) ($_POST['ocr_mode'] ?? 'auto')),
            ];
        },
    ],
    'word_to_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['doc', 'docx'],
        'endpoint' => static function (array $files): string {
            $ext = pdfServiceDetectExtension($files[0]['name'] ?? '');
            return $ext === 'doc' ? 'doc/to/pdf' : 'docx/to/pdf';
        },
        'extra_fields' => static fn(): array => [
            'StoreFile' => 'false',
        ],
    ],
    'merge_pdf' => [
        'mode' => 'multi',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/merge',
        'extra_fields' => static function (): array {
            $bookmarks = trim((string) ($_POST['bookmarks_toc'] ?? 'filename'));
            $pageSize = trim((string) ($_POST['page_size'] ?? 'default'));
            $orientation = trim((string) ($_POST['page_orientation'] ?? 'default'));

            return [
                'StoreFile' => 'false',
                'BookmarksToc' => in_array($bookmarks, ['disabled', 'filename', 'title'], true) ? $bookmarks : 'filename',
                'PageSize' => in_array($pageSize, ['default', 'a4', 'letter', 'legal'], true) ? $pageSize : 'default',
                'PageOrientation' => in_array($orientation, ['default', 'portrait', 'landscape'], true) ? $orientation : 'default',
                'RemoveDuplicateFonts' => !empty($_POST['remove_duplicate_fonts']) ? 'true' : 'false',
            ];
        },
    ],
    'compress_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/compress',
        'extra_fields' => static function (): array {
            $presetMap = [
                'low' => 'lossless',
                'medium' => 'web',
                'high' => 'ebook',
            ];
            $level = trim((string) ($_POST['compression_level'] ?? 'medium'));
            $preset = $presetMap[$level] ?? 'web';

            return [
                'StoreFile' => 'false',
                'Preset' => $preset,
            ];
        },
    ],
    'protect_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/protect',
        'extra_fields' => static function (): array {
            $userPassword = trim((string) ($_POST['user_password'] ?? ''));
            $ownerPassword = trim((string) ($_POST['owner_password'] ?? $userPassword));
            if ($userPassword === '') {
                pdfServiceJsonError('Please provide a PDF password.');
            }

            return [
                'StoreFile' => 'false',
                'UserPassword' => $userPassword,
                'OwnerPassword' => $ownerPassword !== '' ? $ownerPassword : $userPassword,
                'PrintDocument' => !empty($_POST['allow_print']) ? 'true' : 'false',
                'CopyContent' => !empty($_POST['allow_copy']) ? 'true' : 'false',
            ];
        },
    ],
    'unlock_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/unprotect',
        'extra_fields' => static function (): array {
            return [
                'StoreFile' => 'false',
                'Password' => trim((string) ($_POST['password'] ?? '')),
            ];
        },
    ],
    'ocr_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/ocr',
        'extra_fields' => static function (): array {
            $language = strtolower(trim((string) ($_POST['ocr_language'] ?? 'en')));
            $allowedLanguages = [
                'ar', 'ca', 'zh-cn', 'zh-tw', 'da', 'nl', 'en', 'fi', 'fa', 'de',
                'el', 'he', 'it', 'ja', 'ko', 'lt', 'no', 'pl', 'pt', 'ro',
                'ru', 'sl', 'es', 'sv', 'tr', 'ua', 'th'
            ];
            $ocrMode = strtolower(trim((string) ($_POST['ocr_mode'] ?? 'auto')));
            $allowedModes = ['auto', 'always', 'reprocess'];

            return [
                'StoreFile' => 'false',
                'OutputType' => trim((string) ($_POST['output_type'] ?? 'pdf')),
                'OcrLanguage' => in_array($language, $allowedLanguages, true) ? $language : 'en',
                'OcrMode' => in_array($ocrMode, $allowedModes, true) ? $ocrMode : 'auto',
            ];
        },
    ],
    'redact_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/redact',
        'extra_fields' => static function (): array {
            $searchText = trim((string) ($_POST['search_text'] ?? ''));
            if ($searchText === '') {
                pdfServiceJsonError('Please enter the text you want to redact.');
            }

            return [
                'StoreFile' => 'false',
                'SearchText' => $searchText,
                'CaseSensitive' => !empty($_POST['case_sensitive']) ? 'true' : 'false',
            ];
        },
    ],
    'add_watermark' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/watermark',
        'extra_fields' => static function (): array {
            $text = trim((string) ($_POST['watermark_text'] ?? ''));
            if ($text === '') {
                pdfServiceJsonError('Please enter watermark text.');
            }

            return [
                'StoreFile' => 'false',
                'Text' => $text,
                'Opacity' => trim((string) ($_POST['opacity'] ?? '35')),
                'PageRange' => trim((string) ($_POST['page_range'] ?? '1-last')),
                'HorizontalAlignment' => trim((string) ($_POST['horizontal_alignment'] ?? 'center')),
                'VerticalAlignment' => trim((string) ($_POST['vertical_alignment'] ?? 'center')),
                'Style' => trim((string) ($_POST['style'] ?? 'watermark')),
                'FontSize' => trim((string) ($_POST['font_size'] ?? '42')),
                'Rotate' => trim((string) ($_POST['rotate'] ?? '315')),
            ];
        },
    ],
    'sign_pdf' => [
        'mode' => 'single',
        'output' => 'pdf',
        'allowed_ext' => ['pdf'],
        'endpoint' => static fn(array $files): string => 'pdf/to/image-watermark',
        'extra_fields' => static function (): array {
            if (!isset($_FILES['signature_image']) || !is_array($_FILES['signature_image']) || (($_FILES['signature_image']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK)) {
                pdfServiceJsonError('Please upload a signature image.');
            }

            $signature = $_FILES['signature_image'];
            if (!is_uploaded_file($signature['tmp_name'])) {
                pdfServiceJsonError('Signature image could not be verified.');
            }

            return [
                'StoreFile' => 'false',
                'ImageFile' => new CURLFile(
                    $signature['tmp_name'],
                    $signature['type'] ?: 'application/octet-stream',
                    $signature['name']
                ),
                'Opacity' => trim((string) ($_POST['opacity'] ?? '100')),
                'PageRange' => trim((string) ($_POST['page_range'] ?? '1-last')),
                'HorizontalAlignment' => trim((string) ($_POST['horizontal_alignment'] ?? 'right')),
                'VerticalAlignment' => trim((string) ($_POST['vertical_alignment'] ?? 'bottom')),
                'Style' => trim((string) ($_POST['style'] ?? 'stamp')),
                'Scale' => trim((string) ($_POST['scale'] ?? '22')),
                'OffsetX' => trim((string) ($_POST['offset_x'] ?? '-12')),
                'OffsetY' => trim((string) ($_POST['offset_y'] ?? '-12')),
            ];
        },
    ],
];

if (!isset($actionConfig[$action])) {
    pdfServiceJsonError('Unsupported PDF service action.');
}

$config = $actionConfig[$action];
$files = [];

if ($config['mode'] === 'single') {
    if (!isset($_FILES['file']) || !is_array($_FILES['file']) || ($_FILES['file']['error'] ?? UPLOAD_ERR_NO_FILE) !== UPLOAD_ERR_OK) {
        pdfServiceJsonError('Please upload a valid file.');
    }

    $files[] = $_FILES['file'];
} else {
    if (!isset($_FILES['files'])) {
        pdfServiceJsonError('Please upload at least two PDF files.');
    }

    $fileGroup = $_FILES['files'];
    if (!is_array($fileGroup['name'] ?? null)) {
        pdfServiceJsonError('Please upload at least two PDF files.');
    }

    foreach ($fileGroup['name'] as $index => $name) {
        $error = $fileGroup['error'][$index] ?? UPLOAD_ERR_NO_FILE;
        if ($error !== UPLOAD_ERR_OK) {
            continue;
        }

        $files[] = [
            'name' => $name,
            'type' => $fileGroup['type'][$index] ?? 'application/octet-stream',
            'tmp_name' => $fileGroup['tmp_name'][$index] ?? '',
            'error' => $error,
            'size' => $fileGroup['size'][$index] ?? 0,
        ];
    }

    if (count($files) < 2) {
        pdfServiceJsonError('Please upload at least two PDF files to merge.');
    }
}

foreach ($files as $file) {
    $extension = pdfServiceDetectExtension($file['name'] ?? '');
    if (!in_array($extension, $config['allowed_ext'], true)) {
        pdfServiceJsonError('Unsupported file type for this tool.');
    }

    if (!is_uploaded_file($file['tmp_name'])) {
        pdfServiceJsonError('Uploaded file could not be verified.');
    }
}

$pdfEngine = strtolower((string) envValue('PDF_SERVICE_ENGINE', 'auto'));
if (!in_array($pdfEngine, ['auto', 'convertapi', 'local'], true)) {
    $pdfEngine = 'auto';
}

if ($pdfEngine === 'local' || ($pdfEngine === 'auto' && pdfServiceLocalActionSupported($action))) {
    pdfServiceHandleLocalAction($action, $files);
}

$convertApiSecret = envValue('CONVERTAPI_SECRET', '');
if ($convertApiSecret === '') {
    $convertApiSecret = envValue('CONVERTAPI_TOKEN', '');
}
if ($convertApiSecret === '') {
    $convertApiSecret = 'qSzcB1SYa1HFNleMxZtvRNCWWEGjlnBR';
}
if ($convertApiSecret === '') {
    pdfServiceJsonError('Server-side PDF processing is not configured yet. Add CONVERTAPI_SECRET to .env.', 503);
}

$endpoint = ($config['endpoint'])($files);
$extraFields = ($config['extra_fields'])();
$postFields = [];

if ($config['mode'] === 'single') {
    $file = $files[0];
    $postFields['File'] = new CURLFile(
        $file['tmp_name'],
        $file['type'] ?: 'application/octet-stream',
        $file['name']
    );
} else {
    foreach ($files as $index => $file) {
        $postFields["Files[$index]"] = new CURLFile(
            $file['tmp_name'],
            $file['type'] ?: 'application/octet-stream',
            $file['name']
        );
    }
}

foreach ($extraFields as $key => $value) {
    $postFields[$key] = $value;
}

$url = 'https://v2.convertapi.com/convert/' . $endpoint;
$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $convertApiSecret,
    ],
    CURLOPT_POSTFIELDS => $postFields,
    CURLOPT_TIMEOUT => 300,
    CURLOPT_CONNECTTIMEOUT => 30,
]);

$responseBody = curl_exec($ch);
$curlError = curl_error($ch);
$httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = (string) curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);
$downloadName = null;

if ($responseBody === false || $curlError !== '') {
    pdfServiceJsonError('PDF service request failed: ' . $curlError, 502);
}

$isJson = str_contains(strtolower($contentType), 'application/json');
if ($isJson) {
    $decoded = json_decode($responseBody, true);

    if ($httpCode >= 200 && $httpCode < 300 && !empty($decoded['Files'][0])) {
        $firstFile = $decoded['Files'][0];
        $fileData = $firstFile['FileData'] ?? null;
        $remoteFileName = trim((string) ($firstFile['FileName'] ?? ''));
        $remoteExt = trim((string) ($firstFile['FileExt'] ?? ''));

        if (is_string($fileData) && $fileData !== '') {
            $binaryData = base64_decode($fileData, true);
            if ($binaryData === false) {
                pdfServiceJsonError('The PDF service returned unreadable file data.', 502);
            }

            if ($remoteFileName !== '') {
                $downloadName = $remoteFileName;
            } else {
                $downloadName = pdfServiceDownloadName($action, $files);
                if ($remoteExt !== '' && !str_ends_with(strtolower($downloadName), '.' . strtolower($remoteExt))) {
                    $downloadName .= '.' . $remoteExt;
                }
            }

            $responseBody = $binaryData;
            $contentType = match (strtolower($remoteExt)) {
                'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                default => 'application/pdf',
            };
        } else {
            pdfServiceJsonError('The PDF service completed but did not return file data.', 502);
        }
    } else {
        $message = $decoded['Message'] ?? $decoded['error'] ?? 'Conversion failed.';
        pdfServiceJsonError($message, $httpCode >= 400 ? $httpCode : 502);
    }
}

if ($httpCode < 200 || $httpCode >= 300) {
    pdfServiceJsonError('PDF service returned an unexpected response.', 502, [
        'status' => $httpCode,
    ]);
}

$downloadName = $downloadName ?? pdfServiceDownloadName($action, $files);
$contentTypeOut = $contentType !== ''
    ? $contentType
    : ($config['output'] === 'docx'
        ? 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'
        : ($config['output'] === 'xlsx'
            ? 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            : ($config['output'] === 'pptx'
                ? 'application/vnd.openxmlformats-officedocument.presentationml.presentation'
                : 'application/pdf')));

header('Content-Type: ' . $contentTypeOut);
header('Content-Length: ' . strlen($responseBody));
header('Content-Disposition: attachment; filename="' . rawurlencode($downloadName) . '"; filename*=UTF-8\'\'' . rawurlencode($downloadName));
header('X-File-Name: ' . rawurlencode($downloadName));
header('X-Tool-Engine: convertapi');
echo $responseBody;
