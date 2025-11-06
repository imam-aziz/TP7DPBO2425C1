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
        <th>Anime ID (FK)</th>
        <th>Action</th>
    </tr>
    <?php 
    $char_list = $character->readAll();
    if ($char_list) {
        foreach ($char_list as $c): ?>
    <tr>
        <td><?= $c['id_character'] ?></td>
        <td><?= htmlspecialchars($c['nama_character']) ?></td>
        <td><?= htmlspecialchars($c['jenis_kelamin']) ?></td>
        <td><?= htmlspecialchars($c['voice_actor']) ?></td>
        <td><?= $c['id_anime'] ?></td>
        <td class="table-actions"> <!-- Class ditambahkan -->
            <!-- Tombol diubah menjadi .btn -->
            <a href="?page=characters&edit_char=<?= $c['id_character'] ?>" class="btn btn-warning">Edit</a>
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
    <!-- Ini adalah cara handle Foreign Key -->
    <select name="id_anime" required>
        <option value="">-- Pilih Anime --</option>
        <?php 
        // Mengambil data dari Model Anime untuk mengisi dropdown
        $anime_list_for_dropdown = $anime->readAll();
        if ($anime_list_for_dropdown) {
            foreach ($anime_list_for_dropdown as $a): ?>
                <option value="<?= $a['id_anime'] ?>">
                    <?= htmlspecialchars($a['nama_anime']) ?>
                </option>
        <?php 
            endforeach; 
        }
        ?>
    </select>
    
    <button type="submit" name="add_character">Add Character</button>
</form>