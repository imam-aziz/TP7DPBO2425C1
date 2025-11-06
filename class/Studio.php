<?php
// class/Studio.php

// Memanggil file koneksi database
require_once 'config/db.php';

class Studio {
    private $db;

    // Constructor untuk inisialisasi koneksi DB
    public function __construct() {
        // Menggunakan koneksi dari file db.php
        $this->db = (new Database())->conn;
    }

    // =================================================================
    // FUNGSI CREATE (Tambah Data)
    // =================================================================
    public function create($nama_studio, $asal_kota) {
        try {
            // 1. Query SQL (Gunakan '?' sebagai placeholder)
            $query = "INSERT INTO studio (nama_studio, asal_kota) VALUES (?, ?)";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Bind parameter (sangat penting untuk keamanan)
            $stmt->bindParam(1, $nama_studio);
            $stmt->bindParam(2, $asal_kota);
            
            // 4. Execute
            if ($stmt->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // =================================================================
    // FUNGSI READ (Ambil Semua Data)
    // =================================================================
    public function readAll() {
        try {
            // 1. Query SQL
            $query = "SELECT * FROM studio ORDER BY id_studio ASC";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Execute
            $stmt->execute();
            
            // 4. Fetch all data
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // =================================================================
    // FUNGSI READ (Ambil Satu Data by ID)
    // =================================================================
    public function readSingle($id) {
        try {
            // 1. Query SQL
            $query = "SELECT * FROM studio WHERE id_studio = ?";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Bind parameter
            $stmt->bindParam(1, $id);
            
            // 4. Execute
            $stmt->execute();
            
            // 5. Fetch data
            return $stmt->fetch(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // =================================================================
    // FUNGSI UPDATE (Ubah Data)
    // =================================================================
    public function update($id, $nama_studio, $asal_kota) {
        try {
            // 1. Query SQL
            $query = "UPDATE studio SET 
                      nama_studio = ?, 
                      asal_kota = ? 
                      WHERE id_studio = ?";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Bind parameter
            $stmt->bindParam(1, $nama_studio);
            $stmt->bindParam(2, $asal_kota);
            $stmt->bindParam(3, $id);
            
            // 4. Execute
            if ($stmt->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    // =================================================================
    // FUNGSI DELETE (Hapus Data)
    // =================================================================
    public function delete($id) {
        try {
            // 1. Query SQL
            $query = "DELETE FROM studio WHERE id_studio = ?";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Bind parameter
            $stmt->bindParam(1, $id);
            
            // 4. Execute
            if ($stmt->execute()) {
                return true;
            }
            return false;

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>