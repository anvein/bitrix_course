<?=$FORM->ShowFormDescription("")?> 
<br />
 <?=$FORM->ShowFormNote()?><?=$FORM->ShowFormErrors()?> 
<br />
 
<table width="100%" cellspacing="1" cellpadding="2" border="0" class="data-table"> 
  <tbody> 
    <tr><td width="15%" valign="top" height="" align="right"><?=$FORM->ShowInputCaption("NAME","")?></td><td><?=$FORM->ShowInput('NAME')?></td></tr>
   
    <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("COMPANY","")?></td><td><?=$FORM->ShowInput('COMPANY')?></td></tr>
   
    <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("POSITION","")?></td><td><?=$FORM->ShowInput('POSITION')?></td></tr>
   
    <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("EMAIL","")?></td><td><?=$FORM->ShowInput('EMAIL')?></td></tr>
   
    <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("PHONE","")?></td><td><?=$FORM->ShowInput('PHONE')?></td></tr>
   
    <tr><td valign="top" align="right"><?=$FORM->ShowInputCaption("QUESTIONS","")?></td><td><?=$FORM->ShowInput('QUESTIONS')?></td></tr>
   
    <tr><td valign="top" align="right"><?=$FORM->ShowCaptchaImage()?></td><td>Введите текст на картинке <?=$FORM->ShowRequired()?> 
        <br />
       <?=$FORM->ShowCaptchaField()?></td></tr>
   </tbody>
 </table>
 
<br />
<?=$FORM->ShowSubmitButton("","")?>