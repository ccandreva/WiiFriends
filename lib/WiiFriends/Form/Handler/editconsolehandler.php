<?php

class wiifriends_user_editconsoleHandler extends pnFormHandler
  {
    
    /* Global variables here */
    
    /* Functions */
    function initialize(&$render)
    {
      $uid = pnUserGetVar('uid');
      $code = wiifriendsGetConsoleCode($uid);
      $render->assign('code', $code);      

      return true;
    }
    
    function handleCommand(&$render, &$args)
    {
    
      $ok = $render->pnFormIsValid();
      $formData = $render->pnFormGetValues();
      
      $codePlugin = & $render->pnFormGetPluginById('code');
      $code = $formData['code'];
      $matches = array();
      if (preg_match('/^(\d{4})[ .-]?(\d{4})[ .-]?(\d{4})[ .-]?(\d{4})$/', $code, $matches ) ) {
        $codePlugin->clearValidation($render);
        $code = $matches[1].$matches[2].$matches[3].$matches[4];
        $formData['code'] = $code;
      } else {
        $codePlugin->setError('Console codes consist of 16 digits.');
        $ok = false;
      }
      if (!$ok) return false;
      
      // Get Userid
      $uid = pnUserGetVar('uid');

      $formData['id'] = $uid;
      
      
      if ( DBUtil::selectObjectByID('wiifriends_console', $uid) ) {
        DBUtil::updateObject($formData, 'wiifriends_console');
        LogUtil::registerStatus("Your code has been updated.");
      } else {
        DBUtil::insertObject($formData, 'wiifriends_console', true) ;
        LogUtil::registerStatus("Your code has been added.");
      }      
      
      $url = pnModUrl('wiifriends', 'user');
      return $render->pnFormRedirect($url);

    }


  }


