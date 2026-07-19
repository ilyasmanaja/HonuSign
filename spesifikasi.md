
# SPESIFIKASI PROYEK: HONUSIGN

## 1. Pendahuluan
### 1.1 Latar Belakang
HonuSign adalah platform pembelajaran interaktif berbasis web yang dirancang khusus untuk memfasilitasi anak-anak berkebutuhan khusus (tunarungu) maupun masyarakat umum dalam mempelajari Sistem Isyarat Bahasa Indonesia (SIBI). Platform ini memadukan materi ajar tematik, game edukatif, dan teknologi kecerdasan buatan (Artificial Intelligence) berbasis pendeteksian gerakan tangan (hand landmarks) secara langsung dari kamera web (webcam) pengguna untuk memvalidasi ejaan isyarat tangan secara real-time.

HonuSign mengadopsi model pembelajaran **RADEC** (Read, Answer, Discuss, Explain, Create) yang disesuaikan ke dalam 6 tahapan linear pembelajaran demi mengoptimalkan pemahaman kognitif, motorik, dan interaksi sosial siswa tunarungu.

### 1.2 Tujuan
- Menyediakan media pembelajaran SIBI yang menyenangkan, interaktif, dan adaptif untuk siswa tunarungu.
- Membantu guru dalam mengelola materi pelajaran dan memantau kemajuan serta evaluasi nilai belajar siswa secara komprehensif.
- Memanfaatkan pendeteksian AI pada sisi klien (client-side) tanpa membebani server untuk memvalidasi bahasa isyarat SIBI secara langsung.

---

## 2. Arsitektur & Tech Stack
Sistem HonuSign dikembangkan dengan stack teknologi modern sebagai berikut:
- **Framework Utama**: Laravel v13.x (PHP 8.3+)
- **Sistem Autentikasi**: Laravel Fortify v1.34 (frontend-agnostic auth backend)
- **Komponen Interaktif**: Livewire v4.x & Flux UI v2.13.1 (modern UI component library)
- **Desain & Gaya (Styling)**: Tailwind CSS & Vanilla CSS (desain bertema neo-brutalisme dengan bayangan tebal, batas hitam pekat `brutal-border`, dan palet warna pastel yang ceria).
- **Basis Data**: MySQL (koneksi utama via port 3306)
- **Kecerdasan Buatan (AI)**:
  - **MediaPipe Hand Landmarker** (`@mediapipe/tasks-vision`): Pendeteksian koordinat 21 titik sendi tangan.
  - **TensorFlow.js** & **TensorFlow Lite (TFLite) Web Compiler**: Meload model klasifikasi kustom (`honusign_model.tflite`) untuk mengenali huruf SIBI A-Y.
  - Berjalan sepenuhnya di sisi klien menggunakan teknologi WebAssembly (WASM) untuk performa real-time dan privasi yang terjamin.

---

## 3. Struktur Database (Skema & Relasi Eloquent)
Berikut adalah daftar tabel utama dan struktur kolom yang digunakan pada HonuSign:

### 3.1 Tabel `users`
Menyimpan data akun pengguna baik Guru maupun Siswa.
- `id` (BigInt, PK, AutoIncrement)
- `name` (String): Nama lengkap pengguna.
- `email` (String, Unique): Alamat email untuk login.
- `role` (String, Default: `'student'`): Peran pengguna, bernilai `'student'` atau `'teacher'`.
- `password` (String): Password terenkripsi.
- `email_verified_at` (Timestamp, Nullable)
- `remember_token` (String, Nullable)
- `two_factor_secret`, `two_factor_recovery_codes` (Text, Nullable): Dukungan keamanan Two Factor Authentication (2FA) bawaan Fortify.
- `created_at` & `updated_at` (Timestamps)

### 3.2 Tabel `mapels`
Menyimpan data mata pelajaran/subjek pembelajaran.
- `id` (BigInt, PK, AutoIncrement)
- `nama` (String): Nama mata pelajaran (contoh: PPKn, Matematika, Bahasa Indonesia).
- `slug` (String, Unique): URL ramah pengguna (contoh: `'ppkn'`).
- `deskripsi` (Text, Nullable): Penjelasan singkat mengenai mata pelajaran.
- `icon` (String, Nullable): Nama file gambar ikon mapel.
- `created_at` & `updated_at` (Timestamps)

