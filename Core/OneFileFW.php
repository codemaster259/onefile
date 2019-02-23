<?php

namespace Core;

/*CONSTANTS*/

use \PDO;

/*BASE*/

class OneFileFW{
    
    const FRAMEWORK_MAKER = "Pirulo Radec";
    const FRAMEWORK_NAME = "OneFile PHP Framework";
    const FRAMEWORK_VERSION = "v1.0";
}

class FileSystem{
    
    private static $ROOT = "";
    
    public static function setRoot($root)
    {
        self::$ROOT = $root;
    }
    
    public static function autoload($className = null)
    {
        if(!$className){return spl_autoload_register(__METHOD__);}
        
        $one = str_replace("\\", "/", $className);
        
        $two = $one . ".php";
        
        if(self::fileExists($two))
        {
            self::requireFile($two, true);
            return $two;
        }
        
        return false;
    }
    
    public static function capture($_file, $_data = [])
    {
        return call_user_func(function(){
            // It's very simple :)
            ob_start();
            extract(func_get_arg(1));
            include func_get_arg(0);
            $output = ob_get_clean();
            return $output;
        }, self::$ROOT.$_file, $_data);
    }
    
    public static function requireFile($filename, $once = false)
    {
        return ($once) ? require_once self::$ROOT.$filename : require self::$ROOT.$filename;
    }

    public static function read($filename, $callback = null){
        
        $output = file_get_contents(self::$ROOT.$filename);
        
        if($callback)
        {
            $output = call_user_func_array($callback, array($output));
        }
        
        return $output;
    }
    
    public static function fileExists($filename)
    {
        return file_exists(self::$ROOT.$filename);
    }
    
    public static function writeFile($filename, $data = "")
    {
        $dir = dirname(self::$ROOT.$filename);
        
        if(!is_dir($dir))
        {
            mkdir($dir, 0777, true);
        }
        
        return file_put_contents(self::$ROOT.$filename, $data);
    }
}

/* For console commands */
class Commander{
    
    private static $commands = [];
    
    public static function addCommand($name, $callback)
    {
        self::$commands[$name] = $callback;
    }

    public static function run($args = [])
    {
        //remove filename
        array_shift($args);
        
        
        //get command name
        $commandName = array_shift($args);
        
        if(!$commandName)
        {
            print_r("Must type a Command!");
            die();
        }
        
        //get command function
        $commandFn = isset(self::$commands[$commandName]) ? self::$commands[$commandName] : null;
        
        if(!$commandFn)
        {
            print_r("Command {$commandName} not found!");
            die();
        }
        
        call_user_func($commandFn, $args);
    }
}

class Server{
    
    public static function get($key = null)
    {
        $CLEAN = [];
        $CLEAN = $_SERVER;
        array_walk($CLEAN, function($elemento){
            return trim($elemento);
        });
        
        if(!$key)
        {
            
            return $CLEAN;
        }
        
        return isset($CLEAN[$key]) ? $CLEAN[$key] : null;
    }
}

class Helper{
    
    public static function debug($data = null){
        
        echo "\n<pre>\n";
        
        print_r($data);
        
        echo "</pre>\n";
    }

    public static function PATH_INFO()
    {
        return isset($_SERVER['PATH_INFO']) ? "/".ltrim($_SERVER['PATH_INFO'],"/") : isset($_GET['PATH_INFO']) ? "/".ltrim($_GET['PATH_INFO'],"/") : "/";
    }
    
    public static function CURRENT_URL()
    {
        return Server::get('REQUEST_SCHEME')."://".Server::get('HTTP_HOST').Server::get('REQUEST_URI');
    }
    
    public static function HTTP_ROOT()
    {
        $php_self = Server::get('REQUEST_SCHEME')."://".Server::get('HTTP_HOST').Server::get('PHP_SELF');
        
        return explode("public/index.php", $php_self)[0];
    }
}

class Times{
    /**
     * Seconds = 1;
     */
    const Seconds = 1;
    const Minutes = self::Seconds * 60;
    const Hours = self::Minutes * 60;
    const Days = self::Hours * 24;
    const Weeks = self::Days * 7;
    const Months = self::Days * 30;
    const Years = self::Days * 365;
    
    const times = [
            self::Years     => ["año","años"],
            self::Months    => ["mes","meses"],
            self::Weeks     => ["semana","semanas"],
            self::Days      => ["dia","dias"],
            self::Hours     => ["hora","horas"],
            self::Minutes   => ["minuto","minutos"],
            self::Seconds   => ["segundo","segundos"],
        ];
    
