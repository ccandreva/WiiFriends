
{include file="wiifriends_admin_menu.tpl"}
<div class="z-admincontainer">
<div class="z-adminpageicon">{pnimg modname=core src=filenew.gif set=icons/large alt='' }</div>
<h2>{gt text='All Games'}</h2>

<table>
<tr>
<th>{gt text='Name'}</th>
<th>{gt text='State'}</th>
</tr>


{foreach key=game item=item from=$games}
<tr>
<td>{$item.game}</td>
<td>{$item.obj_status}</td>
<td><a href="{pnmodurl modname="wiifriends" type="admin" func="editgame" id=$item.id }">Edit</a>
</td>
</tr>
{/foreach}

</table>

</div>
