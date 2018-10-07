<p><?=$FORM->ShowFormNote()?><?=$FORM->ShowFormErrors()?></p>
 
<p> 
  <table width="100%" cellspacing="1" cellpadding="1" border="0" class="data-table"> 
    <tbody> 
      <tr><td width="15%" valign="top" align="right"><?=$FORM->ShowInputCaption("VS_NAME","")?></td><td><?=$FORM->ShowInput('VS_NAME')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_BIRTHDAY","")?> (<?=$FORM->ShowDateFormat("")?>)</td><td><?=$FORM->ShowInput('VS_BIRTHDAY')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_ADDRESS","")?></td><td><?=$FORM->ShowInput('VS_ADDRESS')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_MARRIED","")?></td><td><?=$FORM->ShowInput('VS_MARRIED')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_INTEREST","")?></td><td><?=$FORM->ShowInput('VS_INTEREST')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_AGE","")?></td><td><?=$FORM->ShowInput('VS_AGE')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_EDUCATION","")?></td><td><?=$FORM->ShowInput('VS_EDUCATION')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("VS_INCOME","")?></td><td><?=$FORM->ShowInput('VS_INCOME')?></td></tr>
     
      <tr><td valign="top" align="right"><?=$FORM->ShowCaptchaImage()?></td><td>Введите символы на картинке <?=$FORM->ShowRequired()?> 
          <br />
         <?=$FORM->ShowCaptchaField()?></td></tr>
     </tbody>
   </table>
 </p>
 
<p><?=$FORM->ShowSubmitButton("","")?></p>
 
<p>&nbsp;</p>
 
<p></p>