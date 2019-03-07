<?php

use Core\Database;
use Core\TableMaker;

/*
$test_again = TableMaker::createTable("test_again", function(TableMaker $table){

    //table properties
    $table->ifNotExists = true;
    $table->engine = TableMaker::ENGINE_INNODB;
    $table->charset = 'utf8';
    $table->collation = 'utf8_spanish_ci';

    //table fields
    $table->integer("id")->autoIncrement();
    $table->string("title", 30);
    $table->text("text");
    $table->datetime("created")->timestamp();
    
});

Database::instance("DB2")->execute($test_again);
*/