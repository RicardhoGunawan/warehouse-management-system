<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo; // Menginisialisasi database
    }

    public function create($data) {
        // Meng-hash password
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        $stmt->execute([$data['username'], $hashedPassword]);
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC); // Mengembalikan data pengguna
    }
}
?>
