<?php
// class/Anime.php

// Memanggil file koneksi database
require_once 'config/db.php';

class Anime {
    private $db;

    // Constructor untuk inisialisasi koneksi DB
    public function __construct() {
        // Menggunakan koneksi dari file db.php
        $this->db = (new Database())->conn;
    }

    // =================================================================
    // FUNGSI CREATE (Tambah Data)
    // =================================================================
    public function create($nama_anime, $genre, $id_studio) {
        try {
            // 1. Query SQL (Placeholder-nya 3)
            $query = "INSERT INTO anime (nama_anime, genre, id_studio) VALUES (?, ?, ?)";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Bind parameter
            $stmt->bindParam(1, $nama_anime);
            $stmt->bindParam(2, $genre);
            $stmt->bindParam(3, $id_studio);
            
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
            $query = "SELECT * FROM anime ORDER BY id_anime ASC";
            
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
            $query = "SELECT * FROM anime WHERE id_anime = ?";
            
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
    public function update($id, $nama_anime, $genre, $id_studio) {
        try {
            // 1. Query SQL
            $query = "UPDATE anime SET 
                      nama_anime = ?, 
                      genre = ?, 
                      id_studio = ? 
                      WHERE id_anime = ?";
            
            // 2. Prepare statement
            $stmt = $this->db->prepare($query);
            
            // 3. Bind parameter
            $stmt->bindParam(1, $nama_anime);
            $stmt->bindParam(2, $genre);
            $stmt->bindParam(3, $id_studio);
            $stmt->bindParam(4, $id);
            
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
            $query = "DELETE FROM anime WHERE id_anime = ?";
            
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