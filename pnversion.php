<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2001, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id$
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

$modversion['name']         = pnVarPrepForDisplay(_WIIFRIENDS_NAME);
$modversion['displayname']  = pnVarPrepForDisplay(_WIIFRIENDS_DISPLAYNAME);
$modversion['description']  = pnVarPrepForDisplay(_WIIFRIENDS_DESCRIPTION);
$modversion['version']      = '1.0';
$modversion['credits']      = 'pndocs/credits.txt';
$modversion['help']         = 'pndocs/install.txt';
$modversion['changelog']    = 'pndocs/changelog.txt';
$modversion['license']      = 'pndocs/license.txt';
$modversion['official']     = true;
$modversion['author']       = 'Chris Candreva';
$modversion['contact']      = 'http://www.westnet.com/';
$modversion['securityschema'] = array('wiifriends::' => 'wiifriends::');
