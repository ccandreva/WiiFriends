{* $Id$ *}

<h1>{gt text='All Console Codes'}</h1>

{include file="wiifriends_user_menu.tpl"}

{insert name='getstatusmsg' module='WiiFriends'}

<table>
<tr>
<th>{gt text='User'}</th>
<th>{gt text='Console Code'}</th>
</tr>

{nocache}
{foreach item=item from=$codes}
{pnusergetvar uid=$item.cr_uid name='_UREALNAME' assign=username}
{if $username == '' }
{pnusergetvar uid=$item.cr_uid name='uname' assign=username}
{/if}
<tr>
{* <td>{$item.cr_uid}</td> *}
<td>{$username|pnvarprepfordisplay}</td>
<td>{$item.code|regex_replace:"/^(\d{4})(\d{4})(\d{4})(\d{4})/":"\${1}-\${2}-\${3}-\${4}"}</td>
</tr>
{/foreach}
{/nocache}

</table>
