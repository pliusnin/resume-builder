<?php

require_once 'vendor/autoload.php';

use Twig\Environment;
use Twig\Error;
use Twig\Loader\FilesystemLoader;
use Knp\Snappy\Pdf;

$loader = new FilesystemLoader(__DIR__ . '/template');
$twig = new Environment($loader);
$snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
$snappy->setOptions([
    'allow' => [__DIR__],
    'margin-top' => 0,
    'margin-bottom' => 0,
    'margin-left' => 0,
    'margin-right' => 0
]);

$data = json_decode(file_get_contents(__DIR__ . '/resources/data.json'), true);

try {
    $html = $twig->render('resume.html.twig', array_merge([
        'projectRoot' => __DIR__,
    ], $data));
    $snappy->generateFromHtml($html, './result/resume.pdf', [], true);
    print_r('Successfully generated');
} catch (Error\LoaderError | Error\RuntimeError | Error\SyntaxError $e) {
}
