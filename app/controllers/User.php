<?php
class User extends CoreController{

    public function index()
    {
        $this->params_on_view['error'] = !empty($_GET['error']) ? $_GET['error'] : "";
        $this->getView('login');
    }

    public function authorization()
    {
        print_r($_POST);
        $name = $_POST['name'];
        $password = hash('sha256', $_POST['password']);
        $user = new UsersModel();
        if($user->login($name, $password))
            $this->redirectOn();
        else
            $this->redirectOn("/user?error=1");
    }

    public function logout()
    {
        $user = new UsersModel();
        $user->logout();
        $this->redirectOn();
    }
}
