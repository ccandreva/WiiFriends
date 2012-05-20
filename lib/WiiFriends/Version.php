<?php
/**
* Wii Friends
*
* @copyright (C) 2010-2012, Chris Candreva
* @link http://github.com/ccandreva/WiiFriends
* @license See license.txt
* @license GNU/GPL - http://www.gnu.org/copyleft/gpl.html
*/


class WiiFriends_Version extends Zikula_AbstractVersion
{
    public function getMetaData()
    {

        $meta['name']         = $this->__('wiifriends');
        $meta['displayname']  = $this->__('Wii Friends');
        $meta['description']  = $this->__('Manage your Wii friends and console codes.',$dom);
        $meta['url']         = $this->__('wiifriends');
        $meta['version']      = '1.1';
        $meta['core_min']      =   '1.3.0';
        $meta['core_max']      =   '1.3.99';
        $meta['official']     = true;
        $meta['author']       = 'Chris Candreva';
        $meta['contact']      = 'http://github.com/ccandreva/WiiFriends';
        $meta['securityschema'] = array('wiifriends::' => 'wiifriends::');

        return $meta;
    }
}
        