<?php
// class/Character.php

// Memanggil file koneksi database
require_once 'config/db.php';

class Character {
    private $db;

    // Constructor untuk inisialisasi koneksi DB
    public function __construct() {
        // Menggunakan koneksi dari file db.php
        $this->db = (new Database())->conn;
    }

    // =================================================================
    // FUNGSI CREATE (Tambah Data)
    // =================================================================
    public function create($nama_character, $jenis_kelamin, $voice_actor, $id_anime) {
        try {
            $query = "INSERT INTO `character` (nama_character, jenis_kelamin, voice_actor, id_anime) 
                      VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $nama_character);
            $stmt->bindParam(2, $jenis_kelamin);
            $stmt->bindParam(3, $voice_actor);
            $stmt->bindParam(4, $id_anime);
            
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
            $query = "SELECT * FROM `character` ORDER BY id_character ASC";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
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
            $query = "SELECT * FROM `character` WHERE id_character = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    // =================================================================
    // FUNGSI UPDATE (Ubah Data)
    // =================================================================
    public function update($id, $nama_character, $jenis_kelamin, $voice_actor, $id_anime) {
        try {
            $query = "UPDATE `character` SET 
                      nama_character = ?, 
                      jenis_kelamin = ?, 
                      voice_actor = ?, 
                      id_anime = ? 
                      WHERE id_character = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $nama_character);
            $stmt->bindParam(2, $jenis_kelamin);
            $stmt->bindParam(3, $voice_actor);
            $stmt->bindParam(4, $id_anime);
            $stmt->bindParam(5, $id);
            
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
            $query = "DELETE FROM `character` WHERE id_character = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(1, $id);
            
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