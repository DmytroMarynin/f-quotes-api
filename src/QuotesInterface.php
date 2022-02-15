<?php

namespace FQuotes;

interface QuotesInterface
{
    /**
     * @param int $id
     * @return array
     */
    public function getQuoteByID(int $id): array;

    /**
     * Get random Quote with possibility to add popularity value and limit
     * @param int $popularity
     * @param int $limit
     * @return array
     */
    public function getRandomQuote(int $popularity = 80, int $limit = 1): array;

    /**
     * Get popular day Quote by Tag
     * @param string $quote
     * @return array
     */
    public function getQuoteByTagName(string $quote, int $limit = 1): array;

    /**
     * get Quote by author name
     * @param string $authorName
     * @return array
     */
    public function getQuoteByAuthor(string $authorName, int $limit = 1): array;

}