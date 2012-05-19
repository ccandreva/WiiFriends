<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2001, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id$
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

function wiifriends_init()
{
    pnModSetVar('wiifriends', 'modulestylesheet', 'wiifriends.css');
    pnModSetVar('wiifriends', 'adminEmail', '');
    
    if ( !DBUtil::createTable('wiifriends_console') ) return false;
    if ( !DBUtil::createTable('wiifriends_wfc') ) return false;
    DBUtil::createIndex('wiifriends_wfc_Igames', 'wiifriends_wfc', 'game');
    if ( !DBUtil::createTable('wiifriends_games') ) return false;


    return true;
}

function wiifriends_upgrade($oldversion)
{
    switch($oldversion) {
        case "1.0" :
            pnModSetVar('wiifriends', 'adminEmail', '');

        /* This break should be after the last upgrade */
            break;
            
        default:
            pnSessionSetVar('errormsg', __("An unknown version is installed!") );
            return false;
    }
                
    return true;
}

function wiifriends_delete()
{
    pnModDelVar('wiifriends');
    if ( !DBUtil::dropTable('wiifriends_console') ) return false;
    if ( !DBUtil::dropTable('wiifriends_wfc') ) return false;
    if ( !DBUtil::dropTable('wiifriends_games') ) return false;
    return true;
}
        