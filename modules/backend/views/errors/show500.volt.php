
<?= $this->getContent() ?>

<div class="jumbotron">
    <h1>内部错误</h1>
    <p>发生了一些错误,如果您看到这个请联系我们</p>
    <p><?= $this->tag->linkTo(['index/index', '返回首页', 'class' => 'btn btn-primary']) ?></p>
</div>