    public static function ago($time, $precision = 2)
    {
        $passed = time() - $time;

        if($passed<5)
        {
            return 'Hace menos de 5 segundos';
        }
        else
        {
            $output = array();
            $exit = 0;

            foreach(self::times as $period => $name)
            {
                if($exit >= $precision || ($exit > 0 && $period < 60)) break;

                $result = floor($passed / $period);
                if($result > 0)
                {
                    $output[] = $result.' '.($result == 1 ? $name[0] : $name[1]);
                    $passed -= $result * $period;
                    $exit++;
                }
                else if($exit > 0){
                    $exit++;
                }
            }

            $text = "";
            $sep = "";
            
            if($precision > 1)
            {
                for($x = 0; $x < count($output); $x++)
                {
                    if($x == count($output) - 1 )
                    {
                        $sep = " y ";
                    }
                    $text = $text.$sep.$output[$x];
                    $sep = ", ";
                }
                return "Hace ".$text;
            }else{
                return date("d-M-Y h:ia", $time);
            }
        }
    }
}

class Password{
    
    public static function encrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    public static function verify($password, $crypt)
    {
        return password_verify($password, $crypt);
    }
}

class Env{
    
    protected static $env = array();
    
    public static function fromINI($file){
        
        self::$env = parse_ini_file($file, true);
    }
    
    public static function fromPHP($file){
        
        self::$env = FileSystem::requireFile($file, true);
    }
    
    public static function get($key = null, $def = null){
        
        if(!$key)
        {
            return self::$env;
        }
        
        return isset(self::$env[$key]) ? (self::$env[$key]) : $def;
    }
}

/*HTTP*/
class Route{
    
    private static $routes = [];

    public static function add($url, $data)
    {
        self::$routes[$url] = $data;
    }
    
    public static function match($url = "/")
    {
        $found = null;
        
        foreach(self::$routes as $route => $destiny)
        {
            $matches = [];
            
            $pattern = self::makePattern($route);
            
            if(preg_match($pattern, $url, $matches))
            {
                $matches = self::assoc($matches);
                $found = $destiny;
                Request::setParams($matches);
                break;
            }
        }
        
        if(!$found)
        {
            return Response::html("<h1>Error:</h1><p>Pagina <b>{$url}</b> no encontrada (R)!</p>", 404);
        }
        
        if(is_string($found) && self::isClass($found))
        {
            $p = explode("@", $found);
            $class = $p[0];
            $method = $p[1];
            
            if(!class_exists($class))
            {
                return Response::html("<h1>Error:</h1><p>Pagina <b>{$url}</b> no encontrada (C)!</p>", 404);
            }
            
            $controller = new $class();
            
            if(!method_exists($controller, $method))
            {
                return Response::html("<h1>Error:</h1><p>Pagina <b>{$url}</b> no encontrada (M)!</p>", 404);
            }
            
            return $controller->__execute($method);
        }
        
        if(is_callable($found))
        {
            return call_user_func($found);
        }
        
        return $found;
    }
    
    protected static function makePattern($pattern)
    {
        $final = "";
    
        if(preg_match('/[^:\/\*_{}()a-zA-Z\d]/', $pattern))
        {
            //Invalid Pattern
            return false;
        }
        
        $chars = array(
            ':num'  =>  '[0-9]+',          //integers
            ':str'  =>  '[a-zA-Z]+',       //leters
            ':alpha'=>  '[a-zA-Z0-9]+',    //alphanumerics
            ':any'  =>  '[a-zA-Z0-9_]+',   //any but slash
            ':all'  =>  '[a-zA-Z0-9_/\.]*',//matches all usable chars :)
            '{'     =>  '(',               //named start OK
            '}'     =>  ')',               //named end OK
        );
        
        $allowedParamChars = '[a-zA-Z0-9\_]+';
        
        // Turn "(/)" into "/?" DEPRECATED
        //$pattern = preg_replace('#\(/\)#', '/?', $pattern);
        
        
        //todo 0: Change '*' into '?' for making any parameter optional xD
        $pattern = preg_replace('#\*#', '?', $pattern);

        
        //todo 1: required format {parameter:type}
        
        //todo 1.1: replace {parameter} with {parameter:any} DONE
        $pattern = preg_replace(
            '/\{(' . $allowedParamChars . ')}/', // Replace "{parameter}"
            '{$1:any}'                        , // with "{parameter:any}"
            $pattern
        );
        
        
        //todo 1.2: replace {:type} with {type:type} DONE
        $pattern = preg_replace(
            '/\{:(' . $allowedParamChars . ')}/', // Replace "{:type}"
            '{$1:$1}'                          , // with "{type:type}"
            $pattern
        );       
        
        
        //todo 2: replace {parameter:type} with {?<parameter>:type} DONE
        $pattern = preg_replace(
            '/\{(' . $allowedParamChars . ')/', // Replace "{parameter"
            '{?P<$1>'                        , // with "{?P<parameter>"
            $pattern
        );
        
        
        //todo 3: replace {?P<parameter>:type} with {?P<parameter>[chars]} DONE
        $searches = array_keys($chars);
        $replaces = array_values($chars);
        
        $pattern = str_replace($searches, $replaces, $pattern);
        
        $final = "#^" . $pattern . "$#Du";
        
        return $final;
    }
    
