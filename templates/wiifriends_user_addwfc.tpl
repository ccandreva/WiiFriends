
<h1>{gt text='Add Friend Code'}</h1>

{include file="wiifriends_user_menu.tpl"}
{* <p>ID: {$id}</p> *}

{insert name='getstatusmsg' module='WiiFriends'}

{nocache}
{pnform cssClass="z-form"}
{pnformvalidationsummary}

<fieldset>
  <legend>{gt text='Enter You Information'}

  <div class="z-admincontainer">
    {pnformlabel for=game __text="Name of Game"}
    {pnformdropdownlist id=game mandatory=1}
  </div>

  <div class="z-admincontainer">
    {pnformlabel for=code __text="Your Friend Code"}
    {pnformtextinput id=code width=14em maxLength=14 mandatory=1}
  </div>
</fieldset>

{pnformbutton commandName="submit" text="Submit" }
{/pnform}
{/nocache}
