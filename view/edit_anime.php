<?php
// File ini "mewarisi" $anime dan $studio dari index.php

// 1. Ambil ID dari URL
$id = $_GET['edit_anime'];

// 2. Ambil data lama dari database
$data = $anime->readSingle($id);
if (!$data) {
    header('Location: index.php?page=animes');
    exit;
}

// 3. Ambil daftar studio untuk dropdown
$studio_list_for_dropdown = $studio->readAll();
?>

<h3>Edit Anime: <?= htmlspecialchars($data['nama_anime']) ?></h3>

<form method="POST" action="index.php">
    <input type="hidden" name="id_anime" value="<?= $data['id_anime'] ?>">
    
    <label>Nama Anime:</label>
    <input type="text" name="nama_anime" value="<?= htmlspecialchars($data['nama_anime']) ?>" required>
    
    <label>Genre:</label>
    <input type="text" name="genre" value="<?= htmlspecialchars($data['genre']) ?>">
    
    <label>Studio:</label>
    <select name="id_studio" required>
        <option value="">-- Pilih Studio --</option>
        <?php 
        if ($studio_list_for_dropdown) {
            foreach ($studio_list_for_dropdown as $s): ?>
                <!-- 
                Ini adalah trik untuk memilih studio yang saat ini 
                terhubung dengan anime-nya (selected)
                -->
                <option value="<?= $s['id_studio'] ?>" <?= ($s['id_studio'] == $data['id_studio']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($s['nama_studio']) ?>
                </option>
        <?php 
            endforeach; 
        }
        ?>
    </select>
    
    <button type="submit" name="update_anime">Update Anime</button>
    <a href="index.php?page=animes" class="btn">Cancel</a>
</form>