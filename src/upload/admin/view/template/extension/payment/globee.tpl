<?= $header; ?><?= $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-globee" data-toggle="tooltip" title="<?= $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?= $url_cancel; ?>" data-toggle="tooltip" title="<?= $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><?= $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?= $breadcrumb['href']; ?>"><?= $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if (isset($error_warning)) { ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?= $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if (isset($success) && ! empty($success)) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?= $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?= $label_edit; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?= $url_action; ?>" method="post" enctype="multipart/form-data" id="form-globee" class="form-horizontal">
                    <input type="hidden" name="action" value="save">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-settings" data-toggle="tab"><?= $tab_settings; ?></a></li>
                        <li><a href="#tab-log" data-toggle="tab"><?= $tab_log; ?></a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-settings">

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-status"><?= $label_enabled; ?></label>
                                <div class="col-sm-10">
                                    <select name="globee_status" id="input-status" class="form-control">
                                        <option value="1" <?php if ($value_enabled == 1) { ?> selected="selected" <?php } ?>><?= $text_enabled; ?></option>
                                        <option value="0" <?php if ($value_enabled == 0) { ?> selected="selected" <?php } ?>><?= $text_disabled; ?></option>
                                    </select>
                                    <?php if (isset($error_enabled)) { ?>
                                    <div class="text-danger"><?= $error_enabled; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-sort-order"><?= $label_sort_order; ?></label>
                                <div class="col-sm-10">
                                    <input type="number" name="globee_sort_order" id="input-sort-order" value="<?= $value_sort_order; ?>" class="form-control" />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-network"><?= $label_network; ?></label>
                                <div class="col-sm-10">
                                    <select name="globee_livenet" id="input-network" class="form-control">
                                        <option value="1" <?php if ($value_livenet == 1) { ?> selected="selected" <?php } ?>><?= $text_livenet; ?></option>
                                        <option value="0" <?php if ($value_livenet == 0) { ?> selected="selected" <?php } ?>><?= $text_testnet; ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-payment-api-key"><?= $label_payment_api_key; ?></label>
                                <div class="col-sm-10">
                                    <input type="text" name="globee_payment_api_key" id="input-payment-api-key" value="<?= $value_payment_api_key; ?>" class="form-control" />
                                    <?php if (isset($error_payment_api_key)) { ?>
                                    <div class="text-danger"><?= $error_payment_api_key; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-risk-speed"><?= $label_risk_speed; ?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-bolt fa-fw"></i></span>
                                        <select name="globee_risk_speed" id="input-risk-speed" class="form-control">
                                            <option value="high" <?php if ($value_risk_speed == "high") { ?> selected="selected" <?php } ?>><?= $text_high; ?></option>
                                            <option value="medium" <?php if ($value_risk_speed == "medium") { ?> selected="selected" <?php } ?>><?= $text_medium; ?></option>
                                            <option value="low" <?php if ($value_risk_speed == "low") { ?> selected="selected" <?php } ?>><?= $text_low; ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= $label_paid_status ?></label>
                                <div class="col-sm-10">
                                    <select name="globee_paid_status" class="form-control">
                                        <?php foreach ($order_statuses as $order_status): ?>
                                        <?php $selected = ($order_status['order_status_id'] == $value_paid_status) ? 'selected' : ''; ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $order_status['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= $label_confirmed_status; ?></label>
                                <div class="col-sm-10">
                                    <select name="globee_confirmed_status" class="form-control">
                                        <?php foreach ($order_statuses as $order_status): ?>
                                        <?php $selected = ($order_status['order_status_id'] == $value_confirmed_status) ? 'selected' : ''; ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $order_status['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label"><?= $label_completed_status; ?></label>
                                <div class="col-sm-10">
                                    <select name="globee_completed_status" class="form-control">
                                        <?php foreach ($order_statuses as $order_status): ?>
                                        <?php $selected = ($order_status['order_status_id'] == $value_completed_status) ? 'selected' : ''; ?>
                                        <option value="<?php echo $order_status['order_status_id']; ?>" <?php echo $selected; ?>>
                                        <?php echo $order_status['name']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-notify-url"><?= $label_notification_url; ?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link fa-fw"></i></span>
                                        <input type="url" name="globee_notification_url" id="input-notify-url" value="<?= $value_notification_url; ?>" class="form-control" />
                                    </div>
                                    <?php if (isset($error_notification_url)) { ?>
                                    <div class="text-danger"><?= $error_notification_url; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-redirect-url"><?= $label_redirect_url; ?></label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-link fa-fw"></i></span>
                                        <input type="url" name="globee_redirect_url" id="input-redirect-url" value="<?= $value_redirect_url; ?>" class="form-control" />
                                    </div>
                                    <?php if (isset($error_redirect_url)) { ?>
                                    <div class="text-danger"><?= $error_redirect_url; ?></div>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label" for="input-debug"><?= $label_debugging; ?></label>
                                <div class="col-sm-10">
                                    <select name="globee_logging" id="input-debugging" class="form-control">
                                        <option value="1" <?php if ($value_debugging == 1) { ?> selected="selected" <?php } ?>><?= $text_enabled; ?></option>
                                        <option value="0" <?php if ($value_debugging == 0) { ?> selected="selected" <?php } ?>><?= $text_disabled; ?></option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane" id="tab-log">
                            <pre><?= $log; ?></pre>
                            <div class="text-right">
                                <a href="<?= $url_clear; ?>" class="btn btn-danger"><i class="fa fa-eraser"></i> <?= $button_clear; ?></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $footer; ?>
