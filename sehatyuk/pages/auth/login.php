<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sistem - SehatYuk</title>
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
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-sm w-full border-t-4 border-sehat-pink">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-sehat-abu">Login Sistem</h1>
            <p class="text-gray-500 text-sm">Masuk sebagai Petugas atau Peserta</p>
        </div>

        <form action="/sehatyuk/process/cek_login.php" method="POST">
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username / NIK</label>
                
                <input type="text" name="username" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Username Admin atau NIK Peserta" required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password / No. HP</label>
                
                <input type="password" name="password" class="w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-pink-300" placeholder="Password Admin atau No HP WA" required>
            </div>

            <button type="submit" class="w-full bg-sehat-pink text-white font-bold py-2 px-4 rounded hover:bg-pink-600 transition duration-300">
                MASUK
            </button>
        </form>
        
        <div class="mt-4 text-center">
            <a href="../../index.php" class="text-sm text-gray-500 hover:text-sehat-pink">Kembali ke Beranda</a>
        </div>
        
        <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'){ ?>
            <p class="text-red-500 text-xs text-center mt-3 italic">Login Gagal! Username/NIK atau Password salah.</p>
        <?php } ?>
    </div>

</body>
</html>