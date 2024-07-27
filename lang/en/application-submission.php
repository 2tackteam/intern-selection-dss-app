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

        'application_exists' => 'The internship application has been registered. You are only allowed to apply once.',
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
    'edit' => [
        'page_title' => 'Edit Internship Application Submissions',

        'title' => 'Application Data Edit',
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
        'edit' => 'Edit',
        'delete' => 'Delete',
        'submit' => 'Submit Application',
    ],

    'gender' => [
        'M' => 'Male',
        'F' => 'Female',
    ],

    'status' => [
        'draft' => 'Draft',
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
            'submit' => [
                'success' => 'Application Data successfully submitted.',
                'error' => 'Application Data failed to be submitted.',
            ],
            'update' => [
                'success' => 'Application Data successfully updated.',
                'error' => 'Application Data failed to be updated.',
            ],
            'delete' => [
                'success' => 'Application Data successfully deleted.',
                'error' => 'Application Data failed to be deleted.',
            ],
        ],
    ],

    'modals' => [
        'submit' => [
            'title' => 'Are you sure you want to submit an internship application?',
            'subtitle' => 'Data that has been submitted cannot be changed or deleted. Press the Submit Application button to proceed.',
        ],
        'delete' => [
            'title' => 'Are you sure you want to delete your internship application?',
            'subtitle' => 'Deleted data cannot be restored. Press the delete button to confirm that you want to permanently delete the data.',
        ],
    ],
];
