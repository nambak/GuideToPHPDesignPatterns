<?php

define('BOOKMARK_TABLE_DDL', <<<EOS
CREATE TABLE 'bookmark' (
    'id' INT NOT NULL AUTO_INCREMENT,
    'url' VARCHAR(255) NOT NULL,
    'name' VARCHAR(255) NOT NULL,
    'description' MEDIUMTEXT,
    'tag' VARCHAR(50),
    'created' DATETIME NOT NULL',
    'updated' DATETIME NOT NULL',
    PRIMARY KEY ('id')
)
EOS
);