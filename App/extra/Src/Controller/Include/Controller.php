<?php

abstract class Controller {
	
	public $model;

	final public function getElement($pk)
	{
		$object = $this->model->byId($pk);

        if ($object) {
            $this->model->setPost($object);
        } else Hell::error("403");
	}

	public function hook()
    {
        if (isset($_SESSION['CSRFTOKEN']) and isset($_POST['csrf_token']) and hash_equals($_SESSION['CSRFTOKEN'], $_POST['csrf_token'])) {

            unset($_SESSION['CSRFTOKEN']);
            unset($_POST['csrf_token']);
            if ( isset($_POST['id']) and $_POST['id'] ) $this->model->update($_POST['id'], $_POST);
            else $this->model->save($_POST);
            header("location: /main");
    
        } else Hell::error('403');
    }

	public function delete($pk = null)
    {
        if ($pk) {

            $this->model->delete($pk);
            header("location: /main");
    
        } else Hell::error('403');
    }
	
	final public function setModel($modelName)
	{
		$this->model = new $modelName;
	}
	
	public function form($pk = null)
	{
		$this->getElement($pk);
		header('Content-type: application/json');
		echo json_encode($this->model->getPost());
	}

	function view($content, $data = null) 
	{
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		
		$content = VIEW_FOLDER . $content . '.php';
		include VIEW_FOLDER . VIEW_TEMPLATE;
	}

	function render($content, $data = null) 
	{
		if(is_array($data)) {
			// преобразуем элементы массива в переменные
			extract($data);
		}
		
		include VIEW_FOLDER . $content . '.php';
	}

}

?>