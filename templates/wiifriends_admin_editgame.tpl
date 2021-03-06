
<h1>{gt text="Game Administration"}</h1>

{include file="wiifriends_user_menu.tpl"}


{insert name='getstatusmsg' module='WiiFriends'}

{pnform cssClass="z-form"}
{pnformvalidationsummary}

<fieldset>
  <legend>{gt text="Edit Game"}</legend>

  
  <div class="z-formrow">
  {pnformlabel for=game __text="Game Name"}
  {pnformtextinput id=game width=20em maxLength=200 mandatory=1}
  </div>

  <div class="z-formrow">
  {pnformlabel for=obj_status __text="Status" }
  {pnformdropdownlist id=obj_status mandatory=1 width=4em}
  </div>

  <div class="z-formrow">
  {pnformlabel for=delete __text="Delete this game:"}
  {pnformcheckbox id=delete}
  </div>
</fieldset>

{pnformbutton commandName="submit" __text="Submit" }
{/pnform}
