<?php

// Include Composer autoloader if not already done.
use Smalot\PdfParser\Parser;
use Xthiago\PDFVersionConverter\Guesser\RegexGuesser;

function PDFtoText($document)
{

    // Parse pdf file and build necessary objects.
    $parser = new Parser();

    $pdf = $parser->parseFile($document);

    $data = $pdf->getText();

    return $data;
}

function PDFtoImg($document)
{

    // Parse pdf file and build necessary objects.
    $parser = new Parser();

    $pdf = $parser->parseFile($document);
    $images = $pdf->getObjectsByType('XObject', 'Image');

    foreach ($images as $image) {
        $content = $image->getContent();
//        echo '<img src="data:image/png;base64,' . base64_encode($content) . '" />';
    }


    return $images;
}


function PDFtoArray($document)
{

    // Parse pdf file and build necessary objects.
    $parser = new Parser();

    $pdf = $parser->parseFile($document);

    // Retrieve all pages from the pdf file.
    $pages = $pdf->getPages();
    $data = [];
    foreach ($pages as $page) {
        $text = $page->getText();
        array_push($data, $text);
    }

    return $data;
}

function string_between_two_string($str, $starting_word, $ending_word)
{

    try {
        $text = explode($starting_word, $str)[1];
        $text = explode($ending_word, $text)[0];
        $text = str_replace(array("\n", "\r"), ' ', $text);

    } catch (Exception $e) {
        $text = "";
    }

    //remove empty spaces in int of text
    if (strlen($text) > 0) {

        for ($i = 0; $i < strlen($text); $i++) {

            if ($text[$i] == " ") {
                $text = substr($text, 1);
                $i--;
            } else {
                break;
            }
        }
    }
    return $text;
}

function string_split($delimiter, $str, $index)
{

    try {
        $text = isset(explode($delimiter, $str)[$index]) ? explode($delimiter, $str)[$index] : "";

    } catch (Exception $e) {

        $text = "";
    }

    return $text;
}
