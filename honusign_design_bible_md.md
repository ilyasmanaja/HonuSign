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
- gunakan monochrome icon,
- gunakan single-color icon,
- gunakan outline icon,
- stroke konsisten,
- bentuk sederhana.

### FORBIDDEN
- icon full-color,
- icon realistis,
- icon terlalu detail,
- icon dengan banyak gradient,
- icon 3D kompleks.

---

## Recommended Icon Libraries
- Lucide Icons
- Tabler Icons
- Phosphor Icons
- Heroicons

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
