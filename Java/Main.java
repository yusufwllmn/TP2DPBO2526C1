/* Saya Yusuf Willman Hammam dengan NIM 2511185 mengerjakan Tugas Praktikum 2 
dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya 
maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin. */

import java.util.ArrayList;
import java.util.Scanner;

public class Main {
    static ArrayList<FilmFranchise> daftar = new ArrayList<FilmFranchise>();   // list of object
    static final int MAKS_DATA = 100;

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        isiDataDefault();   // 5 data contoh dimasukkan lebih dulu, sebelum ada input user

        int pilihan;

        do {
            System.out.println();
            System.out.println("=== DATA FILM BIOSKOP JAVA (Tontonan -> Film -> FilmFranchise) ===");
            System.out.println("1. Tambah Data");
            System.out.println("2. Tampilkan Data");
            System.out.println("0. Keluar");
            pilihan = bacaAngka(input, "Pilih menu: ", 0);
            System.out.println();

            if (pilihan == 1) {
                tambahData(input);
            } else if (pilihan == 2) {
                tampilData();
            } else if (pilihan == 0) {
                System.out.println("Terima kasih!");
            } else {
                System.out.println("Menu tidak valid!");
            }

        } while (pilihan != 0);

        input.close();
    }

    // ===== Validasi input =====
    // Semua input dibaca sebagai satu baris teks, dicek dulu, dan
    // ditanyakan ulang terus sampai isinya benar.

    // Membaca angka bulat. "minimal" = angka terkecil yang boleh diterima.
    static int bacaAngka(Scanner input, String pesan, int minimal) {
        while (true) {
            System.out.print(pesan);
            String teks = input.nextLine();

            try {
                // Kalau bukan angka bulat (huruf, koma, kosong), parseInt akan error
                int angka = Integer.parseInt(teks.trim());

                if (angka < 0) {
                    System.out.println("Angka tidak boleh negatif!");
                } else if (angka < minimal) {
                    System.out.println("Angka tidak boleh kurang dari " + minimal + "!");
                } else {
                    return angka;
                }
            } catch (NumberFormatException e) {
                System.out.println("Input harus berupa angka bulat!");
            }
        }
    }

    // Membaca teks. Tidak boleh kosong atau hanya spasi.
    static String bacaTeks(Scanner input, String pesan) {
        while (true) {
            System.out.print(pesan);
            String teks = input.nextLine();

            if (teks.trim().isEmpty()) {
                System.out.println("Input tidak boleh kosong!");
            } else {
                return teks;
            }
        }
    }

    // Mencari posisi film berdasarkan ID, kalau tidak ketemu hasilnya -1
    static int cariIndex(int idCari) {
        for (int i = 0; i < daftar.size(); i++) {
            if (daftar.get(i).getId() == idCari) {
                return i;
            }
        }
        return -1;
    }

    // Mengisi 5 data contoh sebelum program menerima input dari user
    static void isiDataDefault() {
        daftar.add(new FilmFranchise(1, "Avengers: Endgame", 181, "Aksi", "Anthony Russo", "13+",
                4, "Avengers", "-"));
        daftar.add(new FilmFranchise(2, "John Wick 4", 169, "Aksi", "Chad Stahelski", "17+",
                4, "John Wick", "-"));
        daftar.add(new FilmFranchise(3, "Fast X", 141, "Aksi", "Louis Leterrier", "13+",
                10, "Fast & Furious", "Fast & Furious 11"));
        daftar.add(new FilmFranchise(4, "Toy Story 4", 100, "Animasi", "Josh Cooley", "SU",
                4, "Toy Story", "-"));
        daftar.add(new FilmFranchise(5, "Spider-Man: No Way Home", 148, "Aksi", "Jon Watts", "13+",
                3, "Spider-Man (Trilogi Home)", "-"));
    }

    // Fitur Tambah Data
    static void tambahData(Scanner input) {
        if (daftar.size() >= MAKS_DATA) {
            System.out.println("Data sudah penuh!");
            return;
        }

        int id = bacaAngka(input, "ID              : ", 1);

        if (cariIndex(id) != -1) {
            System.out.println("ID sudah dipakai!");
            return;
        }

        String judul = bacaTeks(input, "Judul           : ");
        int durasi = bacaAngka(input, "Durasi (menit)  : ", 1);
        String genre = bacaTeks(input, "Genre           : ");
        String sutradara = bacaTeks(input, "Sutradara       : ");
        String ratingUsia = bacaTeks(input, "Rating Usia     : ");
        int jilid = bacaAngka(input, "Jilid Ke        : ", 1);
        String franchise = bacaTeks(input, "Nama Franchise  : ");
        String selanjutnya = bacaTeks(input, "Judul Selanjutnya (\"-\" jika belum ada): ");

        daftar.add(new FilmFranchise(id, judul, durasi, genre, sutradara, ratingUsia,
                jilid, franchise, selanjutnya));

        System.out.println("Data berhasil ditambahkan!");
    }

    // Fitur Tampilkan Data: tabel dengan lebar kolom yang menyesuaikan isi
    static void tampilData() {
        if (daftar.size() == 0) {
            System.out.println("Belum ada data film.");
            return;
        }

        // Judul kolom (urut sesuai urutan pewarisan: dari Tontonan, lalu Film, lalu FilmFranchise)
        String[] header = {
            "ID", "Judul", "Durasi", "Genre", "Sutradara", "Rating",
            "Jilid", "Franchise", "Judul Selanjutnya"
        };
        int jumlahKolom = header.length;

        // Langkah 1: lebar default setiap kolom dihitung dari panjang judul kolomnya
        int[] lebar = new int[jumlahKolom];
        for (int k = 0; k < jumlahKolom; k++) {
            lebar[k] = header[k].length();
        }

        // Kumpulkan isi setiap baris jadi teks dahulu, supaya panjangnya bisa dihitung
        String[][] isi = new String[daftar.size()][jumlahKolom];
        for (int i = 0; i < daftar.size(); i++) {
            FilmFranchise f = daftar.get(i);
            // String.valueOf dipakai untuk mengubah angka menjadi teks
            isi[i][0] = String.valueOf(f.getId());
            isi[i][1] = f.getJudul();
            isi[i][2] = f.getDurasi() + " menit";
            isi[i][3] = f.getGenre();
            isi[i][4] = f.getSutradara();
            isi[i][5] = f.getRatingUsia();
            isi[i][6] = String.valueOf(f.getJilidKe());
            isi[i][7] = f.getNamaFranchise();
            isi[i][8] = f.getJudulSelanjutnya();
        }

        // Langkah 2: lebar tiap kolom dihitung ulang, dibesarkan jika ada isi yang lebih panjang
        for (int i = 0; i < daftar.size(); i++) {
            for (int k = 0; k < jumlahKolom; k++) {
                if (isi[i][k].length() > lebar[k]) {
                    lebar[k] = isi[i][k].length();
                }
            }
        }

        // Menghitung total lebar tabel untuk garis pemisah
        int totalLebar = 1;   // 1 untuk tanda '|' di paling kiri
        for (int k = 0; k < jumlahKolom; k++) {
            totalLebar += lebar[k] + 3;   // 3 = spasi kiri + spasi kanan + tanda '|'
        }

        StringBuilder garisBuilder = new StringBuilder();
        for (int i = 0; i < totalLebar; i++) {
            garisBuilder.append('-');
        }
        String garis = garisBuilder.toString();

        // Mencetak judul kolom
        System.out.println(garis);
        StringBuilder barisHeader = new StringBuilder("|");
        for (int k = 0; k < jumlahKolom; k++) {
            barisHeader.append(" ").append(header[k]);
            for (int s = header[k].length(); s < lebar[k]; s++) {
                barisHeader.append(" ");
            }
            barisHeader.append(" |");
        }
        System.out.println(barisHeader);
        System.out.println(garis);

        // Mencetak isi tabel
        for (int i = 0; i < daftar.size(); i++) {
            StringBuilder barisData = new StringBuilder("|");
            for (int k = 0; k < jumlahKolom; k++) {
                barisData.append(" ").append(isi[i][k]);
                for (int s = isi[i][k].length(); s < lebar[k]; s++) {
                    barisData.append(" ");
                }
                barisData.append(" |");
            }
            System.out.println(barisData);
        }
        System.out.println(garis);
    }
}