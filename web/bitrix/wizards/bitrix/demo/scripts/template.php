<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class DemoSiteTemplate extends CWizardTemplate
{

	function GetLayout()
	{
		$wizard = &$this->wizard;

		$formName = htmlspecialchars($wizard->GetFormName());

		$charset = LANG_CHARSET;
		$wizardName = htmlspecialcharsEx($wizard->GetWizardName());

		$nextButtonID = htmlspecialchars($wizard->GetNextButtonID());
		$prevButtonID = htmlspecialchars($wizard->GetPrevButtonID());
		$cancelButtonID = htmlspecialchars($wizard->GetCancelButtonID());
		$finishButtonID = htmlspecialchars($wizard->GetFinishButtonID());

		$wizardPath = $wizard->GetPath();

		$obStep =& $wizard->GetCurrentStep();
		$arErrors = $obStep->GetErrors();
		$strError = $strJsError = "";
		if (count($arErrors) > 0)
		{
			foreach ($arErrors as $arError)
			{
				$strError .= $arError[0]."<br />";

				if ($arError[1] !== false)
					$strJsError .= ($strJsError <> ""? ", ":"")."{'name':'".CUtil::addslashes($wizard->GetRealName($arError[1]))."', 'title':'".CUtil::addslashes(htmlspecialcharsback($arError[0]))."'}";
			}

			if (strlen($strError) > 0)
				$strError = '<div id="step_error">'.$strError."</div>";

			$strJsError = '
			<script type="text/javascript">
				ShowWarnings(['.$strJsError.']);
			</script>';
		}

		$stepTitle = $obStep->GetTitle();
		$stepSubTitle = $obStep->GetSubTitle();
		if (strlen($stepSubTitle) > 0)
			$stepSubTitle = '<div id="step_description">'.$stepSubTitle.'</div>';

		$autoSubmit = "";
		if ($obStep->IsAutoSubmit())
			$autoSubmit = 'setTimeout("AutoSubmit();", 500);';

		$currentStep = $wizard->GetCurrentStepID();
		$hideButtons = "";
		if ($obStep->IsAutoSubmit() || $currentStep == "install_services")
			$hideButtons = ' style="display:none;"';

		$alertText = CUtil::JSEscape($_SERVER["PHP_SELF"] == "/index.php" ? GetMessage("DEMO_CANCEL_STEP_ALERT_INDEX") : GetMessage("DEMO_CANCEL_STEP_ALERT_ADMIN"));
		$loadingText = CUtil::JSEscape(GetMessage("MAIN_WIZARD_WAIT_WINDOW_TEXT"));
		$jsNotSupported = CUtil::JSEscape(GetMessage("JAVASCRIPT_NOT_ENABLE"));

		return <<<HTML
<html>
	<head>
		<title>{$wizardName}</title>
		<meta http-equiv="Content-Type" content="text/html; charset={$charset}">
		<noscript>
			<style type="text/css">
				#container {display: none;}
				body {background-image:none;}
				#noscript {padding: 3em; font-size: 130%; background:white; height:100%;}
			</style>
			<p id="noscript">{$jsNotSupported}</p>
		</noscript>

		<style type="text/css">
			body
			{
				background:#4a507b url({$wizardPath}/images/bg_fill.gif) repeat;
				margin:0; 
				padding:0; 
				font-family:Verdana,Arial,helvetica,sans-serif;
				font-size:75%;
			}

			table {font-size:100%;}
			form {margin:0; padding:0;}

			#container
			{
				background: transparent url({$wizardPath}/images/bg_top.gif) repeat-x;
			}

			#step_info
			{
				height:38px;
				padding:0px 10px 0px 15px;
				border-bottom:1px solid #ccc;
				box-sizing:border-box;
				-moz-box-sizing:border-box;
				overflow:hidden;
				background:#e3f0f9 url({$wizardPath}/images/fill_top.gif) left center no-repeat;
			}

			#main-table
			{
				width:600px;
				border-collapse:collapse;
				/*height:365px;*/
				padding:0;
			}

			#main-table td {padding:0;}

			#step_title
			{
				font-weight:bold;
			}

			#step_description
			{
				font-size:95%;
				padding-left:10px;
			}

			#step_content 
			{
				padding:15px 20px;
				float:left;
				box-sizing:border-box;
				-moz-box-sizing:border-box;
			}
			#step_buttons
			{
				height:37px;
				text-align:center;
				padding-right:20px;
				padding-top:12px;
				overflow:hidden;
				box-sizing:border-box;
				-moz-box-sizing:border-box;
				background:#e3f0f9 url({$wizardPath}/images/fill_bottom.gif) left top repeat-x;
			}

			#step_content_container
			{
				width:100%;
				height:290px;
				overflow:auto;
				background:#fff;
			}

			#step_error
			{
				color:red;
				background:white;
				border-bottom:1px solid #ccc;
				padding:2px 30px;
			}

			#logo
			{
				float:left;
				width:35px;
				height:35px;
				margin-right:20px;
				background: url({$wizardPath}/images/wizard.gif) no-repeat;
			}

			.wizard-template-box, .wizard-group-box
			{
				float:left;
				margin:5px;
				margin-top:0;
				width:160px;
				height:150px;
			}

			#hidden-layer
			{
				background:transparent;
				height:100%;
				position:absolute;
				top:0pt;
				width:100%;
				z-index:10001;
			}

			/*Data table*/
			table.wizard-data-table
			{
				border:1px solid #7d7d7d;
				border-collapse:collapse;
			}

			/*Any cell*/
			table.wizard-data-table td
			{
				border:1px solid #d0d0d0;
				background-color:#FFFFFF;
				padding:3px 5px;
			}

			/*Head cell*/
			table.wizard-data-table thead td, table.wizard-data-table th
			{
				background: #e3f0f9;
				font-weight: bold;
				background-image:none;
				border:1px solid #d0d0d0;
				padding:4px;
			}

			/*Body cell*/
			table.wizard-data-table tbody td
			{
				background-color:#FFF;
				background-image:none;
			}

			/*Foot cell*/
			table.wizard-data-table tfoot td
			{
				background-color:#fff;
				padding:4px;
			}

		</style>

		<script type="text/javascript">

			function OnLoad()
			{
				{$autoSubmit}

				var title = self.parent.window.document.getElementById("wizard_dialog_title");
				if (title)
					title.innerHTML = "{$wizardName}";

				var form = document.forms["{$formName}"];

				if (form)
					form.onsubmit = OnFormSubmit;

				var cancelButton = document.forms["{$formName}"].elements["{$cancelButtonID}"];
				var nextButton = document.forms["{$formName}"].elements["{$nextButtonID}"];
				var prevButton = document.forms["{$formName}"].elements["{$prevButtonID}"];
				var finishButton = document.forms["{$formName}"].elements["{$finishButtonID}"];

				if (cancelButton && !nextButton && !prevButton && !finishButton)
					cancelButton.onclick = CloseWindow;
				else if(cancelButton)
					cancelButton.onclick = ConfirmCancel;

				var preloadImages = ["wait.gif", "icon_warn.gif", "services/content.gif", "services/other.gif", "services/vote.gif", "services/support.gif", "services/advertising.gif", "services/blog.gif", "services/sale.gif", "services/subscribe.gif", "services/photogallery.gif", "services/forum.gif", "services/form.gif"];

				for (var imageIndex = 0; imageIndex < preloadImages.length; imageIndex++)
				{
					var imageObj = new Image();
					imageObj.src = "{$wizardPath}/images/" + preloadImages[imageIndex];
				}
			}

			function OnFormSubmit()
			{
				var div = document.body.appendChild(document.createElement("DIV"));
				div.id = "hidden-layer";
			}

			function AutoSubmit()
			{
				var nextButton = document.forms["{$formName}"].elements["{$nextButtonID}"];
				if (nextButton)
				{
					//WaitWindow.Show();
					nextButton.click();
					nextButton.disabled=true;
				}
			}

			function ConfirmCancel()
			{
				return (confirm("{$alertText}"));
			}

			function ShowWarnings(warnings)
			{
				var form = document.forms["{$formName}"];
				if(!form)
					return;

				for(var i in warnings)
				{
					var e = form.elements[warnings[i]["name"]];
					if(!e)
						continue;

					var type = (e.type? e.type.toLowerCase():"");
					var bBefore = false;
					if(e.length > 1 && type != "select-one" && type != "select-multiple")
					{
						e = e[0];
						bBefore = true;
					}
					if(type == "textarea" || type == "select-multiple")
						bBefore = true;

					var td = e.parentNode;
					var img;
					if(bBefore)
					{
						img = td.insertBefore(new Image(), e);
						td.insertBefore(document.createElement("BR"), e);
					}
					else
					{
						img = td.insertBefore(new Image(), e.nextSibling);
						img.hspace = 2;
						img.vspace = 2;
						img.style.verticalAlign = "bottom";
					}
					img.src = "{$wizardPath}/images/icon_warn.gif";
					img.title = warnings[i]["title"];
				}
			}

			document.onkeydown = EnterKeyPress;

			function EnterKeyPress(event)
			{
				if (!document.getElementById)
					return;

				if (window.event)
					event = window.event;

				var sourceElement = (event.target? event.target : (event.srcElement? event.srcElement : null));

				if (!sourceElement || sourceElement.tagName.toUpperCase() == "TEXTAREA")
					return;

				var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null) );
				if (!key)
					return;

				if (key == 13)
				{
					CancelBubble(event);
				}
				else if (key == 39 && event.ctrlKey)
				{
					var nextButton = document.forms["{$formName}"].elements["{$nextButtonID}"];
					if (nextButton)
					{
						nextButton.click();
						CancelBubble(event);
					}
				}
				else if (key == 37 && event.ctrlKey)
				{
					var prevButton = document.forms["{$formName}"].elements["{$prevButtonID}"];
					if (prevButton)
					{
						prevButton.click();
						CancelBubble(event);
					}
				}
			}

			function CancelBubble(event)
			{
				if (event.stopPropagation)
				{
					event.preventDefault();
					event.stopPropagation();
				}
				else
				{
					event.cancelBubble = true;
					event.returnValue = false;
				}
			}

			function strip_tags(str)
			{
				return str.replace(/<\\/?[^>]+>/gi, '');
			}

			function CloseWindow()
			{
				if (top.window.WizardWindow)
					top.window.WizardWindow.Close();
				else
					top.window.location = '/?finish';
				return false;
			}

			function CAjaxForm(formName, target, hiddenField)
			{
				var form = document.forms[formName];
				if (!form)
					 form = document.getElementById(formName);

				this.nextStep = form.elements[hiddenField];
				this.nextStepStage = form.elements[hiddenField+"Stage"];
				this.iframe = document.getElementById(target);
				this.form = form;
				this.form.target = target;

				var _this = this;

				if (this.iframe.attachEvent) //IE
					this.iframe.attachEvent("onload", function() {_this.AjaxHandler()});
				else
					this.iframe.onload = function() {_this.AjaxHandler()};

				this.percent = null;
				this.indicator = null;
				this.status = null;
			}

			CAjaxForm.prototype.AjaxHandler = function()
			{
				//opera triggers onload event even on empty iframe
				if(this.iframe.contentWindow && this.iframe.contentWindow.location.href.indexOf('http') != 0)
					return;

				if (this.iframe.contentDocument)
					var iframeDocument = this.iframe.contentDocument;
				else
					var iframeDocument = this.iframe.contentWindow.document;

				var response = iframeDocument.body.innerHTML;
				if (response.length == 0 || iframeDocument.getElementById("bitrix_install_template"))
				{
					this.ShowError("Connection error. Empty response.");
					return;
				}

				var regexpStart = new RegExp('\\\\[response\\\\]', 'i');
				var regexpEnd = new RegExp('\\\\[\/response\\\\]', 'i');

				var matchResponse = response.match(regexpStart);

				if (matchResponse === null)
				{
					this.ShowError(response);
					return;
				}

				var start = matchResponse.index + matchResponse[0].length;
				var end = response.search(regexpEnd);
				if (end == -1)
				{
					this.ShowError(response);
					return;
				}

				response = response.substr(start, end-start);

				window.eval(response);
			}

			CAjaxForm.prototype.ShowError = function(errorMessage)
			{
				var errorContainer = document.getElementById("error_container");
				var errorText = document.getElementById("error_text");
				if (!errorContainer || !errorText)
					return;

				var waitWindow = document.getElementById("wait");
				if (waitWindow)
					waitWindow.style.display = "none";

				errorContainer.style.display = 'block';
				errorText.innerHTML = strip_tags(errorMessage);

				var retryButton = document.getElementById("error_retry_button");
				var skipButton = document.getElementById("error_skip_button");

				var _this = this;
				var nextStep = this.nextStep.value;
				var nextStepStage = this.nextStepStage.value;

				retryButton.onclick = function() {_this.HideError(); _this.Post(nextStep, nextStepStage,'');};
				skipButton.onclick = function() {_this.HideError(); _this.Post(nextStep, 'skip','');};
				//if (nextStep == "main")
					//skipButton.onclick = function() {_this.HideError(); _this.Post(nextStep, nextStepStage,'');};
			}

			CAjaxForm.prototype.HideError = function()
			{
				var errorContainer = document.getElementById("error_container");
				var errorText = document.getElementById("error_text");
				if (!errorContainer || !errorText)
					return;

				while (errorText.firstChild)
					errorText.removeChild(errorText.firstChild);
				
				errorContainer.style.display = 'none';

				var waitWindow = document.getElementById("wait");
				if (waitWindow)
					waitWindow.style.display = "block";
			}

			CAjaxForm.prototype.Post = function(nextStep, nextStepStage, status)
			{
				if (nextStep)
					this.nextStep.value = nextStep;

				if (nextStepStage)
					this.nextStepStage.value = nextStepStage;

				this.form.submit();

				if (!this.status)
					this.status = document.getElementById("status");

				if (status.length > 0)
					this.status.innerHTML = status + "...";
			}

			CAjaxForm.prototype.StopAjax = function()
			{
				this.iframe.onload = null;
				this.form.target = "_self";
			}

			CAjaxForm.prototype.SetStatus = function(percent, status)
			{
				if (!this.percent)
					this.percent = document.getElementById("percent");

				if (!this.indicator)
					this.indicator = document.getElementById("indicator");

				if (!this.status)
					this.status = document.getElementById("status");
				this.status.innerHTML = status;

				this.percent.innerHTML = percent + "%";
				this.indicator.style.width = percent + "%";
			}

			function CWaitWindow()
			{
				this.Show = function()
				{
					try
					{
						var oDiv = document.createElement("DIV");
						oDiv.id = "bx_wait_window";
						oDiv.style.width = "170px";
						//oDiv.style.height = "80px";
						oDiv.style.border = "1px solid #E1B52D";
						oDiv.style.textAlign = "center";
						oDiv.style.backgroundColor = "#FCF7D1";
						oDiv.style.position = "absolute";
						oDiv.style.padding = "10px";
						oDiv.style.backgroundImage = "url({$wizardPath}/images/wait.gif)";
						oDiv.style.backgroundPosition = "10px center"; 
						oDiv.style.backgroundRepeat = "no-repeat";
						oDiv.style.left = "45%";
						oDiv.style.top = "45%";
						oDiv.style.color = "black";
						oDiv.style.fontSize = "100%";
						oDiv.style.zIndex = "3000";
						oDiv.innerHTML = "&nbsp;&nbsp;{$loadingText}";
						document.getElementById("step_content").appendChild(oDiv);
					}
					catch(e){}
				}

				this.Hide = function()
				{
					try
					{
						var oDiv = document.getElementById("bx_wait_window");
						oDiv.parentNode.removeChild(oDiv);
						oDiv = null;
					}catch(e){}
				}
			}

			var WaitWindow = new CWaitWindow();
		</script>

	</head>

	<body onload="OnLoad();" id="bitrix_install_template">
