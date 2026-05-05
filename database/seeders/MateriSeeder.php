<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materi;

class MateriSeeder extends Seeder
{
    public function run(): void
    {
        $materi_cerita = [
            'order' => 1,
            'judul' => 'Samsul dan Pakaian Kebanggaannya',
            'slug' => 'samsul-dan-pakaian-kebanggaannya',
            // Kita numpang di kolom ini untuk nyimpan nama gambar ilustrasi
            'video_peragaan' => 'kelas.png',
            // Isi paragraf cerita
            'deskripsi' => "Di kelas 4 SLB Insan Mutiara Pekanbaru, Samsul dan teman-temannya bersiap mengikuti festival budaya untuk merayakan Hari Kemerdekaan 17 Agustus. Sebelum festival, mereka gotong royong membersihkan kelas. Samsul menyusun kursi, Abdul mengelap kaca, dan Siti menyapu. 

Saat festival, mereka memakai pakaian adat yang berbeda-beda. Samsul memakai teluk belanga, Siti memakai bundo kanduang, dan Abdul memakai kanigaran. Awalnya beberapa anak berbicara dengan bahasa daerah, tetapi tidak semua teman mengerti. Guru kemudian mengingatkan untuk memakai Bahasa Indonesia agar semua bisa saling memahami. Mereka berjalan bersama dengan rapi dan terlihat kompak. Pada acara 17 Agustus, kelas 4 SLB Insan Mutiara diumumkan sebagai kelas terbersih karena mereka rajin bekerja sama membersihkan kelas. Amir dan teman-temannya merasa senang dan bangga.
",
            'deskripsi_tambahan' => 'Pada sore hari di lapangan sekolah di Dumai, anak-anak kelas 2 diminta untuk menjadi pengisi paduan suara saat upacara bendera pada hari senin. Anak-anak sangat riang gembira, termasuk made, samsul, dan udin. Mereka bersemangat untuk menyanyikan lagu satu nusa,satu bangsa ciptaan L.Manik karena guru mereka pernah bercerita bahwa meski Indonesia punya beragam suku dan budaya tetapi Indonesia tetaplah sebuah kesatuan yang tidak dapat dipisahkan. Lagu ini mencerminkan persahabatan made, samsul dan udin yang berbeda budaya. Made dari bali, Samsul dari melayu riau, dan udin dari jawa, meski berbeda suku dan kebudayaan mereka masih tetap bersahabat bersama.

Selesai mereka latihan paduan suara, made, samsul dan udin berkumpul dengan teman-temannya yang lain memberitahukan makna lagu satu nusa, satu bangsa yang mereka nyanyikan. Saat semuanya berkumpul, siti yang baru selesai membacakan undang-undang langsung berlari menuju tempat teman-temannya. Sebab terburu-buru ia pun tersandung bebatuan dan jatuh. Udin pun segera menolong siti yang hampir menangis karena rasa sakit di kakinya. Kemudian siti pun duduk bersama-sama membahas mengenai lagu satu nusa,satu bangsa dan tentang keberagaman budaya mereka. 
'
        ];

        Materi::create($materi_cerita);
    }
}