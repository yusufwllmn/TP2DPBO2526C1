from Film import Film


# Class level 3 (paling bawah): FilmFranchise
# FilmFranchise adalah Film yang merupakan bagian dari sebuah franchise/waralaba,
# sehingga punya info jilid keberapa dan film sesudahnya.
# Lewat "class FilmFranchise(Film)", FilmFranchise otomatis mewarisi seluruh
# atribut dari Film (genre, sutradara, ratingUsia) SEKALIGUS dari Tontonan
# (id, judul, durasi).
class FilmFranchise(Film):

    # Constructor. Bagian Film (dan otomatis Tontonan) diteruskan ke atas.
    # Nilai default berperan seperti constructor kosong pada C++.
    def __init__(self, id: int = 0, judul: str = "", durasi: int = 0,
                 genre: str = "", sutradara: str = "", ratingUsia: str = "",
                 jilidKe: int = 0, namaFranchise: str = "", judulSelanjutnya: str = ""):
        super().__init__(id, judul, durasi, genre, sutradara, ratingUsia)
        self.jilidKe = jilidKe                     # film ini jilid/urutan ke berapa dalam franchise-nya
        self.namaFranchise = namaFranchise         # nama franchise-nya, misal "Fast & Furious"
        self.judulSelanjutnya = judulSelanjutnya   # judul film sesudah ini, "-" kalau belum ada

    def __del__(self):
        pass

    # ===== Getter =====
    def getJilidKe(self) -> int:
        return self.jilidKe

    def getNamaFranchise(self) -> str:
        return self.namaFranchise

    def getJudulSelanjutnya(self) -> str:
        return self.judulSelanjutnya

    # ===== Setter =====
    def setJilidKe(self, jilidKe: int):
        self.jilidKe = jilidKe

    def setNamaFranchise(self, namaFranchise: str):
        self.namaFranchise = namaFranchise

    def setJudulSelanjutnya(self, judulSelanjutnya: str):
        self.judulSelanjutnya = judulSelanjutnya