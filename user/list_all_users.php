<?php
session_start();
require_once '../connetionDB/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


$sql = "SELECT id, name, email, room_number, image FROM users";
$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
        }
        .user-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
        }
        .card-header {
            background: linear-gradient(45deg, #6c5ce7, #341f97);
        }
        .btnadd {
            background-color:rgb(16, 112, 124) !important;
            color: white;
            border-radius: 15px;
            padding: 10px 20px;
            margin-bottom: 20px !important;
            text-decoration: none;
        }
    </style>
</head>
<body>
<?php include '../admin/includes/navbar.php'; ?>

<div class="container py-5">
<a href="../admin/adduser.php" class="btn btnadd" >
            <i class="fas fa-plus-circle me-2" styles="margin-bottom: 50px;"></i>Add User
           
   
</a>
    <div class="card shadow">
        <div class="card-header text-white text-center">
            <h3 class="mb-0">User Management</h3>
        </div>
        <div class="card-body">
            <?php if ($result->num_rows > 0): ?>
                <div class="row g-4">
                    <?php while($row = $result->fetch_assoc()): ?>
                        <div class="col-md-6 col-lg-4">
                            <div class="card user-card h-100 shadow-sm">
                                <div class="card-body text-center">
                                    <?php if (!empty($row["image"])): ?>
                                        <img src="<?php echo htmlspecialchars($row["image"]); ?>" alt="Profile Picture">
                                    <?php else: ?>
                                        <img src="default_user.png" alt="Default User">
                                    <?php endif; ?>

                                    <h5 class="card-title mt-3"><?php echo htmlspecialchars($row["name"]); ?></h5>
                                    <p class="card-text mb-1 text-muted"><?php echo htmlspecialchars($row["email"]); ?></p>
                                    <p class="card-text mb-1">Room: <?php echo htmlspecialchars($row["room_number"] ?? 'N/A'); ?></p>
                                    <p class="card-text mb-3">Ext: <?php echo htmlspecialchars($row["ext"] ?? 'N/A'); ?></p>

                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="update_user.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">Edit</a>
                                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-danger btn-sm" >Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning text-center">No users found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $conn->close(); ?>
