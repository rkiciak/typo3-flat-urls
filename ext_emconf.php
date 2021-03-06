<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Flat URLs',
    'description' => 'Flat URLs (like Stackoverflow) for TYPO3',
    'category' => 'misc',
    'author' => 'Mathias Brodala',
    'author_email' => 'mbrodala@pagemachine.de',
    'author_company' => 'Pagemachine AG',
    'state' => 'stable',
    'version' => '1.1.0',
    'constraints' => [
        'depends' => [
            'php' => '7.0.0-7.99.99',
            'typo3' => '7.6.0-8.7.99',
            'realurl' => '2.0.0-2.99.99',
        ],
    ],
];
