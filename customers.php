<?php
// Database configuration
$host    = 'localhost';
$dbname  = 'cloud_app';
$user    = 'root';
$pass    = '';           // XAMPP default is no password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

// Connect — handle failure gracefully
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    error_log('DB connection failed: ' . $e->getMessage());
    die('<h2 style="color:red;font-family:Arial">
         Database unavailable. Please try again later.</h2>');
}

// Fetch all customers using a prepared statement
try {
    $stmt = $pdo->prepare(
        'SELECT id, name, email, created_at FROM customers ORDER BY id ASC'
    );
    $stmt->execute();
    $customers = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log('Query failed: ' . $e->getMessage());
    die('<p style="color:red">Could not retrieve customer data.</p>');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Customer Records</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f0f4f8; padding: 30px; }
    h1   { color: #2b6cb0; }
    table { border-collapse: collapse; width: 100%; background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); border-radius: 8px; overflow: hidden; }
    thead { background: #2b6cb0; color: white; }
    th, td { padding: 12px 16px; text-align: left; border-bottom: 1px solid #e2e8f0; }
    tr:hover { background: #ebf4ff; }
  </style>
</head>
<body>
  <h1>Customer Records</h1>
  <table>
    <thead>
      <tr><th>ID</th><th>Name</th><th>Email</th><th>Created At</th></tr>
    </thead>
    <tbody>
      <?php if (empty($customers)): ?>
        <tr><td colspan="4">No records found.</td></tr>
      <?php else: ?>
        <?php foreach ($customers as $c): ?>
          <tr>
            <td><?= htmlspecialchars($c['id']) ?></td>
            <td><?= htmlspecialchars($c['name']) ?></td>
            <td><?= htmlspecialchars($c['email']) ?></td>
            <td><?= htmlspecialchars($c['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</body>
</html>