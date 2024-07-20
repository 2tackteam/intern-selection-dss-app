<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':Attribute harus diterima.',
    'accepted_if' => ':Attribute harus diterima jika :other adalah :value.',
    'active_url' => ':Attribute harus berupa URL yang valid.',
    'after' => ':Attribute harus beruba tanggal setelah :date.',
    'after_or_equal' => ':Attribute harus berupa tanggal setelah atau sama dengan :date.',
    'alpha' => ':Attribute hanya boleh berisi huruf.',
    'alpha_dash' => ':Attribute hanya boleh berisi huruf, angka, tanda hubung, dan garis bawah.',
    'alpha_num' => ':Attribute hanya boleh berisi huruf dan angka.',
    'array' => ':Attribute harus berupa array.',
    'ascii' => ':Attribute hanya boleh berisi karakter dan simbol alfanumerik satu-byte.',
    'before' => ':Attribute harus berupa tanggal sebelum :date.',
    'before_or_equal' => ':Attribute field must be a date before or equal to :date.',
    'between' => [
        'array' => ':Attribute harus memiliki antara :min dan :max item.',
        'file' => ':Attribute harus memiliki ukuran antara :min dan :max kilobyte.',
        'numeric' => ':Attribute harus berada di antara :min dan :max.',
        'string' => ':Attribute harus berada di antara :min dan :max karakter.',
    ],
    'boolean' => ':Attribute  harus bernilai true atau false.',
    'can' => ':Attribute berisi nilai yang tidak sah.',
    'confirmed' => ':Attribute konfirmasi tidak sesuai.',
    'contains' => ':Attribute tidak memiliki nilai yang harus diisi.',
    'current_password' => 'Kata sandi salah.',
    'date' => ':Attribute harus berupa tanggal yang valid.',
    'date_equals' => ':Attribute harus berupa tanggal yang sama dengan :date',
    'date_format' => ':Attribute harus sesuai dengan format :format.',
    'decimal' => ':Attribute harus berupa desimal :desimal.',
    'declined' => ':Attribute harus ditolak.',
    'declined_if' => ':Attribute ditolak ketika :other adalah :value.',
    'different' => ':Attribute dan :other harus berbeda.',
    'digits' => ':Attribute harus berupa angka :digit.',
    'digits_between' => ':Attribute harus berada di antara :min dan :max digit.',
    'dimensions' => ':Attribute memiliki dimensi gambar yang tidak valid.',
    'distinct' => ':Attribute memiliki nilai duplikat.',
    'doesnt_end_with' => ':Attribute tidak boleh diakhiri dengan salah satu dari yang berikut ini: :values.',
    'doesnt_start_with' => ':Attribute tidak boleh dimulai dengan salah satu dari berikut ini: :values.',
    'email' => ':Attribute harus berupa alamat email yang valid.',
    'ends_with' => ':Attribute harus diakhiri dengan salah satu dari yang berikut ini: :values.',
    'enum' => ':Attribute yang dipilih tidak valid.',
    'exists' => ':Attribute yang dipilih tidak valid.',
    'extensions' => ':Attribute harus memiliki salah satu dari ekstensi berikut: :values.',
    'file' => ':Attribute harus berupa file.',
    'filled' => ':Attribute harus memiliki nilai.',
    'gt' => [
        'array' => ':Attribute harus memiliki lebih dari item :value.',
        'file' => ':Attribute :value harus lebih besar dari :value kilobyte.',
        'numeric' => ':Attribute harus lebih besar dari :value.',
        'string' => ':Attribute harus lebih besar dari :value karakter.',
    ],
    'gte' => [
        'array' => ':Attribute harus memiliki item :value atau lebih.',
        'file' => ':Attribute :value harus lebih besar dari atau sama dengan :value kilobyte.',
        'numeric' => ':Attribute :value harus lebih besar dari atau sama dengan :value.',
        'string' => ':Attribute harus lebih besar dari atau sama dengan :value karakter.',
    ],
    'hex_color' => ':Attribute harus berupa warna heksadesimal yang valid.',
    'image' => ':Attribute harus berupa gambar.',
    'in' => ':Attribute dipilih tidak valid.',
    'in_array' => ':Attribute harus ada dalam :other.',
    'integer' => ':Attribute harus berupa bilangan bulat.',
    'ip' => ':Attribute harus berupa alamat IP yang valid.',
    'ipv4' => ':Attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => ':Attribute harus berupa alamat IPv6 yang valid.',
    'json' => ':Attribute harus berupa string JSON yang valid.',
    'list' => ':Attribute harus berupa daftar.',
    'lowercase' => ':Attribute harus berupa huruf kecil.',
    'lt' => [
        'array' => ':Attribute harus memiliki kurang dari :value item.',
        'file' => ':Attribute harus memiliki ukuran kurang dari :value kilobyte.',
        'numeric' => ':Attribute harus kurang dari :value.',
        'string' => ':Attribute harus kurang dari :value karakter.',
    ],
    'lte' => [
        'array' => ':Attribute tidak boleh memiliki lebih dari item :value.',
        'file' => ':Attribute harus kurang dari atau sama dengan :value kilobyte.',
        'numeric' => ':Attribute harus kurang dari atau sama dengan :value.',
        'string' => ':Attribute harus kurang dari atau sama dengan :value karakter.',
    ],
    'mac_address' => ':Attribute harus berupa alamat MAC yang valid.',
    'max' => [
        'array' => ':Attribute tidak boleh memiliki lebih dari :max item.',
        'file' => ':Attribute tidak boleh lebih besar dari :max kilobyte.',
        'numeric' => ':Attribute tidak boleh lebih besar dari :max.',
        'string' => ':Attribute tidak boleh lebih besar dari :max karakter.',
    ],
    'max_digits' => ':Attribute tidak boleh memiliki lebih dari :max digit.',
    'mimes' => ':Attribute harus berupa file bertipe: :values.',
    'mimetypes' => ':Attribute harus berupa file bertipe: :values.',
    'min' => [
        'array' => ':Attribute harus memiliki setidaknya :min item.',
        'file' => ':Attribute harus memiliki setidaknya :min kilobyte.',
        'numeric' => ':Attribute harus memiliki setidaknya :min.',
        'string' => ':Attribute harus setidaknya :min karakter.',
    ],
    'min_digits' => ':Attribute harus memiliki setidaknya :min digit.',
    'missing' => ':Attribute harus tidak ada.',
    'missing_if' => ':Attribute harus hilang ketika :other adalah :value.',
    'missing_unless' => ':Attribute harus hilang kecuali :other adalah :value.',
    'missing_with' => ':Attribute harus hilang ketika :values ada.',
    'missing_with_all' => ':Attribute harus hilang ketika :values ada.',
    'multiple_of' => ':Attribute harus merupakan kelipatan dari :value.',
    'not_in' => ':Attribute yang dipilih tidak valid.',
    'not_regex' => 'Format :Attribute tidak valid.',
    'numeric' => ':Attribute harus berupa angka.',
    'password' => [
        'letters' => ':Attribute harus berisi setidaknya satu huruf.',
        'mixed' => ':Attribute harus berisi setidaknya satu huruf besar dan satu huruf kecil.',
        'numbers' => ':Attribute harus berisi setidaknya satu angka.',
        'symbols' => ':Attribute harus berisi setidaknya satu simbol.',
        'uncompromised' => ':Attribute yang diberikan telah muncul dalam kebocoran data. Pilihlah :Attribute yang berbeda.',
    ],
    'present' => ':Attribute harus ada.',
    'present_if' => ':Attribute harus ada ketika :other adalah :value.',
    'present_unless' => ':Attribute harus ada kecuali :other adalah :value.',
    'present_with' => ':Attribute harus ada ketika :values ada.',
    'present_with_all' => ':Attribute harus ada ketika :values ada.',
    'prohibited' => ':Attribute dilarang.',
    'prohibited_if' => ':Attribute dilarang jika :other adalah :value.',
    'prohibited_unless' => ':Attribute dilarang kecuali :other dalam :values.',
    'prohibits' => ':Attribute melarang keberadaan :other.',
    'regex' => 'Format :Attribute tidak valid.',
    'required' => ':Attribute wajib diisi.',
    'required_array_keys' => ':Attribute harus berisi entri untuk: :values.',
    'required_if' => ':Attribute diperlukan ketika :other adalah :value.',
    'required_if_accepted' => ':Attribute diperlukan ketika :other diterima.',
    'required_if_declined' => ':Attribute diperlukan ketika :other ditolak.',
    'required_unless' => ':Attribute diperlukan kecuali :other ada di dalam :values',
    'required_with' => ':Attribute diperlukan ketika :values ada.',
    'required_with_all' => ':Attribute diperlukan ketika :values ada.',
    'required_without' => ':Attribute diperlukan ketika :values tidak ada.',
    'required_without_all' => ':Attribute diperlukan ketika tidak ada :values yang ada.',
    'same' => ':Attribute harus sama dengan :other.',
    'size' => [
        'array' => ':Attribute harus berisi item :size.',
        'file' => ':Attribute harus berukuran :size kilobyte.',
        'numeric' => ':Attribute harus berukuran :size.',
        'string' => ':Attribute harus berupa karakter dengan ukuran :size.',
    ],
    'starts_with' => ':Attribute harus dimulai dengan salah satu dari yang berikut ini: :values.',
    'string' => ':Attribute harus berupa string.',
    'timezone' => ':Attribute harus berupa zona waktu yang valid.',
    'unique' => ':Attribute sudah terdaftar.',
    'uploaded' => ':Attribute gagal diunggah.',
    'uppercase' => ':Attribute harus berupa huruf besar.',
    'url' => ':Attribute harus berupa URL yang valid.',
    'ulid' => ':Attribute harus berupa ULID yang valid.',
    'uuid' => ':Attribute harus berupa UUID yang valid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
