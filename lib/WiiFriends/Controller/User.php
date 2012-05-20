<?php
/**
* Wii Friends
*
* @copyright (C) 2010-2012, Chris Candreva
* @link http://github.com/ccandreva/WiiFriends
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

require_once("modules/WiiFriends/common.php");

class WiiFriends_Controller_User extends Zikula_AbstractController
{

    public function main()
    {

        $uid = UserUtil::getVar('uid');

        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_OVERVIEW)) {
            return LogUtil::registerPermissionError();
        }

        $code = wiifriendsGetConsoleCode($uid); 
        $this->view->assign('console', $code);

        $where = "WHERE wiifriends_wfc_cr_uid=$uid";
        $orderby = 'gameName';

        $joinInfo[] = wiifriendsGamesJoin();

        $codesObj = DBUtil::selectExpandedObjectArray('wiifriends_wfc', $joinInfo, $where, $orderby );
        $this->view->assign('codes', $codesObj);

        return $this->view->fetch('wiifriends_user_main.htm');
    }



    public function addgame()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }

        $GLOBALS['info']['title'] = 'WiiFriends :: Add a game';

        $render = FormUtil::newForm('WiiFriends', $this);

        $tmplfile = 'wiifriends_user_addgame.htm';
        if ($render->template_exists($tmplfile))
        {
            $formobj = new wiifriends_user_addgameHandler();
            $output = $render->fetch($tmplfile, $formobj);
        } else {
            $output =  "No template found: $tmplfile";
        }

        return $output;

    }

    public function showgames()
    {

        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_OVERVIEW)) {
            return LogUtil::registerPermissionError();
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

    public function showcodes()
    {

        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $id = FormUtil :: getPassedValue('id');
        if ( ($id == '') || preg_match('/\D/',$id) ) {
            LogUtil::registerError("Invalid Game");
            $url = ModUtil::url('wiifriends', 'user', 'showgames');
            return System::redirect($url);
        }


        // User function should only show approved games
        $where = "WHERE wiifriends_wfc_game=$id";

    //    $fields = array('id', 'game' );
    //    $orderby='game';
        $codes = DBUtil::selectObjectArray('wiifriends_wfc', $where, $orderby);

        $this->view->assign('codes', $codes);
        $gameObj = DBUtil::selectObjectByID('wiifriends_games', $id);
        $this->view->assign('game', $gameObj['game']);


        return $this->view->fetch('wiifriends_user_showcodes.htm');
    }


    public function editconsole()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }

        $GLOBALS['info']['title'] = 'WiiFriends :: Edit Console Code';

        $render = FormUtil::newForm('WiiFriends');

        $tmplfile = 'wiifriends_user_editconsole.htm';
        if ($render->template_exists($tmplfile))
        {
            $formobj = new wiifriends_user_editconsoleHandler();
            $output = $render->fetch($tmplfile, $formobj);
        } else {
            $output =  "No template found: $tmplfile";
        }

        return $output;

    }

    public function editwfc()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }

        $id = FormUtil :: getPassedValue('id');
        if ( ($id == '') || preg_match('/\D/',$id) ) {
            LogUtil::registerError("Invalid Code");
            $url = pnModUrl('wiifriends', 'user' );
            return System::redirect($url);
        }

        $GLOBALS['info']['title'] = 'WiiFriends :: Edit Friend Code';

        $render = FormUtil::newForm('WiiFriends');

        $tmplfile = 'wiifriends_user_editwfc.htm';
        if ($render->template_exists($tmplfile))
        {
            $formobj = new wiifriends_user_editwfcHandler();
            $output = $render->fetch($tmplfile, $formobj);
        } else {
            $output =  "No template found: $tmplfile";
        }

        return $output;

    }

    public function addwfc()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }

        $GLOBALS['info']['title'] = 'WiiFriends :: Add Friend Code';

        $render = FormUtil::newForm('WiiFriends');

        $tmplfile = 'wiifriends_user_addwfc.htm';
        if ($render->template_exists($tmplfile))
        {
            $formobj = new wiifriends_user_addwfcHandler();
            $output = $render->fetch($tmplfile, $formobj);
        } else {
            $output =  "No template found: $tmplfile";
        }

        return $output;

    }

    public function showconsole()
    {

        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_READ)) {
            return LogUtil::registerPermissionError();
        }

        $where = '';
        $codes = DBUtil::selectObjectArray('wiifriends_console', $where, $orderby);

        $this->view->assign('codes', $codes);

        return $this->view->fetch('wiifriends_user_showconsole.htm');
    }

}
