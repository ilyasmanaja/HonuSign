# HONUSIGN DESIGN BIBLE
## Platform Edukasi Anak Tunarungu
### Visual System, Accessibility Guide, & Frontend Design Rules

---

# I. CORE PHILOSOPHY

## Main Objective
HonuSign bukan hanya platform edukasi biasa.

HonuSign adalah platform pembelajaran visual-first yang dirancang khusus untuk membantu anak tunarungu belajar dengan pengalaman yang:
- nyaman,
- ramah,
- mudah dipahami,
- menyenangkan,
- dan tidak melelahkan secara visual.

Seluruh elemen antarmuka harus membantu pengguna memahami informasi TANPA bergantung pada audio.

Karena itu:
- visual = komunikasi,
- warna = feedback,
- animasi = respons,
- maskot = emosi,
- layout = fokus.

---

# II. VISUAL IDENTITY

## Design Style
### Semi-Brutalism + Soft Pastel Friendly UI

Style utama HonuSign menggabungkan:
- semi-brutalism,
- playful educational UI,
- modern accessibility design,
- dan soft pastel emotional interface.

Tujuannya:
- terlihat unik,
- mudah dikenali,
- tidak membosankan,
- tetap modern,
- namun tidak terlalu kompleks bagi anak-anak.

---

## Visual Characteristics

### Semi-Brutalist Elements
- Border hitam tegas
- Hard shadow tanpa blur
- Struktur layout jelas
- Card terpisah tegas
- Kontras visual kuat
- Elemen terasa "pop-out"

### Friendly Elements
- Rounded corner besar
- Warna pastel lembut
- Ilustrasi anak-anak
- Motion playful
- Layout ringan dan tidak intimidatif

---

# III. COLOR SYSTEM

## Main Background
| Usage | Color | HEX |
|---|---|---|
| Primary Background | Broken White | #FFFEFA |
| Secondary Surface | Soft Cream | #FFF9F0 |

Tujuan:
- mengurangi kelelahan mata,
- nyaman untuk penggunaan lama,
- menjaga tampilan tetap ringan.

---

## Accent Colors

| Function | Color | HEX |
|---|---|---|
| General Learning | Soft Blue | #BEE9E8 |
| Creativity & Art | Soft Pink | #FFD1E3 |
| Logic & Coding | Bright Yellow | #FFF5B8 |
| Success & Positive | Mint Green | #D4F1BE |
| Profile & Achievement | Pastel Purple | #E0BBE4 |
| Warning | Soft Orange | #FFD8A8 |
| Error | Soft Red | #FFB3B3 |

---

## Color Rules

### DO
- gunakan warna pastel lembut,
- gunakan background terang,
- gunakan warna untuk membantu hierarchy,
- gunakan glow untuk feedback.

### DON'T
- jangan gunakan warna neon menyilaukan,
- jangan gunakan saturasi berlebihan,
- jangan gunakan terlalu banyak warna dalam satu section,
- jangan gunakan gradient agresif.

---

# IV. TYPOGRAPHY SYSTEM

## Main Font
Recommended:
- Fredoka
- Quicksand
- Nunito

Semua font wajib:
- rounded,
- friendly,
- mudah dibaca,
- tidak terlalu tipis.

---

## Typography Scale

| Usage | Size |
|---|---|
| Hero Title | 40px - 52px |
| Section Title | 28px - 36px |
| Card Title | 20px - 24px |
| Body Text | 16px - 18px |
| Small Text | 14px |

---

## Typography Rules

### Headings
- wajib bold,
- kontras tinggi,
- spacing lega,
- maksimal 2 baris.

### Body Text
- hindari paragraf panjang,
- gunakan bullet point,
- gunakan spacing lega,
- gunakan bahasa sederhana.

---

# V. ICONOGRAPHY SYSTEM

## Icon Philosophy
Icon harus:
- sederhana,
- mudah dikenali,
- tidak membingungkan,
- dan tidak terlalu ramai.

---

## Icon Rules

### REQUIRED
- **wajib menggunakan gaya Duotone / Bulk Icons** (seperti Solar Icons Duotone, Iconly Bulk, atau Heroicons Duotone),
- memiliki struktur dua lapisan (*two-tone layer*):
  - **Layer Dasar/Latar**: Menggunakan `opacity="0.2"` (transparansi 20%) dengan warna senada untuk memberi efek kedalaman/dimensi lembut.
  - **Layer Utama/Depan**: Menggunakan warna solid pekat (`fill="currentColor"`).
