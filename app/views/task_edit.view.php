<div class="col-lg-6" style="margin-left: 25%;">
    <form class="form-signin" role="form" action="/task/save/" method="POST">
        <input type="text" class="form-control" name="id" value="<?=!empty($this->params_on_view['task']['id']) ? $this->params_on_view['task']['id'] : "" ?>" style="display: none;">
        <h2 class="form-signin-heading"><?=$this->params_on_view['title']?></h2>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Имя пользователя</label>
                <input type="text" class="form-control" required="" name="name" value="<?= !empty($this->params_on_view['task']['user_name']) ? $this->params_on_view['task']['user_name'] : "" ?>">
                <div class="invalid-feedback">
                    Valid first name is required.
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" class="form-control" required="" name="email" value="<?= !empty($this->params_on_view['task']['email']) ? $this->params_on_view['task']['email'] : ""?>">
            </div>
        </div>
        <div class="mb-3">
            <label>Текст задачи</label>
            <textarea class="form-control" name="text" required=""><?=!empty($this->params_on_view['task']['text'])  ? $this->params_on_view['task']['text'] : "" ?></textarea>
        </div>
        <?php if(!empty($this->params_on_view['task']['id'])){ ?>
        <div class="mb-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="complete" name="complete" <?php if(!empty($this->params_on_view['task']['complete'])
                && $this->params_on_view['task']['complete'] == 1) echo 'checked';?>>
                <label class="custom-control-label" for="complete">Завершено</label>
            </div>
        </div>
        <?php } ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Отправить</button>
    </form>
</div>