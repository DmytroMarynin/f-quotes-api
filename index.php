<?php

include __DIR__ . "/vendor/autoload.php";

echo "<h2>EXAMPLES FOR USE!</h2>";

$fq = FQuotes\FamousQuotesAPI::create();

$byID = $fq->getQuoteByID(10)[0];
$random = $fq->getRandomQuote()[0];
$byTag = $fq->getQuoteByTagName('programming')[0];
$byName = $fq->getQuoteByAuthor('Steve')[0];

showQuote($byID, 'byID');
showQuote($random, 'Random');
showQuote($byTag, 'byTag');
showQuote($byName, 'byName');

function showQuote($quote, $method)
{
    echo '<p> The methos is ' . $method . '</p>' . PHP_EOL;
    echo '<p> The quote is ' . $quote[1] . '</p>' . PHP_EOL;
    echo '<p> The quote ID is ' . $quote[0] . '</p>' . PHP_EOL;
    echo '<p> The quote author is ' . $quote[2] . '</p>' . PHP_EOL;
    echo '<p> The quote popularity is ' . $quote[2] . '</p>' . PHP_EOL;
    echo '<br><br>' . PHP_EOL . PHP_EOL;
}