- bentuk bersih, modern, dan *playful* yang ramah untuk anak-anak.

### FORBIDDEN
- icon 3D kompleks atau realistis,
- icon outline tipis (*kawat/light stroke*) yang sulit ditangkap mata anak tunarungu,
- icon dengan banyak gradient rumit atau shadow blur,
- icon bergaya korporat kaku.

---

## Recommended Icon Libraries
- **Solar Icons Duotone / Bulk (Utama & Wajib)**
- Heroicons Duotone
- Tabler Icons (versi Filled / Duotone)
- Iconly Bulk

---

# VI. BORDER & SHADOW SYSTEM

## Border Rules

Semua elemen utama WAJIB memiliki:
- border hitam,
- ketebalan 3px - 4px,
- kontras jelas.

Contoh:
- card,
- button,
- modal,
- navbar,
- popup,
- input.

---

## Shadow Rules

Gunakan:
### Hard Shadow

Karakteristik:
- tanpa blur,
- offset jelas,
- terasa seperti layer kertas.

Contoh:
- 6px 6px 0px #000

---

## Hover Shadow
Saat hover:
- shadow mengecil,
- elemen sedikit bergeser,
- memberi efek ditekan.

---

# VII. RADIUS SYSTEM

## Border Radius Scale

| Token | Radius |
|---|---|
| sm | 12px |
| md | 18px |
| lg | 24px |
| xl | 32px |

---

## Radius Rules

Hindari:
- sharp corner ekstrem,
- radius tidak konsisten.

Tujuan:
- UI terasa ramah,
- tidak kaku,
- cocok untuk anak-anak.

---

# VIII. LAYOUT SYSTEM

## Main Layout Philosophy

Gunakan:
### Bento Grid Layout

Karakteristik:
- informasi dipisah dalam kotak,
- satu card = satu fokus,
- mudah dipindai mata,
- tidak overwhelming.

---

## Layout Rules

### DO
- gunakan whitespace lega,
- gunakan hierarchy jelas,
- gunakan grouping visual.

### DON'T
- jangan padat,
- jangan terlalu banyak elemen dalam satu area,
- jangan gunakan layout berantakan.

---

## Container Rules

| Device | Width |
|---|---|
| Desktop | max 1280px |
| Tablet | fluid |

---

# IX. SPACING SYSTEM

## Spacing Tokens

| Token | Value |
|---|---|
| xs | 4px |
| sm | 8px |
| md | 16px |
| lg | 24px |
| xl | 32px |
| 2xl | 48px |
| 3xl | 64px |

---

## Spacing Rules

Setiap section wajib memiliki:
- breathing room,
- visual separation,
- hierarchy spacing.

Tujuan:
- membantu fokus visual,
- mengurangi kelelahan mata,
- memperjelas struktur informasi.

---

# X. COMPONENT SYSTEM

# Buttons

## Button Style

Karakteristik:
- border hitam tebal,
- rounded,
- shadow keras,
- warna pastel,
- teks bold.

---

## Button Interaction

Saat hover:
- tombol naik sedikit,
- shadow berubah,
- scale sangat kecil,
- transisi cepat dan playful.

Saat click:
- tombol turun,
- shadow mengecil,
- terasa ditekan.

---

# Cards

## Card Rules

Card wajib:
- memiliki border,
- memiliki shadow,
- memiliki padding lega,
- tidak terlalu penuh.

---

## Card Hierarchy

Setiap card harus memiliki:
- title,
- visual/icon,
- isi utama,
- CTA jika diperlukan.

---

# Forms & Inputs

## Input Rules

Input wajib:
- tinggi besar,
- mudah disentuh,
- memiliki border jelas,
- placeholder mudah dibaca.

---

## Focus State

Saat focus:
- muncul glow lembut,
- border berubah warna,
- visibility tinggi.

---

# Navbar

## Navbar Style

Karakteristik:
- fixed/sticky,
- clean,
- rounded,
- shadow kecil,
- spacing lega.

---

# Sidebar

Sidebar harus:
- mudah dipahami,
- icon besar,
- teks jelas,
- active state jelas.

---

# XI. ACCESSIBILITY SYSTEM

## Deaf-Friendly UX Principles

Semua feedback penting harus divisualisasikan.

