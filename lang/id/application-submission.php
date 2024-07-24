<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Submission Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the Application Submission Message
    | You are free to change them to anything you want
    | to customize your views to better match your application.
    |
    */

    'index' => [
        'page_title' => 'Daftar Pengajuan Saya',
    ],
    'show' => [
        'page_title' => 'Detail Pengajuan Lamaran Magang',

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
    'create' => [
        'page_title' => 'Pengajuan Lamaran Magang',

        'title' => 'Input Data Lamaran',
        'subtitle' => 'Pastikan untuk mengisi semua informasi dengan lengkap dan akurat pada formulir data lamaran Anda.',
    ],

    'tables' => [
        'headers' => [
            'full_name' => 'Nama Lengkap',
            'submission_date' => 'Tanggal Pengajuan',
            'status' => 'Status',
            'actions' => 'Aksi',
        ],
    ],

    'buttons' => [
        'create' => 'Tambahkan Pengajuan Magang',
        'detail' => 'Detail',
        'print' => 'Cetak',
    ],

    'gender' => [
        'M' => 'Laki-laki',
        'F' => 'Perempuan',
    ],

    'status' => [
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
            'store' => [
                'success' => 'Anda telah menambahkan data pengajuan magang.',
                'error' => 'Tidak dapat menambahkan data pengajuan magang.',
            ],
        ],
    ],
];