<table width="100%" height="100%" cellpadding="0" cellspacing="0" id="container">
<tr>
<td>
<table id="main-table" align="center">
		<tr>
			<td width="11" height="11"><img src="{$wizardPath}/images/top_left.gif" width="11" height="11" alt="" /></td>
			<td width="578" style="background:#e3f0f9;"></td>
			<td width="11" height="11"><img src="{$wizardPath}/images/top_right.gif" width="11" height="11" alt="" /></td>
		</tr>
		<tr>
			<td colspan="3" style="background:white;" >
				{#FORM_START#}
					<div id="step_info"><div id="logo"></div>
						<div id="step_title">{$stepTitle}</div>
						{$stepSubTitle}
					</div>
					<div id="step_content_container">
						{$strError}
						<div id="step_content">{#CONTENT#}</div>
					</div>
					<div id="step_buttons"><div{$hideButtons}>{#BUTTONS#}</div></div>
				{#FORM_END#}
				{$strJsError}
			</td>
		</tr>
		<tr>
			<td width="11" height="11"><img src="{$wizardPath}/images/bottom_left.gif" width="11" height="11" alt="" /></td>
			<td width="100%" style="background:#e3f0f9;"></td>
			<td width="11" height="11"><img src="{$wizardPath}/images/bottom_right.gif" width="11" height="11" alt="" /></td>
		</tr>
	</table>
</td>
</tr>
</table>
	</body>
</html>
HTML;

	}

}
