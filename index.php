<?php
// index.php - Halaman Utama (Pink Theme + Background "Lala")

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
            min-height: 100vh;
            padding: 20px;
            background: #1a0a0a;
            position: relative;
            overflow-x: hidden;
        }
        
        /* BACKGROUND DENGAN NAMA "Lala" */
        body::before {
            content: "Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala Lala";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            font-size: 120px;
            font-weight: 900;
            color: rgba(255, 182, 193, 0.04);
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            z-index: -1;
            pointer-events: none;
            letter-spacing: 20px;
            line-height: 1.5;
            text-shadow: 0 0 30px rgba(255, 105, 180, 0.05);
            transform: rotate(-15deg) scale(1.5);
            white-space: pre-wrap;
            word-break: break-all;
            padding: 50px;
        }
        
        /* Tambahan background glow pink */
        body::after {
            content: '';
            position: fixed;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(ellipse at center, rgba(255, 20, 147, 0.05) 0%, transparent 70%);
            z-index: -1;
            pointer-events: none;
            animation: glowPulse 8s ease-in-out infinite;
        }
        
        @keyframes glowPulse {
            0%, 100% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.3); opacity: 1; }
        }
        
        .container { max-width: 1400px; margin: 0 auto; position: relative; z-index: 1; }
        
        /* Navbar */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: rgba(255, 182, 193, 0.15);
            border-radius: 12px;
            margin-bottom: 30px;
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 105, 180, 0.3);
            flex-wrap: wrap;
            gap: 15px;
            box-shadow: 0 8px 32px rgba(255, 20, 147, 0.15);
        }
        .navbar .logo { 
            font-size: 1.5rem; 
            font-weight: bold; 
            color: #ff69b4; 
            text-shadow: 0 0 20px rgba(255, 105, 180, 0.3);
        }
        .navbar .logo span { color: #fff; }
        
        .search-box {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .search-box input {
            padding: 10px 15px;
            border-radius: 8px;
            border: 2px solid rgba(255, 105, 180, 0.3);
            background: rgba(255, 182, 193, 0.1);
            color: #fff;
            font-size: 1rem;
            width: 250px;
            transition: all 0.3s ease;
        }
        .search-box input::placeholder { color: rgba(255,255,255,0.5); }
        .search-box input:focus {
            outline: none;
            border-color: #ff69b4;
            background: rgba(255, 182, 193, 0.15);
            box-shadow: 0 0 20px rgba(255, 105, 180, 0.2);
        }
        .search-box button {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            background: #ff69b4;
            color: #fff;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .search-box button:hover { 
            background: #ff1493; 
            transform: scale(1.05);
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.3);
        }
        .search-box .btn-reset {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .search-box .btn-reset:hover { 
            background: rgba(255,255,255,0.2);
            box-shadow: 0 0 20px rgba(255,255,255,0.1);
        }
        
        h1 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 40px;
            color: #ff69b4;
            text-shadow: 0 0 40px rgba(255, 105, 180, 0.3), 0 0 80px rgba(255, 20, 147, 0.1);
        }
        
        /* Counter */
        .counter {
            text-align: center;
            margin-bottom: 20px;
            color: rgba(255,255,255,0.6);
            font-size: 0.95rem;
        }
        .counter span { color: #ff69b4; font-weight: bold; }
        
        .studio-section {
            margin-bottom: 50px;
            padding: 20px;
            border-radius: 15px;
            background: rgba(255, 182, 193, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 105, 180, 0.1);
        }
        .studio-section h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 3px solid;
        }
        .regular h2 { color: #ff6b9d; border-color: #ff6b9d; }
        .imax h2 { color: #ff4d6d; border-color: #ff4d6d; }
        .velvet h2 { color: #ff1493; border-color: #ff1493; }
        
        .tiket-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            transition: all 0.3s ease;
        }
        .tiket-card {
            background: rgba(255, 182, 193, 0.08);
            border-radius: 12px;
            padding: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 105, 180, 0.15);
            animation: fadeInUp 0.5s ease;
        }
        .tiket-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(255, 20, 147, 0.2);
            border-color: rgba(255, 105, 180, 0.4);
        }
        .tiket-card.hidden {
            display: none;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .tiket-card h3 { color: #ff69b4; font-size: 1.3rem; margin-bottom: 12px; }
        .tiket-card p { margin: 8px 0; font-size: 0.95rem; color: rgba(255,255,255,0.8); }
        
        .fasilitas {
            margin: 15px 0;
            padding: 12px;
            background: rgba(255, 182, 193, 0.08);
            border-radius: 8px;
            border: 1px solid rgba(255, 105, 180, 0.1);
        }
        .fasilitas ul { list-style: none; padding-left: 10px; margin-top: 5px; }
        .fasilitas ul li { padding: 4px 0; color: rgba(255,255,255,0.7); font-size: 0.9rem; }
        .fasilitas ul li strong { color: #ff69b4; }
        
        .total-harga {
            margin-top: 15px;
            padding: 12px;
            background: rgba(255, 105, 180, 0.15);
            border-radius: 8px;
            text-align: center;
            font-size: 1.2rem;
            border: 1px solid rgba(255, 105, 180, 0.2);
            color: #ff69b4;
        }
        
        /* Tombol Detail */
        .btn-detail {
            display: block;
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            background: linear-gradient(135deg, #ff69b4, #ff1493);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .btn-detail:hover { 
            transform: scale(1.02);
            box-shadow: 0 0 30px rgba(255, 20, 147, 0.3);
        }
        
        .velvet .tiket-card { border-left: 4px solid #ff1493; background: rgba(255, 20, 147, 0.08); }
        .regular .tiket-card { border-left: 4px solid #ff6b9d; }
        .imax .tiket-card { border-left: 4px solid #ff4d6d; }
        
        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background: rgba(0,0,0,0.7);
            backdrop-filter: blur(8px);
            animation: fadeIn 0.3s ease;
        }
        .modal.show { display: block; }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        .modal-content {
            background: linear-gradient(135deg, #1a0a0a, #2d0a1a);
            margin: 5% auto;
            padding: 30px;
            border-radius: 15px;
            max-width: 600px;
            border: 1px solid rgba(255, 105, 180, 0.3);
            animation: slideDown 0.3s ease;
            position: relative;
            box-shadow: 0 20px 60px rgba(255, 20, 147, 0.2);
        }
        @keyframes slideDown {
            from { transform: translateY(-50px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
        
        .modal-close {
            position: absolute;
            top: 15px;
            right: 25px;
            font-size: 2rem;
            font-weight: bold;
            color: rgba(255,255,255,0.5);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .modal-close:hover { color: #ff69b4; transform: rotate(90deg); }
        
        .modal-content h2 {
            color: #ff69b4;
            margin-bottom: 20px;
            border-bottom: 2px solid rgba(255, 105, 180, 0.2);
            padding-bottom: 10px;
        }
        .modal-content .info-item {
            padding: 10px 0;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        .modal-content .info-item label {
            color: rgba(255,255,255,0.5);
            font-size: 0.85rem;
            display: block;
        }
        .modal-content .info-item .value {
            font-size: 1.1rem;
            font-weight: bold;
            color: #fff;
        }
        .modal-content .fasilitas-list {
            margin: 15px 0;
            padding: 15px;
            background: rgba(255, 182, 193, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(255, 105, 180, 0.1);
        }
        .modal-content .fasilitas-list ul {
            list-style: none;
            padding-left: 10px;
        }
        .modal-content .fasilitas-list ul li {
            padding: 5px 0;
            color: rgba(255,255,255,0.7);
        }
        .modal-content .fasilitas-list ul li strong { color: #ff69b4; }
        .modal-content .total-price {
            text-align: center;
            padding: 15px;
            margin-top: 20px;
            background: rgba(255, 105, 180, 0.15);
            border-radius: 10px;
            border: 2px solid rgba(255, 105, 180, 0.3);
        }
        .modal-content .total-price .price {
            font-size: 1.8rem;
            font-weight: bold;
            color: #ff69b4;
        }
        .modal-content .total-price .label {
            font-size: 1rem;
            color: rgba(255,255,255,0.5);
        }
        
        .badge-studio {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
            margin-top: 5px;
        }
        .badge-regular { background: #ff6b9d; color: #fff; }
        .badge-imax { background: #ff4d6d; color: #fff; }
        .badge-velvet { background: #ff1493; color: #fff; }
        
        @media (max-width: 768px) {
            h1 { font-size: 1.8rem; }
            .tiket-grid { grid-template-columns: 1fr; }
            .navbar { flex-direction: column; align-items: stretch; }
            .search-box { flex-direction: column; }
            .search-box input { width: 100%; }
            .modal-content { margin: 10% 15px; padding: 20px; }
            body::before {
                font-size: 60px;
                transform: rotate(-10deg) scale(1.2);
                letter-spacing: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        <nav class="navbar">
            <div class="logo">🎀 <span>Cinema</span>App</div>
            <div class="search-box">
                <input type="text" id="searchInput" placeholder="🔍 Cari film..." onkeyup="filterFilm()">
                <button onclick="filterFilm()">Cari</button>
                <button class="btn-reset" onclick="resetFilter()">Reset</button>
            </div>
        </nav>
        
        <h1>🎀 Sistem Manajemen Tiket Bioskop 🎬</h1>
        
        <div class="counter" id="counter">
            Menampilkan <span id="totalCount">0</span> film
        </div>
        
        <!-- STUDIO REGULAR -->
        <div class="studio-section regular">
            <h2>🎫 Studio Regular</h2>
            <div class="tiket-grid" id="gridRegular">
                <?php foreach ($tiketRegular as $tiket): ?>
                <div class="tiket-card" data-nama="<?= strtolower($tiket->getNamaFilm()) ?>">
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
                    <button class="btn-detail" onclick="showDetail(<?= $tiket->getIdTiket() ?>)">
                        📋 Lihat Detail
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- STUDIO IMAX -->
        <div class="studio-section imax">
            <h2>🎬 Studio IMAX</h2>
            <div class="tiket-grid" id="gridIMAX">
                <?php foreach ($tiketIMAX as $tiket): ?>
                <div class="tiket-card" data-nama="<?= strtolower($tiket->getNamaFilm()) ?>">
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
                    <button class="btn-detail" onclick="showDetail(<?= $tiket->getIdTiket() ?>)">
                        📋 Lihat Detail
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- STUDIO VELVET -->
        <div class="studio-section velvet">
            <h2>✨ Studio Velvet (Premium)</h2>
            <div class="tiket-grid" id="gridVelvet">
                <?php foreach ($tiketVelvet as $tiket): ?>
                <div class="tiket-card premium" data-nama="<?= strtolower($tiket->getNamaFilm()) ?>">
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
                    <button class="btn-detail" onclick="showDetail(<?= $tiket->getIdTiket() ?>)">
                        📋 Lihat Detail
                    </button>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL -->
    <div id="detailModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <h2>📋 Detail Tiket</h2>
            <div id="modalBody"></div>
        </div>
    </div>

    <script>
        // === DATA TIKET ===
        const tiketData = {
            <?php
            $allData = array_merge($tiketRegular, $tiketIMAX, $tiketVelvet);
            foreach ($allData as $tiket) {
                $id = $tiket->getIdTiket();
                $nama = addslashes($tiket->getNamaFilm());
                $jadwal = $tiket->getJadwalTayang();
                $kursi = $tiket->getJumlahKursi();
                $hargaDasar = $tiket->getHargaDasarTiket();
                $total = $tiket->hitungTotalHarga();
                $studio = $tiket->getJenisStudio();
                $fasilitas = $tiket->tampilkanInfoFasilitas();
                $fasilitasJson = json_encode($fasilitas);
                echo "$id: { nama: '$nama', jadwal: '$jadwal', kursi: $kursi, hargaDasar: $hargaDasar, total: $total, studio: '$studio', fasilitas: $fasilitasJson },";
            }
            ?>
        };

        // === FILM SEARCH ===
        function filterFilm() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const cards = document.querySelectorAll('.tiket-card');
            let count = 0;

            cards.forEach(card => {
                const nama = card.getAttribute('data-nama');
                if (nama.includes(keyword)) {
                    card.classList.remove('hidden');
                    count++;
                } else {
                    card.classList.add('hidden');
                }
            });

            document.getElementById('totalCount').textContent = count;
        }

        function resetFilter() {
            document.getElementById('searchInput').value = '';
            filterFilm();
        }

        // === SHOW MODAL DETAIL ===
        function showDetail(id) {
            const data = tiketData[id];
            if (!data) {
                alert('Data tidak ditemukan!');
                return;
            }

            const modal = document.getElementById('detailModal');
            const body = document.getElementById('modalBody');

            let fasilitasHtml = '<ul>';
            for (const [key, value] of Object.entries(data.fasilitas)) {
                fasilitasHtml += `<li><strong>${key}:</strong> ${value}</li>`;
            }
            fasilitasHtml += '</ul>';

            const tanggal = new Date(data.jadwal);
            const formattedDate = tanggal.toLocaleDateString('id-ID') + ' ' + 
                                 tanggal.toLocaleTimeString('id-ID', {hour: '2-digit', minute:'2-digit'});

            let badgeClass = 'badge-regular';
            if (data.studio === 'IMAX') badgeClass = 'badge-imax';
            if (data.studio === 'Velvet') badgeClass = 'badge-velvet';

            body.innerHTML = `
                <div class="info-item">
                    <label>🎬 Nama Film</label>
                    <div class="value">${data.nama}</div>
                </div>
                <div class="info-item">
                    <label>🏷️ Jenis Studio</label>
                    <div class="value"><span class="badge-studio ${badgeClass}">${data.studio}</span></div>
                </div>
                <div class="info-item">
                    <label>📅 Jadwal Tayang</label>
                    <div class="value">${formattedDate}</div>
                </div>
                <div class="info-item">
                    <label>💺 Jumlah Kursi</label>
                    <div class="value">${data.kursi}</div>
                </div>
                <div class="info-item">
                    <label>💰 Harga Dasar</label>
                    <div class="value">Rp ${data.hargaDasar.toLocaleString('id-ID')}</div>
                </div>
                <div class="fasilitas-list">
                    <strong>🎁 Fasilitas:</strong>
                    ${fasilitasHtml}
                </div>
                <div class="total-price">
                    <div class="label">Total Harga</div>
                    <div class="price">Rp ${data.total.toLocaleString('id-ID')}</div>
                </div>
                <div style="text-align:center;margin-top:20px;">
                    <button onclick="closeModal()" style="padding:10px 30px;background:linear-gradient(135deg,#ff69b4,#ff1493);color:#fff;border:none;border-radius:8px;font-weight:bold;cursor:pointer;transition:all 0.3s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        ✅ Tutup
                    </button>
                </div>
            `;

            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        }

        // === CLOSE MODAL ===
        function closeModal() {
            document.getElementById('detailModal').classList.remove('show');
            document.body.style.overflow = 'auto';
        }

        // === CLICK OUTSIDE MODAL ===
        window.onclick = function(event) {
            const modal = document.getElementById('detailModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        // === ESC KEY ===
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // === COUNTER AWAL ===
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.tiket-card:not(.hidden)');
            document.getElementById('totalCount').textContent = cards.length;
        });
    </script>
</body>
</html>