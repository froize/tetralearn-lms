<div class="table-responsive"> 
<table class="table table table-striped table-bordered table-hover table-condensed">
    <caption><h3><?='Chat'?></h3></caption>
    <thead>
        <tr class="success">
           <th style="width:20%"><?='Time'?></th>
           <th style="width:10%"><?='Icon'?></th>
           <th style="width:20%"><?='Username'?></th>
           <th><?='Message'?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($messages as $message) : ?>
        <tr>
            <td><?= $message['rfc822'] ?></td>
            <td>
                <img src="<?= $message['icon'] ?>" width="50px" />
            </td>
            <td><?= $message['name'] ?></td>
            <td><?= $message['message'] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
</div>
