<?php
// File ini "mewarisi" $studio dari index.php

// 1. Ambil ID dari URL
$id = $_GET['edit_studio'];

// 2. Ambil data lama dari database
$data = $studio->readSingle($id);

// 3. Jika data tidak ditemukan, kembali ke halaman list
if (!$data) {
    header('Location: index.php?page=studios');
    exit;
}
?>

<h3>Edit Studio: <?= htmlspecialchars($data['nama_studio']) ?></h3>

<!-- 
Form ini akan di-submit ke index.php
Perhatikan nama tombol 'update_studio'
-->
<form method="POST" action="index.php">
    <!-- 
    Kita perlu mengirim ID-nya, tapi jangan diperlihatkan ke user.
    Gunakan 'hidden' input.
    -->
    <input type="hidden" name="id_studio" value="<?= $data['id_studio'] ?>">
    
    <label>Nama Studio:</label>
    <input type="text" name="nama_studio" value="<?= htmlspecialchars($data['nama_studio']) ?>" required>
    
    <label>Asal Kota:</label>
    <input type="text" name="asal_kota" value="<?= htmlspecialchars($data['asal_kota']) ?>">
    
    <button type="submit" name="update_studio">Update Studio</button>
    <a href="index.php?page=studios" class="btn">Cancel</a>
</form>