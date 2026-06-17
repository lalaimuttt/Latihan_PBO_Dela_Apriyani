<?php
// classes/TiketRegular.php

require_once 'Tiket.php';

class TiketRegular extends Tiket {
    // Properti tambahan khusus Regular
    private $tipeAudio;
    private $lokasiBaris;

    // Constructor
    public function __construct($data) {
        parent::__construct($data); // Panggil constructor parent
        $this->tipeAudio = $data['tipe_audio'] ?? 'Stereo';
        $this->lokasiBaris = $data['lokasi_baris'] ?? 'A1';
    }

    // Getter untuk properti tambahan
    public function getTipeAudio() { 
        return $this->tipeAudio; 
    }
    
    public function getLokasiBaris() { 
        return $this->lokasiBaris; 
    }

    // Implementasi method abstract dari parent (wajib)
    public function hitungTotalHarga() {
        // Nanti diisi di Tahap 5
        return 0;
    }

    // Implementasi method abstract dari parent (wajib)
    public function tampilkanInfoFasilitas() {
        return [
            'Tipe Audio' => $this->tipeAudio,
            'Lokasi Baris' => $this->lokasiBaris
        ];
    }
}
?>