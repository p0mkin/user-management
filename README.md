# User Management System (PHP OOP)

A simple, entry-level Object-Oriented PHP project that demonstrates user registration, authentication, and role-based access control (Admin vs Regular User) without using a database.

## Features
* **Object-Oriented Design**: Uses namespaces, interfaces (`AuthInterface`), abstract classes (`AbstractUser`), and traits (`LoggerTrait`).
* **Role-Based Access**: Distinguishes between `Admin` and `RegularUser` models with different permissions.
* **No Database Required**: Uses PHP's native `serialize()` to save user objects directly into a local text file (`data/users.dat`).
* **Secure Passwords**: Implements `password_hash()` and `password_verify()` for secure credential storage.
* **Session Management**: Native PHP `$_SESSION` controls the login, logout, and dashboard state.

## Project Structure
* `/Core` - Contains the base abstract class, interfaces, and traits.
* `/Models` - Contains the specific user implementations (Admin, RegularUser).
* `/Services` - Contains the logic for Authentication (`AuthService`) and Data Storage (`UserRepository`).
* `register.php` - The UI and logic for creating a new account.
* `login.php` - The UI and logic for authenticating an existing account.
* `index.php` - The main Dashboard profile (Role-protected view).
* `logout.php` - Ends the active session.

## How to Run Locally

You can run this project using XAMPP/WAMP or simply using PHP's built-in web server.

### Option 1: PHP Built-in Server (Easiest)
1. Open your terminal in the root directory of this project.
2. Run the following command:
   ```bash
   php -S localhost:8000
   ```
3. Open your browser and navigate to `http://localhost:8000/register.php`

### Option 2: XAMPP / Apache
1. Move the entire project folder into your `htdocs` directory (e.g. `C:\xampp\htdocs\user-management`).
2. Start the Apache module in the XAMPP Control Panel.
3. Open your browser and navigate to `http://localhost/user-management/register.php`
