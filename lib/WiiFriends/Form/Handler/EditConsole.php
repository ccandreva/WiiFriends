<?php

class WiiFriends_Form_Handler_EditConsole extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    
    /* Functions */
    public function __construct()
    {
        //$this->args = $args;
    }
    
    public function initialize(Zikula_Form_View $view)
    {
      $uid = pnUserGetVar('uid');
      $code = wiifriendsGetConsoleCode($uid);
      $this->view->assign('code', $code);
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    
      $ok = $this->view->isValid();
      $formData = $this->view->getValues();
    
      $codePlugin = $this->view->getPluginById('code');
      $code = $formData['code'];
      $matches = array();
      if (preg_match('/^(\d{4})[ .-]?(\d{4})[ .-]?(\d{4})[ .-]?(\d{4})$/', $code, $matches ) ) {
        $codePlugin->clearValidation($this->view);
        $code = $matches[1].$matches[2].$matches[3].$matches[4];
        $formData['code'] = $code;
      } else {
        $codePlugin->setError('Console codes consist of 16 digits.');
        $ok = false;
      }
      if (!$ok) return false;
      
      // Get Userid
      $uid = UserUtil::getVar('uid');

      $formData['id'] = $uid;
      
      if ( DBUtil::selectObjectByID('wiifriends_console', $uid) ) {
        DBUtil::updateObject($formData, 'wiifriends_console');
        LogUtil::registerStatus("Your code has been updated.");
      } else {
        DBUtil::insertObject($formData, 'wiifriends_console', true) ;
        LogUtil::registerStatus("Your code has been added.");
      }      
      
      $url = ModUtil::url('wiifriends', 'user');
      return $this->view->redirect($url);

    }


  }


