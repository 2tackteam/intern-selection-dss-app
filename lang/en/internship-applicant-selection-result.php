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
        'page_title' => 'Internship Applicant Selection Result',

        'title' => 'Internship Applicant Selection Result List',
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
            'success' => 'Success',
            'info' => 'Information',
            'error' => 'Oops! Something went wrong.',
        ],
        'messages' => [
            'export' => [
                'success' => 'Successfully export applicant selection results.',
                'empty' => 'No results found.',
                'error' => 'Failed to export applicant selection results.',
            ],
        ],
    ],
];
