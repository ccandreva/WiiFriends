
<h1>{gt text="Edit Console Code"}</h1>

{include file="wiifriends_user_menu.tpl"}


{insert name='getstatusmsg' module='WiiFriends'}

{nocache}
{pnform cssClass="z-form"}
{pnformvalidationsummary}

<div class="z-admincontainer">
{pnformlabel for=code __text="Console Code"}
{pnformtextinput id=code width=20em maxLength=20 mandetory=1}
</div>

{pnformbutton commandName="submit" __text="Submit" }
{/pnform}
{/nocache}
