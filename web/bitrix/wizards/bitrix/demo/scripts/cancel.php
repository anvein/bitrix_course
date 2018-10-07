<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CancelStep extends CWizardStep
{
	function InitStep()
	{
		$this->SetStepID("cancel_step");
		$this->SetCancelStep("cancel_step");
		$this->SetTitle(GetMessage("DEMO_CANCEL_STEP_TITLE"));

		if ($_SERVER["PHP_SELF"] == "/index.php")
			$this->SetCancelCaption(GetMessage("DEMO_CANCEL_STEP_BUTTON_INDEX"));
		else
			$this->SetCancelCaption(GetMessage("DEMO_CANCEL_STEP_BUTTON_ADMIN"));
	}

	function OnPostForm()
	{
	}

	function ShowStep()
	{
		$wizard =& $this->GetWizard();
		if ($_SERVER["PHP_SELF"] == "/index.php")
		{
			$this->content .= GetMessage("DEMO_CANCEL_STEP_CONTENT_INDEX");

			CopyDirFiles(
				$_SERVER["DOCUMENT_ROOT"].$wizard->GetPath()."/indexes/".LANGUAGE_ID."/cancel",
				$_SERVER["DOCUMENT_ROOT"],
				$rewrite = true, 
				$recursive = true
			);
		}
		else
		{
			$this->content .= GetMessage("DEMO_CANCEL_STEP_CONTENT_ADMIN");
		}
	}
}
?>