
<h1>{gt text='Suggest a Game'}</h1>

{include file="wiifriends_user_menu.tpl"}


{insert name='getstatusmsg' module='WiiFriends'}

{pnform cssClass="z-form"}
{pnformvalidationsummary}

<fieldset>
  <legend>{gt text='Game Information'}</legend>
  
  <div class="z-formrow">
    {pnformlabel for=game __text="Name of Game"}
    {pnformtextinput id=game width=20em maxLength=200 mandatory=1}
  </div>

{pnformbutton commandName="submit" __text="Submit" }
{/pnform}
