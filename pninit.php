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
/*
    if (!_wiifriends_createdefaultcategory())
    {
    	return LogUtil :: registerError(_CREATEFAILED);
    }
*/

    pnModSetVar('wiifriends', 'modulestylesheet', 'wiifriends.css');

    // get the db driver
    $dbdriver = DBConnectionStack::getConnectionDBDriver();
    
    if ( !DBUtil::createTable('wiifriends_console') ) return false;
    if ( !DBUtil::createTable('wiifriends_wfc') ) return false;
    DBUtil::createIndex('wiifriends_wfc_Igames', 'wiifriends_wfc', 'game');
    if ( !DBUtil::createTable('wiifriends_games') ) return false;


    return true;
}

function wiifriends_upgrade($oldversion)
{
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




/*
function _wiifriends_createdefaultcategory()
{

    $regpath='/__SYSTEM__/Modules/Global';
    // load necessary classes
    Loader::loadClass('CategoryUtil');
    Loader::loadClassFromModule('Categories', 'Category');
    Loader::loadClassFromModule('Categories', 'CategoryRegistry');

    // get the gategory path for which we're going to insert our category
    $rootcat = CategoryUtil::getCategoryByPath($regpath);
    if ($rootcat) {
        //create an entry in the categories registry to the Main property
        $registry = new PNCategoryRegistry();
        $registry->setDataField('modname', 'wiifriends');
        $registry->setDataField('table', 'wiifriends_codes');
        $registry->setDataField('property', 'Main');
        $registry->setDataField('category_id', $rootcat['id']);
        $registry->insert();
    } else {
        return false;
    }
    
    return true;
}
*/

        