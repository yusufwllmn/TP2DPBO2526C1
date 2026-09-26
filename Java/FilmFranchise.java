// Class level 3 (paling bawah): FilmFranchise
// FilmFranchise adalah Film yang merupakan bagian dari sebuah franchise/waralaba,
// sehingga punya info jilid keberapa dan film sesudahnya.
// Lewat "extends Film", FilmFranchise otomatis mewarisi seluruh atribut dari Film
// (genre, sutradara, ratingUsia) SEKALIGUS dari Tontonan (id, judul, durasi).
public class FilmFranchise extends Film {
    private int jilidKe;                // film ini jilid/urutan ke berapa dalam franchise-nya
    private String namaFranchise;       // nama franchise-nya, misal "Fast & Furious"
    private String judulSelanjutnya;    // judul film sesudah ini, "-" kalau belum ada

    // Constructor kosong
    public FilmFranchise() {
        super();
        this.jilidKe = 0;
        this.namaFranchise = "";
        this.judulSelanjutnya = "";
    }

    // Constructor dengan isi: bagian Film (dan otomatis Tontonan) diteruskan ke atas
    public FilmFranchise(int id, String judul, int durasi, String genre, String sutradara, String ratingUsia,
                          int jilidKe, String namaFranchise, String judulSelanjutnya) {
        super(id, judul, durasi, genre, sutradara, ratingUsia);
        this.jilidKe = jilidKe;
        this.namaFranchise = namaFranchise;
        this.judulSelanjutnya = judulSelanjutnya;
    }

    // ===== Getter =====
    public int getJilidKe() { return jilidKe; }
    public String getNamaFranchise() { return namaFranchise; }
    public String getJudulSelanjutnya() { return judulSelanjutnya; }

    // ===== Setter =====
    public void setJilidKe(int jilidKe) { this.jilidKe = jilidKe; }
    public void setNamaFranchise(String namaFranchise) { this.namaFranchise = namaFranchise; }
    public void setJudulSelanjutnya(String judulSelanjutnya) { this.judulSelanjutnya = judulSelanjutnya; }
}