    protected static function assoc($a)
    {
        return array_filter($a, function($k){
            return !is_int($k);
        }, ARRAY_FILTER_USE_KEY);
    }
    
    protected static function isClass($data)
    {
        return preg_match("#^[a-zA-Z].+@[a-zA-Z].+$#D", $data);
    }
}


class Request{

    public static function isPost()
    {
        return strtolower(Server::get('REQUEST_METHOD')) == 'post';
    }
    
    public static function isAjax()
    {
        return strtolower(Server::get('HTTP_X_REQUESTED_WITH')) == 'xmlhttprequest';
    }

    public static function post($key = null, $def = null)
    {
        $CLEAN = [];
        $CLEAN = $_POST;
        array_walk($CLEAN, function($elemento){
            return trim($elemento);
        });
        
        if(!$key)
        {
            return $CLEAN;
        }
        
        return isset($CLEAN[$key]) ? $CLEAN[$key] : $def;
    }

    public static function query($key = null, $def = null)
    {
        $CLEAN = [];
        $CLEAN = $_GET;
        array_walk($CLEAN, function($elemento){
            return trim($elemento);
        });

        if(!$key)
        {
            return $CLEAN;
        }
        
        return isset($CLEAN[$key]) ? $CLEAN[$key] : $def;
    }
    
    private static $params = [];
    
    public static function setParams($params = [])
    {
        self::$params = $params;
    }
    
    public static function param($key = null, $def = null)
    {
        $CLEAN = self::$params;
        array_walk($CLEAN, function($elemento){
            return trim($elemento);
        });

        if(!$key)
        {
            return $CLEAN;
        }
        
        return isset($CLEAN[$key]) ? $CLEAN[$key] : $def;
    }

    public static function location($path = "")
    {
        header("Location: ".HTTP_ROOT."{$path}");
        exit();
    }
}

class Response{
    
    const HTTP_CODES = [
        200 => "OK",
        302 => "Found",
        400 => "Bad Request",
        401 => "Unauthorized",
        402 => "Payment Required",
        403 => "Forbidden",
        404 => "Not Found",
        429 => "Too Many Requests",
        405 => "Method Not Allowed",
        500 => "Internal Server Error",
        501 => "Not Implemented",
    ];
    
    const TYPE_JSON = "application/json";
    const TYPE_TEXT = "text/plain";
    const TYPE_HTML = "text/html;charset=UTF-8";
    
    protected $status_code = 200;
    
    protected $headers = [];
    
    protected $content = "";
    
    public function __construct($content = null, $status = 200)
    {
        $this->setContent($content);
        $this->setStatus($status);
        if(env("APP.discover", false))
        {
            $this->setHeader("X-Developed-With", OneFileFW::FRAMEWORK_NAME." - ".OneFileFW::FRAMEWORK_VERSION);
            $this->setHeader("X-Developed-By", OneFileFW::FRAMEWORK_MAKER);
        }
    }
    
    public function setStatus($status)
    {
        $this->status_code = $status;
        return $this;
    }
    
    public function setHeader($key, $value = null)
    {
        $this->headers[$key] = $value;
        return $this;
    }
    
    public function setContent($content = null)
    {
        $this->content = $content;
        return $this;
    }
    
    public function send()
    {
        $status_msg = isset(self::HTTP_CODES[$this->status_code]) ? self::HTTP_CODES[$this->status_code] : "UNKNOWN";
                        
        foreach ($this->headers as $name => $value)
        {
            if($value)
            {
                header("{$name}: {$value}");
            }else{
                header("{$name}");
            }
        }
        
        header("HTTP/1.1 {$this->status_code} {$status_msg}");
        
        return $this->content;
    }
        
    public static function html($content = "", $status = 200)
    {
        $r = new self($content, $status);
        $r->setHeader("Content-Type", self::TYPE_HTML);
        $r->setHeader("Cache-Control","no-cache, no-store, must-revalidate");
        return $r->send();
    }
    
