
<h1>Edit Friend Code</h1>

{include file="wiifriends_user_menu.tpl"}
<p>ID: {$id}</p>

{insert name='getstatusmsg' module='WiiFriends'}

{nocache}
{pnform cssClass=""}
{pnformvalidationsummary}
<input type="hidden" name="id" value="{$id}">

<h3>Editing friend code for game: {$gameName}</h3>

<p>
{pnformlabel for=code text="Code"}
{pnformtextinput id=code width=20em maxLength=20 mandatory=1}
</p>

<p>
{pnformlabel for=delete text="Delete this game:"}
{pnformcheckbox id=delete}
</p>

{pnformbutton commandName="submit" text="Submit" }
{/pnform}
{/nocache}
