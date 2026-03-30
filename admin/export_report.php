<?php
session_start();
require_once __DIR__ . '/../backend/db.php';
require_once __DIR__ . '/../backend/auth_bootstrap.php';

any2convertBootstrapAuthSchema($conn);

if (($_SESSION['email'] ?? '') !== 'syedwasiulhassanshah@any2convert.com') {
    header('Location: ../login.php');
    exit();
}

$stmt = $conn->query("
    SELECT sa.visit_date,
           sa.page_name,
           sa.tool_used,
           sa.user_id,
           COALESCE(u.name, 'Guest') AS user_name,
           COALESCE(u.email, sa.user_email, 'Guest') AS user_email,
           sa.visitor_ip
    FROM site_analytics sa
    LEFT JOIN users u ON u.id = sa.user_id
    ORDER BY sa.visit_date DESC
");

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=any2convert-report-' . date('Y-m-d-His') . '.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['Visit Date', 'Page Name', 'Tool Used', 'User ID', 'User Name', 'User Email', 'Visitor IP']);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    fputcsv($output, [
        $row['visit_date'],
        $row['page_name'],
        $row['tool_used'],
        $row['user_id'],
        $row['user_name'],
        $row['user_email'],
        $row['visitor_ip'],
    ]);
}

fclose($output);
exit();
