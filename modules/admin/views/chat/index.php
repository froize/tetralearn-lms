<?php
use app\modules\admin\ChatAsset;
$assets = ChatAsset::register($this);
$this->title = 'Чат';
$this->params['breadcrumbs'][] = $this->title;
?>
                <div class="chat-default-index content">
                    <div class="row">
                        <div id="chat-box" class="col-sm-12">
                            <?= $this->render('_table',compact('messages')) ?>
                        </div>
                        <?php if (Yii::$app->user->isGuest) :?>
                            <div id="chat-box" class="col-sm-12">
                                <h2><?= Yii::t('chat','Register to take part in chat') ?></h2>
                            </div>
                        <?php else :?>
                        <div class="col-sm-12">
                           <h2>Диалоги</h2>
                            <hr/><?=debug($dialogs)?><br/><hr/><h2>Сообщения из диалогов</h2><?=debug($dialogs_messages)?>
                        </div>
                            <?php if($dialog_id != 0) :?>
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table table table-striped table-bordered table-hover table-condensed">
                                        <caption><h3><?= Yii::t('chat','Current user') ?></h3></caption>
                                        <thead>
                                        <tr class="success">
                                            <th style="width:10%"><?= Yii::t('chat','Icon') ?></th>
                                            <th style="width:20%"><?= Yii::t('chat','Username') ?></th>
                                            <th><?= Yii::t('chat','Message') ?></th>
                                            <th style="width:20%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="<?= $user->avatar ?>" width="50px" />
                                            </td>
                                            <td>
                                                <?= $user->name ?>
                                            </td>
                                            <td>
                                                <textarea id="chat-message" class="form-control" aria-invalid="false"></textarea>
                                            </td>
                                            <td>
                                                <img id="ajax-loader" src="<?php // $assets->baseUrl.'/images/loader.gif' ?>" style="display:none" />
                                                <button type="submit" id="send-message" class="btn btn-success" data-dialog-id="<?=$dialog_id?>" data-id="<?= $user->id ?>" data-icon="<?= $user->avatar ?>" >
                                                    <?= Yii::t('chat','Send message') ?>
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>

<?php
$script=<<<SCRIPT
$('#send-message').click(function(){
    reloadchat(this,true);
});
setInterval(function () { reloadchat(null,false); }, 5000 );
function reloadchat(button,sendMessage) {
    if (sendMessage)
        $('#ajax-loader').show();

    $.ajax({
        url: '/admin/chat/send-message?dialog_id=$dialog_id',
        type: "POST",
        data: {
            sendMessage:sendMessage,
            dialog_id: $(button).data('dialog-id'),
            user_id: $(button).data('id'),
            icon: $(button).data('icon'),
            message: $('#chat-message').val(),
             _csrf: yii.getCsrfToken(),
        },
        success: function (html) {
            if (sendMessage)
            {
                $('#ajax-loader').hide();
                $('#chat-message').val('')
            }
            $("#chat-box").html(html);
        }
    });
}

SCRIPT;
$this->registerJs($script,$this::POS_READY);
?>