### 3.3 Tabel `materis`
Menyimpan materi pelajaran yang berelasi dengan mata pelajaran.
- `id` (BigInt, PK, AutoIncrement)
- `mapel_id` (BigInt, FK): Terhubung ke tabel `mapels` (Cascade on delete).
- `order` (Integer, Default: 0): Menentukan urutan materi keberapa dalam mapel tersebut.
- `judul` (String): Judul materi (contoh: `'Festival Budaya Kemerdekaan Indonesia'`).
- `slug` (String, Unique): Slug materi kustom yang digenerate otomatis.
- `video_peragaan` (String, Nullable): Path file video demonstrasi isyarat SIBI untuk materi ini.
- `deskripsi` (Text, Nullable): Deskripsi cerita utama (mengandung HTML murni).
- `deskripsi_tambahan` (Text, Nullable): Paragraf tambahan untuk materi ajar.
- `created_at` & `updated_at` (Timestamps)

### 3.4 Tabel `materi_images`
Menyimpan gambar ilustrasi cerita, kartu keberagaman, sketsa, dan konten teks/gambar dinamis per tahap.
- `id` (BigInt, PK, AutoIncrement)
- `materi_id` (BigInt, FK): Terhubung ke tabel `materis` (Cascade on delete).
- `path` (String): Path file gambar di public storage atau penanda khusus seperti `'text_content'`.
- `tipe` (String): Mengelompokkan gambar berdasarkan fungsinya di setiap tahap:
  - Tahap 1: `ilustrasi_atas`, `ilustrasi_tengah`, `ilustrasi_bawah`, `cerita_1`, `cerita_2`, `paragraf_akhir`.
  - Tahap 3: `deskripsi_tahap3`, `penutup_tahap3`, `cerita_tahap3`.
  - Tahap 4: `deskripsi_tahap4`, `penutup_tahap4`, `kartu_keberagaman`.
  - Tahap 6: `sketsa_mewarnai`.
- `teks` (Text, Nullable): Keterangan teks gambar atau isi teks paragraf.
- `urutan` (Integer, Default: 0): Mengurutkan gambar/kartu agar tampil sesuai urutan yang diatur guru.
- `created_at` & `updated_at` (Timestamps)

### 3.5 Tabel `quizzes`
Menyimpan data soal evaluasi dan game interaktif di dalam materi.
- `id` (BigInt, PK, AutoIncrement)
- `materi_id` (BigInt, FK): Terhubung ke tabel `materis` (Cascade on delete).
- `tipe` (String): Tipe game kuis yang dimainkan:
  - `susun_huruf`: Mengeja kata berdasarkan huruf acak dengan bantuan gambar.
  - `puzzle_3x3`: Menyusun potongan gambar menjadi utuh.
  - `susun_kalimat`: Menyusun kata-kata terpisah menjadi kalimat yang benar.
  - `eja_kata`: Soal mengeja kata bahasa isyarat menggunakan kamera AI (Tahap 3).
  - `pilah_perilaku`: Game drag-and-drop mengelompokkan perilaku positif/negatif.
- `pertanyaan` (Text): Kalimat soal atau instruksi game.
- `jawaban_benar` (String): Jawaban akhir yang benar (misalnya kata target, nama file gambar utuh, atau kalimat utuh).
- `pilihan_data` (JSON, Nullable): Menyimpan data pelengkap (seperti daftar pilihan kata acak, data koordinat, list item perilaku beserta statusnya).
- `created_at` & `updated_at` (Timestamps)

### 3.6 Tabel `user_progresses`
Mencatat progres penyelesaian materi dan skor dari siswa secara real-time.
- `id` (BigInt, PK, AutoIncrement)
- `user_id` (BigInt, FK): Terhubung ke tabel `users` (Siswa).
- `materi_id` (BigInt, FK): Terhubung ke tabel `materis`.
- `tahap` (Integer): Indikator tahap pembelajaran (tahap 1 sampai 6).
- `score` (Integer, Default: 0): Nilai yang didapatkan (0 - 100).
- `is_completed` (Boolean, Default: false): Status apakah siswa telah menyelesaikan tahap tersebut.
- `answers` (JSON, Nullable): Menyimpan detail jawaban yang dikirimkan oleh siswa saat menyelesaikan tugas.
- `created_at` & `updated_at` (Timestamps)

---

## 4. Fitur Utama & Alur Pengguna (User Roles)

### 4.1 Hak Akses Siswa (Student)

#### A. Registrasi & Autentikasi
Siswa mendaftarkan akun secara mandiri melalui halaman Register (Fortify). Secara default, akun baru yang terdaftar akan mendapat role `'student'`. Setelah login, sistem mengarahkan siswa ke halaman dashboard.

