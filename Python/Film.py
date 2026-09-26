from Tontonan import Tontonan


# Class level 2: Film
# Film adalah Tontonan yang punya genre, sutradara, dan batasan usia penonton.
# Lewat "class Film(Tontonan)", Film otomatis punya id, judul, durasi, beserta
# getter dan setter-nya, tanpa perlu menulis ulang.
class Film(Tontonan):

    # Constructor. Bagian id, judul, durasi diteruskan ke constructor Tontonan.
    # Nilai default ("", "", "") berperan seperti constructor kosong pada C++.
    def __init__(self, id: int = 0, judul: str = "", durasi: int = 0,
                 genre: str = "", sutradara: str = "", ratingUsia: str = ""):
        super().__init__(id, judul, durasi)
        self.genre = genre
        self.sutradara = sutradara
        self.ratingUsia = ratingUsia   # contoh: "SU", "13+", "17+", "21+"

    def __del__(self):
        pass

    # ===== Getter =====
    def getGenre(self) -> str:
        return self.genre

    def getSutradara(self) -> str:
        return self.sutradara

    def getRatingUsia(self) -> str:
        return self.ratingUsia

    # ===== Setter =====
    def setGenre(self, genre: str):
        self.genre = genre

    def setSutradara(self, sutradara: str):
        self.sutradara = sutradara

    def setRatingUsia(self, ratingUsia: str):
        self.ratingUsia = ratingUsia