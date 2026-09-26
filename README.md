# Data Film Franchise Bioskop

## Janji

Saya Yusuf Willman Hammam dengan NIM 2511185 mengerjakan Tugas Praktikum 2 dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Desain

<img width="1080" height="1080" alt="Desain Class" src="https://github.com/user-attachments/assets/8a22be1c-c5fa-4aa6-977e-6d7695294bb2" />

Program pengelolaan data film franchise di sebuah bioskop ini dibuat dalam versi console (C++, Python, dan Java) dan versi web (PHP). dengan menerapkan **inheritance bertingkat 3 level (multilevel)**:

* **Tontonan** (paling atas): berisi hal paling umum yang dimiliki segala jenis tontonan di bioskop, belum tentu berupa film.
   * ID
   * Judul
   * Durasi (dalam menit)
* **Film** (mewarisi `Tontonan`): tontonan yang punya genre, sutradara, dan batasan usia penonton.
   * Genre
   * Sutradara
   * Rating Usia
   * Gambar (khusus versi web PHP, berisi path ke image, setiap Film pasti butuh poster untuk ditampilkan, sedangkan `Tontonan` masih terlalu umum)
* **FilmFranchise** (mewarisi `Film`, paling bawah): film yang merupakan bagian dari sebuah franchise/waralaba.
   * Jilid Ke
   * Nama Franchise
   * Judul Selanjutnya

Lewat inheritance ini, class `Film` otomatis memiliki seluruh atribut `Tontonan`, dan class `FilmFranchise` otomatis memiliki seluruh atribut `Tontonan` maupun `Film`, tanpa perlu menulis ulang.

Setiap class memiliki:

* constructor dan destructor,
* getter dan setter untuk atributnya masing-masing.

## Penjelasan

### Versi Console (C++, Python, Java)

Setelah program dijalankan akan muncul menu berikut:

```
=== DATA FILM BIOSKOP (Tontonan -> Film -> FilmFranchise) ===
1. Tambah Data
2. Tampilkan Data
0. Keluar
```

Pada halaman tersebut user memilih menu dengan mengetik angkanya lalu menekan Enter. Menu akan muncul kembali setelah setiap fitur selesai, sampai pengguna memilih `0`.

* **Tambah Data**: program meminta `ID`, `Judul`, `Durasi`, `Genre`, `Sutradara`, `Rating Usia`, `Jilid Ke`, `Nama Franchise`, dan `Judul Selanjutnya`. ID tidak boleh sama dengan ID film yang sudah ada. Data maksimal berjumlah 100 film.
* **Tampilkan Data**: menampilkan seluruh film yang tersimpan dalam bentuk tabel yang lebar kolomnya menyesuaikan isi data (dinamis). Jika belum ada data, akan muncul pesan `Belum ada data film.`

Angka negatif, huruf, dan angka desimal ditolak dengan pesan kesalahan, begitu pula input teks yang kosong atau hanya berisi spasi. Data pada versi console hanya disimpan di memori, sehingga hilang ketika program ditutup.

### Versi Web (PHP)

Versi webnya dibuat tanpa database. Data disimpan pada file `data.json`, sedangkan gambar yang diupload disimpan pada folder `image/`. Halaman yang tersedia:

* **`index.php`**: halaman utama yang menampilkan seluruh film franchise dalam bentuk tabel (`ID`, `Gambar`, `Judul`, `Durasi`, `Genre`, `Sutradara`, `Rating`, `Jilid`, `Franchise`, dan `Judul Selanjutnya`).
* **`tambah.php`**: formulir untuk menambahkan film baru.

Sama seperti versi console, tidak ada fitur Update, Hapus, maupun Cari Data pada versi web ini.

## Dokumentasi

### Console (C++, Python, dan Java)

1. TestCase 1: Tambah Data valid, bukan bagian franchise

   <img width="1345" height="634" alt="CPP_TestCase1" src="https://github.com/user-attachments/assets/7da63f21-b243-405a-82a9-8897c351eb02" />

2. TestCase 2: ID sudah dipakai

   <img width="575" height="163" alt="CPP_TestCase2" src="https://github.com/user-attachments/assets/8bb1ac16-b1da-4a28-96c7-089a8866a0ee" />

3. TestCase 3: Uji Validasi Input Tidak Valid (Desimal, Huruf, Kosong) pada Semua Atribut

   <img width="911" height="848" alt="CPP_TestCase3" src="https://github.com/user-attachments/assets/a03c9178-aed3-4f1a-b3ae-1508ef026970" />

### Web (PHP)

1. Tampil Awal

   <img width="1920" height="1080" alt="PHP_TampilAwal" src="https://github.com/user-attachments/assets/5a3bd676-59ad-4180-b724-69702faa9059" />

2. Tambah Data

   <img width="1920" height="1080" alt="PHP_TambahData" src="https://github.com/user-attachments/assets/95a16790-d669-490a-b88f-a27cf54ca0b0" />

4. Setelah Tambah

   <img width="1920" height="1080" alt="PHP_SetelahTambah" src="https://github.com/user-attachments/assets/a5d51d9b-ff8f-4236-b165-dcdb9f781ed0" />
