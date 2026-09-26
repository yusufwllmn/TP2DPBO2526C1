// Class level 2: Film
// Film adalah Tontonan yang punya genre, sutradara, dan batasan usia penonton.
// Lewat "extends Tontonan", Film otomatis punya id, judul, durasi, beserta
// getter dan setter-nya, tanpa perlu menulis ulang.
public class Film extends Tontonan {
    private String genre;
    private String sutradara;
    private String ratingUsia;   // contoh: "SU", "13+", "17+", "21+"

    // Constructor kosong
    public Film() {
        super();
        this.genre = "";
        this.sutradara = "";
        this.ratingUsia = "";
    }

    // Constructor dengan isi: bagian id, judul, durasi diteruskan ke constructor Tontonan
    public Film(int id, String judul, int durasi, String genre, String sutradara, String ratingUsia) {
        super(id, judul, durasi);
        this.genre = genre;
        this.sutradara = sutradara;
        this.ratingUsia = ratingUsia;
    }

    // ===== Getter =====
    public String getGenre() { return genre; }
    public String getSutradara() { return sutradara; }
    public String getRatingUsia() { return ratingUsia; }

    // ===== Setter =====
    public void setGenre(String genre) { this.genre = genre; }
    public void setSutradara(String sutradara) { this.sutradara = sutradara; }
    public void setRatingUsia(String ratingUsia) { this.ratingUsia = ratingUsia; }
}