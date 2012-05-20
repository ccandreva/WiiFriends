<?php
/**
* Wii Friends
*
* @copyright (C) 2010-2012, Chris Candreva
* @link http://github.com/ccandreva/WiiFriends
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class WiiFriends_Installer extends Zikula_AbstractInstaller
{
    public function wiifriends_init()
    {
        ModUtil::setVar('wiifriends', 'modulestylesheet', 'wiifriends.css');
        ModUtil::setVar('wiifriends', 'adminEmail', '');

        if ( !DBUtil::createTable('wiifriends_console') ) return false;
        if ( !DBUtil::createTable('wiifriends_wfc') ) return false;
        DBUtil::createIndex('wiifriends_wfc_Igames', 'wiifriends_wfc', 'game');
        if ( !DBUtil::createTable('wiifriends_games') ) return false;


        return true;
    }

    public function wiifriends_upgrade($oldversion)
    {
        switch($oldversion) {
            case "1.0" :
                ModUtil::setVar('wiifriends', 'adminEmail', '');

            /* This break should be after the last upgrade */
                break;

            default:
                SessionUtil::setVar('errormsg', __("An unknown version is installed!") );
                return false;
        }

        return true;
    }

    public function wiifriends_delete()
    {
        ModUtil::delVar('wiifriends');
        if ( !DBUtil::dropTable('wiifriends_console') ) return false;
        if ( !DBUtil::dropTable('wiifriends_wfc') ) return false;
        if ( !DBUtil::dropTable('wiifriends_games') ) return false;
        return true;
    }
}