    public static function text($content = "", $status = 200)
    {
        $r = new self($content, $status);
        $r->setHeader("Content-Type", self::TYPE_TEXT);
        $r->setHeader("Cache-Control","no-cache, no-store, must-revalidate");
        return $r->send();
    }
    
    public static function json($content = [], $status = 200)
    {
        $r = new self(json_encode($content), $status);
        $r->setHeader("Content-Type", self::TYPE_JSON);
        $r->setHeader("Cache-Control","no-cache, no-store, must-revalidate");
        return $r->send();
    }
    
    public function __toString()
    {
        return $this->send();
    }
}

/*MVC*/

class Controller{
    
    protected $response = null;
    
    public function __pre(){}
    
    public final function __execute($method_name)
    {
        $this->__pre();
        
        if(method_exists($this, $method_name))
        {
            $this->response = $this->{$method_name}();
        }else{
            $this->response = "Method <i>'$method_name'</i> not found in <i>'". get_called_class()."'</i>";
        }
        
        $this->__post();

        return $this->response;
    }
    
    public function __post(){}
}

class Database{
        
    protected $host = null;
    protected $user = null;
    protected $pass = null;
    protected $name = null;
    
    protected $pdo = null;
    
    protected $error = null;
    
    protected $lastID = null;
    
    protected static $instances = [];
    
    /**
     * 
     * @return self
     */
    public static function instance($dbconfig = "default"){

        if(!isset(self::$instances[$dbconfig]))
        {
            $database = env("Database");
            
            $host = $database[$dbconfig.".host"];
            $user = $database[$dbconfig.".user"];
            $pass = $database[$dbconfig.".pass"];
            $name = $database[$dbconfig.".name"];
        
            self::$instances[$dbconfig] = new self($host,$user,$pass,$name);
        }
        
        return self::$instances[$dbconfig];
    }
    
    public function __construct($host,$user,$pass,$name)
    {
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->name = $name;
    }
    
    protected function connect(){
        
        try{
            
            $this->pdo = new PDO("mysql:dbname={$this->name};host={$this->host}", $this->user, $this->pass, []);
        
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        }catch(PDOException $e){
            
            die($e->getMessage());
            
        }
    }
    
    public function execute($sql, $data = array(), $insertMode = false){
        
        $this->error = null;
        
        $this->lastID = null;
        
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
        
        $res = $sth->execute($data);
        
        if(!$res)
        {
            $this->error = $this->pdo->errorInfo()[2];
        }
 
        if($insertMode)
        {
            $this->lastID = $this->pdo->lastInsertId();
        }
        
        $this->disconnect();
            
        return $res;
    }
    
    public function fetch($sql, $data = array())
    {
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
        
        $res = null;
                
        if($sth->execute($data))
        {
            $res = $sth->fetch(PDO::FETCH_ASSOC);
        }else{
            $this->error = $this->pdo->errorInfo()[2];
        }
        
        $this->disconnect();
        
        return $res;
    }
    
    public function fetchAll($sql, $data = array()){
        
        $this->connect();
        
        $sth = $this->pdo->prepare($sql);
              
        $res = array();
        
        if($sth->execute($data))
        {
            $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        }else{
            $this->error = $this->pdo->errorInfo()[2];
        }
        
        $this->disconnect();
        
        return $res;
        
    }

    public function InsertId(){
        return $this->lastID;
    }
    
    public function getError()
    {
        return $this->error;
    }
    
    protected function disconnect(){
        $this->pdo = null;
    }
    
    public function parseSql($sql, $data)
    {
        $parsed = $sql;
        
        foreach($data as $key => $value)
        {
            $parsed = str_replace(":$key", "'".$value."'", $parsed);
        }
        
        return $parsed;
    }
}

class View{
    
    protected $_path = null;
    protected $_data = [];
    
    public static function make($_path, $_data = [])
    {
        return new self($_path, $_data);
    }
    
    private function __construct($_path, $_data = []){
        
        $this->_path = $_path;
        $this->_data = $_data;
    }
    
    public function add($key, $value)
    {
        if($value instanceof View) 
        {
            $value = $value->render();
        }
        
        $this->_data[$key] = $value;
        
        return $this;
    }
    
    public static function load($_path, $_data = [])
    {
        $_file = "App/Views/".$_path;
        
        if(!FileSystem::fileExists($_file))
        {
            return "$_path no existe";
        }
        
        return FileSystem::capture($_file, $_data);
    }
    
    public function render()
    {
        return self::load($this->_path, $this->_data);
    }
    
    public function __toString(){
        
        return $this->render();
    }
}

/*Validation*/

class Validator{
    
