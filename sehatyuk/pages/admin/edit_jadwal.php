<?php
session_start();
include '../../config/koneksi.php';
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal='$id'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Jadwal - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899' } } } }
    </script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded shadow-lg w-full max-w-md border-t-4 border-sehat-pink">
        <h2 class="text-xl font-bold mb-6">Edit Jadwal</h2>
        
        <form action="../../process/jadwal_process.php?aksi=update" method="POST">
            <input type="hidden" name="id_jadwal" value="<?php echo $data['id_jadwal']; ?>">
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Tanggal</label>
                <input type="date" name="tanggal_pemeriksaan" value="<?php echo $data['tanggal_pemeriksaan']; ?>" class="w-full border p-2 rounded" required>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Lokasi</label>
                <input type="text" name="lokasi" value="<?php echo $data['lokasi']; ?>" class="w-full border p-2 rounded" required>
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-bold mb-1">Status</label>
                <select name="status_aktif" class="w-full border p-2 rounded">
                    <option value="1" <?php if($data['status_aktif']==1) echo 'selected'; ?>>Buka (Aktif)</option>
                    <option value="0" <?php if($data['status_aktif']==0) echo 'selected'; ?>>Tutup</option>
                </select>
            </div>
            
            <div class="flex justify-between">
                <a href="data_jadwal.php" class="text-gray-500 py-2">Batal</a>
                <button type="submit" class="bg-sehat-pink text-white px-4 py-2 rounded hover:bg-pink-600">Update Data</button>
            </div>
        </form>
    </div>

</body>
</html>