{* $Id$ *}
{include file="wiifriends_admin_menu.tpl"}
<div class="z-admincontainer">
  <div class="z-adminpageicon">{pnimg modname=core src=filenew.gif set=icons/large  __alt='Wii Friends Module Admin' altml=true}</div>
  <h2>Options</h2>
  {insert name='getstatusmsg' module='WiiFriends'}

  {pnform cssClass="z-form"}
  {pnformvalidationsummary}

  <fieldset>
    <legend>{gt text="Email Settings"}</legend>
    <div class="z-formrow">
    {pnformlabel for=adminEmail text="Game Admin Email Address"}
    {pnformtextinput id=adminEmail width=20em maxLength=200}
    <p class="z-formnote z-informationmsg">
      {gt text="If this is left blank, the site admin address will be used."}
    </p>
    </div>
  </fieldset>

  {pnformbutton commandName="submit" text="Submit" }
  {/pnform}

</div>
