<?php

return [
    //ENVIRONMENT VARIABLES
    "APP" => [
        //default timezone
        "timezone" => "America/Caracas",
        //show X-Developed-By and X-Developed-With headers
        "discover = true" => true,
        //allow register route and link
        "allowRegister" => true,
    ],

    //DATABASE INFO
    "Database" => [
        //default settings -> Database::instance()->method()
        "default_host" => "localhost",
        "default_user" => "root",
        "default_pass" => "root",
        "default_name" => "tasker",
        
        //optional settings -> Database::instance("DB2")->method()
        "DB2_host" => "localhost",
        "DB2_user" => "root",
        "DB2_pass" => "root",
        "DB2_name" => "tasker",
    ],
];