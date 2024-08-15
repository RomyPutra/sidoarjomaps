<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $authlogin = [
        'email'         => 'required|valid_email',
        'password'      => 'required'
    ];

    public $authlogin_errors = [
        'email'=> [
            'required'  => 'Email wajib diisi.',
            'valid_email'   => 'Email tidak valid'
        ],
        'password'=> [
            'required'  => 'Password wajib diisi.'
        ]
    ];

    public $authregister = [
        'id'                => 'max_length[20]|is_natural_no_zero',
        'email'             => 'required|valid_email|is_unique[users.email,id,{id}]',
        'username'          => 'required|alpha_numeric|is_unique[users.username,id,{id}]|min_length[8]|max_length[35]',
        'name'              => 'required|alpha_numeric_space|min_length[3]|max_length[35]',
        'password'          => 'required|string|min_length[8]|max_length[35]',
        'confirm_password'  => 'required|string|matches[password]|min_length[8]|max_length[35]',
    ];

    public $authregister_errors = [
        'email'=> [
            'required'      => 'Email wajib diisi',
            'valid_email'   => 'Email tidak valid',
            'is_unique'     => 'Email sudah terdaftar'
        ],
        'username'=> [
            'required'      => 'Username wajib diisi',
            'alpha_numeric' => 'Username hanya boleh berisi huruf dan angka',
            'is_unique'     => 'Username sudah terdaftar',
            'min_length'    => 'Username minimal 8 karakter',
            'max_length'    => 'Username maksimal 35 karakter'
        ],
        'name'=> [
            'required'              => 'Name wajib diisi',
            'alpha_numeric_spaces'  => 'Name hanya boleh berisi huruf, angka dan spasi',
            'min_length'            => 'Name minimal 3 karakter',
            'max_length'            => 'Name maksimal 35 karakter'
        ],
        'password'=> [
            'required'      => 'Password wajib diisi',
            'string'        => 'Password hanya boleh berisi huruf, angka, spasi dan karakter lain',
            'min_length'    => 'Password minimal 8 karakter',
            'max_length'    => 'Password maksimal 35 karakter'
        ],
        'confirm_password'=> [
            'required'      => 'Konfirmasi password wajib diisi',
            'string'        => 'Konfirmasi password hanya boleh berisi huruf, angka, spasi dan karakter lain',
            'matches'       => 'Konfirmasi password tidak sama dengan password',
            'min_length'    => 'Konfirmasi password minimal 8 karakter',
            'max_length'    => 'Konfirmasi password maksimal 35 karakter'
        ]
    ];
}
