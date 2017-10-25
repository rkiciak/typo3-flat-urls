<?php
defined('TYPO3_MODE') or die();

$GLOBALS['TCA']['pages_language_overlay']['columns']['tx_realurl_pathsegment']['label'] = 'LLL:EXT:flat_urls/Resources/Private/Language/locallang_db.xlf:pages.tx_realurl_pathsegment';
$GLOBALS['TCA']['pages_language_overlay']['columns']['tx_realurl_pathsegment']['config']['readOnly'] = true;
$GLOBALS['TCA']['pages_language_overlay']['columns']['tx_realurl_pathsegment']['config']['eval'] = str_replace(
    'nospace',
    \Pagemachine\FlatUrls\Evaluation\SpaceToDashEvaluator::class,
    $GLOBALS['TCA']['pages_language_overlay']['columns']['tx_realurl_pathsegment']['config']['eval']
);