<?php
// classes/TiketVelvet.php

require_once 'Tiket.php';

class TiketVelvet extends Tiket {
    // Properti tambahan khusus Velvet
    private $bantalSelimutPack;
    private $layananButler;

    // Constructor
    public function __construct($data) {
        parent::__construct($data); // Panggil constructor parent
        $this->bantalSelimutPack = $data['bantal_selimut_pack'] ?? 'Standard';
        $this->layananButler = $data['layanan_butler'] ?? 'Tidak tersedia';
    }

    // Getter untuk properti tambahan
    public function getBantalSelimutPack() { 
        return $this->bantalSelimutPack; 
    }
    
    public function getLayananButler() { 
        return $this->layananButler; 
    }

    // Implementasi method abstract dari parent (wajib)
    public function hitungTotalHarga() {
        // Nanti diisi di Tahap 5
        return 0;
    }

    // Implementasi method abstract dari parent (wajib)
    public function tampilkanInfoFasilitas() {
        return [
            'Bantal Selimut Pack' => $this->bantalSelimutPack,
            'Layanan Butler' => $this->layananButler
        ];
    }
}
?>