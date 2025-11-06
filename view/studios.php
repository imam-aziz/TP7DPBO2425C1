<!-- 
File ini "mewarisi" variabel $studio dari index.php 
-->

<h3>Studio List</h3>
<!-- Atribut tabel lama (border, dll) dihapus agar CSS bisa ambil alih -->
<table>
    <tr>
        <th>ID</th>
        <th>Nama Studio</th>
        <th>Asal Kota</th>
        <th>Action</th>
    </tr>
    <?php 
    // Mengambil semua data studio dari Model
    $studio_list = $studio->readAll(); 
    if ($studio_list) {
        foreach ($studio_list as $s): ?>
    <tr>
        <td><?= $s['id_studio'] ?></td>
        <td><?= htmlspecialchars($s['nama_studio']) ?></td>
        <td><?= htmlspecialchars($s['asal_kota']) ?></td>
        <td class="table-actions"> <!-- Class ditambahkan -->
            <!-- Tombol diubah menjadi .btn -->
            <a href="?edit_studio=<?= $s['id_studio'] ?>" class="btn btn-warning">Edit</a>
            <a href="?page=studios&delete_studio=<?= $s['id_studio'] ?>" 
               class="btn btn-danger"
               onclick="return confirm('Are you sure you want to delete this studio?');">
               Delete
            </a>
        </td>
    </tr>
    <?php 
        endforeach; 
    } else {
        echo "<tr><td colspan='4'>No studios found.</td></tr>";
    }
    ?>
</table>

<hr>

<h3>Add New Studio</h3>
<form method="POST" action="index.php?page=studios">
    <label>Nama Studio:</label>
    <input type="text" name="nama_studio" required>
    
    <label>Asal Kota:</label>
    <input type="text" name="asal_kota">
    
    <button type="submit" name="add_studio">Add Studio</button>
</form>