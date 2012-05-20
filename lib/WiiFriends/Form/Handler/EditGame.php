<?php

class WiiFriends_Form_Handler_EditGame extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    var $gameID;	// ID of the game we are editing.
    
    /* Functions */
    public function __construct()
    {
        //$this->args = $args;
    }
    
    public function initialize(Zikula_Form_View $view)
    {
      $this->gameID = FormUtil :: getPassedValue('id');
      $gameObj = DBUtil::SelectObjectById('wiifriends_games', $this->gameID);
      $gameObj['obj_statusItems'] = array (
        array('text' => 'A', value => 'A'),
        array('text' => 'P', value => 'P'),
      );
      $this->view->assign($gameObj);
      
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {    
      if (!$this->view->isValid()) return false;

      $formData = $this->view->getValues();
      
      $game = DataUtil::formatForDisplay($formData['game']) ;
      $formData['game'] = $game;
      $formData['id']=$this->gameID;
      
      if ($formData['delete']) {
        DBUtil::deleteObjectByID('wiifriends_games',$this->gameID);
        DBUtil::deleteObjectById('wiifriends_wfc', $this->gameID, 'game');	// Delete all wfc's for this game too.
        LogUtil::registerStatus("Game <b>$game</b> has been deleted.");
      }
      elseif (DBUtil::updateObject($formData, 'wiifriends_games' )) {
        LogUtil::registerStatus("Game <b>$game</b> has been updated.");
      } else {
        LogUtil::registerError("Error updating game <b>$game</b>");

      }

      $url = ModUtil::url('wiifriends', 'admin', 'showgames');
      return $this->view->redirect($url);

    }


  }


