<?php
session_start();
include '../../config/koneksi.php';
$id_peserta = $_GET['id'];

// Ambil data peserta
$q_peserta = mysqli_query($koneksi, "SELECT * FROM peserta WHERE id_peserta='$id_peserta'");
$peserta = mysqli_fetch_assoc($q_peserta);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Form Pemeriksaan - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }</script>
</head>
<body class="bg-gray-100 flex justify-center py-10">

    <div class="bg-white p-8 rounded shadow-lg w-full max-w-2xl border-t-4 border-sehat-pink">
        <h2 class="text-2xl font-bold mb-2">Form Pemeriksaan Kesehatan</h2>
        <div class="bg-pink-50 p-4 rounded mb-6 border border-pink-100">
            <p><strong>Nama Pasien:</strong> <?php echo $peserta['nama']; ?></p>
            <p><strong>NIK:</strong> <?php echo $peserta['nik']; ?></p>
        </div>

        <form action="../../process/hasil_process.php" method="POST">
            <input type="hidden" name="id_peserta" value="<?php echo $id_peserta; ?>">

            <?php
            $q_layanan = mysqli_query($koneksi, "SELECT * FROM layanan");
            while($layanan = mysqli_fetch_assoc($q_layanan)){
            ?>
                <div class="mb-5 border-b pb-4">
                    <label class="block font-bold text-sehat-abu mb-1">
                        <?php echo $layanan['nama_layanan']; ?> 
                        <span class="text-sm font-normal text-gray-500">(Satuan: <?php echo $layanan['satuan']; ?>)</span>
                    </label>
                    
                    <input type="hidden" name="id_layanan[]" value="<?php echo $layanan['id_layanan']; ?>">
                    
                    <?php if($layanan['nama_layanan'] == 'Konsultasi Gizi'){ ?>
                        <textarea name="nilai_hasil[]" rows="2" class="w-full border p-2 rounded" placeholder="Catatan dokter..."></textarea>
                    <?php } else { ?>
                        <input type="text" name="nilai_hasil[]" class="w-full border p-2 rounded" placeholder="Masukkan hasil (Angka)" required>
                    <?php } ?>
                </div>
            <?php } ?>

            <div class="flex gap-2 mt-6">
                <button type="submit" class="w-full bg-sehat-pink text-white font-bold py-3 rounded hover:bg-pink-600">
                    SIMPAN HASIL MEDIS
                </button>
                <a href="input_hasil.php" class="w-1/4 text-center border border-gray-300 py-3 rounded hover:bg-gray-100">Batal</a>
            </div>
        </form>
    </div>
</body>
</html>