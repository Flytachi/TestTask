<?php

class TaskController extends Controller
{

    public function list()
    {
        $order = $_GET['sort'] . ' ';
        $order .= ($_GET['type']) ? 'ASC' : 'DESC';
        $this->model->Order($order)->Limit(3);
        $this->render('tables/task', $this->model);
    }

    public function form($pk = null)
    {
        if ($pk) parent::getElement($pk);
        $this->render('forms/task', $this->model);
    }

    public function hook()
    {
        if (isset($_SESSION['CSRFTOKEN']) and isset($_POST['csrf_token']) and hash_equals($_SESSION['CSRFTOKEN'], $_POST['csrf_token'])) {
            
            unset($_SESSION['CSRFTOKEN']);
            unset($_POST['csrf_token']);
            if ( isset($_POST['id']) and $_POST['id'] ) {
                isAuth();
                $_POST['is_edit'] = 1;
                $this->model->update($_POST['id'], $_POST);
            } else $this->model->save($_POST);

            header('Content-type: application/json');
            echo json_encode(array(
                'status' => 'success'
            ));
    
        } else Hell::error('403');
    }

    public function complete($pk)
    {
        isAuth();
        $this->model->update($pk, array('status' => 1));
        header('Content-type: application/json');
        echo json_encode(array(
            'status' => 'success'
        ));
    }

    public function delete($pk = null)
    {
        isAuth();
        if ($pk) {

            $this->model->delete($pk);
            header('Content-type: application/json');
            echo json_encode(array(
                'status' => 'success'
            ));
    
        } else Hell::error('403');
    }
    
}

?>