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
     * @var list<string>
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

    public $subject = [
        'title' => [
            'label' => 'Título del examen',
            'rules' => 'required|min_length[5]|max_length[100]|is_unique[subjects.title]',
            'errors' => [
                'required' => 'El campo {field} es obligatorio.',
                'min_length' => 'El título debe tener al menos 5 caracteres.',
                'max_length' => 'El título no puede tener más de 100 caracteres.',
                'is_unique' => 'El título del examen ya existe en la base de datos.'
            ]
        ]
    ];


}
