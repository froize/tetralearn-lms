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
                                <h2><?='Register to take part in chat'?></h2>
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
                                        <caption><h3><?='Current user'?></h3></caption>
                                        <thead>
                                        <tr class="success">
                                            <th style="width:10%"><?='Icon'?></th>
                                            <th style="width:20%"><?='Username'?></th>
                                            <th><?='Message'?></th>
                                            <th style="width:20%"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <img src="<?= $user->chaticon ?>" width="50px" />
                                            </td>
                                            <td>
                                                <?= $user->chatname ?>
                                            </td>
                                            <td>
                                                <textarea id="chat-message" class="form-control" aria-invalid="false"></textarea>
                                            </td>
                                            <td>
                                                <img id="ajax-loader" src="<?php // $assets->baseUrl.'/images/loader.gif' ?>" style="display:none" />
                                                <button type="submit" id="send-message" class="btn btn-success" data-id="<?= $user->id ?>" data-name="<?= $user->chatname ?>" data-icon="<?= $user->chaticon ?>" >
                                                    <?='Send message'?>
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
function reloadchat(button,sendMessage) {
    if (sendMessage)
        $('#ajax-loader').show();
    $.ajax({
        url: '/admin/chat/send-message?dialog_id=',
        type: "POST",
        data: {
            'sendMessage':sendMessage,
            'Chat[user_id]': $(button).data('id'),
            'Chat[name]': $(button).data('name'),
            'Chat[icon]': $(button).data('icon'),
            'Chat[message]': $('#chat-message').val(),
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
$('#send-message').click(function(){
    reloadchat(this,true);
});
setInterval(function () { reloadchat(null,false); }, 5000 );
SCRIPT;
$this->registerJs($script,$this::POS_READY);
?>
