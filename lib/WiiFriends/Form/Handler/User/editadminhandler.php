<?php

class wiifriends_admin_mainHandler extends pnFormHandler
  {
    
    /* Global variables here */
//    var $gameID;	// ID of the game we are editing.
    
    /* Functions */
    function initialize(&$render)
    {
    
      $adminEmail = pnModGetVar('WiiFriends', 'adminEmail');
      $render->assign('adminEmail', $adminEmail);
      
      return true;
    }
    
    function handleCommand(&$render, &$args)
    {
    
      if (!$render->pnFormIsValid()) return false;

      $formData = $render->pnFormGetValues();
      
      $adminEmail = $formData['adminEmail'];
      ModUtil::setVar('WiiFriends', 'adminEmail', $adminEmail);
      
      $url = pnModUrl('wiifriends', 'admin', 'main');
      return $render->pnFormRedirect($url);

    }


  }


