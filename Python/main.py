# Saya Yusuf Willman Hammam dengan NIM 2511185 mengerjakan Tugas Praktikum 2
# dalam mata kuliah Desain Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya
# maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

import sys
from FilmFranchise import FilmFranchise

daftar = []   # list of object untuk menyimpan data film franchise (pengganti array of object)
jumlah = 0    # jumlah data yang sudah tersimpan


# ===== Validasi input =====
# Membaca angka bulat. "minimal" = angka terkecil yang boleh diterima.
def bacaAngka(pesan: str, minimal: int) -> int:
    while True:
        try:
            teks = input(pesan)
        except EOFError:
            # Input sudah habis (misalnya ditutup dengan Ctrl+D / Ctrl+Z)
            print()
            print("Input dihentikan.")
            sys.exit(0)

        negatif = False
        angkaSaja = teks
        if len(teks) > 0 and teks[0] == '-':
            negatif = True
            angkaSaja = teks[1:]

        semuaAngka = len(angkaSaja) > 0 and len(angkaSaja) <= 9
        for c in angkaSaja:
            if c < '0' or c > '9':
                semuaAngka = False

        if not semuaAngka:
            print("Input harus berupa angka bulat!")
        elif negatif:
            print("Angka tidak boleh negatif!")
        elif int(angkaSaja) < minimal:
            print(f"Angka tidak boleh kurang dari {minimal}!")
        else:
            return int(angkaSaja)


# Membaca teks. Tidak boleh kosong atau hanya spasi.
def bacaTeks(pesan: str) -> str:
    while True:
        try:
            teks = input(pesan)
        except EOFError:
            print()
            print("Input dihentikan.")
            sys.exit(0)

        if teks.strip(" \t") == "":
            print("Input tidak boleh kosong!")
        else:
            return teks


# Mencari posisi film berdasarkan ID, kalau tidak ketemu hasilnya -1
def cariIndex(idCari: int) -> int:
    for i in range(jumlah):
        if daftar[i].getId() == idCari:
            return i
    return -1


# Mengisi 5 data contoh sebelum program menerima input dari user
def isiDataDefault():
    global jumlah
    # jilidKe dihitung dari urutan film DI DALAM franchise-nya sendiri,
    # bukan urutan lintas semesta (misalnya Avengers: Endgame BUKAN film ke-22,
    # itu urutan gabungan seluruh semesta MCU. Dalam franchise Avengers saja,
    # dia jilid ke-4: Avengers, Age of Ultron, Infinity War, Endgame).
    daftar.append(FilmFranchise(1, "Avengers: Endgame", 181, "Aksi", "Anthony Russo", "13+",
                                 4, "Avengers", "-"))
    jumlah += 1
    daftar.append(FilmFranchise(2, "John Wick 4", 169, "Aksi", "Chad Stahelski", "17+",
                                 4, "John Wick", "-"))
    jumlah += 1
    daftar.append(FilmFranchise(3, "Fast X", 141, "Aksi", "Louis Leterrier", "13+",
                                 10, "Fast & Furious", "Fast & Furious 11"))
    jumlah += 1
    daftar.append(FilmFranchise(4, "Toy Story 4", 100, "Animasi", "Josh Cooley", "SU",
                                 4, "Toy Story", "-"))
    jumlah += 1
    daftar.append(FilmFranchise(5, "Spider-Man: No Way Home", 148, "Aksi", "Jon Watts", "13+",
                                 3, "Spider-Man (Trilogi Home)", "-"))
    jumlah += 1


