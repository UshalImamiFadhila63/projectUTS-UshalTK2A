<?php
session_start();
if($_SESSION['status'] != "login"){
    header("location:../auth/login.php?pesan=belum_login");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - SehatYuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sehat-pink': '#ec4899',
                        'sehat-abu': '#334155',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 font-sans">

    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-xl font-bold text-sehat-pink">Admin Panel</span>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-600 mr-4">Halo, <?php echo $_SESSION['username']; ?></span>
                    <a href="../../process/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded text-sm font-medium">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-sehat-abu mb-8">Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <a href="data_jadwal.php" class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-sehat-pink transition">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">📅 Kelola Jadwal</h5>
                <p class="font-normal text-gray-700">Buat jadwal pemeriksaan baru atau edit yang sudah ada.</p>
            </a>

            <a href="data_peserta.php" class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-sehat-pink transition">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">👥 Data Peserta</h5>
                <p class="font-normal text-gray-700">Lihat daftar masyarakat yang sudah mendaftar.</p>
            </a>

            <a href="input_hasil.php" class="block p-6 bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md hover:border-sehat-pink transition">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">📝 Input Hasil</h5>
                <p class="font-normal text-gray-700">Masukkan hasil pemeriksaan kesehatan peserta.</p>
            </a>

        </div>
    </div>

</body>
</html>