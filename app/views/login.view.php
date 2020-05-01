<?php if($this->params_on_view['error']){?>
    <div class=" alert alert-danger" role="alert">
        Неправильные реквизиты доступа!
    </div>
<?php } ?>
<div class="col-lg-6" style="margin-left: 25%;">
    <form class="form-signin" role="form" action="/user/authorization/" method="POST">
        <h2 class="form-signin-heading">Вход</h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Имя пользователя</label>
                <input type="text" class="form-control" required="" name="name" value="<?= !empty($this->params_on_view['task']['user_name']) ? $this->params_on_view['task']['user_name'] : "" ?>">
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label>Пароль</label>
                <input type="password" class="form-control" required="" name="password" value="<?= !empty($this->params_on_view['task']['email']) ? $this->params_on_view['task']['email'] : ""?>">
            </div>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Отправить</button>
    </form>
</div>