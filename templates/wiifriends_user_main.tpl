{* $Id$ *}

<h1>{gt text="Wii Friends"}</h1>

{include file="wiifriends_user_menu.tpl"}

{insert name='getstatusmsg' module='WiiFriends'}

{nocache}
{img modname=core src=xedit.gif set=icons/extrasmall alt='Edit' assign=editIcon}
{/nocache}

<h2>{gt text="Your Information"}</h2>
{modurl modname="wiifriends" func="editconsole" assign="consoleurl"}

{nocache}
{if $console == '' }
    {assign var="console" __value="(None set)" }
{/if}
<p>{gt text="Your console code is"}: <strong>{$console}</strong>
{/nocache}

<a href="{$consoleurl}" title="{gt text='Edit your console code'}.">{$editIcon.imgtag}</a>
</p>


<h3>{gt text="Your Games"}</h3>
<table>
    <tr>
        <th>{gt text="Game"}</th>
        <th>{gt text="Friend Code"}</th>
    </tr>

    {nocache}
        {foreach item=item from=$codes}
            <tr>
            <td>{$item.gameName}</td>
            <td>{$item.code}{*|regex_replace:"/^(\d{4})(\d{4})(\d{4})/":"\${1}-\${2}-\${3}"*}</td>
            <td>
            <a href="{modurl modname="wiifriends" func="editwfc" id=$item.id }"
                    title="{gt text='Edit this game'}.">{$editIcon.imgtag}</a>
            </td>
            </tr>
        {/foreach}
    {/nocache}

</table>
