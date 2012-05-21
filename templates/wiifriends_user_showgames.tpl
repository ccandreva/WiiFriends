
<h1>{gt text='All Games'}</h1>

{include file="wiifriends_user_menu.tpl"}
{insert name='getstatusmsg' module='WiiFriends'}
{* <p>Where: {$where}</p> *}

<table>
<tr>
<th>{gt text='Name'}</th>
</tr>


{foreach key=game item=item from=$games}
<tr>
<td>{$item.game}</td>
<td><a href="{pnmodurl modname="wiifriends" func="showcodes" id=$item.id }">Show Codes</A>
</tr>
{/foreach}

</table>
