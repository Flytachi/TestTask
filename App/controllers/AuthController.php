<?php

class AuthController extends Controller
{

    public function login()
    {
        if (empty($_SESSION['id'])) {
            $this->render('forms/login');
        } else Hell::error('423');
    }

    public function logout()
    {
        session_destroy();
        header("location: /main");
    }

    public function verification()
    {
        if ($_POST['username'] and $_POST['password']) {

            importModel('UserModel');
            $userModel = new UserModel;
            $login = $userModel->clean($_POST['username']);
            $password = sha1($userModel->clean($_POST['password']));
            if ($user = $userModel->Where("username = '$login' AND password = '$password'")->get('id')) {
                $_SESSION['id'] = $user;
                header('Content-type: application/json');
                echo json_encode(array(
                    'status' => 'success',
                ));
            } else $this->error("Введенные данные не верные");
            
            
        } else $this->error("Введенные данные не верные");
    }

    public function error($message)
    {
        header('Content-type: application/json');
        echo json_encode(array(
            'status' => 'error',
            'message' => $message
        ));
    }
    
}

?>