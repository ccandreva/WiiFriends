<?php

class WiiFriends_Form_Handler_EditWfc extends Zikula_Form_AbstractHandler
  {
    
    /* Global variables here */
    var $wfcID;		// ID of the friend code we are editing.

    /* Functions */
    public function __construct($wfcID)
    {
        $this->wfcID = $wfcID;
    }
    
    public function initialize(Zikula_Form_View $view)
     {
      // Get current user
      $uid = pnUserGetVar('uid');

      $wfcObj = DBUtil::selectExpandedObjectById('wiifriends_wfc', 
              array(WiiFriends_Util::joinInfo()), $this->wfcID);

      // Make sure the requested object is owned by the user
      if ( $wfcObj['cr_uid'] != $uid) {
        return false;
      }

      $wfcObj['code'] = preg_replace("/^(\d{4})(\d{4})(\d{4})/", "\${1}-\${2}-\${3}", $wfcObj['code']);
      $this->view->assign($wfcObj);
      
      return true;
    }
    
        public function handleCommand(Zikula_Form_View $view, &$args)
    {
    

      $ok = $this->view->isValid();
      $formData = $this->view->getValues();
      $formData['id'] = $this->wfcID;

      if ($formData['delete']) {
        DBUtil::deleteObjectByID('wiifriends_wfc', $this->wfcID);
        LogUtil::registerStatus("Your code has been deleted.");

      } else {

        $codePlugin = &$this->view->getPluginById('code');
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
      
        // Get Userid
        $uid = UserUtil::getVar('uid');
      
        DBUtil::updateObject($formData, 'wiifriends_wfc');
        LogUtil::registerStatus("Your code has been updated.");
      }
      
      $url = ModUtil::url('wiifriends', 'user');
      return $this->view->redirect($url);

    }


  }
