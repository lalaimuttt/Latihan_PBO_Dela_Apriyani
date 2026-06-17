<?php
// classes/Tiket.php

abstract class Tiket {
    // Properti terenkapsulasi (protected)
    protected $id_tiket;
    protected $nama_film;
    protected $jadwal_tayang;
    protected $jumlah_kursi;
    protected $hargaDasarTiket;
    protected $jenis_studio;

    // Constructor
    public function __construct($data) {
        $this->id_tiket = $data['id_tiket'] ?? null;
        $this->nama_film = $data['nama_film'] ?? '';
        $this->jadwal_tayang = $data['jadwal_tayang'] ?? '';
        $this->jumlah_kursi = $data['jumlah_kursi'] ?? 0;
        $this->hargaDasarTiket = $data['harga_dasar_tiket'] ?? 0;
        $this->jenis_studio = $data['jenis_studio'] ?? '';
    }

    // Getter methods (untuk mengakses properti protected)
    public function getIdTiket() { 
        return $this->id_tiket; 
    }
    
    public function getNamaFilm() { 
        return $this->nama_film; 
    }
    
    public function getJadwalTayang() { 
        return $this->jadwal_tayang; 
    }
    
    public function getJumlahKursi() { 
        return $this->jumlah_kursi; 
    }
    
    public function getHargaDasarTiket() { 
        return $this->hargaDasarTiket; 
    }
    
    public function getJenisStudio() { 
        return $this->jenis_studio; 
    }

    // Abstract methods (wajib diimplementasikan oleh subclass)
    abstract public function hitungTotalHarga();
    abstract public function tampilkanInfoFasilitas();
}
?>