<?php
$host = 'yamaha-3s-academy.cwcntgjinzen.ap-southeast-1.rds.amazonaws.com';
$dbname = 'dndportal';
$username = 'admin';
$password = 'Kl2bERwzxrqik7vlmxq7';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
<?php


$sql = "SELECT * FROM topics";
$stmt = $pdo->query($sql);
$items = $stmt->fetchAll();
?>

<a href="create.php" class="btn btn-success">Add New Item</a>

<table class="table table-bordered">
    <thead>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?= $item['IndexKey'] ?></td>
                <td><?= $item['Title'] ?></td>
                <td><?= $item['Description'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $item['IndexKey'] ?>" class="btn btn-warning">Edit</a>
                    <a href="delete.php?id=<?= $item['IndexKey'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>