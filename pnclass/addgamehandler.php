<?php

class wiifriends_user_addgameHandler extends pnFormHandler
  {
    
    /* Global variables here */
    
    /* Functions */
    function initialize(&$render)
    {
    
      return true;
    }
    
    function handleCommand(&$render, &$args)
    {
    
      if (!$render->pnFormIsValid()) return false;

      $formData = $render->pnFormGetValues();
      
      // Check if this needs to be approved or not
      if (SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADMIN)) {
        $obj_status = 'A';
        $okmess = 'has been saved.';
      } else {
        $obj_status = 'P';
        $okmess = 'has been submitted for approval by the site admin.';
      }
        
      $formData['obj_status'] = $obj_status;
      
      $game = pnVarPrepForDisplay($formData['game']) ;
      $formData['game'] = $game;
      if (DBUtil::insertObject($formData, 'wiifriends_games', true)) {
        LogUtil::registerStatus("Your game <b>$game</b> $okmess");

        // Blank game name field for next form view
        $formData['game'] = '';
        $render->pnFormSetValues( $formData);

        // Send mail to admin to say a game has been submitted.
        $mail = "\nPlease approve as soon as you can.\n";
        $toaddress = 'chris@westnet.com';
        $toname = 'Chris Candreva';
        pnModAPIFunc('Mailer', 'user', 'sendmessage',
                        array('toaddress'=> $toaddress,
                                'toname' => $toname,
                                'subject' => 'A new game has been submitted',
                                'fromname' => 'WiiFriends',
                                'fromaddress' => 'webmaster@candreva.us',
                                'body' => $mail,
                                'html' => false )
                );        

      } else {
        LogUtil::registerError("Error inserting game <b>$game</b>");

      }

    }


  }


