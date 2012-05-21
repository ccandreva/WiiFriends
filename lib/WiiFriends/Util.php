<?php
/**
* Wii Friends
*
* @copyright (C) 2010-2012, Chris Candreva
* @link http://github.com/ccandreva/WiiFriends
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class WiiFriends_Util
{
    
    public static function joinInfo()
    {
        return array ( 'join_table' => 'wiifriends_games',
            'join_field' => 'game',
            'object_field_name' => 'gameName',
            'compare_field_table' => 'game',
            'compare_field_join' => 'id'
        );
    }

    public static function GetConsoleCode($uid)
    {
        $consoleObj = DBUtil::selectObjectByID('wiifriends_console', $uid);
        if ($consoleObj) {
            $code = preg_replace('/^(\d{4})(\d{4})(\d{4})(\d{4})$/', '$1-$2-$3-$4', $consoleObj['code']);
            return $code;
        }

        return false;
    }

}

?>