    const Required = 'Required';
    const Numeric = 'Numeric';
    const Alpha = 'Alpha';
    const AlphaNumeric = 'AlphaNumeric';
    const MinLength = 'MinLength';
    const MaxLength = 'MaxLength';
    
    private $data = [];
    
    private $errors = [];
    
    public static function add($field, $rules = [])
    {
        return $data[$field] = $rules;
    }
    
    public static function validate()
    {
        self::_run();
        
        return self::$errors;
    }
    
    private static function _run()
    {
        foreach(self::$data as $field => $rules)
        {
            foreach($rules as $rule => $value)
            {
                
            }
        }
    }
}


/*Storage*/
class Session{

    protected static $prefix = "session_";
    
    public static function start()
    {
        ini_set("session.cookie_lifetime", 0);
        session_start();
    }
    
    public static function definePath($path)
    {
        session_save_path($path);
    }

    public static function set($key, $value)
    {
        $_SESSION[self::$prefix.$key] = $value;
    }

    public static function exists($key)
    {
        return isset($_SESSION[self::$prefix.$key]);
    }

    public static function get($key = null, $def = null)
    {
        if(!$key){return $_SESSION;}
        return self::exists($key) ? $_SESSION[self::$prefix.$key] : $def;
    }

    public static function remove($key)
    {
        unset($_SESSION[self::$prefix.$key]);
    }
    
    public static function clear()
    {
        $_SESSION = [];
    }
    
    public static function destroy()
    {
        if (session_status() == PHP_SESSION_ACTIVE) { session_unset();session_destroy(); }
    }
    
    public static function data()
    {
        return $_SESSION;
    }
    
    public static function debug()
    {
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }
}

class Flash{

    protected static $prefix = "flash_";

    public static function set($key, $value)
    {
        $_SESSION[self::$prefix.$key] = $value;
    }
    
    public static function exists($key)
    {
        return isset($_SESSION[self::$prefix.$key]);
    }

    public static function get($key, $def = null)
    {
        return self::exists($key) ? $_SESSION[self::$prefix.$key] : $def;
    }

    public static function remove($key)
    {
        unset($_SESSION[self::$prefix.$key]);
    }

    public static function show($key)
    {
        $value = self::get($key);
        self::remove($key);
        return $value;
    }
}

class Block{
    
    protected static $blocks = [];
    
    public static function open($name)
    {
        self::$blocks[$name] = "";
        ob_start();
    }
    
    public static function close($name)
    {
        self::$blocks[$name] = ob_get_clean();
        
        return self::$blocks[$name];
    }
    
    public function get($name)
    {
        return self::$blocks[$name];
    }
}

/*Misc*/

class Captcha{
    
    private static $permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ1234567890';

    public static function generate($strength = 6)
    {
        if($strength <= 0 || $strength > 6)
        {
            $strength = 6;
        }
        
        $string_length = strlen(self::$permitted_chars);
        
        $random_string = '';
        
        for($i = 0; $i < $strength; $i++)
        {
            $random_character = self::$permitted_chars[mt_rand(0, $string_length - 1)];
            $random_string .= $random_character;
        }
            
        return $random_string;
    }
    
    public static function printImage($captcha_string  = "")
    {
        $font = 5;
        
        $string_length = strlen($captcha_string);
        
        $image = imagecreatetruecolor(200, 50);
 
        imageantialias($image, true);

        $colors = [];

        $red = rand(125, 175);
        $green = rand(125, 175);
        $blue = rand(125, 175);

        for($i = 0; $i < 5; $i++)
        {
            $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
        }

        imagefill($image, 0, 0, $colors[0]);

        for($i = 0; $i < 10; $i++)
        {
            imagesetthickness($image, rand(2, 10));
            $line_color = $colors[rand(1, 4)];
            imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $line_color);
        }
        
        $textcolors = [];

        //black
        $textcolors[] = imagecolorallocate($image, 0, 0, 0);
        
        //white
        $textcolors[] = imagecolorallocate($image, 255, 255, 255);

        //red
        //$textcolors['red'] = imagecolorallocate($image, 255, 0, 0);

        //blue
        //$textcolors['blue'] = imagecolorallocate($image, 0, 0, 255);
        
        for($i = 0; $i < $string_length; $i++)
        {
            $letter_space = 200/$string_length;
            $initial = $font*2;
            
            $x = $initial + $i*$letter_space;
            $y = rand(10, 30);
            
            $c = rand(0, count($textcolors)-1);

            imagestring($image , $font , $x , $y , $captcha_string[$i] , $textcolors[$c]);
        }

        header('Content-type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}

FileSystem::requireFile("facade.php");