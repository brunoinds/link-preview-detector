<?php 

class LinkPreviewOrigin{
    public static function isForLinkPreview(){
        if (self::isValidRequest() == true){
            return self::analyseRequest();
        }else{
            return false;
        }
    }


    private static function isValidRequest(){
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    private static function analyseRequest(){
        $dataHeaders = getallheaders();
        if (isset($dataHeaders['User-Agent'])){
            return self::verifyIfUserAgendIsOnBlockList($dataHeaders['User-Agent']);
        }else{
            return false;
        }
    }

    private static function verifyIfUserAgendIsOnBlockList($userAgentDescription){
        $blockList = json_decode(file_get_contents(__DIR__.'/blockList.json'), true)['UserAgents'];

        $userAgentDescription = strtolower($userAgentDescription);
        $status = false;
        foreach ($blockList as $itemBlock){
            if (self::stringIncludes($userAgentDescription, strtolower($itemBlock)) == true){
                $status = true;
                break;
            }
        }
        return $status;
    }

    private static function stringIncludes($string, $search){
        $string = strtolower($string);
        $search = strtolower($search);
        if(strpos($string, $search) !== false){
            return true;
        }else{
            return false;
        }
    }
}
