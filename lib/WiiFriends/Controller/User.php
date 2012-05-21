<?php
/**
* Wii Friends
*
* @copyright (C) 2010-2012, Chris Candreva
* @link http://github.com/ccandreva/WiiFriends
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/

class WiiFriends_Controller_User extends Zikula_AbstractController
{
    var $joinInfo = array ( 'join_table' => 'wiifriends_games',
            'join_field' => 'game',
            'object_field_name' => 'gameName',
            'compare_field_table' => 'game',
            'compare_field_join' => 'id'
        );


    public function main()
    {

        $uid = UserUtil::getVar('uid');

        if (!SecurityUtil::checkPermission('wiifriends::', '::', ACCESS_OVERVIEW)) {
            return LogUtil::registerPermissionError();
        }

        $code = $this->GetConsoleCode($uid); 
        $this->view->assign('console', $code);

        $where = "WHERE wiifriends_wfc_cr_uid=$uid";
        $orderby = 'gameName';

        $codesObj = DBUtil::selectExpandedObjectArray('wiifriends_wfc',
                array($this->joinInfo), $where, $orderby );
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

        $view = FormUtil::newForm('WiiFriends', $this);

        $tmplfile = 'wiifriends_user_addgame.htm';
        $formobj = new WiiFriends_Form_Handler_AddGame(array());
        $output = $view->execute($tmplfile, $formobj);
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

        $this->view->assign('games', $games);

        return $this->view->fetch('wiifriends_user_showgames.htm');
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

        $view = FormUtil::newForm('WiiFriends', $this);

        $tmplfile = 'wiifriends_user_editconsole.htm';
        $formobj = new WiiFriends_Form_Handler_EditConsole($this);
        $output = $view->execute($tmplfile, $formobj);

        return $output;

    }

    public function addwfc()
    {
        // Security check
        if (!SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADD)) {
            return LogUtil::registerPermissionError();
        }

        $GLOBALS['info']['title'] = 'WiiFriends :: Add Friend Code';

        $view = FormUtil::newForm('WiiFriends', $this);

        $tmplfile = 'wiifriends_user_addwfc.htm';
        $formobj = new WiiFriends_Form_Handler_AddWfc();
        return $view->execute($tmplfile, $formobj);
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
    
    public function GetConsoleCode($uid)
    {
        $consoleObj = DBUtil::selectObjectByID('wiifriends_console', $uid);
        if ($consoleObj) {
            $code = preg_replace('/^(\d{4})(\d{4})(\d{4})(\d{4})$/', '$1-$2-$3-$4', $consoleObj['code']);
            return $code;
        }

        return false;
    }


}
