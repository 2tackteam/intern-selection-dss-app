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
        'page_title' => 'Internship Applicants',
    ],
    'show' => [
        'page_title' => 'Applicant Information',

        'title' => 'Applicant Information',
        'subtitle' => 'Personal details and application.',

        'full_name' => 'Full Name',
        'email_address' => 'Email Address',
        'place_date_of_birth' => 'Place / Date Of Birth',
        'place_of_birth' => 'Place Of Birth',
        'gender' => 'Gender',
        'last_education' => 'Last Education',
        'institution_name' => 'Institution Name',
        'major' => 'Major',
        'academic_year' => 'Academic Year',
        'gpa' => 'GPA',
        'status' => 'Status',
    ],
    'selection' => [
        'page_title' => 'Selection of Internship Applicants',

        'title' => 'Selection of Internship Applicants',
        'subtitle' => "Select applicants who are best suited to the company's needs.",
    ],

    'tables' => [
        'headers' => [
            'submission_date' => 'Submission Date',
            'full_name' => 'Full Name',
            'date_of_birth' => 'Date Of Birth',
            'place_of_birth' => 'Place Of Birth',
            'gender' => 'Gender',
            'last_education' => 'Last Education',
            'status' => 'Status',
            'actions' => 'Actions',

            'ranking' => 'Ranking',
            'name' => 'Applicant Name',
            'email' => 'Email',
            'major' => 'Major',
            'education' => 'Education',
            'gpa' => 'GPA',
            'score' => 'Selection Score',
        ],
    ],

    'buttons' => [
        'selection' => 'Participant Selection',
        'detail' => 'Details',
        'print' => 'Print',
        'save_result' => 'Simpan Hasil Peserta',
    ],

    'gender' => [
        'ALL' => 'All Gender',
        'M' => 'Male',
        'F' => 'Female',
    ],

    'status' => [
        'pending' => 'Pending',
        'accepted' => 'Accepted',
        'rejected' => 'Rejected',
    ],

    'notify' => [
        'title' => [
            'success' => 'Success',
            'error' => 'Oops! Something went wrong.',
        ],
        'messages' => [
            'process_selection' => [
                'success' => 'Successful selection of applicants.',
                'error' => 'Failed applicant selection.',
            ],
        ],
    ],

];
