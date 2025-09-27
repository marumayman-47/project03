<?php
session_start();

// Simple admin login
$admin_user = 'admin';
$admin_pass = '12345';

if (!isset($_SESSION['logged_in'])) {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['username'] === $admin_user && $_POST['password'] === $admin_pass) {
      $_SESSION['logged_in'] = true;
      header("Location: admin.php");
      exit;
    } else {
      $error = "Wrong username or password.";
    }
  }
  ?>
  <form method="post" style="max-width:300px;margin:100px auto;">
    <h2>Admin Login</h2>
    <?php if (!empty($error)) echo "<p style='color:red'>$error</p>"; ?>
    <input type="text" name="username" class="form-control mb-2" placeholder="Username">
    <input type="password" name="password" class="form-control mb-2" placeholder="Password">
    <button type="submit" class="btn btn-primary w-100">Login</button>
  </form>
  <?php
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

// Handle delete action
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM contacts WHERE id=$id");
    header("Location: admin.php");
    exit;
}

// Search filter
$search = $_GET['search'] ?? '';
$search_sql = "";
if (!empty($search)) {
    $search_esc = $conn->real_escape_string($search);
    $search_sql = "WHERE name LIKE '%$search_esc%' OR email LIKE '%$search_esc%'";
}

// Fetch all messages
$sql = "SELECT * FROM contacts $search_sql ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel - Messages</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container my-5">
  <h1 class="mb-4 text-center">Contact Messages</h1>
  <div class="d-flex justify-content-between mb-3">
    <form class="d-flex" method="get">
      <input type="text" name="search" class="form-control me-2" placeholder="Search name or email" value="<?= htmlspecialchars($search) ?>">
      <button class="btn btn-outline-primary">Search</button>
    </form>
    <a href="logout.php" class="btn btn-secondary btn-sm">Logout</a>
  </div>
  <table class="table table-bordered table-striped">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Sent At</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['name']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td>
              <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="admin.php?delete=<?= $row['id'] ?>"
                 onclick="return confirm('Are you sure you want to delete this message?');"
                 class="btn btn-danger btn-sm">Delete</a>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="6" class="text-center">No messages found</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body>
</html>
<?php $conn->close(); ?>
