<?php

class WiiFriends_Form_Handler_User_AddGame extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    public function __construct($args)
    {
        $this->args = $args;
    }
    
    /* Functions */
    public function initialize(Zikula_Form_View $view)
    {
    
      return true;
    }
    
    public function handleCommand(Zikula_Form_View $view, &$args)
    {
    
      if (!$this->view->isValid()) return false;

      $formData = $this->view->getValues();
      
      // Check if this needs to be approved or not
      if (SecurityUtil::checkPermission( 'WiiFriends::', "::", ACCESS_ADMIN)) {
        $obj_status = 'A';
        $okmess = 'has been saved.';
      } else {
        $obj_status = 'P';
        $okmess = 'has been submitted for approval by the site admin.';
      }
        
      $formData['obj_status'] = $obj_status;
      
      $game = DataUtil::formatForDisplay($formData['game']) ;
      $formData['game'] = $game;
      if (DBUtil::insertObject($formData, 'wiifriends_games', true)) {
        LogUtil::registerStatus("Your game <b>$game</b> $okmess");

        // Blank game name field for next form view
        $formData['game'] = '';
        $this->view->setValues( $formData);

        // Send mail to admin to say a game has been submitted.
      $mail = "\nPlease approve as soon as you can.\n";
        $toaddress = ModUtil::getVar('WiiFriends', 'adminEmail');
        if ($toaddress == '') {
          $toaddress = System::getVar('adminmail');
        }
        if ($toaddress) {
          ModUtil::apiFunc('Mailer', 'user', 'sendmessage',
                        array('toaddress'=> $toaddress,
                                'toname' => '',
                                'subject' => 'A new game has been submitted',
                                'fromname' => 'WiiFriends',
                                'fromaddress' => $toname,
                                'body' => $mail,
                                'html' => false )
                );
        }
    } else {
        LogUtil::registerError("Error inserting game <b>$game</b>");
      }
    }
  }
