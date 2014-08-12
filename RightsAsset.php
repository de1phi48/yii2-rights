<?php
/**
 * yii2-rights module
 * 
 * (c) de1phi <https://github.com/de1phi48>
 * 
 */

namespace de1phi\rights;

use yii\web\AssetBundle;

/**
 * This declares the asset files required by yii2-rights.
 *
 * @author Andrey Bocharnikov <de1phi@live.ru>
 */
class RightsAsset extends AssetBundle
{
    /**
     * @inheritdoc
     */
    public $sourcePath = '@de1phi/rights/assets';
    /**
     * @inheritdoc
     */
    public $css = [
        'css/rights.css',
    ];
}
