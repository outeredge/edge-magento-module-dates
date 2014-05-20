<?php

$this->startSetup();

$this->run("
    CREATE TABLE IF NOT EXISTS {$this->getTable('dates/dates')} (
        `id` int(11) primary key NOT NULL auto_increment,
        `title` text NULL DEFAULT NULL,
        `date` datetime NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;     
");

$this->endSetup();