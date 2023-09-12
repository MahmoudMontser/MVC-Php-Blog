<?php

namespace App\Controller    ;
require_once 'helpers\session_helper.php';
class Controller
{

    public function notFound()
    {
      echo 'not_found';
    }

    public function getView($sViewName)
    {
        $this->_get($sViewName, 'app\Views');
    }
    private function _get($sFileName, $sType)
    {
        $sFullPath = ROOT_PATH . $sType . '/' . $sFileName . '.php';
        if (is_file($sFullPath))
            require $sFullPath;
        else
            exit('The "' . $sFullPath . '" file doesn\'t exist');
    }

    public function __set($sKey, $mVal)
    {
        $this->$sKey = $mVal;
    }

}