JANGAN mengandalkan:
- suara,
- audio cue,
- notifikasi suara.

---

## Frame Glow Feedback

### Success
Glow hijau.

### Error
Glow merah.

### Warning
Glow kuning.

Glow muncul di pinggiran layar untuk memastikan feedback terlihat jelas.

---

## Minimal Text Philosophy

Gunakan:
- icon,
- ilustrasi,
- animasi,
- visual instruction.

Kurangi:
- teks panjang,
- paragraf besar,
- instruksi rumit.

---

# XII. VIDEO LEARNING SYSTEM

## Side-by-Side Learning

Layout:
- video SIBI di kiri,
- materi di kanan.

Tujuan:
- memudahkan sinkronisasi visual,
- membantu anak memahami gerakan sambil membaca.

---

## Video Controls

WAJIB:
- replay 5 detik,
- slow motion 0.5x,
- subtitle jelas.

---

# XIII. CAMERA DETECTION SYSTEM

## Camera Rules

Camera preview:
- tidak muncul permanen,
- hanya aktif saat diperlukan,
- muncul di tengah layar.

Tujuan:
- mengurangi distraksi,
- menjaga UI tetap bersih.

---

# XIV. MOTION SYSTEM

## Motion Philosophy

Animasi harus:
- ringan,
- playful,
- membantu feedback,
- bukan dekorasi berlebihan.

---

## Animation Rules

### DO
- gunakan motion pendek,
- gunakan easing lembut,
- gunakan microinteraction.

### DON'T
- jangan gunakan animasi terlalu cepat,
- jangan gunakan efek agresif,
- jangan gunakan flashing.

---

## Recommended Timing

| Interaction | Duration |
|---|---|
| Hover | 150ms |
| Card Transition | 200ms |
| Popup | 300ms |
| Glow Feedback | 250ms |

---

# XV. MASCOT & ILLUSTRATION SYSTEM

## Mascot Philosophy

Maskot digunakan sebagai:
- pengganti emosi suara,
- pemberi semangat,
- visual encouragement.

---

## Illustration Rules

Ilustrasi wajib:
- rounded,
- ekspresif,
- sederhana,
- tidak terlalu detail,
- warna lembut.

---

## Emotion System

Maskot dapat:
- tersenyum saat berhasil,
- memberi semangat saat gagal,
- menunjukkan instruksi visual.

---

# XVI. RESPONSIVE DESIGN RULES

## Tablet First Accessibility

Karena banyak interaksi touch:
- target klik besar,
- jarak antar tombol lega,
- hindari elemen terlalu kecil.

---

## Minimum Touch Area

Minimal:
- 44px × 44px.

---

## Responsive Layout

Desktop:
- multi-column,
- bento layout penuh.

Tablet:
- grid lebih besar,
- stacking lebih nyaman.

---

# XVII. FRONTEND IMPLEMENTATION RULES

## Recommended Stack
- Tailwind CSS
- Framer Motion
- React / Next.js

---

## Tailwind Principles

Gunakan:
- reusable component,
- utility consistency,
- design token,
- CSS variables.

---

## Naming Consistency

Gunakan naming:
- btn-primary,
- card-learning,
- glow-success,
- section-title.

---

# XVIII. UI QUALITY CONTROL

## Forbidden Design Problems

JANGAN:
- menggunakan default Bootstrap style,
- spacing tidak konsisten,
- border radius random,
- shadow blur berlebihan,
- terlalu banyak warna,
- icon full-color,
- layout padat,
- teks terlalu kecil.

---

# XIX. FINAL EXPERIENCE TARGET

HonuSign harus terasa:
- modern,
- playful,
- premium,
- ramah anak,
- visually clear,
- accessible,
- emotionally supportive.

User harus merasa:
- nyaman,
- tidak takut,
- mudah memahami,
- dan termotivasi belajar.

---

# XX. FINAL PRINCIPLE

## Core Rule

Jika sebuah elemen:
- membingungkan,
- terlalu ramai,
- sulit dibaca,
- tidak membantu fokus visual,
- atau tidak membantu komunikasi visual,

maka elemen tersebut harus disederhanakan.

---

## HonuSign Design Motto

"Visual is Communication."

Semua elemen UI harus membantu pengguna memahami, merasa nyaman, dan menikmati proses belajar tanpa bergantung pada audio.

---

# XXI. READING MATERIAL (MATERI MEMBACA) LAYOUT SYSTEM

