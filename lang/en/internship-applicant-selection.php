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
        'page_title' => 'Selection of Internship Applicants',

        'title' => 'Selection of Internship Applicants',
        'subtitle' => "Select applicants who are best suited to the company's needs.",
    ],
    'result' => [
        'page_title' => 'Selection of Internship Applicants',

        'title' => 'Selection of Internship Applicants',
        'subtitle' => 'The following is a list of internship applicants that have been sorted by selection score.',
    ],

    'tables' => [
        'headers' => [
            'ranking' => 'Ranking',
            'name' => 'Applicant Name',
            'gender' => 'Gender',
            'email' => 'Email',
            'major' => 'Major',
            'education' => 'Education',
            'gpa' => 'GPA',
            'status' => 'Status',
            'score' => 'Selection Score',
        ],
    ],

    'buttons' => [
        'selection' => 'Applicant Selection',
        'save_result' => 'Simpan Hasil Peserta',
    ],

    'notify' => [
        'title' => [
            'success' => 'Success',
            'error' => 'Oops! Something went wrong.',
        ],
        'messages' => [
            'process_selection' => [
                'success' => 'Successfully display the applicant selection results.',
                'error' => 'Failed to display the applicant selection results.',
            ],
            'process_result' => [
                'success' => 'Successfully save the applicant selection results.',
                'error' => 'Failed save the applicant selection results.',
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
