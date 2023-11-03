<?php

return [
    '@DoctrineAnnotation' => true,
    '@PER-CS2.0' => true,
    '@PER-CS2.0:risky' => true,
    '@PHP82Migration' => true,
    '@Symfony' => true,
    '@Symfony:risky' => true,
    '@PHPUnit84Migration:risky' => true,
    'attribute_empty_parentheses' => true, // By PER2.0
    'blank_line_before_statement' => [
        'statements' => [
            'break',
            'case',
            'continue',
            'declare',
            'default',
            'do',
            'exit',
            'for',
            'foreach',
            'goto',
            'if',
            'include',
            'include_once',
            'require',
            'require_once',
            'return',
            'switch',
            'throw',
            'try',
            'while',
            'yield_from',
        ],
    ],
    'blank_line_between_import_groups' => false, // Too much noise
    'concat_space' => ['spacing' => 'one'], // Clarity for concatenations
    'general_phpdoc_annotation_remove' => ['annotations' => ['since', 'package', 'subpackage', 'date']], // Keep author for borrowed code
    //'header_comment' => ['header' => $header], // Needs configuring per project
    'mb_str_functions' => true,
    'not_operator_with_successor_space' => true,
    'phpdoc_line_span' => ['property' => 'single', 'method' => 'single', 'const' => 'single'],
    'phpdoc_param_order' => true,
    'phpdoc_tag_casing' => true,
    'regular_callable_call' => true,
    'ordered_class_elements' => false, // Use the depth-first ordering approach
    'ordered_imports' => [
        'imports_order' => ['const', 'class', 'function'],
    ],
    'php_unit_method_casing' => ['case' => 'snake_case'], // it_[does]_[something]
    'php_unit_strict' => false, // Cannot do this globally
    //'php_unit_test_annotation' => ['style' => 'annotation'],
    'php_unit_test_class_requires_covers' => false,
    'phpdoc_to_comment' => false, // PHPStan needs these
    'phpdoc_var_without_name' => false, // PHPStan needs these
    'single_line_throw' => false, // Long messages might be used
    'strict_comparison' => false, // Cannot do this globally
    'types_spaces' => ['space' => 'single'], // Clarity for separate classes
    'yoda_style' => ['equal' => false, 'identical' => false], // Yoda style is not used
];
