<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<?php session_start(); ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GymMaster Pro | Management System</title>

  <!-- Updated CSS Links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  
  <?php include('./header.php'); ?>

  <style>
    :root {
      --primary-color: #2a2a72;
      --secondary-color: #009ffd;
      --accent-color: #ff7f50;
      --light-bg: #f8f9fa;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light-bg);
    }

    #sidebar {
      width: 280px;
      height: 100vh;
      background: linear-gradient(180deg, var(--primary-color), #1a1a5c);
      transition: all 0.3s;
    }

    .sidebar-header {
      padding: 1.5rem;
      background: rgba(0, 0, 0, 0.1);
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.8);
      padding: 0.75rem 1.5rem;
      margin: 0.25rem 0;
      transition: all 0.3s;
    }

    .nav-link:hover {
      color: white;
      background: rgba(255, 255, 255, 0.1);
      transform: translateX(5px);
    }

    .nav-link.active {
      color: white;
      background: var(--secondary-color);
    }

    .main-content {
      margin-left: 280px;
      transition: all 0.3s;
    }

    .card-custom {
      border: none;
      border-radius: 15px;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
    }

    .card-custom:hover {
      transform: translateY(-5px);
    }

    .btn-primary {
      background-color: var(--secondary-color);
      border: none;
      padding: 0.5rem 1.5rem;
    }

    .btn-primary:hover {
      background-color: #0088cc;
    }

    .modal-custom .modal-content {
      border-radius: 15px;
      border: none;
    }

    .toast-custom {
      position: fixed;
      top: 1rem;
      right: 1rem;
      min-width: 250px;
      border-radius: 10px;
    }

    @media (max-width: 768px) {
      #sidebar {
        margin-left: -280px;
      }
      .main-content {
        margin-left: 0;
      }
      #sidebar.active {
        margin-left: 0;
      }
    }
  </style>
</head>

<body>
  <div class="d-flex">
    <!-- Vertical Sidebar -->
    <nav id="sidebar" class="position-fixed">
      <div class="sidebar-header">
        <h3 class="text-white mb-0">GymMaster Pro</h3>
        <small class="text-white-50">Management System</small>
      </div>
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" href="?page=home">
            <i class="bi bi-speedometer2 me-2"></i>
            Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=members">
            <i class="bi bi-people me-2"></i>
            Members
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=payments">
            <i class="bi bi-credit-card me-2"></i>
            Payments
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?page=schedule">
            <i class="bi bi-calendar-event me-2"></i>
            Schedule
          </a>
        </li>
      </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content w-100">
      <!-- Top Navigation -->
      <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container-fluid">
          <button class="btn btn-primary d-lg-none" id="sidebarToggle">
            <i class="bi bi-list"></i>
          </button>
          <div class="ms-auto">
            <div class="dropdown">
              <a href="#" class="btn btn-link" data-bs-toggle="dropdown">
                <i class="bi bi-person-circle fs-4"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="?page=profile">Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="container-fluid p-4" id="view-panel">
        <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home'; ?>
        <?php include $page.'.php' ?>
      </main>
    </div>
  </div>

  <!-- Updated JavaScript Links -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Sidebar Toggle
    document.getElementById('sidebarToggle').addEventListener('click', () => {
      document.getElementById('sidebar').classList.toggle('active');
      document.querySelector('.main-content').classList.toggle('active');
    });

    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    if (themeToggle) {
      themeToggle.addEventListener('click', () => {
        document.body.dataset.bsTheme = 
          document.body.dataset.bsTheme === 'dark' ? 'light' : 'dark';
      });
    }

    // Toast Notification
    window.alert_toast = function($msg = 'Success!', $bg = 'success') {
      const toast = document.createElement('div');
      toast.className = `toast toast-custom align-items-center text-white bg-${$bg} border-0`;
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">${$msg}</div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
      `;
      document.body.appendChild(toast);
      new bootstrap.Toast(toast, { delay: 3000 }).show();
    }
  </script>
</body>
</html>