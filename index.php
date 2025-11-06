<?php
// 1. Memanggil semua file class (Model)
require_once 'class/Studio.php';
require_once 'class/Anime.php';
require_once 'class/Character.php';

// 2. Inisialisasi semua objek Model
// (Variabel ini akan "terlihat" oleh file view yang di-include)
$studio = new Studio();
$anime = new Anime();
$character = new Character();

// =================================================================
// PUSAT LOGIKA (CONTROLLER)
// Menangani semua aksi (Tambah/Hapus) sebelum HTML dimuat
// =================================================================

// --- LOGIKA STUDIO ---
if (isset($_POST['add_studio'])) {
    $studio->create(
        $_POST['nama_studio'], 
        $_POST['asal_kota']
    );
    // Redirect untuk mencegah re-submit form
    header('Location: index.php?page=studios');
    exit;
}
if (isset($_GET['delete_studio'])) {
    $studio->delete($_GET['delete_studio']);
    header('Location: index.php?page=studios');
    exit;
}

if (isset($_POST['update_studio'])) {
    $studio->update(
        $_POST['id_studio'], // Ambil ID dari hidden input
        $_POST['nama_studio'], 
        $_POST['asal_kota']
    );
    header('Location: index.php?page=studios');
    exit;
}

// --- LOGIKA ANIME ---
if (isset($_POST['add_anime'])) {
    $anime->create(
        $_POST['nama_anime'], 
        $_POST['genre'], 
        $_POST['id_studio'] // Ambil FK dari dropdown
    );
    header('Location: index.php?page=animes');
    exit;
}
if (isset($_GET['delete_anime'])) {
    $anime->delete($_GET['delete_anime']);
    header('Location: index.php?page=animes');
    exit;
}

if (isset($_POST['update_anime'])) {
    $anime->update(
        $_POST['id_anime'], // Ambil ID dari hidden input
        $_POST['nama_anime'], 
        $_POST['genre'], 
        $_POST['id_studio']
    );
    header('Location: index.php?page=animes');
    exit;
}

// --- LOGIKA CHARACTER ---
if (isset($_POST['add_character'])) {
    $character->create(
        $_POST['nama_character'], 
        $_POST['jenis_kelamin'], 
        $_POST['voice_actor'], 
        $_POST['id_anime'] // Ambil FK dari dropdown
    );
    header('Location: index.php?page=characters');
    exit;
}
if (isset($_GET['delete_character'])) {
    $character->delete($_GET['delete_character']);
    header('Location: index.php?page=characters');
    exit;
}

if (isset($_POST['update_character'])) {
    $character->update(
        $_POST['id_character'], // Ambil ID dari hidden input
        $_POST['nama_character'], 
        $_POST['jenis_kelamin'], 
        $_POST['voice_actor'], 
        $_POST['id_anime']
    );
    header('Location: index.php?page=characters');
    exit;
}

?>
<!-- Mulai HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wibu Collection</title>
    <!-- Memanggil CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<div class="container"> <!-- Wrapper container ditambahkan -->
    <!-- 3. Include Header -->
    <?php include 'view/header.php'; ?>

    <main>
        <!-- 4. Navigasi Utama (Diubah ke UL) -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="?page=studios">Studios</a></li>
                <li><a href="?page=animes">Animes</a></li>
                <li><a href="?page=characters">Characters</a></li>
            </ul>
        </nav>

        <hr>

        <!-- 5. Konten Dinamis (Routing) -->
        <?php

         // --- ROUTING UNTUK FORM EDIT (BARU DITAMBAHKAN) ---
        if (isset($_GET['edit_studio'])) {
            include 'view/edit_studio.php';
        } 
        elseif (isset($_GET['edit_anime'])) {
            include 'view/edit_anime.php';
        }
        elseif (isset($_GET['edit_char'])) {
            // (Sesuai link di view/characters.php)
            include 'view/edit_character.php';
        }

        // Cek apakah ada parameter 'page' di URL
        if (isset($_GET['page'])) {
            $page = $_GET['page'];
            
            // Pilih file view yang sesuai
            if ($page == 'studios') {
                include 'view/studios.php';
            } elseif ($page == 'animes') {
                include 'view/animes.php';
            } elseif ($page == 'characters') {
                include 'view/characters.php';
            } else {
                echo "<p>Page not found.</p>";
            }
        } else {
            // Halaman default (Home)
            echo "<h2>Welcome to Your Anime Collection!</h2>";
            echo "<p>Please select a category from the navigation above.</p>";
        }
        ?>
    </main>

    <!-- 6. Include Footer -->
    <?php include 'view/footer.php'; ?>
</div> <!-- Penutup container -->
</body>
</html>