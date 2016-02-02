<?php /* @var $this Controller */ ?>
<?php //$this->beginContent($this->viewPath . '/layouts/main'); ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="row">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
</div>
<?php $this->endContent(); ?>