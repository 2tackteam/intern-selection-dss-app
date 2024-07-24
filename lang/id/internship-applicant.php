<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Applicant Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Applicant Message
    | You are free to change them to anything you want
    | to customize your views to better match your application.
    |
    */
    'index' => [
        'page_title' => 'Pelamar Magang',
    ],
    'show' => [
        'page_title' => 'Informasi Pelamar',

        'title' => 'Informasi Pelamar',
        'subtitle' => 'Detail pribadi dan lamaran magang.',

        'full_name' => 'Nama Lengkap',
        'email_address' => 'Alamat Email',
        'place_date_of_birth' => 'Tempat / Tanggal Lahir',
        'gender' => 'Jenis Kelamin',
        'last_education' => 'Pendidikan Terakhir',
        'institution_name' => 'Nama Instansi',
        'major' => 'Jurusan',
        'academic_year' => 'Tahun Akademik',
        'gpa' => 'IPK / Nilai Rata-rata',
        'status' => 'Status',
    ],
    'selection' => [
        'page_title' => 'Seleksi Pelamar Magang',

        'title' => 'Seleksi Pelamar Magang',
        'subtitle' => 'Untuk menyeleksi pelamar yang paling cocok dengan kebutuhan perusahaan.',
    ],

    'selection_result' => [
        'page_title' => 'Hasil Seleksi Pelamar Magang',

        'title' => 'Hasil Seleksi Pelamar Magang',
        'subtitle' => 'Berikut ini adalah daftar pelamar magang yang telah diurutkan berdasarkan nilai seleksi.',
    ],

    'tables' => [
        'headers' => [
            'submission_date' => 'Tanggal Pengajuan',
            'full_name' => 'Nama Lengkap',
            'date_of_birth' => 'Tanggal Lahir',
            'place_of_birth' => 'Tempat Lahir',
            'gender' => 'Jenis Kelamin',
            'last_education' => 'Pendidikan Terakhir',
            'status' => 'Status',
            'actions' => 'Aksi',

            'ranking' => 'Ranking',
            'name' => 'Nama Pelamar',
            'email' => 'Alamat Email',
            'major' => 'Jurusan',
            'education' => 'Pendidikan',
            'gpa' => 'IPK / Nilai Rata-rata',
            'score' => 'Nilai Seleksi',
        ],
    ],

    'buttons' => [
        'selection' => 'Seleksi Peserta',
        'preview_selection_result' => 'Tampilkan Hasil Seleksi Magang',
        'detail' => 'Detail',
        'print' => 'Cetak',
        'save_result' => 'Simpan Hasil Peserta',
    ],

    'gender' => [
        'ALL' => 'Semua',
        'M' => 'Laki-laki',
        'F' => 'Perempuan',
    ],

    'status' => [
        'all' => 'Semua',
        'pending' => 'Menunggu',
        'accepted' => 'Diterima',
        'rejected' => 'Ditolak',
    ],

    'notify' => [
        'title' => [
            'success' => 'Berhasil',
            'error' => 'Oops, terjadi kesalahan',
        ],
        'messages' => [
            'process_selection' => [
                'success' => 'Berhasil menampilkan hasil seleksi pelamar.',
                'error' => 'Gagal menampilkan hasil seleksi pelamar.',
            ],
            'applicant_selection_result' => [
                'success' => 'Berhasil menyimpan hasil seleksi pelamar.',
                'error' => 'Gagal melakukan seleksi pelamar.',
            ]
        ],
    ],


    'modals' => [
        'confirm_store_applicant_selection_result' => [
            'title' => 'Apakah Anda yakin ingin menyimpan hasil seleksi ini?',
            'subtitle' => 'Setelah menyimpan hasil seleksi ini, status lamaran akan diperbarui sesuai dengan ketentuan nilai ambang batas yang telah diinput.'
        ]
    ]

];
