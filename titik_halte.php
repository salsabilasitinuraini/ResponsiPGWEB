<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "responsi_pgweb";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <title>Data Halte Kota Magelang</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            background-color: #1F509A;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            position: fixed;
            top: 0;
            width: 96%;
            z-index: 1000;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header h1 {
            margin: 0;
            font-size: 1.8rem;
        }
        .nav-menu {
            display: flex;
            gap: 20px;
            position: relative;
        }
        .nav-menu a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
        }
        .nav-menu a:hover {
            text-decoration: underline;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
        }
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }
        .dropdown-content a:hover {
            background-color: #ddd;
        }
        .dropdown:hover .dropdown-content {
            display: block;
        }
        table {
            border-collapse: collapse;
            width: 90%;
            margin: 20px auto 20px;
            background-color: white;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ccc;
        }
        th {
            background-color: #78B3CE;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #F1F9F9;
        }
        .map-link {
            color: #007BFF;
            text-decoration: none;
        }
        .map-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="header">
    <h1>SchoolRide</h1>
    <nav class="nav-menu">
        <a href="index.html">Home</a>
        <div class="dropdown">
            <a href="#">Data</a>
            <div class="dropdown-content">
                <a href="titik_halte.php">Titik Halte</a>
                <a href="titik_pendidikan.php">Titik Pendidikan</a>
            </div>
        </div>
        <a href="info.html">Info</a>
        <a href="peta.html">Map</a>
        <a href="profil.html">Profil</a>
    </nav>
</div>

<h2 style="text-align: center; margin-top: 100px;">Data Halte dan Terminal Kota Magelang</h2>

<?php
// Query untuk mengambil data dari tabel titik_halte
$sql = "SELECT * FROM titik_halte";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div style='display: flex; justify-content: center;'>
            <table>
            <tr>
                <th>No</th>
                <th>Nama Halte</th>
                <th>Lokasi</th>
                <th>Longitude</th>
                <th>Latitude</th>
                <th>Keterangan</th>
                <th>Link Google Maps</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row["No"]) . "</td>
                <td>" . htmlspecialchars($row["Nama Halte"]) . "</td>
                <td>" . htmlspecialchars($row["Lokasi"]) . "</td>
                <td>" . htmlspecialchars($row["Longitude"]) . "</td>
                <td>" . htmlspecialchars($row["Latitude"]) . "</td>
                <td>" . htmlspecialchars($row["Keterangan"]) . "</td>
                <td><a class='map-link' href='https://www.google.com/maps?q=" 
                    . htmlspecialchars($row["Latitude"]) . "," 
                    . htmlspecialchars($row["Longitude"]) . "' target='_blank'>Buka Peta</a></td>
              </tr>";
    }
    echo "</table></div>";
} else {
    echo "<p style='text-align: center;'>Data tidak ditemukan</p>";
}

// Menutup koneksi
$conn->close();
?>
</body>
</html>
