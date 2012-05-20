<?php

class wiifriends_user_addwfcHandler extends pnFormHandler
  {
    
    /* Global variables here */
    
    /* Functions */
    function initialize(&$render)
    {

      $gamesObj = DBUtil::selectObjectArray('wiifriends_games');

      $gameList = array();

      foreach ($gamesObj as $game ) {
              $gameList[] = array('text' => $game['game'], value => $game['id']);
      }
      
      $render->assign('gameItems', $gameList);
      
      
      return true;
    }
    
    function handleCommand(&$render, &$args)
    {
    
      $ok = $render->pnFormIsValid();
      $formData = $render->pnFormGetValues();
      
      $codePlugin = & $render->pnFormGetPluginById('code');
      $code = $formData['code'];
      $matches = array();
      if (preg_match('/^(\d{4})[ .-]?(\d{4})[ .-]?(\d{4})$/', $code, $matches ) ) {
        $codePlugin->clearValidation($render);
        $code = $matches[1].$matches[2].$matches[3];
        $formData['code'] = $code;
      } else {
        $codePlugin->setError('Wii Friend Codes consist of 12 digits.');
        $ok = false;
      }
      if (!$ok) return false;
      
      DBUtil::insertObject($formData, 'wiifriends_wfc') ;
      LogUtil::registerStatus("Your code has been added.");
      
      $url = pnModUrl('wiifriends', 'user');
      return $render->pnFormRedirect($url);

    }


  }


