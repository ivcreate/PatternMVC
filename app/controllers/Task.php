<?php
class Task extends CoreController{

    private $sort;

    public function index()
    {
        $this->lists();
    }

    public function lists()
    {
        $pag = $this->getPagination();
        $user = new UsersModel();
        $task = new TasksModel();
        $this->params_on_view['alert'] = !empty($_GET['alert']) ? $_GET['alert'] : "";
        $this->params_on_view['login'] = $user->checkCookie();
        $this->params_on_view['pag'] = $pag;
        $this->params_on_view['get_array'] = $_GET;
        $this->params_on_view['tasks'] = $task->getList($pag,$this->getSortString());
        $this->getView('tasks');
    }

    public function create()
    {
        $this->params_on_view['title'] = "Добавление задачи";
        $this->getView('task_edit');
    }

    public function edit($data)
    {
        $user = new UsersModel();
        if(!$user->checkCookie())
            return $this->redirectOn("?alert=error");
        $data = json_decode($data);
        if(!empty($data[0]))
        {
            $id = $data[0]*1;
            $task = new TasksModel();
            $record = $task->getTaskById($id);
            if(!empty($record))
            {
                $this->params_on_view['title'] = "Редактирование задачи";
                $this->params_on_view['task'] = $record;
                $this->getView('task_edit');
            } else
                return $this->error();
        }else
            return $this->error();
    }

    public function save()
    {
        $task = new TasksModel();
        $complete = !empty($_POST['complete']) ? 1 : 0;
        $flag_edit = 0;
        $row = $task->getTaskById($_POST['id']);
        if(!empty($row)) {
            $user = new UsersModel();
            if(!$user->checkCookie())
                return $this->redirectOn("?alert=error");
            if($row['text'] != $_POST['text'])
                $flag_edit = 1;
            $task->change($_POST['id'], $_POST['name'], $_POST['email'], $_POST['text'], $complete, $flag_edit);
        }else
            $task->add($_POST['name'], $_POST['email'], $_POST['text']);

        $this->redirectOn("?alert=success");
    }

    private function getPagination()
    {
        $pag['record_on_page'] = 3;
        $pag['page'] = !empty($_GET['pag']) ? $_GET['pag'] : 1;
        $task = new TasksModel();
        $pag['total_page'] = intval(($task->getCountTask() - 1) / $pag['record_on_page']) + 1;
        if($pag['page'] > $pag['total_page'])
            $pag['page'] = $pag['total_page'];
        $pag['start_record'] = $pag['page'] * $pag['record_on_page'] - $pag['record_on_page'];
        $pag['added_uri'] = $this->getAddUriStringForSort();
        return $pag;
    }

    private function getAddUriStringForSort()
    {
        $column = !empty($_GET['column']) ? '&column='.$_GET['column'] : '';
        $type = !empty($_GET['type']) ? '&type=asc' : '';
        return $column.$type;
    }

    private function getSortString()
    {
        $column = !empty($_GET['column']) ? $_GET['column'] : 'id';
        $type = !empty($_GET['type']) ? 'ASC' : 'DESC';
        return "ORDER BY {$column} {$type}";
    }

}
