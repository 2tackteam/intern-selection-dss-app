<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Internship Applicant Selection Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Internship Applicant Selection Message
    | You are free to change them to anything you want
    | to customize your views to better match your application.
    |
    */

    'applicant_selection' => [
        'page_title' => 'Seleksi Pelamar Magang',

        'title' => 'Seleksi Pelamar Magang',
        'subtitle' => 'Untuk menyeleksi pelamar yang paling cocok dengan kebutuhan perusahaan.',
    ],
    'result' => [
        'page_title' => 'Seleksi Pelamar Magang',

        'title' => 'Hasil Seleksi Pelamar Magang',
        'subtitle' => 'Berikut ini adalah daftar pelamar magang yang telah diurutkan berdasarkan nilai seleksi.',

        'final_result' => 'Hasil Akhir',
        'process_matrix' => 'Matriks Proses',

        'weight_matrix' => 'Matrix Bobot',
        'pairwise_matrix' => 'Matrix Perbandingan',
        'criteria_value_matrix' => 'Nilai Kriteria Matrix',
    ],

    'table' => [
        'headers' => [
            'ranking' => 'Ranking',
            'name' => 'Nama Pelamar',
            'gender' => 'Jenis Kelamin',
            'email' => 'Alamat Email',
            'major' => 'Jurusan',
            'education' => 'Pendidikan',
            'gpa' => 'IPK / Nilai Rata-rata',
            'status' => 'Status',
            'score' => 'Nilai Seleksi',

            'criteria_matrix' => 'Matriks Kriteria',
            'sub_criteria_matrix' => 'Matriks Sub Kriteria - :value',
            'weight' => 'Bobot',
        ],
    ],

    'buttons' => [
        'selection' => 'Seleksi Pelamar',
        'save_result' => 'Simpan Hasil Peserta',
    ],

    'notify' => [
        'title' => [
            'success' => 'Berhasil',
            'error' => 'Oops! Terjadi suatu kesalahan.',
        ],
        'messages' => [
            'process_selection' => [
                'success' => 'Berhasil menampilkan hasil seleksi pelamar.',
                'error' => 'Gagal menampilkan hasil seleksi pelamar.',
            ],
            'process_result' => [
                'success' => 'Berhasil menyimpan hasil seleksi pelamar.',
                'error' => 'Gagal menyimpan hasil seleksi pelamar.',
            ],
        ],
    ],

    'modals' => [
        'confirm_store_applicant_selection_result' => [
            'title' => 'Apakah Anda yakin ingin menyimpan hasil seleksi ini?',
            'subtitle' => 'Setelah menyimpan hasil seleksi ini, status lamaran akan diperbarui sesuai dengan ketentuan nilai ambang batas yang telah diinput.',
        ],
    ],

];
