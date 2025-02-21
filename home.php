<?php 
// session_start(); // Start the session
include 'db_connect.php'; 
?>
<style>
.dashboard-card {
    border: none;
    border-radius: 15px;
    transition: all 0.3s ease;
    overflow: hidden;
    position: relative;
    box-shadow: 0 10px 20px rgba(0,0,0,0.05);
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.card-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    opacity: 0.2;
    font-size: 4rem;
    color: white;
}

.welcome-header {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    border-radius: 15px;
    color: white;
    padding: 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
}

.welcome-header::before {
    content: "";
    position: absolute;
    top: -50px;
    right: -50px;
    width: 150px;
    height: 150px;
    background: rgba(255,255,255,0.1);
    border-radius: 50%;
}

.welcome-header h3 {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 1rem;
    opacity: 0.9;
    letter-spacing: 0.5px;
}

.bg-primary { background: linear-gradient(135deg, #3b82f6, #6366f1) !important; }
.bg-info { background: linear-gradient(135deg, #06b6d4, #0ea5e9) !important; }
.bg-warning { background: linear-gradient(135deg, #f59e0b, #fbbf24) !important; }

</style>

<div class="container-fluid">
    <div class="row mt-4 mx-3">
        <div class="col-lg-12">
            <!-- Welcome Header -->
            <div class="welcome-header">
                <h3><?php echo isset($_SESSION['login_name']) ? htmlspecialchars($_SESSION['login_name']) : 'Guest'; ?></h3>
                <p class="mb-0">Gym Management Dashboard Overview</p>
                <i class="bi bi-calendar-check dashboard-icon" style="position: absolute; right: 20px; bottom: 20px; font-size: 3rem; opacity: 0.1;"></i>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="dashboard-card bg-primary">
                        <div class="card-body text-white p-4">
                            <i class="bi bi-people-fill card-icon"></i>
                            <div class="stat-number">
                                <?php echo $conn->query("SELECT * FROM registration_info WHERE status = 1")->num_rows; ?>
                            </div>
                            <div class="stat-label">Active Members</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="dashboard-card bg-info">
                        <div class="card-body text-white p-4">
                            <i class="bi bi-clipboard2-data-fill card-icon"></i>
                            <div class="stat-number">
                                <?php echo $conn->query("SELECT * FROM plans")->num_rows; ?>
                            </div>
                            <div class="stat-label">Membership Plans</div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-4">
                    <div class="dashboard-card bg-warning">
                        <div class="card-body text-white p-4">
                            <i class="bi bi-box-seam-fill card-icon"></i>
                            <div class="stat-number">
                                <?php echo $conn->query("SELECT * FROM packages")->num_rows; ?>
                            </div>
                            <div class="stat-label">Total Packages</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Add animation to stats cards on load
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.dashboard-card');
    cards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });
});
</script>