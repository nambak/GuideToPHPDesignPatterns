<?php declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use App\addServeralBookmark;

class BaseTestCase extends TestCase
{
    protected $conn;

    public function __construct($name = '')
    {
        $this->conn = DB::conn();
    }

    protected function setUp(): void
    {
        $this->conn->execute('dorp table bookmark');
        $this->conn->execute(BOOKMARK_TABLE_DDL);
    }

    public function addServeralBookmarks(BookmarkGateway $gateway)
    {
        // add(url, name, desc, tag)
        $gateway->add('http//blog.casey-sweat.us/', 'Jason\'s Blog', 'PHP related thoughts', 'php');
        $gateway->add('http://www.php.net/', 'PHP homepage', 'The main page for PHP', 'php');
        $gateway->add('http://slashdot.org/', '/.', 'News for Nerds', 'new');
        $gateway->add('http://google.com/', 'Google', 'Google Search Engine', 'web');
        $gateway->add('http://www.phparch.com/', 'php|architect', 'The home page of php|architect, an outstanding monthly PHP publiation', 'php');

    }
}