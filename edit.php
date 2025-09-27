<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
  header("Location: admin.php");
  exit;
}

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "landing_db";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = intval($_GET['id'] ?? 0);

// Handle update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    $stmt = $conn->prepare("UPDATE contacts SET name=?, email=?, message=? WHERE id=?");
    $stmt->bind_param("sssi", $name, $email, $message, $id);
    if ($stmt->execute()) {
        header("Location: admin.php");
        exit;
    } else {
        $error = "Error updating message: " . $stmt->error;
    }
}

// Fetch message
$stmt = $conn->prepare("SELECT * FROM contacts WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$messageData = $result->fetch_assoc();

if (!$messageData) {
    echo "Message not found.";
    exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Edit Message</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
  <h1 class="mb-4 text-center">Edit Message</h1>
  <?php if (!empty($error)) echo "<p class='text-danger'>$error</p>"; ?>
  <form method="post" class="col-md-6 mx-auto">
    <div class="mb-3">
      <label class="form-label">Name</label>
      <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($messageData['name']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($messageData['email']) ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Message</label>
      <textarea name="message" class="form-control" rows="4" required><?= htmlspecialchars($messageData['message']) ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary w-100">Update</button>
    <a href="admin.php" class="btn btn-secondary w-100 mt-2">Back</a>
  </form>
</div>
</body>
</html>
<?php $conn->close(); ?>
