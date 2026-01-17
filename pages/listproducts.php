<?php
// Perbaikan: Gunakan pengkondisian agar tidak error saat dipanggil lewat dashboard maupun langsung
if (!isset($koneksi)) {
    include_once '../koneksi.php';
}

// Gunakan variabel $koneksi sesuai dengan yang ada di koneksi.php kamu
$data = mysqli_query($koneksi, "SELECT * FROM barang ORDER BY id_barang DESC");

// Cek jika query gagal untuk memudahkan debugging
if (!$data) {
    die("Query Gagal: " . mysqli_error($koneksi));
}
?>
<style>
    .card {
        background: white;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
 
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
 
    .btn {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 4px;
        color: white;
        font-size: 14px;
    }
 
    .btn-tambah {
        background: #27ae60;
    }
 
    .btn-edit {
        background: #2980b9;
    }
 
    .btn-hapus {
        background: #c0392b;
    }
 
    table {
        width: 100%;
        border-collapse: collapse;
    }
 
    th,
    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: center;
    }
    th {
        background: #f8f8f8;
    }
</style>
 
<div class="card">
    <div class="card-header">
        <h3>List Produk</h3>
        <a href="dashboard.php?page=tambah" class="btn btn-tambah">+ Tambah Produk</a>
    </div>
    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['kode_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                <td><?= $row['stok']; ?></td>
                <td><?= $row['satuan']; ?></td>
                <td>
                    <a href="dashboard.php?page=edit&id=<?= $row['id_barang']; ?>" class="btn 
btn-edit">Edit</a>
                    <a href="dashboard.php?page=hapus&id=<?= $row['id_barang']; ?>"
                        class="btn btn-hapus"
                        onclick="return confirm('Yakin hapus data?')">
                        Hapus
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>