#### B. Dashboard & Pemilihan Mata Pelajaran
Halaman awal siswa menampilkan subjek yang tersedia (seperti PPKn, Matematika, Bahasa Indonesia). Siswa dapat mengklik salah satu mata pelajaran untuk masuk ke peta pembelajaran materi.

#### C. Peta Belajar Game (Linear Progression RADEC)
Untuk setiap mata pelajaran, terdapat peta pembelajaran interaktif. Siswa mengendalikan karakter animasi dalam format peta petualangan (menuju ke sekolah) untuk menyelesaikan 6 tahap pembelajaran berbasis metode RADEC secara berurutan. Setiap tahap yang berhasil diselesaikan akan membuka tahap berikutnya dan menyimpan progres ke tabel `user_progresses`.

#### D. 6 Tahap Pembelajaran RADEC
1. **Tahap 1: Read (Membaca & Menyimak)**
   - Siswa membaca cerita utama bertema tertentu (dilengkapi ilustrasi gambar di atas, tengah, bawah).
   - Siswa menyimak video demonstrasi bahasa isyarat SIBI yang diperagakan oleh guru atau instruktur.
   - Progres otomatis tersimpan saat video disimak hingga selesai atau saat siswa mengklik tombol lanjut.
2. **Tahap 2: Answer (Kuis Interaktif)**
   Terdapat 3 jenis kuis interaktif yang harus diselesaikan berturut-turut:
   - *Susun Huruf*: Menampilkan gambar tokoh/benda dan huruf acak. Siswa mengklik huruf acak untuk menyusun kata yang tepat (misalnya: S-A-M-S-U-L).
   - *Puzzle 3x3*: Membagi gambar utama menjadi 9 bagian acak. Siswa harus menggeser potongan gambar ke posisi yang benar untuk membentuk gambar yang utuh.
   - *Susun Kalimat*: Menyediakan kata-kata acak yang terpisah. Siswa menyeret (drag) atau mengklik kata-kata tersebut agar tersusun menjadi kalimat yang padu.
3. **Tahap 3: Discuss (Diskusi & Praktik Isyarat AI)**
   - Siswa membaca teks deskripsi diskusi awal.
   - Siswa mengerjakan tantangan "Ejaan Kamera SIBI". Halaman ini mengakses webcam siswa. Kamera membaca gerakan tangan siswa untuk mengeja kata jawaban (misalnya: "MELAYU").
   - Jika isyarat tangan yang diperagakan di depan kamera sesuai dengan huruf target dan diakui oleh model AI (confidence > 0.82), huruf tersebut akan "terbang" ke slot ejaan, lalu sistem berlanjut meminta huruf berikutnya hingga kata selesai dieja.
   - Setelah selesai, siswa membaca bagian penutup diskusi.
4. **Tahap 4: Explain (Penjelasan & Kartu Keberagaman)**
   - Tahap untuk mengeksplorasi pemahaman lebih lanjut.
   - Siswa mempelajari grid interaktif yang berisi 9 slot "Kartu Keberagaman". Setiap kartu dapat diklik untuk menampilkan gambar dan teks penjelasan mengenai nilai-nilai toleransi, keragaman budaya, atau materi terkait.
5. **Tahap 5: Create (Pilah Perilaku)**
   - Game interaktif seret-dan-lepas (drag and drop).
   - Menyediakan sejumlah kartu kasus perilaku sehari-hari (dilengkapi teks, gambar, dan warna latar).
   - Siswa harus menyeret kartu perilaku tersebut ke dalam kategori yang tepat: "Perilaku Positif" (kotak hijau) atau "Perilaku Negatif" (kotak merah).
6. **Tahap 6: Create (Sketsa Mewarnai)**
   - Aktivitas kreativitas digital.
   - Siswa diberikan sketsa gambar hitam putih hasil unggahan guru.
   - Siswa dapat mewarnai sketsa gambar secara interaktif menggunakan palet warna digital langsung di halaman browser.

#### E. Latihan Bebas AI (AI Practice)
Menu khusus di mana siswa dapat memilih kata dari kamus kata latihan bebas (contoh: AYAM, BOLA, KUCING, RUMAH, MOBIL, BUKU, PISANG, BUNGA). Siswa dapat membuka kamera untuk melatih ejaan isyarat tangan SIBI mereka secara mandiri tanpa terikat materi pelajaran.

