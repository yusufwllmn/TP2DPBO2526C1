# Class paling atas (level 1): Tontonan
# Berisi hal paling umum yang dimiliki SEGALA jenis tontonan di bioskop,
# belum tentu berupa film (bisa saja nanti dikembangkan jadi Iklan, Trailer, dsb).
class Tontonan:

    # Constructor.
    # id=0, judul="", durasi=0 berperan seperti constructor kosong pada C++
    # (dibutuhkan supaya bisa membuat "array of object" berupa list Tontonan).
    def __init__(self, id: int = 0, judul: str = "", durasi: int = 0):
        self.id = id
        self.judul = judul
        self.durasi = durasi

    # Python tidak memerlukan destructor manual seperti C++ (~Tontonan()),
    # karena garbage collector otomatis membersihkan objek yang sudah
    # tidak dipakai. Baris ini hanya pengingat, tidak melakukan apa-apa.
    def __del__(self):
        pass

    # ===== Getter =====
    def getId(self) -> int:
        return self.id

    def getJudul(self) -> str:
        return self.judul

    def getDurasi(self) -> int:
        return self.durasi

    # ===== Setter =====
    def setId(self, id: int):
        self.id = id

    def setJudul(self, judul: str):
        self.judul = judul

    def setDurasi(self, durasi: int):
        self.durasi = durasi