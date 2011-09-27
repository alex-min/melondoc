<?php

class indexController extends controller
{
	public function indexAction()
	{
		$this->template->title = "Test Page";
		
		// Ajout des css necessaire
		//$this->addCSS("mbTooltip");
		//$this->addCSS("blackbird");
		
		// Ajout des scripts javascript necessaire
		
		// Chargement de la vue index
		$this->template->setView("index");
	}

	public function testAction()
	{
		$fd = fopen("public/test.txt", "a");
		$this->template->addJSON($this->GET);
	}
}

?>