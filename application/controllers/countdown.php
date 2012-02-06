<?php
class			countdownController extends controller
{
	public function indexAction()
	{
		$this->addCss("jquery.countdown");
		$this->addJavascript("jquery.countdown");
		$this->template->setView("countdown");
	}

	public function disableHeader()
	{
		return true;
	}
}