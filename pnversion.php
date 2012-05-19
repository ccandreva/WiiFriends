<?php
/**
 * PostNuke Application Framework
 *
 * @copyright (c) 2001, PostNuke Development Team
 * @link http://www.postnuke.com
 * @version $Id$
 * @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
 */

$dom = ZLanguage::getModuleDomain('wiifriends');

$modversion['name']         = __('wiifriends', $dom);
$modversion['displayname']  = __('Wii Friends', $dom);
$modversion['description']  = __('Manage your Wii friends and console codes.',$dom);
$modversion['url']         = __('wiifriends', $dom);
$modversion['version']      = '1.1';
$modversion['credits']      = 'pndocs/credits.txt';
$modversion['help']         = 'pndocs/install.txt';
$modversion['changelog']    = 'pndocs/changelog.txt';
$modversion['license']      = 'pndocs/license.txt';
$modversion['official']     = true;
$modversion['author']       = 'Chris Candreva';
$modversion['contact']      = 'http://www.westnet.com/';
$modversion['securityschema'] = array('wiifriends::' => 'wiifriends::');
