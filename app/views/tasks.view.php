<div class="col-lg-12">
    <h1>Задачи</h1>
</div>
<?php if($this->params_on_view['alert'] == 'success'){ ?>
    <div class="alert alert-success" role="alert">
        Задача успешно сохранена!
    </div>
<?php } ?>
<?php if($this->params_on_view['alert'] == 'error'){ ?>
    <div class="alert alert-danger" role="alert">
        Сохранить невозможно! Вы не авторизованы...
    </div>
<?php } ?>
<div class="col-lg-10" style="float: left;">
    <ul class="nav nav-pills" style="margin-bottom: 5px;">
        <?php $type = !empty($this->params_on_view['get_array']['type']) ? true : false; ?>
        <li class="nav-item">
            <a class="nav-link <?=$this->params_on_view['get_array']['column'] =='user_name' ? 'active' : ''?>"
               href="/task/lists?column=user_name<?=$type ? '' : '&type=asc'?>&pag=<?=$this->params_on_view['pag']['page']?>">
                Имя пользователя
                <?php if(!empty($this->params_on_view['get_array']['column']) && $this->params_on_view['get_array']['column'] == 'user_name') {?>
                    <i class="fa <?= $type ? 'fa-arrow-up' : 'fa-arrow-down'?>" aria-hidden="true"></i>
                <?php } ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=$this->params_on_view['get_array']['column'] =='email' ? 'active' : ''?>"
               href="/task/lists?column=email<?=$type ? '' : '&type=asc'?>&pag=<?=$this->params_on_view['pag']['page']?>">
                email
                <?php if(!empty($this->params_on_view['get_array']['column']) && $this->params_on_view['get_array']['column'] == 'email') {?>
                    <i class="fa <?= $type ? 'fa-arrow-up' : 'fa-arrow-down'?>" aria-hidden="true"></i>
                <?php } ?>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?=$this->params_on_view['get_array']['column'] =='complete' ? 'active' : ''?>"
               href="/task/lists?column=complete<?=$type ? '' : '&type=asc'?>&pag=<?=$this->params_on_view['pag']['page']?>">
                статус
                <?php if(!empty($this->params_on_view['get_array']['column']) && $this->params_on_view['get_array']['column'] == 'complete') {?>
                    <i class="fa <?= $type ? 'fa-arrow-up' : 'fa-arrow-down'?>" aria-hidden="true"></i>
                <?php } ?>
            </a>
        </li>
    </ul>
    <?php if(!empty($this->params_on_view['tasks']))
            foreach ($this->params_on_view['tasks'] as $task){?>
    <div class="card" style="margin-bottom: 5px;">
        <div class="card-body">
            <p class="card-text">имя пользователя: <?=$task['user_name']?></p>
            <p class="card-text">email: <?=$task['email']?></p>
            <p class="card-text">текст задачи: <?=htmlspecialchars($task['text'])?></p>
            <?php if($task['complete'] == 1){?>
                <p class="card-text" style="color: #01c54f;">статус: выполнено</p>
            <?php }else{ ?>
                <p class="card-text">статус: в работе</p>
            <?php }?>
            <?php if($task['edited_text']) {?>
                <p class="card-text">отредактировано администратором</p>
            <?php } ?>
            <?php if($this->params_on_view['login']) {?>
                <a href="/task/edit/<?=$task['id']?>" class="btn btn-primary">Редактировать</a>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
    <?php if($this->params_on_view['pag']['total_page'] > 1){
        $left = "";
        $right = "";
        if($this->params_on_view['pag']['page'] - 1 > 0)
            $left = '<li class="page-item"><a class="page-link" href="/task/lists?pag='.($this->params_on_view['pag']['page']-1).$this->params_on_view['pag']['added_uri'].'">'.
                ($this->params_on_view['pag']['page']-1).
                '</a></li>';
        if($this->params_on_view['pag']['page'] + 1 <= $this->params_on_view['pag']['total_page'])
            $right = '<li class="page-item"><a class="page-link" href="/task/lists?pag='.($this->params_on_view['pag']['page']+1).$this->params_on_view['pag']['added_uri'].'">'.
                ($this->params_on_view['pag']['page']+1).
                '</a></li>';
        $page = '<li class="page-item active"><a class="page-link" href="#">'.($this->params_on_view['pag']['page']).'</a></li>'; ?>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <?php echo $left.'<b>'.$page.'</b>'.$right; ?>
        </ul>
    </nav>
    <?php } ?>
</div>
<div class="col-lg-2" style="float: left;">
    <p><a href="/task/create" class="btn btn-primary">Добавить задачу</a></p>
    <?php if($this->params_on_view['login']){ ?>
        <p><a href="/user/logout" class="btn btn-primary">Выход</a></p>
    <?php }else{ ?>
        <p><a href="/user" class="btn btn-primary">Вход</a></p>
    <?php } ?>
</div>
