<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<?php session_start(); ?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GymMaster Pro | Management System</title>

  <!-- CSS Links -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <?php include('./header.php'); ?>

  <style>
    :root {
      --primary-color: #2A2A72;
      --secondary-color: #00B4D8;
      --accent-color: #FF7F50;
      --light-bg: #F8F9FA;
      --dark-text: #2B2D42;
      --gradient-primary: linear-gradient(135deg, #2A2A72 0%, #009FFD 100%);
    }

    body {
      font-family: 'Poppins', sans-serif;
      background-color: var(--light-bg);
      color: var(--dark-text);
    }

    #sidebar {
      width: 280px;
      height: 100vh;
      background: var(--gradient-primary);
      box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .sidebar-header {
      padding: 1.5rem;
      background: rgba(255, 255, 255, 0.1);
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .nav-link {
      color: rgba(255, 255, 255, 0.85);
      padding: 0.75rem 1.5rem;
      margin: 0.25rem 1rem;
      border-radius: 8px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      align-items: center;
    }

    .nav-link:hover {
      background: rgba(255, 255, 255, 0.15);
      transform: translateX(8px);
    }

    .nav-link.active {
      background: var(--secondary-color);
      box-shadow: 0 4px 6px rgba(0, 180, 216, 0.2);
    }

    .main-content {
      margin-left: 280px;
      transition: all 0.3s;
    }

    /* Improved Profile Dropdown */
    .profile-dropdown {
      position: relative;
    }

    .profile-dropdown .dropdown-menu {
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      border-radius: 12px;
      padding: 0.5rem;
      margin-top: 1rem !important;
      min-width: 200px;
      transform: translateX(-20px);
    }

    .profile-dropdown .dropdown-item {
      padding: 0.75rem 1rem;
      border-radius: 8px;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    .profile-dropdown .dropdown-item:hover {
      background: var(--light-bg);
      transform: translateX(5px);
    }

    .profile-dropdown .dropdown-item i {
      width: 20px;
      text-align: center;
    }

    .profile-dropdown .dropdown-divider {
      margin: 0.5rem 0;
    }

    .profile-toggle {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.5rem 1rem;
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .profile-toggle:hover {
      background: rgba(var(--secondary-color), 0.1);
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

      .profile-dropdown .dropdown-menu {
        position: fixed !important;
        right: 1rem !important;
        left: auto !important;
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
        <small class="text-white-50">Performance Redefined</small>
      </div>
      <ul class="nav flex-column mt-3">
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
          <a class="nav-link" href="?page=payment">
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
            <div class="dropdown text-center profile-dropdown">
              <a href="#" class="btn btn-link d-block" data-bs-toggle="dropdown">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi bi-person-circle fs-4 text-secondary"></i>
                  <div class="small text-dark">Profile</div>
                </div>
              </a>
              <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                <li><a class="dropdown-item" href="?page=profile">User Profile</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
                </ul>
            </div>
          </div>
        </div>
      </nav>

      <!-- Page Content -->
      <main class="container-fluid p-4" id="view-panel">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        $page_file = __DIR__ . "/$page.php";
        
        if (file_exists($page_file)) {
            include $page_file;
        } else {
            echo '<div class="alert alert-danger mt-4">Error: Requested page not found!</div>';
        }
        ?>
      </main>
    </div>
  </div>

  <!-- JavaScript Links -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Enhanced Sidebar Toggle
    document.getElementById('sidebarToggle').addEventListener('click', () => {
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.querySelector('.main-content');
      
      sidebar.classList.toggle('active');
      mainContent.classList.toggle('active');
      
      // Store sidebar state
      localStorage.setItem('sidebarState', sidebar.classList.contains('active') ? 'open' : 'closed');
    });

    // Initialize sidebar state
    document.addEventListener('DOMContentLoaded', () => {
      const savedState = localStorage.getItem('sidebarState');
      const sidebar = document.getElementById('sidebar');
      const mainContent = document.querySelector('.main-content');
      
      if (window.innerWidth > 768 && savedState === 'closed') {
        sidebar.classList.add('active');
        mainContent.classList.add('active');
      }
    });

    // Enhanced Dropdown Hover
    const profileDropdown = document.querySelector('.profile-dropdown');
    profileDropdown.addEventListener('mouseenter', () => {
      new bootstrap.Dropdown(profileDropdown.querySelector('.dropdown-toggle')).show();
    });

    profileDropdown.addEventListener('mouseleave', () => {
      new bootstrap.Dropdown(profileDropdown.querySelector('.dropdown-toggle')).hide();
    });
  </script>
</body>
</html>