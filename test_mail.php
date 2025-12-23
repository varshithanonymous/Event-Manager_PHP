<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<h1>DEBUG START</h1>";
echo "<p><strong>Current sendmail_path:</strong> " . ini_get('sendmail_path') . "</p>";
echo "<p><strong>SMTP Server:</strong> " . ini_get('SMTP') . "</p>";
echo "<p><strong>SMTP Port:</strong> " . ini_get('smtp_port') . "</p>";
require_once __DIR__ . '/app/libs/MailHelper.php';
echo "<p>MailHelper loaded successfully.</p>";

$testEmail = 'your-email@example.com'; // CHANGE THIS
if ($testEmail === 'your-email@example.com') {
    echo "<p>Please edit this file and set your email.</p>";
    exit;
}

echo "<p>Attempting to send to: $testEmail</p>";
$res = MailHelper::send($testEmail, "Test", "Test Message");
if ($res) {
    echo "<p>SUCCESS</p>";
} else {
    echo "<p>FAILED</p>";
}
?>
