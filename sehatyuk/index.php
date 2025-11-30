<?php include 'config/koneksi.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SehatYuk - Sistem Pemeriksaan Kesehatan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = { theme: { extend: { colors: { 'sehat-pink': '#ec4899', 'sehat-abu': '#334155' } } } }
    </script>
</head>

<body class="bg-gray-50 text-sehat-abu font-sans flex flex-col min-h-screen">

    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-sehat-pink text-white p-2 rounded-lg">🏥</div>
                <span class="text-2xl font-bold text-sehat-pink">SehatYuk</span>
            </div>
            <a href="pages/auth/login.php" class="text-sehat-pink font-semibold hover:bg-pink-50 px-4 py-2 rounded transition">Login Sistem →</a>
        </div>
    </nav>

    <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'sukses_daftar'){ ?>
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 text-center" role="alert">
            <p class="font-bold">Pendaftaran Berhasil!</p>
            <p>Silakan datang ke lokasi sesuai jadwal. Terima kasih.</p>
        </div>
    <?php } ?>

    <header class="text-center py-16 px-4 bg-gradient-to-b from-pink-50 to-gray-50">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-gray-800">Pemeriksaan Kesehatan <span class="text-sehat-pink">Gratis</span></h1>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">Daftarkan diri Anda untuk cek Gula Darah, Tensi, BB, TB, dan Konsultasi Gizi.</p>
    </header>

    <main class="max-w-4xl mx-auto px-4 pb-20 flex-grow">
        <h2 class="text-2xl font-bold mb-6 border-l-4 border-sehat-pink pl-3">📅 Jadwal Kegiatan Terdekat</h2>
        <div class="grid gap-6">
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM jadwal WHERE status_aktif = 1 ORDER BY tanggal_pemeriksaan ASC");
            if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
            ?>
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex flex-col md:flex-row justify-between items-center hover:shadow-md transition">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-xl font-bold text-gray-800"><?php echo $row['lokasi']; ?></h3>
                        <p class="text-sehat-pink font-medium mt-1">🕒 <?php echo date('d F Y', strtotime($row['tanggal_pemeriksaan'])); ?></p>
                    </div>
                    <a href="pages/daftar_pasien.php?id=<?php echo $row['id_jadwal']; ?>" class="bg-sehat-pink text-white px-6 py-3 rounded-lg font-semibold hover:bg-pink-600 transition shadow-lg shadow-pink-500/30">
                        Daftar Sekarang
                    </a>
                </div>
            <?php 
                } 
            } else {
                echo "<div class='text-center p-10 bg-white rounded shadow text-gray-500'>Belum ada jadwal pemeriksaan.</div>";
            }
            ?>
        </div>
    </main>

    <footer class="bg-sehat-abu text-white py-6 text-center mt-auto">
        <p>&copy; 2025 SehatYuk-ushal.</p>
    </footer>

</body>
</html>