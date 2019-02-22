<?php

return [
    //ENVIRONMENT VARIABLES
    "APP.timezone" => "America/Caracas",
    
    //show X-Developed-By and X-Developed-With headers
    "APP.discover = true" => true,

    //DATABASE INFO
    "Database" => [
        //default settings -> Database::instance()->method()
        "default.host" => "localhost",
        "default.user" => "root",
        "default.pass" => "root",
        "default.name" => "tasker",
        
        //optional settings -> Database::instance("DB2")->method()
        "DB2.host" => "localhost",
        "DB2.user" => "root",
        "DB2.pass" => "root",
        "DB2.name" => "tasker",
    ]
];