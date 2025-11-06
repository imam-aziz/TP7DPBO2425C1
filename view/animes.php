<!-- 
File ini "mewarisi" variabel $anime dan $studio dari index.php 
-->

<h3>Anime List</h3>
<!-- Atribut tabel lama (border, dll) dihapus -->
<table>
    <tr>
        <th>ID</th>
        <th>Nama Anime</th>
        <th>Genre</th>
        <th>Studio ID (FK)</th>
        <th>Action</th>
    </tr>
    <?php 
    $anime_list = $anime->readAll();
    if ($anime_list) {
        foreach ($anime_list as $a): ?>
    <tr>
        <td><?= $a['id_anime'] ?></td>
        <td><?= htmlspecialchars($a['nama_anime']) ?></td>
        <td><?= htmlspecialchars($a['genre']) ?></td>
        <td><?= $a['id_studio'] ?></td>
        <td class="table-actions"> <!-- Class ditambahkan -->
            <!-- Tombol diubah menjadi .btn -->
            <a href="?page=animes&edit_anime=<?= $a['id_anime'] ?>" class="btn btn-warning">Edit</a>
            <a href="?page=animes&delete_anime=<?= $a['id_anime'] ?>" 
               class="btn btn-danger"
               onclick="return confirm('Are you sure you want to delete this anime?');">
               Delete
            </a>
        </td>
    </tr>
    <?php 
        endforeach; 
    } else {
        echo "<tr><td colspan='5'>No animes found.</td></tr>";
    }
    ?>
</table>

<hr>

<h3>Add New Anime</h3>
<form method="POST" action="index.php?page=animes">
    <label>Nama Anime:</label>
    <input type="text" name="nama_anime" required>
    
    <label>Genre:</label>
    <input type="text" name="genre">
    
    <label>Studio:</label>
    <!-- Ini adalah cara handle Foreign Key -->
    <select name="id_studio" required>
        <option value="">-- Pilih Studio --</option>
        <?php 
        // Mengambil data dari Model Studio untuk mengisi dropdown
        $studio_list_for_dropdown = $studio->readAll();
        if ($studio_list_for_dropdown) {
            foreach ($studio_list_for_dropdown as $s): ?>
                <option value="<?= $s['id_studio'] ?>">
                    <?= htmlspecialchars($s['nama_studio']) ?>
                </option>
        <?php 
            endforeach; 
        }
        ?>
    </select>
    
    <button type="submit" name="add_anime">Add Anime</button>
</form>