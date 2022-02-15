<?php

namespace FQuotes;

use Curl\Curl;

class FamousQuotesAPI implements QuotesInterface
{
    private $tags = array(
        'sport',
        'career',
        'humour',
        'politics',
        'programming',
        'family',
        'education',
        'romance'
    );
    public static $curl;

    private function __construct()
    {
        self::$curl = new Curl();

        return (is_object(self::$curl)) ? self::$curl : null;
    }

    public static function create()
    {
        return
            (is_object(self::$curl) && self::$curl !== null)
            ? self::$curl
            : new self();
    }

    protected function queryBuilder(array $parameters)
    {
        if (isset($parameters['tag'])) {
            if (!in_array($parameters['tag'], $this->tags)) {
                $parameters['tag'] = false;
            }
        }

        $data = array(
            'id' => (isset($parameters['id'])) ? (int)$parameters['id'] : 'day',
            'tags' => (isset($parameters['tag'])) ? $parameters['tag'] : false,
            'popularity' => (isset($parameters['popularity'])) ? (int)$parameters['popularity'] : false,
            'vote-max' => (isset($parameters['limit']) && !isset($parameters['id'])) ? (int)$parameters['limit'] : false,
            'author' => (isset($parameters['author'])) ? $parameters['author'] : false,
        );

        $data = array_filter($data);

        return http_build_query($data, '', '&');
    }

    protected function sendResponce(string $query = '')
    {
        if ($query == '') {
            return false;
        }

        //echo "http://www.Famous-Quotes.uk/api.php?" . $query . PHP_EOL; return false;

        self::$curl->get("http://www.Famous-Quotes.uk/api.php?" . $query);

        return (self::$curl->error) ? false : json_decode(self::$curl->response);
    }

    public function getQuoteByID(int $id): array
    {
        $query = $this->queryBuilder(array('id' => $id));
        $result = $this->sendResponce($query);
        return ($result) ? $result : array();
    }

    public function getRandomQuote(int $popularity = 80, int $limit = 1): array
    {
        $query = $this->queryBuilder(array('popularity' => $popularity, 'limit' => $limit));
        $result = $this->sendResponce($query);
        return ($result) ? $result : array();
    }

    public function getQuoteByTagName(string $tag, int $limit = 1): array
    {
        $query = $this->queryBuilder(array('tag' => $tag, 'limit' => $limit));
        $result = $this->sendResponce($query);
        return ($result) ? $result : array();
    }

    public function getQuoteByAuthor(string $authorName, int $limit = 1): array
    {
        $query = $this->queryBuilder(array('author' => $authorName, 'limit' => $limit));
        $result = $this->sendResponce($query);
        return ($result) ? $result : array();
    }

    public function __destruct()
    {
        self::$curl->close();
    }
}