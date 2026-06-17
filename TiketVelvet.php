<?php
// classes/TiketVelvet.php

require_once 'Tiket.php';

class TiketVelvet extends Tiket {
    // Properti tambahan khusus Velvet
    private $bantalSelimutPack;
    private $layananButler;

    // Constructor
    public function __construct($data) {
        parent::__construct($data);
        $this->bantalSelimutPack = $data['bantal_selimut_pack'] ?? 'Standard';
        $this->layananButler = $data['layanan_butler'] ?? 'Tidak tersedia';
    }

    // Getter
    public function getBantalSelimutPack() { 
        return $this->bantalSelimutPack; 
    }
    
    public function getLayananButler() { 
        return $this->layananButler; 
    }

    // ✅ TAHAP 5: OVERRIDE method hitungTotalHarga()
    // Velvet: Total = (jumlah_kursi * hargaDasarTiket) * 1.50
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) * 1.50;
    }

    // Implementasi method abstract
    public function tampilkanInfoFasilitas() {
        return [
            'Bantal Selimut Pack' => $this->bantalSelimutPack,
            'Layanan Butler' => $this->layananButler
        ];
    }
}
?>