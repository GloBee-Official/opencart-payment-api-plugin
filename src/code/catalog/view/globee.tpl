<?php if (isset($testnet)) : ?>
    <div class="alert alert-warning"><i class="fa fa-exclamation-triangle"></i> <?= $warning_testnet; ?></div>
<?php endif; ?>
<?php if (isset($error_globee)) : ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> <?= $error_globee; ?></div>
<?php endif; ?>
<div class="buttons">
    <div class="pull-right">
        <a class="btn btn-primary" href="<?= $url_redirect; ?>"><?= $button_confirm; ?></a>
    </div>
</div>