## Layout Structure
Layout materi membaca dirancang dengan prinsip **fokus tunggal**, **minim distraksi**, dan **terstruktur secara visual (storyboard)**. Gunakan layout dari [tahap1.blade.php](file:///c:/Users/M S I/Downloads/HonuSign/resources/views/materi/tahap1/tahap1.blade.php) sebagai referensi utama.

### 1. Progress Bar & Header
- **Judul Tahap**: Menggunakan teks uppercase tebal (`font-black text-xl tracking-widest text-black`).
- **Progress Track**: Menggunakan container `bg-white brutal-border brutal-shadow-sm rounded-2xl p-1 h-8`.
- **Progress Indicator**: Menggunakan warna Soft Blue (`#BEE9E8`) dengan border pemisah di sisi kanan (`border-r-4 border-black`).
- **Judul Materi**: Centered, menggunakan font Fredoka tebal, ber-outline hitam tebal, rotasi sedikit (`-rotate-1`), dan drop shadow tegas (`drop-shadow-[0_6px_0_#000]`).

### 2. Layered Paper Container (Card Utama)
- **Outer Frame Card**: Menggunakan warna pastel cerah (misal: Soft Pink `#FFD1E3`), dibungkus dengan `brutal-border brutal-shadow rounded-[3rem] p-6 md:p-8`.
- **Inner Paper Card (Surface)**: Kertas putih bersih (`#FFFEFA`), rounded besar (`rounded-[2rem]`), padding lega (`p-6 md:p-10`), bertindak sebagai permukaan bacaan utama.

### 3. Story Elements & Storyboard Cards
- **Header Cerita**: Judul instansi/sumber cerita dengan ikon duotone (Solar Icons) di dalam kotak kecil yang terotasi (`p-3 bg-[#FFF5B8] brutal-border brutal-shadow-sm rounded-2xl transform -rotate-3`).
- **Tombol Video Isyarat**: Tombol pintas cepat berbentuk ikon TV (`bg-[#BEE9E8] brutal-border brutal-shadow-sm brutal-hover p-4 rounded-2xl`) diletakkan di sebelah kanan header cerita.
- **Ilustrasi Utama**: Gambar diposisikan di tengah (centered) di dalam bingkai putih terotasi: `bg-white p-4 brutal-border brutal-shadow-sm rounded-[2.5rem] transform rotate-1 / -rotate-1 hover:scale-105 transition-transform duration-300`.
- **Storyboard Character Grid (Kartu Karakter)**:
  - Gunakan layout grid 3 kolom (`grid grid-cols-1 md:grid-cols-3 gap-6`).
  - Setiap kartu memiliki warna pastel yang berbeda secara berselingan (`#D4F1BE`, `#BEE9E8`, `#FFF5B8`).
  - Gunakan rounded corner besar (`rounded-[2.5rem]`) dan rotasi dinamis (`rotate-2`, `-rotate-2`, `rotate-1`).
  - Animasi hover: `hover:-translate-y-2 transition-transform duration-300`.
  - Pola Floating: Kartu kolom tengah memiliki efek mengapung lebih tinggi pada layar desktop menggunakan offset top (`md:-translate-y-6`).

### 4. Navigation Actions
- Tombol aksi navigasi ("Keluar", "Kembali", atau "Lanjut") dipusatkan di bagian bawah halaman.
- Berbentuk lingkaran besar (`w-20 h-20 rounded-full`), menggunakan warna pastel fungsional (misal: Merah `#FFB3B3` untuk keluar, Hijau `#D4F1BE` untuk lanjut).
- Memiliki `brutal-border brutal-shadow-sm brutal-hover` dengan transisi naik saat dihover (`hover:-translate-y-2`).

---

# XXII. GAME LAYOUT & INTERACTIVE FLOW SYSTEM

UI Game di HonuSign menggunakan prinsip **visual-first feedback**, **interaktivitas tanpa teks rumit**, dan **edutainment yang ramah anak**. Ambil contoh implementasi dari [memory.blade.php](file:///c:/Users/M S I/Downloads/HonuSign/resources/views/general/memory.blade.php), [puzzle_instrument.blade.php](file:///c:/Users/M S I/Downloads/HonuSign/resources/views/general/puzzle_instrument.blade.php), dan [puzzle.blade.php](file:///c:/Users/M S I/Downloads/HonuSign/resources/views/general/puzzle.blade.php).

### 1. Game Intro Splash Screen
- Overlay pembuka full-screen (`fixed inset-0 bg-[#FFFEFA] z-[9999]`) yang menutupi board saat halaman dimuat.
- Menampilkan badge kategori game (misal: "Sliding Puzzle", "Memory Game", "Drag & Drop") dan Judul Game yang memantul (`animate-bounce`).
- Otomatis memudar secara perlahan setelah 2.5 detik (`transition-opacity duration-1000`).

### 2. Game Navigation & Difficulty
- **Tombol Kembali (Back)**: Terletak di kiri atas, berwarna merah lembut (`bg-[#FFB3B3]`), dilengkapi ikon panah kembali bersih (`brutal-border brutal-shadow-sm brutal-hover`).
- **Pilihan Tingkat Kesulitan**:
  - Menggunakan ikon bintang (1 bintang untuk Mudah, 3 bintang untuk Sulit).
  - Mode aktif berwarna kuning pastel (`bg-[#FFF5B8]`), mode tidak aktif berwarna abu-abu (`bg-[#E2E8F0]`).

### 3. Interactive Visual Tutorial Overlay
- **Tanpa Teks Panjang**: Anak-anak (terutama anak tunarungu) belajar lebih cepat dengan visual. Wajib menyediakan tutorial animasi interaktif.
- **Tampilan Overlay**: Latar belakang hitam transparan dengan blur (`bg-slate-900/80 backdrop-blur-md`).
- **Simulasi Animasi**: Tampilkan simulasi interaksi gameplay menggunakan gambar tangan penunjuk (`👆`) yang bergerak secara otomatis (misal: memperagakan klik kartu, menukar kotak puzzle, atau menarik potongan peta) lengkap dengan indikator sukses (warna hijau/glow) dan salah (warna merah/shake).

### 4. Soundless Visual Feedback System
Karena anak tunarungu tidak bisa mendengar audio cue, feedback visual harus sangat responsif dan jelas:
- **Sukses / Benar (Correct)**:
  - Element/kartu memancarkan glow hijau (`#D4F1BE`) atau langsung menghilang/bergabung.
  - Memancarkan efek partikel bintang terbang (`victory-star`) dengan timing cepat (1.5 detik) yang dibuat menggunakan CSS clip-path polygon bintang.
- **Gagal / Salah (Incorrect)**:
  - Screen-shake / Goyangan layar cepat (`screen-shake` animation).
  - Elemen berubah warna menjadi merah (`#FF6B6B`), bergetar (`mismatch-shake` animation), lalu kembali ke posisi semula.
  - Memunculkan balon teks popup kecil yang lucu ("Oops, coba lagi ya 😊") di sekitar area kesalahan.
- **Fitur Bantuan (Hint)**:
  - Jika anak terdiam selama 4 detik tanpa melakukan aksi, kartu target atau pilihan yang benar harus mulai bergoyang lembut (`hint-shake` / jiggle animation) untuk memandu pandangan mata anak.

### 5. Game Boards & Mechanics
- **Memory Card**: Card Grid 4x4. Punggung kartu menggunakan motif pola lingkaran pastel (`#BEE9E8` & `#FFF5B8`). Putaran kartu menggunakan CSS 3D transform (`perspective: 1000px`, `backface-visibility: hidden`).
- **Sliding Puzzle**: Board 3x3 dengan sistem tukar koordinat. Potongan gambar diatur menggunakan `background-position` secara persentase berdasarkan posisi grid.
- **Drag & Drop Map**: Rak penampung kepingan (`#pieces-tray`) berada di bawah dengan overflow horizontal yang smooth. Potongan peta ditarik menggunakan event mouse/touch, dengan garis putus-putus bantuan (`guide-line`) ke target koordinat sesungguhnya, dan menggunakan jarak toleransi piksel (threshold) untuk efek menempel otomatis.

### 6. Victory Overlay (Pop Up Menang)
- Modal kemenangan dengan transisi pop-out yang lembut (`transform scale-90 opacity-0 transition-all`).
- Menampilkan ilustrasi maskot emosi ceria: wajah tersenyum (`#BEE9E8`) dan jempol (`#FFD1E3`).
- Menyediakan tombol aksi yang jelas: Ulangi (kuning), Lanjut/Berikutnya (hijau), dan Kembali ke Menu (merah).
