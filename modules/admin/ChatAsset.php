<?php

namespace app\modules\admin;

use yii\web\AssetBundle;

/**
 * Module asset bundle
 */
class ChatAsset extends AssetBundle
{
	/**
	 * @inheritdoc
	 */
	public $sourcePath = '@app/modules/admin/assets';

    public $css = [
        'images/images.css'
    ];

} 