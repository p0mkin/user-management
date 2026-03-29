<?php
require 'autoload.php';
session_start();

use App\Services\AuthService;
use App\Services\UserRepository;

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Nuskaitome vartotojus iš failo
    $repo = new UserRepository();
    $user = $repo->getUserByEmail($email);

    if ($user) {
        // Patikriname prisijungimo duomenis su AuthService
        $authService = new AuthService();
        $loginMessage = $authService->authenticate($user, $email, $password);
        
        if (strpos($loginMessage, "successfully") !== false) {
            // Prisijungimas pavyko - išsaugome sesiją
            $_SESSION['logged_in_email'] = $user->getEmail();
            header("Location: index.php");
            exit;
        } else {
            $message = "Invalid password.";
        }
    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>Login</h2>
    <p><?php echo $message; ?></p>
    
    <form method="POST">
        Email:<br>
        <input type="email" name="email" required><br><br>
        
        Password:<br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
    
    <br>
    <a href="register.php">Need an account? Register here</a>
</body>
</html>
