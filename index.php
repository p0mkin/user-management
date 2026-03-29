<?php
require 'autoload.php';
session_start();

use App\Services\UserRepository;

// Tikriname, ar vartotojas yra prisijungęs
if (!isset($_SESSION['logged_in_email'])) {
    header("Location: login.php");
    exit;
}

$repo = new UserRepository();
$user = $repo->getUserByEmail($_SESSION['logged_in_email']);

if (!$user) {
    echo "User data missing. Please log in again.";
    session_destroy();
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Your Profile Dashboard</h2>
    
    <p><b>Name:</b> <?php echo htmlspecialchars($user->getName()); ?></p>
    <p><b>Email:</b> <?php echo htmlspecialchars($user->getEmail()); ?></p>
    <p><b>Role:</b> <?php echo htmlspecialchars($user->userRole()); ?></p>

    <!-- Jei vartotojas yra Admin, rodome visus registruotus vartotojus -->
    <?php if ($user->userRole() === "Admin"): ?>
        <hr>
        <h3>Admin Section</h3>
        <p>Because you are an Admin, you can see all registered users below:</p>
        <ul>
            <?php 
                $allUsers = $repo->getAllUsers();
                foreach($allUsers as $u) {
                    echo "<li>" . htmlspecialchars($u->getName()) . " - " . htmlspecialchars($u->userRole()) . "</li>";
                }
            ?>
        </ul>
    <?php endif; ?>

    <hr>
    <a href="logout.php">Log Out</a>
</body>
</html>