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

        'application_exists' => 'Pengajuan lamaran magang sudah terdaftar. Anda hanya diperbolehkan mendaftar satu kali.',
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
    'edit' => [
        'page_title' => 'Ubah Pengajuan Lamaran Magang',

        'title' => 'Ubah Data Lamaran',
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
        'edit' => 'Ubah',
        'delete' => 'Hapus',
        'submit' => 'Kirim Lamaran',
    ],

    'gender' => [
        'M' => 'Laki-laki',
        'F' => 'Perempuan',
    ],

    'status' => [
        'draft' => 'Draft',
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
            'submit' => [
                'success' => 'Anda telah mengirim data pengajuan magang.',
                'error' => 'Tidak dapat mengirim data pengajuan magang.',
            ],
            'update' => [
                'success' => 'Anda telah mengubah data pengajuan magang.',
                'error' => 'Tidak dapat mengubah data pengajuan magang.',
            ],
            'delete' => [
                'success' => 'Anda telah menghapus data pengajuan magang.',
                'error' => 'Tidak dapat menghapus data pengajuan magang.',
            ],
        ],
    ],

    'modals' => [
        'submit' => [
            'title' => 'Apakah Anda yakin ingin mengirimkan pengajuan magang?',
            'subtitle' => 'Data yang telah diajukan tidak dapat diubah ataupun dihapus. Tekan tombol Kirim Lamaran untuk melanjutkan.',
        ],
        'delete' => [
            'title' => 'Apakah Anda yakin ingin menghapus pengajuan lamaran magang Anda?',
            'subtitle' => 'Data yang dihapus tidak dapat dikembalikan. Tekan tombol hapus untuk mengonfirmasi bahwa Anda ingin menghapus data secara permanen.',
        ],
    ],
];
