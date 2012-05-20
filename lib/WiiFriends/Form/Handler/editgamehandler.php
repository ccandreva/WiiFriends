<?php

class wiifriends_admin_editgameHandler extends pnFormHandler
  {
    
    /* Global variables here */
    var $gameID;	// ID of the game we are editing.
    
    /* Functions */
    function initialize(&$render)
    {
    
      $this->gameID = FormUtil :: getPassedValue('id');
      $gameObj = DBUtil::SelectObjectById('wiifriends_games', $this->gameID);
      $gameObj['obj_statusItems'] = array (
        array('text' => 'A', value => 'A'),
        array('text' => 'P', value => 'P'),
      );
      $render->assign($gameObj);
      
      return true;
    }
    
    function handleCommand(&$render, &$args)
    {
    
      if (!$render->pnFormIsValid()) return false;

      $formData = $render->pnFormGetValues();
      
      $game = pnVarPrepForDisplay($formData['game']) ;
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

      $url = pnModUrl('wiifriends', 'admin', 'showgames');
      return $render->pnFormRedirect($url);

    }


  }


