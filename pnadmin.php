<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2001, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id: pnadmin.php 22371 2007-07-10 12:47:15Z rgasch $
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

Loader::requireOnce('includes/pnForm.php');
require_once('pnclass/editgamehandler.php');

function wiifriends_admin_main()
{
    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }

    $pnRender = pnRender::getInstance('WiiFriends', false);
    return $pnRender->fetch('wiifriends_admin_main.htm');

}

function wiifriends_admin_showgames($args)
{
    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }


        $status = FormUtil :: getPassedValue('status');
        if ( ($status == 'A') || ($status == 'P') ){
            $where = "WHERE wiifriends_games_obj_status = '$status'";
        }
    

    $fields = array('id', 'game', 'obj_status');
    $games = DBUtil::selectObjectArray('wiifriends_games', $where);
//        $orderby='game', 
 //       $limitOffset=-1, $limitNumRows=-1, $assocKey='', 
  //      $permissionFilter=null, $columnArray=null);
    
    $pnRender = pnRender :: getInstance('WiiFriends');
    $pnRender->caching = 0;
    $pnRender->assign('games', $games);
//    $pnRender->assign('where', $where);
    return $pnRender->fetch('wiifriends_admin_showgames.htm');
}


function wiifriends_admin_editgame($args)
{
    if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_ADMIN)) {
        return pnVarPrepHTMLDisplay(_MODULENOAUTH);
    }

    $GLOBALS['info']['title'] = 'WiiFriends :: Edit a game';
    $render = FormUtil::newpnForm('WiiFriends');
    $tmplfile = 'wiifriends_admin_editgame.htm';

    if ($render->template_exists($tmplfile))
    {
        $formobj = new wiifriends_admin_editgameHandler();
        $output = $render->pnFormExecute($tmplfile, $formobj);
    } else {
        $output =  "No template found: $tmplfile";
    }

    return $output;
                        
}
