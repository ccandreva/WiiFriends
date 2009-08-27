<?php


/* 
    Retrieve console code for a user.
    Format's the code
*/

function wiifriendsGetConsoleCode($uid)
{
    $consoleObj = DBUtil::selectObjectByID('wiifriends_console', $uid);
    if ($consoleObj) {
        $code = preg_replace('/^(\d{4})(\d{4})(\d{4})(\d{4})$/', '$1-$2-$3-$4', $consoleObj['code']);
        return $code;
    }
    
    return false;
}

function wiifriendsGamesJoin()
{
    $joinInfo = array ( 'join_table' => 'wiifriends_games',
            'join_field' => 'game',
            'object_field_name' => 'gameName',
            'compare_field_table' => 'game',
            'compare_field_join' => 'id'
        );
    return $joinInfo;
}
