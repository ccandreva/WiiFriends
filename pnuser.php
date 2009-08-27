<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2001, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id: pnuser.php 22371 2007-07-10 12:47:15Z rgasch $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */


// Include pnForm in order to be able to inherit from pnFormHandler
// DO NOT use require_once since this has a different "once" logic than the PostNuke loader.
// (and Loader::requireOnce is used internally by PostNuke)
Loader::requireOnce('includes/pnForm.php');

require_once('common.php');
require_once('pnclass/addgamehandler.php');
require_once('pnclass/editconsolehandler.php');
require_once('pnclass/addwfchandler.php');
require_once('pnclass/editwfchandler.php');



function wiifriends_user_main()
{

    $uid = pnUserGetVar('uid');
//    $pnRender->assign('uid', $uid);
    if ($uid < 1) {
        $url = pnModUrl('users', 'user', 'loginscreen');
        return pnRedirect($url);
    }

    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_OVERVIEW)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }

    $pnRender = pnRender::getInstance('WiiFriends');

    $code = wiifriendsGetConsoleCode($uid); 
    $pnRender->assign('console', $code);
    
    $where = "WHERE wiifriends_wfc_cr_uid=$uid";
    $orderby = 'gameName';

    $joinInfo[] = wiifriendsGamesJoin();

    $codesObj = DBUtil::selectExpandedObjectArray('wiifriends_wfc', $joinInfo, $where, $orderby );
    $pnRender->assign('codes', $codesObj);
    
    return $pnRender->fetch('wiifriends_user_main.htm');
}



function wiifriends_user_addgame($args)
{
    // Security check
    if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
        return LogUtil::registerError (_MODULENOAUTH);
    }

    $GLOBALS['info']['title'] = 'WiiFriends :: Add a game';
    
    $render = FormUtil::newpnForm('WiiFriends');
    
    $tmplfile = 'wiifriends_user_addgame.htm';
    if ($render->template_exists($tmplfile))
    {
        $formobj = new wiifriends_user_addgameHandler();
        $output = $render->pnFormExecute($tmplfile, $formobj);
    } else {
        $output =  "No template found: $tmplfile";
    }

    return $output;
                        
}

function wiifriends_user_showgames($args)
{

    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_OVERVIEW)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }

    // User function should only show approved games
    $where = "WHERE wiifriends_games_obj_status = 'A'";

//    $fields = array('id', 'game' );
    $orderby='game';
    $games = DBUtil::selectObjectArray('wiifriends_games', $where, $orderby);
    
    $pnRender = pnRender :: getInstance('WiiFriends');
    $pnRender->assign('games', $games);

    return $pnRender->fetch('wiifriends_user_showgames.htm');
}

function wiifriends_user_showcodes($args)
{

    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_READ)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }

    $id = FormUtil :: getPassedValue('id');
    if ( ($id == '') || preg_match('/\D/',$id) ) {
        LogUtil::registerError("Invalid Game");
        $url = pnModUrl('wiifriends', 'user', 'showgames');
        return pnRedirect($url);
    }

    
    // User function should only show approved games
    $where = "WHERE wiifriends_wfc_game=$id";
    
//    $fields = array('id', 'game' );
//    $orderby='game';
    $codes = DBUtil::selectObjectArray('wiifriends_wfc', $where, $orderby);
    
    $pnRender = pnRender :: getInstance('WiiFriends');
    $pnRender->assign('codes', $codes);
    $gameObj = DBUtil::selectObjectByID('wiifriends_games', $id);
    $pnRender->assign('game', $gameObj['game']);
    

    return $pnRender->fetch('wiifriends_user_showcodes.htm');
}


function wiifriends_user_editconsole($args)
{
    // Security check
    if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
        return LogUtil::registerError (_MODULENOAUTH);
    }

    $GLOBALS['info']['title'] = 'WiiFriends :: Edit Console Code';
    
    $render = FormUtil::newpnForm('WiiFriends');
    
    $tmplfile = 'wiifriends_user_editconsole.htm';
    if ($render->template_exists($tmplfile))
    {
        $formobj = new wiifriends_user_editconsoleHandler();
        $output = $render->pnFormExecute($tmplfile, $formobj);
    } else {
        $output =  "No template found: $tmplfile";
    }

    return $output;
                        
}

function wiifriends_user_editwfc($args)
{
    // Security check
    if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
        return LogUtil::registerError (_MODULENOAUTH);
    }

    $id = FormUtil :: getPassedValue('id');
    if ( ($id == '') || preg_match('/\D/',$id) ) {
        LogUtil::registerError("Invalid Code");
        $url = pnModUrl('wiifriends', 'user' );
        return pnRedirect($url);
    }

    $GLOBALS['info']['title'] = 'WiiFriends :: Edit Friend Code';
    
    $render = FormUtil::newpnForm('WiiFriends');
    
    $tmplfile = 'wiifriends_user_editwfc.htm';
    if ($render->template_exists($tmplfile))
    {
        $formobj = new wiifriends_user_editwfcHandler();
        $output = $render->pnFormExecute($tmplfile, $formobj);
    } else {
        $output =  "No template found: $tmplfile";
    }

    return $output;
                        
}

function wiifriends_user_addwfc($args)
{
    // Security check
    if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
        return LogUtil::registerError (_MODULENOAUTH);
    }

    $id = FormUtil :: getPassedValue('id');

    $GLOBALS['info']['title'] = 'WiiFriends :: Add Friend Code';
    
    $render = FormUtil::newpnForm('WiiFriends');
    
    $tmplfile = 'wiifriends_user_addwfc.htm';
    if ($render->template_exists($tmplfile))
    {
        $formobj = new wiifriends_user_addwfcHandler();
        $output = $render->pnFormExecute($tmplfile, $formobj);
    } else {
        $output =  "No template found: $tmplfile";
    }

    return $output;
                        
}

function wiifriends_user_showconsole($args)
{

    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_READ)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }

    $where = '';
//    $fields = array('id', 'game' );
//    $orderby='game';
    $codes = DBUtil::selectObjectArray('wiifriends_console', $where, $orderby);
    
    $pnRender = pnRender :: getInstance('WiiFriends');
    $pnRender->assign('codes', $codes);

    return $pnRender->fetch('wiifriends_user_showconsole.htm');
}
