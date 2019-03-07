<?php

namespace Core;

class TableBuilder{

    private $name = "";
    private $ifNotExtist = false;
    private $engine = null;
    private $charSet = "utf8";
    private $collate = "utf8_spanish_ci";
    private $autoInc = 1;
    
    private $columns = array();
    
    const TYPE_INT = "int";
    const TYPE_VARCHAR = "varchar";
    const TYPE_TEXT = "text";
    const TYPE_LONGTEXT = "longtext";
    const TYPE_DATE = "date";
    const TYPE_DATETIME = "datetime";
    const TYPE_TIMESTAMP = "timestamp";
    
    const KEY_PRIMARY = 1;
    const KEY_UNIQUE = 2;
    const KEY_INDEX= 3;
    
    const ENGINE_INNODB = "InnoDB";
    const ENGINE_MYISAM = "MyISAM";
    
    /**
     * 
     * @param type $name
     * @param type $ifNotExtist
     * @param type $engine
     * @param type $charSet
     * @param type $collate
     * @param type $autoInc
     */
    public function __construct($name, $ifNotExtist = true, $engine = null, $charSet = null, $collate = null, $autoInc = 1)
    {
        $this->name = $name;
        $this->ifNotExtist = $ifNotExtist;
        $this->engine = $engine;
        $this->charSet = ($charSet) ? $charSet : $this->charSet;
        $this->collate = ($collate) ? $collate : $this->collate;
        $this->autoInc = $autoInc;
    }
    
    /**
     * 
     * @param type $name
     * @param type $type
     * @param type $len
     * @param type $default
     * @param type $autoInc
     * @param type $key
     * @param type $isNotNull
     */
    public function addColumn($name, $type = self::TYPE_INT, $len = 0, $default = null, $autoInc = false, $key = false, $isNotNull = true)
    {
        $column["name"] = $name;
        $column["type"] = $type;
        $column["len"] = $len;
        $column["autoInc"] = $autoInc;
        $column["key"] = $key;
        $column["isNotNull"] = $isNotNull;
        $column["default"] = $default;
        
        $this->columns[] = $column;
    }

    public function integer($name, $size = 5, $default = 0, $ai = false, $key = null)
    {
        $this->addColumn($name, slef::TYPE_INT, $size, $default, $ai, $key);
    }
    
    /**
     * return SQL string
     * @return string
     */
    public function show()
    {
        $output = "CREATE TABLE ".(($this->ifNotExtist) ? "IF NOT EXISTS " : "")."{$this->name} (".PHP_EOL;
        
        $primary = null;
        $unique = null;
        $index = null;
        $comma = "";
        
        foreach($this->columns as $column)
        {          
            $col = "  {$column['name']} {$column['type']}";
            $col .= ($column['len'] != 0) ? "({$column['len']})" : "";
            
            if($column['isNotNull'])
            {
                $col .= " NOT NULL";
            }
            
            if($column["default"] != null)
            {
                $col .= " DEFAULT {$column["default"]}";
            }
            
            if($column['autoInc'])
            {
                $col .= " AUTO_INCREMENT";
            }
            
            if(isset($column['key']))
            {
                switch ($column['key'])
                {
                    case self::KEY_PRIMARY:
                        $primary = $column['name'];
                    break;
                
                    case self::KEY_UNIQUE:
                        $unique = $column['name'];
                    break;
                
                    case self::KEY_INDEX:
                        $index = $column['name'];
                    break;
                }
            }
            
            $output .= $comma.$col;
            $comma = ",".PHP_EOL;
        }
        
        if($primary)
            {
                $output .= ",".PHP_EOL."  PRIMARY KEY({$primary})";
            }
        
        if($unique)
            {
                $output .= ",".PHP_EOL."  UNIQUE KEY {$unique} ({$unique})";
            }
        
        if($index)
            {
                $output .= ",".PHP_EOL."  KEY {$index} ({$index})";
            }
        
        
        $output .= PHP_EOL.") ENGINE={$this->engine}"; 
        
        if($this->charSet != null)
        {
            $output .= " DEFAULT CHARSET={$this->charSet}";
        }
        
        if($this->collate != null)
        {
            $output .= " COLLATE={$this->collate}";
        }
        
        if($this->autoInc != 1)
        {
            $output .= " AUTO_INCREMENT={$this->autoInc}";
        }
        
        return $output.";";
    }
}

/*
CREATE TABLE IF NOT EXISTS `sdrg` (
  `f1` int(7) NOT NULL AUTO_INCREMENT,
  `f2` varchar(5) NOT NULL,
  `f3` text CHARACTER SET latin1 NOT NULL,
  `f4` date NOT NULL,
  `f5` longtext CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`f1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

    
CREATE TABLE `ggg` (
 `id` int(10) NOT NULL,
 `ff` int(10) NOT NULL,
 `gg` varchar(10) NOT NULL,
 `hh` text NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `ff` (`ff`),
 KEY `gg` (`gg`) //indice
) ENGINE=InnoDB DEFAULT CHARSET=latin1
*/