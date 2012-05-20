<?php

class wiifriends_user_editwfcHandler extends pnFormHandler
  {
    
    /* Global variables here */
    var $wfcID;		// ID of the friend code we are editing.
        
    /* Functions */
    function initialize(&$render)
    {

      $this->wfcID = FormUtil :: getPassedValue('id');

      $joinInfo[] = wiifriendsGamesJoin();
                                                            
      // Get current user
      $uid = pnUserGetVar('uid');

      $wfcObj = DBUtil::selectExpandedObjectById('wiifriends_wfc', $joinInfo, $this->wfcID);

      // Make sure the requested object is owned by the user
      if ( $wfcObj['cr_uid'] != $uid) {
        return false;
      }

      $wfcObj['code'] = preg_replace("/^(\d{4})(\d{4})(\d{4})/", "\${1}-\${2}-\${3}", $wfcObj['code']);
      $render->assign($wfcObj);
      
      return true;
    }
    
    function handleCommand(&$render, &$args)
    {
    

      $ok = $render->pnFormIsValid();
      $formData = $render->pnFormGetValues();
      $formData['id'] = $this->wfcID;

      if ($formData['delete']) {
        DBUtil::deleteObjectByID('wiifriends_wfc', $this->wfcID);
        LogUtil::registerStatus("Your code has been deleted.");

      } else {

        $codePlugin = &$render->pnFormGetPluginById('code');
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
      
        // Get Userid
        $uid = pnUserGetVar('uid');
      
        DBUtil::updateObject($formData, 'wiifriends_wfc');
        LogUtil::registerStatus("Your code has been updated.");
      }
      
      $url = pnModUrl('wiifriends', 'user');
      return $render->pnFormRedirect($url);

    }


  }
