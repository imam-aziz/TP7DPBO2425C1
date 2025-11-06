<?php
// File ini "mewarisi" $character dan $anime dari index.php

// 1. Ambil ID dari URL
$id = $_GET['edit_char']; // Sesuai link di view/characters.php

// 2. Ambil data lama dari database
$data = $character->readSingle($id);
if (!$data) {
    header('Location: index.php?page=characters');
    exit;
}

// 3. Ambil daftar anime untuk dropdown
$anime_list_for_dropdown = $anime->readAll();
?>

<h3>Edit Character: <?= htmlspecialchars($data['nama_character']) ?></h3>

<form method="POST" action="index.php">
    <input type="hidden" name="id_character" value="<?= $data['id_character'] ?>">
    
    <label>Nama Character:</label>
    <input type="text" name="nama_character" value="<?= htmlspecialchars($data['nama_character']) ?>" required>
    
    <label>Jenis Kelamin:</label>
    <input type="text" name="jenis_kelamin" value="<?= htmlspecialchars($data['jenis_kelamin']) ?>">

    <label>Voice Actor:</label>
    <input type="text" name="voice_actor" value="<?= htmlspecialchars($data['voice_actor']) ?>">
    
    <label>Anime:</label>
    <select name="id_anime" required>
        <option value="">-- Pilih Anime --</option>
        <?php 
        if ($anime_list_for_dropdown) {
            foreach ($anime_list_for_dropdown as $a): ?>
                <!-- Trik 'selected' untuk dropdown -->
                <option value="<?= $a['id_anime'] ?>" <?= ($a['id_anime'] == $data['id_anime']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($a['nama_anime']) ?>
                </option>
        <?php 
            endforeach; 
        }
        ?>
    </select>
    
    <button type="submit" name="update_character">Update Character</button>
    <a href="index.php?page=characters" class="btn">Cancel</a>
</form>