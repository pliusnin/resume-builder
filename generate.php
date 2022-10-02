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

$options = array_merge([
    'data' => 'resources/demo.json',
    'template' => 'demo.html.twig',
    'output' => 'result/resume.pdf'
], getopt('', ['data::', 'template::', 'output::']));

if (null === $data = json_decode(file_get_contents(__DIR__ . '/' . $options['data']), true)) {
    print_r('Content is not a valid JSON. Filename: ' . $options['data']);
}

try {
    $html = $twig->render($options['template'], array_merge([
        'projectRoot' => __DIR__,
    ], $data));
    $snappy->generateFromHtml($html, __DIR__ . '/' . $options['output'], [], true);
    print_r('Successfully generated');
} catch (Error\LoaderError | Error\RuntimeError | Error\SyntaxError $e) {
    print_r('Error occurred: ' . $e->getMessage());
}
