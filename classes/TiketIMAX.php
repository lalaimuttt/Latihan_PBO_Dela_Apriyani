<?php
// classes/TiketIMAX.php

require_once 'Tiket.php';

class TiketIMAX extends Tiket {
    // Properti tambahan khusus IMAX
    private $kacamata3dId;
    private $efekGerakFitur;

    // Constructor
    public function __construct($data) {
        parent::__construct($data);
        $this->kacamata3dId = $data['kacamata_3d_id'] ?? 'Tidak tersedia';
        $this->efekGerakFitur = $data['efek_gerak_fitur'] ?? 'Tidak tersedia';
    }

    // Getter
    public function getKacamata3dId() { 
        return $this->kacamata3dId; 
    }
    
    public function getEfekGerakFitur() { 
        return $this->efekGerakFitur; 
    }

    // ✅ TAHAP 5: OVERRIDE method hitungTotalHarga()
    // IMAX: Total = (jumlah_kursi * hargaDasarTiket) + 35000
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->hargaDasarTiket) + 35000;
    }

    // Implementasi method abstract
    public function tampilkanInfoFasilitas() {
        return [
            'Kacamata 3D ID' => $this->kacamata3dId,
            'Efek Gerak Fitur' => $this->efekGerakFitur
        ];
    }
}
?>