# Fitur Tambah Data
def tambahData():
    global jumlah
    if jumlah >= 100:
        print("Data sudah penuh!")
        return

    id = bacaAngka("ID              : ", 1)

    if cariIndex(id) != -1:
        print("ID sudah dipakai!")
        return

    judul = bacaTeks("Judul           : ")
    durasi = bacaAngka("Durasi (menit)  : ", 1)
    genre = bacaTeks("Genre           : ")
    sutradara = bacaTeks("Sutradara       : ")
    ratingUsia = bacaTeks("Rating Usia     : ")
    jilid = bacaAngka("Jilid Ke        : ", 1)
    franchise = bacaTeks("Nama Franchise  : ")
    selanjutnya = bacaTeks('Judul Selanjutnya ("-" jika belum ada): ')

    daftar.append(FilmFranchise(id, judul, durasi, genre, sutradara, ratingUsia,
                                 jilid, franchise, selanjutnya))
    jumlah += 1

    print("Data berhasil ditambahkan!")


# Fitur Tampilkan Data: tabel dengan lebar kolom yang menyesuaikan isi
def tampilData():
    if jumlah == 0:
        print("Belum ada data film.")
        return

    # Judul kolom (urut sesuai urutan pewarisan: dari Tontonan, lalu Film, lalu FilmFranchise)
    header = ["ID", "Judul", "Durasi", "Genre", "Sutradara", "Rating",
              "Jilid", "Franchise", "Judul Selanjutnya"]
    JUMLAH_KOLOM = 9

    # Langkah 1: lebar default setiap kolom dihitung dari panjang judul kolomnya
    lebar = [len(h) for h in header]

    # Kumpulkan isi setiap baris jadi teks dahulu, supaya panjangnya bisa dihitung
    isi = [["" for _ in range(JUMLAH_KOLOM)] for _ in range(jumlah)]
    for i in range(jumlah):
        # str() dipakai untuk mengubah angka menjadi teks
        isi[i][0] = str(daftar[i].getId())
        isi[i][1] = daftar[i].getJudul()
        isi[i][2] = str(daftar[i].getDurasi()) + " menit"
        isi[i][3] = daftar[i].getGenre()
        isi[i][4] = daftar[i].getSutradara()
        isi[i][5] = daftar[i].getRatingUsia()
        isi[i][6] = str(daftar[i].getJilidKe())
        isi[i][7] = daftar[i].getNamaFranchise()
        isi[i][8] = daftar[i].getJudulSelanjutnya()

    # Langkah 2: lebar tiap kolom dihitung ulang, dibesarkan jika ada isi yang lebih panjang
    for i in range(jumlah):
        for k in range(JUMLAH_KOLOM):
            if len(isi[i][k]) > lebar[k]:
                lebar[k] = len(isi[i][k])

    # Menghitung total lebar tabel untuk garis pemisah
    totalLebar = 1   # 1 untuk tanda '|' di paling kiri
    for k in range(JUMLAH_KOLOM):
        totalLebar += lebar[k] + 3   # 3 = spasi kiri + spasi kanan + tanda '|'

    garis = "-" * totalLebar

    # Mencetak judul kolom
    print(garis)
    baris = "|"
    for k in range(JUMLAH_KOLOM):
        baris += " " + header[k]
        # Tambahkan spasi supaya lebarnya sama dengan "lebar[k]"
        baris += " " * (lebar[k] - len(header[k]))
        baris += " |"
    print(baris)
    print(garis)

    # Mencetak isi tabel
    for i in range(jumlah):
        baris = "|"
        for k in range(JUMLAH_KOLOM):
            baris += " " + isi[i][k]
            baris += " " * (lebar[k] - len(isi[i][k]))
            baris += " |"
        print(baris)
    print(garis)


def main():
    isiDataDefault()   # 5 data contoh dimasukkan lebih dulu, sebelum ada input user

    pilihan = None

    while True:
        print()
        print("=== DATA FILM BIOSKOP Python (Tontonan -> Film -> FilmFranchise) ===")
        print("1. Tambah Data")
        print("2. Tampilkan Data")
        print("0. Keluar")
        pilihan = bacaAngka("Pilih menu: ", 0)
        print()

        if pilihan == 1:
            tambahData()
        elif pilihan == 2:
            tampilData()
        elif pilihan == 0:
            print("Terima kasih!")
        else:
            print("Menu tidak valid!")

        if pilihan == 0:
            break


if __name__ == "__main__":
    main()