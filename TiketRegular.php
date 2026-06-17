<?php
// classes/TiketRegular.php

require_once 'Tiket.php';

class TiketRegular extends Tiket {
    // Properti tambahan khusus Regular
    private $tipeAudio;
    private $lokasiBaris;

    // Constructor
    public function __construct($data) {
        parent::__construct($data);
        $this->tipeAudio = $data['tipe_audio'] ?? 'Stereo';
        $this->lokasiBaris = $data['lokasi_baris'] ?? 'A1';
    }

    // Getter
    public function getTipeAudio() { 
        return $this->tipeAudio; 
    }
    
    public function getLokasiBaris() { 
        return $this->lokasiBaris; 
    }

    // ✅ TAHAP 5: OVERRIDE method hitungTotalHarga()
    // Regular: Total = jumlah_kursi * hargaDasarTiket (tanpa tambahan)
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->hargaDasarTiket;
    }

    // Implementasi method abstract
    public function tampilkanInfoFasilitas() {
        return [
            'Tipe Audio' => $this->tipeAudio,
            'Lokasi Baris' => $this->lokasiBaris
        ];
    }
}
?>