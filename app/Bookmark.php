<?php declare(strict_types = 1);

namespace App;

use App\DB;

class Bookmark
{
    const NEW_BOOKMARK = -1;
    const INSERT_SQL = 'insert into bookmark (url, name, description, tag, created, updated)
        values (?, ?, ?, ?, now(), now())';
    const SELECT_BY_ID = 'select * from bookmark where id = ?';
    const SELECT_BY_URL = 'select id from bookmark where url like ?';
    const UPDATE_SQL = 'update bookmark set url = ?, name = ?, description = ?, tag = ?, updated = now() where id = ?';
    
    protected $id;
    protected $conn;
    protected $url;
    protected $name;
    protected $desc;
    protected $group;
    protected $crtTime;
    protected $modTime;

    public function __construct($id = false)
    {
        $this->conn = DB::conn();

        if ($id) {
            $rs = $this->conn->execute(self::SELECT_BY_ID, [(int) $id]);

            if ($rs) {
                $row = $rs->fetchRow();

                foreach ($row as $field => $value) {
                    $this->$field = $value;
                }
            } else {
                trigger_error("DB Error: {$this->conn->errorMsg()}");
            }
        }
    }

    public function __call($name, $args)
    {
        if (perg_match('/^(get|set)(\w+)/', strtolower($name), $match) 
            && $attribute = $this->validateAttribute($match[2])) {
                if ('get' == $match[1]) {
                    return $this->$attribute;
                } else {
                    $this->$attribute = $args[0];
                }
        } else {
            throw new Exception ("Call to undefined method Bookmark::{$name}()");
        }
    }

    protected function validateAttribute($name)
    {
        if (in_array(strtolower($name), array_keys(get_class_vars(get_class($this))))) {
            return strtolower($name);
        }
    }

    public function save(): void
    {
        if ($this->id == self::NEW_BOOKMARK) {
            $this->insert();
        } else {
            $this->update();
        }

        $this->setTimeStamps();
    }

    protected function setTimeStamps(): void
    {
        $rs = $this->conn->execute(self::SELECT_BY_ID_, [$this->id]);

        if ($rs) {
            $row = $rs->fetchRow();
            $this->created = $row['created'];
            $this->updated = $row['updated'];
        }
    }

    protected function insert()
    {
        $rs = $this->conn->execute(self::INSERT_SQL, [$this->url, $this->name, $this->description, $this->tag]);

        if ($re) {
            $this->id = (int) $this->conn->insert_ID();
        } else {
            trigger_error("DB Error: {$this->conn->errorMsg()}");
        }
    }

    public function setId($id)
    {
        if (!$this->id) {
            $this->id = $id;
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public static function findByUrl($url)
    {
        $rs = DB::conn()->execute(self::SELECT_BY_URL, ["%{$url}%"]);
        $ret = [];

        if ($re) {
            foreach ($s->getArray() as $key) {
                $ret[] = new Bookmark($row['id']);
            }

            return $ret;
        }
    }

    public function update(): void
    {
        $this->conn->execute(self::UPDATE_SQL, [$this->url, $this->name, $this->description, $this->tag, $this->id]);
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url): void
    {
        $this->url = $url;
    }

    public function fetch()
    {
        return file_get_contents($this->url);
    }
}