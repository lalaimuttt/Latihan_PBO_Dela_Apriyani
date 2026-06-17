<?php
// classes/TiketIMAX.php

require_once 'Tiket.php';

class TiketIMAX extends Tiket {
    // Properti tambahan khusus IMAX
    private $kacamata3dId;
    private $efekGerakFitur;

    // Constructor
    public function __construct($data) {
        parent::__construct($data); // Panggil constructor parent
        $this->kacamata3dId = $data['kacamata_3d_id'] ?? 'Tidak tersedia';
        $this->efekGerakFitur = $data['efek_gerak_fitur'] ?? 'Tidak tersedia';
    }

    // Getter untuk properti tambahan
    public function getKacamata3dId() { 
        return $this->kacamata3dId; 
    }
    
    public function getEfekGerakFitur() { 
        return $this->efekGerakFitur; 
    }

    // Implementasi method abstract dari parent (wajib)
    public function hitungTotalHarga() {
        // Nanti diisi di Tahap 5
        return 0;
    }

    // Implementasi method abstract dari parent (wajib)
    public function tampilkanInfoFasilitas() {
        return [
            'Kacamata 3D ID' => $this->kacamata3dId,
            'Efek Gerak Fitur' => $this->efekGerakFitur
        ];
    }
}
?>