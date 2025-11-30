<?php
session_start();
include '../../config/koneksi.php';
if($_SESSION['status'] != "login"){ header("location:../auth/login.php"); }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Jadwal - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow p-4 flex justify-between">
        <span class="font-bold text-sehat-pink">Kelola Jadwal</span>
        <a href="dashboard.php" class="text-gray-600 hover:text-sehat-pink">Kembali ke Dashboard</a>
    </nav>

    <div class="max-w-6xl mx-auto mt-10 p-5">
        
        <div class="bg-white p-6 rounded shadow mb-10 border-t-4 border-sehat-pink">
            <h3 class="font-bold text-lg mb-4">Tambah Jadwal Baru</h3>
            <form action="../../process/jadwal_process.php?aksi=add" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <input type="date" name="tanggal_pemeriksaan" class="border p-2 rounded" required>
                <input type="text" name="lokasi" placeholder="Lokasi Pemeriksaan" class="border p-2 rounded" required>
                <select name="status_aktif" class="border p-2 rounded">
                    <option value="1">Buka (Aktif)</option>
                    <option value="0">Tutup</option>
                </select>
                <button type="submit" class="bg-sehat-pink text-white p-2 rounded hover:bg-pink-600">Simpan Jadwal</button>
            </form>
        </div>

        <div class="bg-white p-6 rounded shadow">
            <h3 class="font-bold text-lg mb-4">Daftar Jadwal</h3>
            <table class="w-full border-collapse border border-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3">No</th>
                        <th class="border p-3">Tanggal</th>
                        <th class="border p-3">Lokasi</th>
                        <th class="border p-3">Status</th>
                        <th class="border p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM jadwal ORDER BY tanggal_pemeriksaan DESC");
                    while($row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr class="text-center">
                        <td class="border p-3"><?php echo $no++; ?></td>
                        <td class="border p-3"><?php echo $row['tanggal_pemeriksaan']; ?></td>
                        <td class="border p-3 text-left"><?php echo $row['lokasi']; ?></td>
                        <td class="border p-3">
                            <?php if($row['status_aktif'] == 1){ ?>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs">Aktif</span>
                            <?php } else { ?>
                                <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs">Tutup</span>
                            <?php } ?>
                        </td>
                        <td class="border p-3">
                            <a href="edit_jadwal.php?id=<?php echo $row['id_jadwal']; ?>" class="text-blue-500 hover:underline mr-2">Edit</a>
                            <a href="../../process/jadwal_process.php?aksi=delete&id=<?php echo $row['id_jadwal']; ?>" onclick="return confirm('Hapus jadwal ini?')" class="text-red-500 hover:underline">Hapus</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>