<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "myshop";

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$id = $_GET['id']; // Retrieve the ID from the query string

if (isset($id)) {
    // Prepare and execute deletion query
    $stmt = $connection->prepare("DELETE FROM clients WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $successMessage = "Client deleted successfully.";
    } else {
        $errorMessage = "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $errorMessage = "No ID provided.";
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-6">
        <h2>Delete Client</h2>
        <?php if (!empty($errorMessage)): ?>
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong><?php echo $errorMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        <?php endif; ?>

        <?php if (!empty($successMessage)): ?>
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong><?php echo $successMessage; ?></strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            <a href="/myshop/index.php" class="btn btn-primary">Back to Client List</a>
        <?php else: ?>
            <a href="/myshop/index.php" class="btn btn-primary">Back to Client List</a>
        <?php endif; ?>
    </div>
</body>
</html>
