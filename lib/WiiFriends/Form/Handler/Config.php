<?php

class WiiFriends_Form_Handler_Config extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
//    var $gameID;	// ID of the game we are editing.
    
    /* Functions */
    public function __construct()
    {
        //$this->args = $args;
    }
    
    public function initialize(Zikula_Form_View $view)
    {
      $adminEmail = ModUtil::getVar('WiiFriends', 'adminEmail');
      $this->view->assign('adminEmail', $adminEmail);
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    
      if (!$this->view->isValid()) return false;

      $formData = $this->view->getValues();
      $adminEmail = $formData['adminEmail'];
      ModUtil::setVar('WiiFriends', 'adminEmail', $adminEmail);
      
      $url = ModUtil::url('wiifriends', 'admin', 'main');
      return $this->view->redirect($url);
    }
  }


