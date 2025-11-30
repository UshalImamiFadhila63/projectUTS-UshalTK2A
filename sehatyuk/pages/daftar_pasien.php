<?php
include '../config/koneksi.php';
$id_jadwal = $_GET['id'];

$query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE id_jadwal='$id_jadwal'");
$jadwal = mysqli_fetch_assoc($query);

if(mysqli_num_rows($query) < 1){
    header("location:../index.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }
    </script>
</head>
<body class="bg-gray-50 flex items-center justify-center min-h-screen py-10">

    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-lg border-t-4 border-sehat-pink">
        
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-sehat-abu">Form Pendaftaran</h1>
            <p class="text-gray-500 text-sm mt-2">Anda mendaftar untuk pemeriksaan di:</p>
            <p class="font-bold text-sehat-pink text-lg"><?php echo $jadwal['lokasi']; ?></p>
            <p class="text-xs text-gray-400">Tanggal: <?php echo $jadwal['tanggal_pemeriksaan']; ?></p>
        </div>

        <form action="/sehatyuk/process/daftar_process.php" method="POST">
            <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>">

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap</label>
                <input type="text" name="nama" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Sesuai KTP" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">NIK</label>
                <input type="number" name="nik" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="16 Digit NIK" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Nomor HP (WhatsApp)</label>
                <input type="text" name="nomor_hp" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Contoh: 0812..." required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Alamat Domisili</label>
                <textarea name="alamat" rows="3" class="w-full px-3 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-pink-300" required></textarea>
            </div>

            <div class="flex flex-col gap-3">
                <button type="submit" class="w-full bg-sehat-pink text-white font-bold py-3 rounded hover:bg-pink-600 transition shadow-lg shadow-pink-500/30">
                    KIRIM PENDAFTARAN
                </button>
                <a href="../index.php" class="w-full text-center text-gray-500 text-sm hover:text-sehat-pink">Batal / Kembali</a>
            </div>
        </form>
    </div>

</body>
</html>