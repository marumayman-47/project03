<?php
session_start();
if (!isset($_SESSION['user'])) {
  header("Location: signin.php");
  exit;
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
  <h3>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h3>
  <p>You are signed in.</p>
  <a href="logout.php" class="btn btn-danger">Log out</a>
</div>
</body>
</html>
