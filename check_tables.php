<?php
require_once __DIR__ . '/config/database.php';
$db = new Database();
$conn = $db->getConnection();
$res = $conn->query("SHOW TABLES");
$tables = [];
while($row = $res->fetch()) {
    $tables[] = $row[0];
}
echo json_encode($tables);