#### F. Evaluasi Pemahaman
Kuis evaluasi mandiri yang terdiri dari 10 soal pilihan berganda/interaktif untuk menguji pemahaman akhir siswa terhadap mata pelajaran.

#### G. Game Umum (General Games)
Siswa dapat mengakses area game umum untuk melatih memori dan logika:
- **Puzzle**: Game menyusun puzzle gambar umum.
- **Puzzle Instrument**: Menyusun potongan alat musik tradisional.
- **Memory Game**: Mencocokkan pasangan kartu gambar terbalik dengan jumlah langkah minimum.

---

### 4.2 Hak Akses Guru (Teacher)

#### A. Login & Dashboard Guru
Jika pengguna masuk dengan akun yang memiliki nilai kolom `role = 'teacher'`, middleware `EnsureUserIsTeacher` akan meloloskan akses dan mengarahkan ke dashboard guru di `/teacher/dashboard`. Halaman ini menampilkan daftar mata pelajaran yang dikelola.

#### B. Manajemen Materi
Guru dapat melihat materi yang ada pada mata pelajaran tertentu, membuat materi baru, atau mengedit materi yang sudah ada.

#### C. Wizard Input Materi (6 Langkah Konten)
Untuk mempermudah guru menyusun materi RADEC tanpa harus menyentuh database, disediakan Wizard Pembuatan Materi interaktif 6-langkah:
- **Langkah 1 (Dasar)**: Mengisi judul materi, deskripsi teks cerita, dan mengunggah video peragaan SIBI (`.mp4`, `.mov`, `.avi` maks 20MB).
- **Langkah 2 (Tahap 2 - Kuis)**:
  - Input kata target dan gambar tokoh untuk game *Susun Huruf*.
  - Mengunggah gambar besar untuk game *Puzzle 3x3*.
  - Input jawaban kalimat benar dan kata acak dipisah koma untuk game *Susun Kalimat*.
- **Langkah 3 (Tahap 3 - Diskusi)**:
  - Mengisi deskripsi diskusi awal dan penutup.
  - Memasukkan daftar kata target (maksimal 5 kata) beserta pertanyaan cerita untuk dieja siswa menggunakan Kamera AI.
  - Mengunggah kumpulan gambar storyboard diskusi.
- **Langkah 4 (Tahap 4 - Penjelasan)**:
  - Mengisi teks deskripsi awal & penutup.
  - Mengonfigurasi data 9 kartu keberagaman (upload gambar & isi penjelasan teks untuk masing-masing kartu).
- **Langkah 5 (Tahap 5 - Pilah Perilaku)**:
  - Mengisi daftar perilaku (teks perilaku, unggah gambar ilustrasi, dan memilih status apakah perilaku tersebut Positif atau Negatif). Sistem akan otomatis menentukan warna kotak (hijau untuk positif, merah untuk negatif) di sisi siswa.
- **Langkah 6 (Tahap 6 - Kreativitas)**:
  - Mengunggah file gambar sketsa hitam-putih (`.png`, `.jpg`, `.jpeg` maks 5MB) untuk bahan aktivitas mewarnai digital siswa.

#### D. Monitoring Evaluasi & Progress Siswa
Halaman khusus untuk guru memantau perkembangan belajar. Guru dapat melihat daftar siswa berkategori `student` beserta kemajuan belajarnya:
- Status penyelesaian tiap tahap (Tahap 1 - 6).
- Nilai/skor yang didapatkan siswa pada masing-masing tahap.
- Detail jawaban yang dikirimkan siswa untuk dievaluasi oleh guru.

---

## 5. Implementasi Sistem Deteksi Isyarat Kamera SIBI AI

Teknologi deteksi bahasa isyarat SIBI di HonuSign diimplementasikan di sisi browser menggunakan TensorFlow.js dan model TFLite kustom yang dikombinasikan dengan MediaPipe Hand Landmarker.

### 5.1 Pipeline Deteksi Real-time
1. **Inisialisasi Model**:
   - Sistem memuat MediaPipe Hand Landmarker via CDN (`tasks-vision/wasm`).
   - Sistem memuat model klasifikasi huruf SIBI (`honusign_model.tflite`) menggunakan compiler TFLite Web (`tf-tflite`).
   - Kamera web diaktifkan dengan resolusi ideal `640x480`.
2. **Pendeteksian Landmark Tangan**:
   - Setiap frame video yang ditangkap diumpankan ke model Hand Landmarker.
   - Jika tangan terdeteksi, model mengembalikan 21 koordinat titik sendi tangan dalam ruang 3 dimensi `(x, y, z)` (total 63 fitur numerik).
