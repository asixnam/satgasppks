// Database Type Definitions for Satgas PPKS

export interface Hero {
  id: number;
  nama_gambar: string;
  gambar: string;
  created_at: string;
  updated_at: string;
}

export interface Berita {
  id: number;
  judul: string;
  isi: string;
  gambar: string | null;
  created_at: string;
  updated_at: string;
}

export interface Edukasi {
  id: number;
  judul: string;
  konten: string;
  gambar: string | null;
  created_at: string;
  updated_at: string;
}

export interface Tim {
  id: number;
  nama: string;
  jabatan: string;
  deskripsi: string | null;
  foto: string | null;
  created_at: string;
  updated_at: string;
}

export interface VisiMisi {
  id: number;
  about: string;
  visi: string;
  misi: string;
  created_at: string;
  updated_at: string;
}

export interface Client {
  id: string;
  nama_lengkap: string;
  jenis_kelamin: 'Laki-laki' | 'Perempuan';
  status_korban: 'Disable' | 'Tidak';
  kategori_disable: string | null;
  status: string; // Mahasiswa, Dosen, Tendik, Masyarakat
  sumber_informasi: string | null;
  created_at: string;
  updated_at: string;
}

export interface Reporter {
  id: string;
  hubungan_pelapor_dengan_pelaku: string;
  nama_lengkap: string;
  tempat_lahir: string;
  tanggal_lahir: string;
  jenis_kelamin: 'Laki-laki' | 'Perempuan';
  usia: number;
  status_pelapor: string;
  no_telepon: string;
  email: string;
  alamat: string;
  keterangan_tambahan: string | null;
  created_at: string;
  updated_at: string;
}

export interface Perpetrator {
  id: string;
  hubungan_dengan_korban: string;
  nama: string;
  telepon: string | null;
  jenis_kelamin: 'Laki-laki' | 'Perempuan';
  keterangan: string;
  upload_bukti: string[] | null; // Stored as array of file paths/URLs
  created_at: string;
  updated_at: string;
}

export interface Violence {
  id: string;
  jenis_kekerasan: string[]; // e.g. ["Seksual", "Fisik"]
  bentuk_kekerasan: string[]; // specific list of forms
  lokasi_kejadian: string;
  waktu_kejadian: string;
  deskripsi_kekerasan: string;
  created_at: string;
  updated_at: string;
}

export interface ViolenceReport {
  id: string;
  id_client: string;
  id_reporter: string;
  id_perpetrator: string;
  id_violence: string;
  status: 'terlapor' | 'diproses' | 'ditolak' | 'selesai';
  code: string;
  created_at: string;
  updated_at: string;

  // Relations
  client?: Client;
  reporter?: Reporter;
  perpetrator?: Perpetrator;
  violence?: Violence;
}
