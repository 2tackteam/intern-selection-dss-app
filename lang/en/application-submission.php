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
        'page_title' => 'My Application Submissions',
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
    'create' => [
        'page_title' => 'Add Internship Application Submissions',

        'title' => 'Application Data Input',
        'subtitle' => 'Be sure to fill in all information completely and accurately on your application data form.',
    ],

    'tables' => [
        'headers' => [
            'full_name' => 'Full Name',
            'submission_date' => 'Submission Date',
            'status' => 'Status',
            'actions' => 'Actions',
        ],
    ],

    'buttons' => [
        'create' => 'Add Internship Application',
        'detail' => 'Details',
        'print' => 'Print',
    ],

    'gender' => [
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
            'store' => [
                'success' => 'Application Data successfully added.',
                'error' => 'Application Data failed to be added.',
            ],
        ]
    ],
];
