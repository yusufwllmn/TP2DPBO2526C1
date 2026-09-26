// Class paling atas (level 1): Tontonan
// Berisi hal paling umum yang dimiliki SEGALA jenis tontonan di bioskop,
// belum tentu berupa film (bisa saja nanti dikembangkan jadi Iklan, Trailer, dsb).
public class Tontonan {
    private int id;
    private String judul;
    private int durasi;   // dalam menit

    // Constructor kosong
    public Tontonan() {
        this.id = 0;
        this.judul = "";
        this.durasi = 0;
    }

    // Constructor dengan isi
    public Tontonan(int id, String judul, int durasi) {
        this.id = id;
        this.judul = judul;
        this.durasi = durasi;
    }

    // Destructor tidak ada di Java (dibersihkan otomatis oleh garbage collector).
    // Sebagai gantinya, finalize() bisa dipakai, tapi sudah deprecated sehingga
    // sengaja tidak dipakai di sini.

    // ===== Getter =====
    public int getId() { return id; }
    public String getJudul() { return judul; }
    public int getDurasi() { return durasi; }

    // ===== Setter =====
    public void setId(int id) { this.id = id; }
    public void setJudul(String judul) { this.judul = judul; }
    public void setDurasi(int durasi) { this.durasi = durasi; }
}