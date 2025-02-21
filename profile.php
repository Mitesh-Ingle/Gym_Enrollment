
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>User Profile</h2>
    <p>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?>!</p>
    <a href="index.php?page=home" class="btn btn-primary">Back to Dashboard</a>
</body>
</html>
