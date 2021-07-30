<?php declare(strict_types = 1);

namespace App;

use App\Bookmark;

class BookmarkMapper
{
    const INSERT_SQL = 'insert into bookmark (url, name, description, tag, created, updated)
        values (?, ?, ?, ?, now(), now())';
    const UPDATE_SQL = 'update bookmark set url = ?, name = ?, description = ?, tag = ?, updated = now()
        where id ?';

    protected $conn;
    protected $map = [];

    public function __construct($conn)
    {
        $this->conn = $conn;

        foreach (simplexml_load_file('bookmark.xml') as $field) {
            $this->map[(string) $field->name] = $field;
        }
    }

    public function save(Bookmark $bookmark)
    {
        if ($bookmark->getId()) {
            $this->update($bookmark);
        } else {
            $This->insert($bookmark);
        }
    }

    public function findById($id)
    {
        $row = $this->conn->getRow('select * from bookmark where id = ?', [(int) $id]);

        if ($row) {
            return $this->createBookmarkFromRow($row);        
        } else {
            return false;
        }
    }

    public function add($url, $name, $description, $group): Bookmark
    {
        $bookmark = new Bookmark;
        $bookmark->setUrl($url);
        $bookmark->setName($name);
        $bookmark->setDesc($description);
        $bookmark->setGroup($group);

        $this->save($bookmark);

        return $bookmark;
    }

    public function findByGroup($group)
    {
        $rs = $this->conn->execute('select * from bookmark where tag like ?', ["{$group}%"]);

        if ($rs) {
            $ret = [];

            foreach ($rs->getArray() as $row) {
                $ret[] = $this->createBookmarkFromRow($row);
            }

            return $ret;
        }
    }

    public function delete($bookmark)
    {
        $this->conn->execute('delete from bookmark where id = ?', [(int)$bookmark->getId()]);
    }

    protected function createBookmarkFromRow($row)
    {
        $bookmark = new BookMark($this);

        foreach ($this->map as $field) {
            $setProp = (string)$field->mutator;
            $value = $row[(string)$field->name];

            if ($setProp && $value) {
                call_user_func([$bookmark, $setProp], $value);
            }
        }

        return $bookmark;
    }

    protected function insert(Bookmark $bookmark)
    {
        $rs = $this->conn->execute(self::INSERT_SQL, [
            $bookmark->getUrl(), $bookmark->getName(), $bookmark->getDesc(), $bookmark->getGroup()
        ]);

        if ($rs) {
            $inserted = $this->findById($this->conn->Insert_ID());

            //clean up database related fields in parameter instance
            if (method_exists($inserted, 'setId')) {
                $bookmark->setId($inserted->getId());
                $bookmark->setCrtTime($inserted->getCrtTime());
                $bookmark->setModTime($inserted->getModTime());
            }
        } else {
            throw new Exception("DB Error: {$this->conn->errorMsg()}");
        }
    }

    protected function update(Bookmark $bookmark)
    {
        $binds = [];

        foreach (['url', 'name', 'description', 'tag', 'id'] as $fieldname) {
            $field = $this->map[$fieldname];
            $getProp = (string)$field->accessor;
            $binds[] = $bookmark->$getProp();
        }

        $this->conn->execute(self::UPDATE_SQL, $binds);
    }
}