<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - MedQueue</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: rgb(153, 228, 218);
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }

        .header {
            text-align: center;
            padding: 30px 2px 10px;
        }

        .header img {
            width: 287px;
            margin-bottom: 17px;
        }

        .header h1 {
            margin: 0;
            font-size: 32px;
            letter-spacing: 1px;
        }

        .menu {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 22px;
        }

        .menu a {
            text-decoration: none;
            margin: 12px 0;
            width: 250px;
        }

        .menu button {
            width: 100%;
            padding: 14px;
            font-size: 16px;
            background-color: white;
            color: #4DB6AC;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .menu button:hover {
            background-color:rgb(153, 228, 218);
            color: white;
        }
    </style>
</head>
<body>

    <div class="header">
        <!-- Ganti dengan <img src="namafile.png"> kalau logomu nanti tersedia -->
        <img src="assets/meme.png" alt="Logo MedQueue" />
        <h1>MedQueue</h1>
    </div>

    <div class="menu">
        <a href="daftar.php"><button>Daftar Antrean</button></a>
        <a href="antrean.php"><button>Lihat Antrean</button></a>
        <a href="admin/login_admin.php"><button>Admin</button></a>
        <a href="petugas/login_petugas.php"><button>Petugas</button></a>
    </div>

</body>
</html>
