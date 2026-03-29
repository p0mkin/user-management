<?php
require 'autoload.php';
session_start();

use App\Models\RegularUser;
use App\Models\Admin;
use App\Services\UserRepository;

$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Sukuriame vartotojo objektą pagal pasirinktą rolę
    if ($role == 'Admin') {
        $user = new Admin($name, $email, $password);
    } else {
        $user = new RegularUser($name, $email, $password);
    }

    // Išsaugome narį į tekstinį failą
    $repo = new UserRepository();
    if ($repo->saveUser($user)) {
        $message = "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        $message = "Error: Email is already registered.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Register</title></head>
<body>
    <h2>Register</h2>
    <p><?php echo $message; ?></p>
    
    <form method="POST">
        Name:<br>
        <input type="text" name="name" required><br><br>
        
        Email:<br>
        <input type="email" name="email" required><br><br>
        
        Password:<br>
        <input type="password" name="password" required><br><br>
        
        Role:<br>
        <select name="role">
            <option value="Regular">Regular User</option>
            <option value="Admin">Admin</option>
        </select><br><br>
        
        <button type="submit">Create Account</button>
    </form>
    
    <br>
    <a href="login.php">Already have an account? Login here</a>
</body>
</html>
