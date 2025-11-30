<?php
session_start();
include '../../config/koneksi.php';
$id_peserta = $_GET['id'];

$peserta = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM peserta WHERE id_peserta='$id_peserta'"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Laporan Hasil - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function cetakHalaman() { window.print(); }
    </script>
</head>
<body class="bg-gray-100 py-10">

    <div class="max-w-2xl mx-auto bg-white p-10 rounded-lg shadow-xl">
        
        <div class="text-center border-b-2 border-gray-800 pb-4 mb-6">
            <h1 class="text-3xl font-bold text-pink-600">SehatYuk</h1>
            <p class="text-gray-600">Laporan Hasil Pemeriksaan Kesehatan Gratis</p>
        </div>

        <table class="w-full mb-6 text-sm">
            <tr>
                <td class="font-bold w-32 py-1">Nama Pasien</td>
                <td>: <?php echo $peserta['nama']; ?></td>
            </tr>
            <tr>
                <td class="font-bold py-1">NIK</td>
                <td>: <?php echo $peserta['nik']; ?></td>
            </tr>
            <tr>
                <td class="font-bold py-1">Tanggal Periksa</td>
                <td>: <?php echo date('d F Y'); ?></td>
            </tr>
        </table>

        <table class="w-full border-collapse border border-gray-300 mb-8">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border border-gray-300 p-2 text-left">Jenis Pemeriksaan</th>
                    <th class="border border-gray-300 p-2 text-left">Hasil</th>
                    <th class="border border-gray-300 p-2 text-left">Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
              
                $query = mysqli_query($koneksi, "SELECT hasil_pemeriksaan.*, layanan.nama_layanan, layanan.satuan 
                                                 FROM hasil_pemeriksaan 
                                                 JOIN layanan ON hasil_pemeriksaan.id_layanan = layanan.id_layanan 
                                                 WHERE id_peserta='$id_peserta'");
                
                while($row = mysqli_fetch_assoc($query)){
                ?>
                <tr>
                    <td class="border border-gray-300 p-2"><?php echo $row['nama_layanan']; ?></td>
                    <td class="border border-gray-300 p-2 font-bold"><?php echo $row['hasil_value']; ?></td>
                    <td class="border border-gray-300 p-2 text-gray-500"><?php echo $row['satuan']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div class="flex justify-end mt-10">
            <div class="text-center">
                <p class="mb-16">Petugas Pemeriksa,</p>
                <p class="font-bold border-b border-black inline-block min-w-[150px]">( <?php echo $_SESSION['username']; ?> )</p>
            </div>
        </div>

        <div class="mt-8 flex gap-4 no-print">
            <button onclick="cetakHalaman()" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">🖨️ Cetak Laporan</button>
            <a href="input_hasil.php" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Kembali</a>
        </div>

        <style>
            @media print {
                .no-print { display: none; }
                body { background: white; }
                .shadow-xl { box-shadow: none; }
            }
        </style>
    </div>

</body>
</html>