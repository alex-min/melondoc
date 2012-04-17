<?php
class SavedocController extends controller {
 public function		indexAction()
  {
  	if (isset($_POST['doc'])) {
  		$this->model->save($_POST['doc'], $_POST['id'],$_POST['name']);
  	}
  }
}