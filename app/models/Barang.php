<?php
class Barang
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Mengambil semua data barang beserta nama lorong, supplier, dan ruangan
    public function getAll()
    {
        $stmt = $this->db->prepare("
            SELECT 
                b.*, 
                l.nama_lorong, 
                s.nama_supplier AS nama_suppliers, 
                r.nama_ruangan 
            FROM barang b
            LEFT JOIN lorong l ON b.lorong_id = l.id
            LEFT JOIN suppliers s ON b.supplier_id = s.id
            LEFT JOIN ruangan r ON b.ruangan_id = r.id
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Menyimpan barang baru ke dalam database
    public function create($data)
    {
        $stmt = $this->db->prepare("
            INSERT INTO barang (nama, stok, expire_date, supplier_id, lorong_id, ruangan_id) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");

        $stmt->execute([
            $data['nama'],
            $data['stok'],
            $data['expire_date'],
            $data['supplier_id'],
            $data['lorong_id'],
            $data['ruangan_id']
        ]);
    }

    // Memperbarui data barang di database berdasarkan ID
    public function update($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE barang 
            SET 
                nama = ?, 
                stok = ?, 
                expire_date = ?, 
                supplier_id = ?, 
                lorong_id = ?, 
                ruangan_id = ? 
            WHERE id = ?
        ");

        // Cek dan debug
        if (
            !$stmt->execute([
                $data['nama'],
                $data['stok'],
                $data['expire_date'],
                $data['supplier_id'],
                $data['lorong_id'],
                $data['ruangan_id'],
                $id
            ])
        ) {
            var_dump($stmt->errorInfo()); // Tampilkan informasi error jika ada
            return false;
        }
        return true; // Mengembalikan true jika berhasil
    }


    // Menghapus barang berdasarkan ID
    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM barang WHERE id = ?");
        $stmt->execute([$id]);
    }

    // Mengambil semua supplier
    public function getSuppliers()
    {
        $stmt = $this->db->prepare("SELECT * FROM suppliers");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil semua lorong
    public function getLorong()
    {
        $stmt = $this->db->prepare("SELECT * FROM lorong");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil semua ruangan
    public function getRuangan()
    {
        $stmt = $this->db->prepare("SELECT * FROM ruangan");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Mengambil barang berdasarkan ID
    public function find($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>