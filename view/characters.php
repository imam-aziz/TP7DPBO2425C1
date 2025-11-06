<!-- 
File ini "mewarisi" variabel $character dan $anime dari index.php 
-->

<h3>Character List</h3>
<!-- Atribut tabel lama (border, dll) dihapus -->
<table>
    <tr>
        <th>ID</th>
        <th>Nama Character</th>
        <th>Jenis Kelamin</th>
        <th>Voice Actor</th>
        <th>Anime</th> <!-- Diubah dari Anime ID (FK) -->
        <th>Action</th>
    </tr>
    <?php 
    $char_list = $character->readAll();

    // (BARU) Ambil semua anime untuk mapping nama
    $anime_map = [];
    $all_animes = $anime->readAll();
    if ($all_animes) {
        foreach ($all_animes as $a) {
            $anime_map[$a['id_anime']] = $a['nama_anime'];
        }
    }

    if ($char_list) {
        foreach ($char_list as $c): ?>
    <tr>
        <td><?= $c['id_character'] ?></td>
        <td><?= htmlspecialchars($c['nama_character']) ?></td>
        <td><?= htmlspecialchars($c['jenis_kelamin']) ?></td>
        <td><?= htmlspecialchars($c['voice_actor']) ?></td>
        <!-- (DIUBAH) Tampilkan nama anime, beri fallback jika id tidak ditemukan -->
        <td><?= htmlspecialchars($anime_map[$c['id_anime']] ?? 'N/A') ?></td>
        <td class="table-actions"> <!-- Class ditambahkan -->
            <!-- Tombol diubah menjadi .btn -->
            <a href="?edit_char=<?= $c['id_character'] ?>" class="btn btn-warning">Edit</a>
            <a href="?page=characters&delete_character=<?= $c['id_character'] ?>" 
               class="btn btn-danger"
               onclick="return confirm('Are you sure you want to delete this character?');">
               Delete
            </a>
        </td>
    </tr>
    <?php 
        endforeach; 
    } else {
        echo "<tr><td colspan='6'>No characters found.</td></tr>";
    }
    ?>
</table>

<hr>

<h3>Add New Character</h3>
<form method="POST" action="index.php?page=characters">
    <label>Nama Character:</label>
    <input type="text" name="nama_character" required>
    
    <label>Jenis Kelamin:</label>
    <input type="text" name="jenis_kelamin">

    <label>Voice Actor:</label>
    <input type="text" name="voice_actor">
    
    <label>Anime:</label>
    <!-- Dropdown untuk Foreign Key (FK) -->
    <select name="id_anime" required>
        <option value="">-- Pilih Anime --</option>
        <?php 
        // $all_animes sudah diambil di atas
        if ($all_animes) {
            foreach ($all_animes as $a): ?>
                <option value="<?= $a['id_anime'] ?>"><?= htmlspecialchars($a['nama_anime']) ?></option>
        <?php 
            endforeach; 
        }
        ?>
    </select>
    
    <button type="submit" name="add_character">Add Character</button>
</form>