<?php

function str_lreplace($search, $replace, $subject)
{
    return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
}


class			xmltolatexController extends controller
{
	public function convertAction() {
		if (!isset($_POST["tek"])) {
			echo 'this file cannot be called this way';
			exit();
		}
		$render = $_POST["tek"];
		//$render = str_replace("\n", " \n\\newline\n", $render);
		$render = str_replace('<br>', "\n//\n", $render);
		$render = str_replace('<br />', "\n//\n", $render);
		$render = str_replace('<title>', '\title{', $render);
		$render = str_replace('</title>', "}", $render);
		$render = preg_replace('/\<paragraph\>/', '\begin{letter}{', $render, 1);
		$render = preg_replace('/\<\/paragraph\>/', "}\n\pagestyle{plain}\n", $render, 1);
		$render = preg_replace('/\<paragraph\>/', '\name{', $render, 1);
		$render = preg_replace('/\<\/paragraph\>/', "}\n", $render, 1);
		$render = preg_replace('/\<paragraph\>/', '\opening{', $render, 1);
		$render = preg_replace('/\<\/paragraph\>/', "}\n", $render, 1);

		$render = str_lreplace('<paragraph>', '\closing{', $render);
		$render = str_lreplace('</paragraph>', '}', $render);

		$render = str_replace('<paragraph>', '', $render);
		$render = str_replace('</paragraph>', '', $render);
		$render = str_replace('<item>', '\item ', $render);
		$render = str_replace('</item>', "\n", $render);
		$render = str_replace('<bullets>', "\begin{itemize}\n", $render);
		$render = str_replace('</bullets>', "\n\end{itemize}\n", $render);
		$render = str_replace('<xml>', '', $render);
		$render = str_replace('</xml>', '', $render);
		//$render = html_entity_decode(html_entity_decode($render));
		$render = str_replace('&amp;', '\&', $render);
		$render = str_replace('&aacute;', '\acute{a}', $render);
		$render = str_replace('&agrave;', '\grave{a}', $render);
		$render = str_replace('&eacute;', '\acute{e}', $render);
		$render = str_replace('&egrave;', '\grave{e}', $render);
		$render = str_replace('<b>', '\textbf{', $render);
		$render = str_replace('</b>', '}', $render);
		$render = str_replace('<u>', '\underline{', $render);
		$render = str_replace('</u>', '}', $render);
		$render = str_replace('<i>', '\textit{', $render);
		$render = str_replace('</i>', '}', $render);
		

		$this->template->data = $render;
		$this->template->setView("raw");
	}

	public function indexAction() {
		echo 'this file cannot be called this way';
	}

	public function disableHeader() { return (TRUE); }
}

?>