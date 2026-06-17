<?php
// index.php - Halaman Utama (Versi Sederhana)

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/database.php';
require_once 'classes/Tiket.php';
require_once 'classes/TiketRegular.php';
require_once 'classes/TiketIMAX.php';
require_once 'classes/TiketVelvet.php';

$db = new Database();
$connection = $db->getConnection();

$query = "SELECT * FROM tabel_tiket ORDER BY jenis_studio, nama_film";
$result = $connection->query($query);

$tiketRegular = [];
$tiketIMAX = [];
$tiketVelvet = [];

while ($row = $result->fetch_assoc()) {
    switch ($row['jenis_studio']) {
        case 'Regular': $tiketRegular[] = new TiketRegular($row); break;
        case 'IMAX': $tiketIMAX[] = new TiketIMAX($row); break;
        case 'Velvet': $tiketVelvet[] = new TiketVelvet($row); break;
    }
}
$db->closeConnection();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Tiket Bioskop</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #fff;
            min-height: 100vh;
            padding: 20px;
        }
        .container { max-width: 1400px; margin: 0 auto; }
        
        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #f5c842;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .studio-section {
            margin-bottom: 50px;
            padding: 20px;
            border-radius: 15px;
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
        }
        .studio-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid;
        }
        .regular h2 { color: #4ecdc4; border-color: #4ecdc4; }
        .imax h2 { color: #ff6b6b; border-color: #ff6b6b; }
        .velvet h2 { color: #ffd93d; border-color: #ffd93d; }
        
        .tiket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        .tiket-card {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .tiket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        }
        .tiket-card h3 { color: #f5c842; font-size: 1.3rem; margin-bottom: 12px; }
        .tiket-card p { margin: 8px 0; font-size: 0.95rem; color: #ddd; }
        
        .fasilitas {
            margin: 15px 0;
            padding: 12px;
            background: rgba(255,255,255,0.05);
            border-radius: 8px;
        }
        .fasilitas ul { list-style: none; padding-left: 10px; margin-top: 5px; }
        .fasilitas ul li { padding: 4px 0; color: #bbb; font-size: 0.9rem; }
        
        .total-harga {
            margin-top: 15px;
            padding: 12px;
            background: rgba(245, 200, 66, 0.2);
            border-radius: 8px;
            text-align: center;
            font-size: 1.2rem;
            border: 1px solid rgba(245, 200, 66, 0.3);
        }
        
        .velvet .tiket-card { border-left: 4px solid #ffd93d; background: rgba(255, 215, 0, 0.08); }
        .regular .tiket-card { border-left: 4px solid #4ecdc4; }
        .imax .tiket-card { border-left: 4px solid #ff6b6b; }
        
        @media (max-width: 768px) {
            h1 { font-size: 1.8rem; }
            .tiket-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🎬 Sistem Manajemen Tiket Bioskop</h1>
        
        <!-- STUDIO REGULAR -->
        <div class="studio-section regular">
            <h2>🎫 Studio Regular</h2>
            <div class="tiket-grid">
                <?php foreach ($tiketRegular as $tiket): ?>
                <div class="tiket-card">
                    <h3><?= htmlspecialchars($tiket->getNamaFilm()) ?></h3>
                    <p><strong>ID Tiket:</strong> <?= $tiket->getIdTiket() ?></p>
                    <p><strong>Jadwal:</strong> <?= date('d/m/Y H:i', strtotime($tiket->getJadwalTayang())) ?></p>
                    <p><strong>Jumlah Kursi:</strong> <?= $tiket->getJumlahKursi() ?></p>
                    <p><strong>Harga Dasar:</strong> Rp <?= number_format($tiket->getHargaDasarTiket(), 0, ',', '.') ?></p>
                    <div class="fasilitas">
                        <strong>Fasilitas:</strong>
                        <ul>
                            <?php foreach ($tiket->tampilkanInfoFasilitas() as $key => $value): ?>
                                <li><?= $key ?>: <?= htmlspecialchars($value) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="total-harga">
                        <strong>Total Harga:</strong> Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- STUDIO IMAX -->
        <div class="studio-section imax">
            <h2>🎬 Studio IMAX</h2>
            <div class="tiket-grid">
                <?php foreach ($tiketIMAX as $tiket): ?>
                <div class="tiket-card">
                    <h3><?= htmlspecialchars($tiket->getNamaFilm()) ?></h3>
                    <p><strong>ID Tiket:</strong> <?= $tiket->getIdTiket() ?></p>
                    <p><strong>Jadwal:</strong> <?= date('d/m/Y H:i', strtotime($tiket->getJadwalTayang())) ?></p>
                    <p><strong>Jumlah Kursi:</strong> <?= $tiket->getJumlahKursi() ?></p>
                    <p><strong>Harga Dasar:</strong> Rp <?= number_format($tiket->getHargaDasarTiket(), 0, ',', '.') ?></p>
                    <div class="fasilitas">
                        <strong>Fasilitas:</strong>
                        <ul>
                            <?php foreach ($tiket->tampilkanInfoFasilitas() as $key => $value): ?>
                                <li><?= $key ?>: <?= htmlspecialchars($value) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="total-harga">
                        <strong>Total Harga:</strong> Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- STUDIO VELVET -->
        <div class="studio-section velvet">
            <h2>✨ Studio Velvet (Premium)</h2>
            <div class="tiket-grid">
                <?php foreach ($tiketVelvet as $tiket): ?>
                <div class="tiket-card premium">
                    <h3><?= htmlspecialchars($tiket->getNamaFilm()) ?></h3>
                    <p><strong>ID Tiket:</strong> <?= $tiket->getIdTiket() ?></p>
                    <p><strong>Jadwal:</strong> <?= date('d/m/Y H:i', strtotime($tiket->getJadwalTayang())) ?></p>
                    <p><strong>Jumlah Kursi:</strong> <?= $tiket->getJumlahKursi() ?></p>
                    <p><strong>Harga Dasar:</strong> Rp <?= number_format($tiket->getHargaDasarTiket(), 0, ',', '.') ?></p>
                    <div class="fasilitas">
                        <strong>Fasilitas:</strong>
                        <ul>
                            <?php foreach ($tiket->tampilkanInfoFasilitas() as $key => $value): ?>
                                <li><?= $key ?>: <?= htmlspecialchars($value) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="total-harga">
                        <strong>Total Harga:</strong> Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.') ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</body>
</html>