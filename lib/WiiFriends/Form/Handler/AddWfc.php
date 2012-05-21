<?php

class WiiFriends_Form_Handler_AddWfc extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    
    /* Functions */
    public function __construct()
    {
    }
    
    public function initialize(Zikula_Form_View $view)
    {

      $gamesObj = DBUtil::selectObjectArray('wiifriends_games');
      $gameList = array();
      foreach ($gamesObj as $game ) {
              $gameList[] = array('text' => $game['game'], value => $game['id']);
      }
      
      $this->view->assign('gameItems', $gameList);
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {
      $ok = $this->view->isValid();
      $formData = $this->view->getValues();
      
      $codePlugin = & $this->view->getPluginById('code');
      $code = $formData['code'];
      $matches = array();
      if (preg_match('/^(\d{4})[ .-]?(\d{4})[ .-]?(\d{4})$/', $code, $matches ) ) {
        $codePlugin->clearValidation($this->view);
        $code = $matches[1].$matches[2].$matches[3];
        $formData['code'] = $code;
      } else {
        $codePlugin->setError('Wii Friend Codes consist of 12 digits.');
        $ok = false;
      }
      if (!$ok) return false;
      
      DBUtil::insertObject($formData, 'wiifriends_wfc') ;
      LogUtil::registerStatus("Your code has been added.");
      
      $url = ModUtil::url('wiifriends', 'user');
      return $this->view->redirect($url);

    }


  }


