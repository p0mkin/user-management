<?php

namespace App\Services;

class UserRepository {
    private $dataFile = __DIR__ . '/../data/users.dat';

    public function __construct() {
        // Sukuriame duomenų katalogą ir failą, jei jų nėra
        $dir = dirname($this->dataFile);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, serialize([]));
        }
    }

    public function getAllUsers() {
        $data = file_get_contents($this->dataFile);
        return unserialize($data);
    }

    public function saveUser($user) {
        $users = $this->getAllUsers();
        
        // Tikriname, ar toks el. paštas jau egzistuoja
        foreach ($users as $existingUser) {
            if ($existingUser->getEmail() === $user->getEmail()) {
                return false; // Email already taken
            }
        }
        
        $users[] = $user;
        file_put_contents($this->dataFile, serialize($users));
        return true;
    }

    public function getUserByEmail($email) {
        $users = $this->getAllUsers();
        foreach ($users as $user) {
            if ($user->getEmail() === $email) {
                return $user;
            }
        }
        return null;
    }
}
