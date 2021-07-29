<?php declare(strict_types = 1);

namespace App;

class BookmarkGateway
{
    const INSERT_SQL = 
        'insert into bookmark (url, name, description, tag, created, updated) 
        values (?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 
        'update bookmark set url = ?, name = ?, description = ?, tag = ?, updated = now()
        where id = ?';

    protected $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function add($url, $name, $description, $group): void
    {
        $rs = $this->conn->execute(self::INSERT_SQL, [$url, $name, $description, $group]);

        if (!$rs) {
            trigger_error("DB Error: {$this->conn->errorMsg()}");
        }
    }

    public function findAll(): array
    {
        $rs = $this->conn->execute('select * from bookmark');

        if ($rs) {
            return $rs->getArray();
        } else {
            trigger_error("DB Error: {$this->conn->errorMsg()}");
        }
    }

    public function findByTag($tag): AdoResultSetIteratorDecorator
    {
        $rs = $this->conn->execute('select * from bookmark where tag lik ?', ["{$tag}%"]);

        return new AdoResultSetIteratorDecorator($rs);
    }

    public function update(BookmarkGateway $bookmark)
    {
        $this->conn->execute(self::UPDATE_SQL, [
            $bookmark->url, $bookmark->name, $bookmark->description, $bookmark->tag, $bookmark->id
        ]);
    }
}