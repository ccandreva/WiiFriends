<?php
/**
* Wii Friends
*
* @copyright (C) 2010-2012, Chris Candreva
* @link http://github.com/ccandreva/WiiFriends
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class WiiFriends_Controller_Admin extends Zikula_AbstractController
{

    public function main()
    {
        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        $render = FormUtil::newForm('WiiFriends', $this);
        $tmplfile='wiifriends_admin_main.htm';
        $formobj = new WiiFriends_Form_Handler_Config();
        $output = $render->execute($tmplfile, $formobj);
        return $output;


    }

    public function showgames($args)
    {
        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
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


    public function editgame($args)
    {
        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_ADMIN)) {
            return LogUtil::registerPermissionError();
        }

        $GLOBALS['info']['title'] = 'WiiFriends :: Edit a game';
        $view = FormUtil::newForm('WiiFriends', $this);
        $tmplfile = 'wiifriends_admin_editgame.htm';

        if ($view->template_exists($tmplfile))
        {
            $formobj = new WiiFriends_Form_Handler_EditGame();
            $output = $view->execute($tmplfile, $formobj);
        } else {
            $output =  "No template found: $tmplfile";
        }

        return $output;

    }
}
