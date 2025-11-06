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
        <th>Studio</th> <!-- Diubah dari Studio ID (FK) -->
        <th>Action</th>
    </tr>
    <?php 
    $anime_list = $anime->readAll();
    
    // (BARU) Ambil semua studio untuk mapping nama
    $studio_map = [];
    $all_studios = $studio->readAll();
    if ($all_studios) {
        foreach ($all_studios as $s) {
            $studio_map[$s['id_studio']] = $s['nama_studio'];
        }
    }

    if ($anime_list) {
        foreach ($anime_list as $a): ?>
    <tr>
        <td><?= $a['id_anime'] ?></td>
        <td><?= htmlspecialchars($a['nama_anime']) ?></td>
        <td><?= htmlspecialchars($a['genre']) ?></td>
        <!-- (DIUBAH) Tampilkan nama studio, beri fallback jika id tidak ditemukan -->
        <td><?= htmlspecialchars($studio_map[$a['id_studio']] ?? 'N/A') ?></td>
        <td class="table-actions"> <!-- Class ditambahkan -->
            <!-- Tombol diubah menjadi .btn -->
            <a href="?edit_anime=<?= $a['id_anime'] ?>" class="btn btn-warning">Edit</a>
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
    <!-- Dropdown untuk Foreign Key (FK) -->
    <select name="id_studio" required>
        <option value="">-- Pilih Studio --</option>
        <?php 
        // $all_studios sudah diambil di atas
        if ($all_studios) {
            foreach ($all_studios as $s): ?>
                <option value="<?= $s['id_studio'] ?>"><?= htmlspecialchars($s['nama_studio']) ?></option>
        <?php 
            endforeach; 
        }
        ?>
    </select>
    
    <button type="submit" name="add_anime">Add Anime</button>
</form>