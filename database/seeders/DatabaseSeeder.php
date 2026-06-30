<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Promo;
use App\Models\Artikel;
use App\Models\Banner;
use App\Models\Kontak;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin Bintang',
            'username' => 'admin',
            'email' => 'admin@bintang.com',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'Operator Toko',
            'username' => 'operator',
            'email' => 'operator@bintang.com',
            'password' => Hash::make('operator123'),
        ]);

        // Kategori
        $kategoris = [
            ['nama' => 'Makanan', 'slug' => 'makanan', 'deskripsi' => 'Berbagai macam produk makanan berkualitas tinggi'],
            ['nama' => 'Minuman', 'slug' => 'minuman', 'deskripsi' => 'Minuman segar dan sehat untuk keluarga'],
            ['nama' => 'Kebutuhan Rumah Tangga', 'slug' => 'kebutuhan-rumah-tangga', 'deskripsi' => 'Peralatan dan kebutuhan rumah tangga sehari-hari'],
            ['nama' => 'Produk Segar', 'slug' => 'produk-segar', 'deskripsi' => 'Sayuran, buah-buahan, dan produk segar lainnya'],
        ];

        foreach ($kategoris as $k) {
            Kategori::create($k);
        }

        // Produk
        $produks = [
            ['kategori_id' => 1, 'nama' => 'Beras Premium 5kg', 'slug' => 'beras-premium-5kg', 'deskripsi' => 'Beras pilihan berkualitas premium, cocok untuk semua jenis masakan. Diproduksi dari padi pilihan yang dipanen langsung dari sawah.', 'harga' => 75000, 'satuan' => 'pack', 'stok' => 100, 'is_active' => true],
            ['kategori_id' => 1, 'nama' => 'Mie Instan Goreng', 'slug' => 'mie-instan-goreng', 'deskripsi' => 'Mie instan goreng dengan bumbu lengkap, rasa lezat yang sudah terpercaya.', 'harga' => 4500, 'satuan' => 'pcs', 'stok' => 500, 'is_active' => true],
            ['kategori_id' => 1, 'nama' => 'Minyak Goreng 2L', 'slug' => 'minyak-goreng-2l', 'deskripsi' => 'Minyak goreng sehat dari bahan nabati pilihan, tahan panas tinggi.', 'harga' => 28000, 'satuan' => 'botol', 'stok' => 80, 'is_active' => true],
            ['kategori_id' => 1, 'nama' => 'Gula Pasir 1kg', 'slug' => 'gula-pasir-1kg', 'deskripsi' => 'Gula pasir kristal putih, manis alami tanpa tambahan bahan kimia.', 'harga' => 15000, 'satuan' => 'pack', 'stok' => 120, 'is_active' => true],
            ['kategori_id' => 2, 'nama' => 'Susu UHT Kotak', 'slug' => 'susu-uht-kotak', 'deskripsi' => 'Susu sapi segar dengan vitamin lengkap, tahan lama tanpa refrigerasi.', 'harga' => 12000, 'satuan' => 'pcs', 'stok' => 200, 'is_active' => true],
            ['kategori_id' => 2, 'nama' => 'Kopi Sachet', 'slug' => 'kopi-sachet', 'deskripsi' => 'Kopi bubuk premium dalam kemasan sachets, praktis dan ekonomis.', 'harga' => 3500, 'satuan' => 'pcs', 'stok' => 300, 'is_active' => true],
            ['kategori_id' => 2, 'nama' => 'Teh Celup 25s', 'slug' => 'teh-celup-25s', 'deskripsi' => 'Teh celup berkualitas tinggi dari daun teh pilihan, 25 kantong per box.', 'harga' => 8000, 'satuan' => 'box', 'stok' => 150, 'is_active' => true],
            ['kategori_id' => 2, 'nama' => 'Jus Jeruk 1L', 'slug' => 'jus-jeruk-1l', 'deskripsi' => 'Jus jeruk segar tanpa pengawet, dibuat dari buah jeruk pilihan.', 'harga' => 22000, 'satuan' => 'botol', 'stok' => 60, 'is_active' => true],
            ['kategori_id' => 3, 'nama' => 'Sabun Cuci Piring', 'slug' => 'sabun-cuci-piring', 'deskripsi' => 'Sabun cair untuk mencuci peralatan makan, efektif mengangkat lemak.', 'harga' => 18000, 'satuan' => 'botol', 'stok' => 90, 'is_active' => true],
            ['kategori_id' => 3, 'nama' => 'Detergen Bubuk 1kg', 'slug' => 'detergen-bubuk-1kg', 'deskripsi' => 'Detergen bubuk serbaguna untuk laundry, noda berat teratasi.', 'harga' => 25000, 'satuan' => 'pack', 'stok' => 75, 'is_active' => true],
            ['kategori_id' => 3, 'nama' => 'Pembersih Lantai 900ml', 'slug' => 'pembersih-lantai-900ml', 'deskripsi' => 'Pembersih lantai anti bacterial, wangi tahan lama.', 'harga' => 15000, 'satuan' => 'botol', 'stok' => 85, 'is_active' => true],
            ['kategori_id' => 4, 'nama' => 'Telur Ayam 1kg', 'slug' => 'telur-ayam-1kg', 'deskripsi' => 'Telur ayam ras segar, kaya protein dan nutrisi penting.', 'harga' => 28000, 'satuan' => 'kg', 'stok' => 50, 'is_active' => true],
            ['kategori_id' => 4, 'nama' => 'Sayuran Segar Mix', 'slug' => 'sayuran-segar-mix', 'deskripsi' => 'Paket sayuran segar pilihan, wash and ready to cook.', 'harga' => 15000, 'satuan' => 'paket', 'stok' => 30, 'is_active' => true],
            ['kategori_id' => 4, 'nama' => 'Buah Jeruk 1kg', 'slug' => 'buah-jeruk-1kg', 'deskripsi' => 'Jeruk import berkualitas, manis segar dan kaya vitamin C.', 'harga' => 35000, 'satuan' => 'kg', 'stok' => 40, 'is_active' => true],
            ['kategori_id' => 4, 'nama' => 'Daging Ayam Segar 500g', 'slug' => 'daging-ayam-segar-500g', 'deskripsi' => 'Daging ayam broiler segar, tanpa hormon dan antibiotik.', 'harga' => 38000, 'satuan' => 'pack', 'stok' => 25, 'is_active' => true],
        ];

        foreach ($produks as $p) {
            Produk::create($p);
        }

        // Promo
        Promo::create([
            'judul' => 'Diskon 20% Semua Produk Makanan',
            'slug' => 'diskon-20-ssemua-produk-makanan',
            'deskripsi' => 'Dapatkan potongan harga 20% untuk semua produk makanan. Berlaku untuk pembelian minimum Rp 50.000.',
            'diskon_persen' => 20,
            'tanggal_mulai' => now(),
            'tanggal_berakhir' => now()->addMonth(),
            'is_active' => true,
        ]);

        Promo::create([
            'judul' => 'Buy 2 Get 1 Free - Susu',
            'slug' => 'buy-2-get-1-free-susu',
            'deskripsi' => 'Beli 2 susu UHT, GRATIS 1 susu UHT lainnya. Promo spesial untuk pelanggan setia.',
            'diskon_persen' => 33,
            'tanggal_mulai' => now(),
            'tanggal_berakhir' => now()->addWeeks(2),
            'is_active' => true,
        ]);

        Promo::create([
            'judul' => 'Cashback 10% Pembayaran Tunai',
            'slug' => 'cashback-10-pembayaran-tunai',
            'deskripsi' => 'Bayar secara tunai dan dapatkan cashback 10% hingga Rp 20.000 per transaksi.',
            'diskon_persen' => 10,
            'tanggal_mulai' => now(),
            'tanggal_berakhir' => now()->addDays(15),
            'is_active' => true,
        ]);

        Promo::create([
            'judul' => 'Weekend Sale - Diskon 30%',
            'slug' => 'weekend-sale-diskon-30',
            'deskripsi' => 'Diskon spesial weekend hanya hari Sabtu dan Minggu. Jangan sampai terlewat!',
            'diskon_persen' => 30,
            'tanggal_mulai' => now()->subWeek(),
            'tanggal_berakhir' => now()->subDays(1),
            'is_active' => false,
        ]);

        // Banner
        Banner::create([
            'judul' => 'Selamat Datang di Supermarket Bintang',
            'deskripsi' => 'Belanja kebutuhan sehari-hari dengan harga terbaik',
            'gambar' => 'banner1.jpg',
            'link' => '/produk',
            'urutan' => 1,
            'is_active' => true,
        ]);

        Banner::create([
            'judul' => 'Promo Minggu Ini',
            'deskripsi' => 'Dapatkan diskon hingga 30% untuk produk pilihan',
            'gambar' => 'banner2.jpg',
            'link' => '/promo',
            'urutan' => 2,
            'is_active' => true,
        ]);

        Banner::create([
            'judul' => 'Produk Segar Setiap Hari',
            'deskripsi' => 'Sayuran dan buah-buahan segar pilihan terbaik',
            'gambar' => 'banner3.jpg',
            'link' => '/produk?kategori=4',
            'urutan' => 3,
            'is_active' => true,
        ]);

        // Artikel
        Artikel::create([
            'judul' => 'Tips Berbelanja Hemat di Supermarket',
            'slug' => 'tips-berbelanja-hemat-di-supermarket',
            'konten' => "Berbelanja di supermarket memang menyenangkan, tapi bisa juga membuat dompet menipis jika tidak bijak. Berikut beberapa tips belanja hemat yang bisa Anda terapkan:\n\n1. Buat Daftar Belanjaan\nSebelum pergi ke supermarket, selalu buat daftar belanjaan. Dengan begitu, Anda tidak akan membeli barang yang tidak diperlukan.\n\n2. Manfaatkan Promo dan Diskon\nSelalu periksa promo yang sedang berlaku. Dengan memanfaatkan diskon, Anda bisa menghemat hingga 30% dari total belanjaan.\n\n3. Beli Produk Segar di Pagi Hari\nUntuk produk segar seperti sayuran dan buah-buahan, sebaiknya beli di pagi hari saat masih sangat segar.\n\n4. Bandingkan Harga\nJangan langsung membeli barang di rak pertama yang Anda jumpai. Bandingkan harga antar merek untuk mendapatkan harga terbaik.\n\n5. Gunakan Kupon atau Poin\nJika supermarket menyediakan kupon atau program poin, manfaatkan sebaik mungkin untuk mendapatkan дополнительные savings.",
            'penulis' => 'Tim Supermarket Bintang',
            'is_active' => true,
        ]);

        Artikel::create([
            'judul' => 'Resep Masakan Hemat untuk Keluarga',
            'slug' => 'resep-masakan-hemat-untuk-keluarga',
            'konten' => "Tidak perlu mahal untuk menyajikan makanan lezat bagi keluarga. Berikut resep masakan hemat yang bisa Anda coba:\n\nNasi Goreng Spesial\nBahan:\n- Nasi putih sisa 2 piring\n- 2 butir telur\n- Kecap manis secukupnya\n- Bawang merah, bawang putih\n- Garam dan merica\n\nCara Membuat:\n1. Tumis bawang merah dan bawang putih hingga harum\n2. Masukkan telur, orak-arik\n3. Tambahkan nasi, aduk rata\n4. Beri kecap, garam, dan merica\n5. Aduk hingga semua bahan tercampur rata\n6. Sajikan dengan irisan timun dan kerupuk\n\nAyam Geprek Murah Meriah\nBahan:\n- 2 potong ayam fillet\n- Tepung terigu, tepung maizena\n- Sambal bawang\n\nCara Membuat:\n1. Marinasi ayam dengan bumbu\n2. Gulingkan di tepung, celup telur, gulingkan lagi\n3. Goreng hingga kecokelatan\n4. Penyet di cobek dengan sambal\n5. Sajikan dengan nasi hangat",
            'penulis' => 'Tim Supermarket Bintang',
            'is_active' => true,
        ]);

        Artikel::create([
            'judul' => 'Keuntungan Belanja di Supermarket Bintang',
            'slug' => 'keuntungan-belanja-di-supermarket-bintang',
            'konten' => "Supermarket Bintang selalu berkomitmen untuk memberikan pengalaman belanja terbaik bagi pelanggan. Berikut keuntungan belanja di Supermarket Bintang:\n\n1. Harga Terjangkau\nKami berkomitmen untuk menawarkan harga yang kompetitif dan terjangkau untuk semua produk berkualitas.\n\n2. Produk Berkualitas\nSemua produk yang kami jual melewati quality control ketat untuk memastikan kesegaran dan kualitasnya.\n\n3. Staff yang Ramah\nTim kami selalu siap membantu Anda menemukan produk yang Anda butuhkan dengan senyuman.\n\n4. Lokasi Strategis\nDengan lokasi yang mudah diakses, belanja di Supermarket Bintang nunca lebih nyaman dan praktis.\n\n5. Promo Menarik\nKami secara rutin memberikan promo dan diskon menarik untuk pelanggan setia kami.\n\n6. Sistem Pembayaran Fleksibel\nTerima berbagai metode pembayaran termasuk tunai, kartu debit, dan kartu kredit.",
            'penulis' => 'Tim Supermarket Bintang',
            'is_active' => true,
        ]);

        // Kontak
        Kontak::create([
            'alamat' => 'Jl. Sudirman No. 123, Jakarta Pusat, DKI Jakarta 10220',
            'telepon' => '(021) 1234-5678',
            'email' => 'info@supermarketbintang.com',
            'peta' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613507864!3d-6.194741395493671!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b4f5%3A0x34e2e9c4f8c1a0c7!2sJl.%20Sudirman!5e0!3m2!1sen!2sid!4v1234567890" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
        ]);
    }
}
