<?php

return [

    'required' => ':attribute wajib diisi.',
    'string' => ':attribute harus berupa teks.',
    'email' => ':attribute harus berupa alamat email yang valid.',
    'unique' => ':attribute sudah digunakan.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'min' => [
        'string' => ':attribute minimal :min karakter.',
    ],
    'max' => [
        'string' => ':attribute maksimal :max karakter.',
    ],
    'numeric' => ':attribute harus berupa angka.',
    'integer' => ':attribute harus berupa bilangan bulat.',
    'date' => ':attribute bukan tanggal yang valid.',
    'date_format' => ':attribute tidak sesuai format :format.',
    'before' => ':attribute harus berupa tanggal sebelum :date.',
    'after' => ':attribute harus berupa tanggal setelah :date.',
    'exists' => ':attribute yang dipilih tidak valid.',
    'in' => ':attribute yang dipilih tidak valid.',
    'image' => ':attribute harus berupa gambar.',
    'mimes' => ':attribute harus berupa file dengan format: :values.',
    'file' => ':attribute harus berupa file.',
    'boolean' => ':attribute harus berupa true atau false.',
    'array' => ':attribute harus berupa array.',
    'regex' => 'Format :attribute tidak valid.',
    'same' => ':attribute harus sama dengan :other.',
    'different' => ':attribute harus berbeda dengan :other.',
    'nullable' => ':attribute boleh dikosongkan.',
    'sometimes' => ':attribute tidak wajib diisi.',

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'password' => 'password',
        'password_confirmation' => 'konfirmasi password',
        'phone' => 'nomor telepon',
        'date_of_birth' => 'tanggal lahir',
        'start_time' => 'jam mulai',
        'end_time' => 'jam selesai',
        'booking_date' => 'tanggal booking',
        'purpose' => 'keperluan',
        'notes' => 'catatan',
        'photo' => 'foto',
        'club_name' => 'nama klub',
        'leader_name' => 'nama ketua',
    ],

];