3. **Ekstraksi & Normalisasi Fitur**:
   Untuk memastikan performa deteksi tetap akurat terlepas dari jarak tangan ke kamera atau pergeseran posisi tangan, koordinat tangan dinormalisasi secara matematis sebelum dimasukkan ke model prediksi:
   - **Wrist Centering (Translasi)**: Koordinat pergelangan tangan (wrist / indeks 0) diambil sebagai pusat referensi `(wrist.x, wrist.y, wrist.z)`. Seluruh koordinat landmark lainnya dikurangi dengan koordinat wrist sehingga titik wrist menjadi `(0, 0, 0)`.
     $$\vec{P}_{i,\text{centered}} = \vec{P}_i - \vec{P}_0$$
   - **Scaling (Penskalaan)**: Jarak Euclidean maksimum dari wrist ke titik landmark terjauh ($d_{\text{max}}$) dihitung. Seluruh koordinat yang telah dipusatkan kemudian dibagi dengan $d_{\text{max}}$ agar ukurannya seragam antara 0 dan 1.
     $$\vec{P}_{i,\text{normalized}} = \frac{\vec{P}_{i,\text{centered}}}{d_{\text{max}}}$$
   - **Flattening**: Array koordinat yang dinormalisasi diubah menjadi flat array 1-dimensi berukuran 63 elemen bertipe float.
4. **Prediksi Klasifikasi Huruf**:
   - Flat array 63-dimensi diubah menjadi tensor 2D berukuran `[1, 63]` menggunakan TensorFlow.js.
   - Tensor dilemparkan ke model TFLite (`tfliteModel.predict(tensor)`) untuk menghasilkan nilai probabilitas masing-masing kelas.
   - Indeks nilai probabilitas tertinggi dicocokkan dengan array alfabet pendukung:
     `['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y']` (Note: J dan Z dilewati karena membutuhkan gerakan dinamis yang tidak dapat dideteksi dari pose satu frame statis).
5. **Logika Validasi Ejaan Kata**:
   - Sistem mencocokkan huruf hasil prediksi dengan huruf target kata yang sedang dieja pada indeks saat ini (`expectedLetter`).
   - Jika huruf prediksi sama dengan huruf target dan nilai tingkat keyakinan (confidence) model melebihi **`0.82`**, sistem akan:
     - Memicu animasi grafis "huruf terbang" dari kotak kamera menuju slot ejaan kata.
     - Menyimpan huruf ke dalam string akumulasi jawaban.
     - Menggeser indeks target ke huruf berikutnya.
     - Memberikan jeda waktu (delay) selama **`700ms`** sebelum memproses deteksi frame berikutnya guna menghindari pendeteksian berulang dari satu pose tangan yang sama.
   - Jika seluruh huruf dalam kata target berhasil dieja, sistem memicu modal kemenangan, memutar suara sukses, dan mengirimkan HTTP POST request ke server `/materi/save-progress` untuk memperbarui progres belajar siswa ke database.

---

## 6. Setup & Instalasi Proyek
Untuk menjalankan proyek HonuSign secara lokal, ikuti langkah-langkah berikut:
1. Pastikan sistem Anda telah terpasang PHP 8.3+, Composer, Node.js (dengan npm), dan MySQL Server.
2. Clone repositori proyek ke direktori lokal Anda.
3. Salin file `.env.example` menjadi `.env` dan konfigurasikan koneksi database MySQL (`DB_DATABASE=HonuSign`, `DB_USERNAME=root`, `DB_PASSWORD=`).
4. Jalankan perintah instalasi otomatis yang disediakan di `composer.json`:
   ```bash
   composer run setup
   ```
   *Perintah di atas akan menjalankan:*
   - `composer install` (instalasi library PHP backend)
   - Menyalin `.env.example` ke `.env` (jika belum ada)
   - `php artisan key:generate` (membuat application key baru)
   - `php artisan migrate --force` (membuat tabel-tabel di MySQL)
   - `npm install` (instalasi package frontend)
   - `npm run build` (melakukan bundling asset frontend menggunakan Vite)
5. Untuk menjalankan server development secara lokal:
   ```bash
   composer run dev
   ```
   *Perintah ini akan menjalankan concurrent process untuk:*
   - `php artisan serve` (web server lokal Laravel)
   - `php artisan queue:listen` (worker database queue)
   - `npm run dev` (Vite dev server untuk reload asset instan)
