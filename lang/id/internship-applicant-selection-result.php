<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Internship Applicant Selection Result Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Internship Applicant Selection Result Message
    | You are free to change them to anything you want
    | to customize your views to better match your application.
    |
    */

    'index' => [
        'page_title' => 'Hasil Seleksi Pelamar Magang',

        'title' => 'Hasil Seleksi Pelamar Magang',
        'subtitle' => 'Berikut ini adalah daftar pelamar magang yang telah diurutkan berdasarkan nilai seleksi.',
    ],
    'tables' => [
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
        ],
    ],

    'buttons' => [
        'print' => 'Print',
    ],

    'gender' => [
        'ALL' => 'All Gender',
        'M' => 'Male',
        'F' => 'Female',
    ],

    'status' => [
        'all' => 'Semua',
        'pending' => 'Pending',
        'accepted' => 'Accepted',
        'rejected' => 'Rejected',
    ],

    'notify' => [
        'title' => [
            'success' => 'Berhasil',
            'info' => 'Informasi',
            'error' => 'Oops! Terjadi suatu kesalahan.',
        ],
        'messages' => [
            'export' => [
                'success' => 'Berhasil export hasil seleksi pelamar.',
                'empty' => 'Tidak ada hasil seleksi pelamar.',
                'error' => 'Gagal export hasil seleksi pelamar.',
            ],
        ],
    ],
];
