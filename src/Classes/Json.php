<?php 
namespace Ispbox2\Classes;

use Ispbox2\Vars;
use stdClass;

class Json{
    private $jsonresult;
    private stdClass $result;

    public function __construct($string){
        $this->jsonresult = $string;
    }

    public function isJson(){
        if(is_numeric($this->jsonresult))
            return false;
        
        $this->result = json_decode($this->jsonresult);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public function __get($property){
        return property_exists($this->result, $property) ? $this->result->$property : null;
    }

    public static function removeNull(stdClass &$obj){
        foreach($obj as $k => $v){
            if($v == NULL)
                $obj->$k = "";
        }
    }
}