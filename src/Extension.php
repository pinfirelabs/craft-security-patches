<?php
/**
 * @link https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license MIT
 */

namespace craft\sp;

use Craft;
use craft\controllers\AssetsController;
use yii\base\ActionEvent;
use yii\base\BootstrapInterface;
use yii\base\Event;
use yii\web\BadRequestHttpException;

/**
 * Generator Yii2 Extension
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 */
class Extension implements BootstrapInterface
{
    public function bootstrap($app)
    {
        // GHSA-f3gw-9ww9-jmc3
        Event::on(AssetsController::class, AssetsController::EVENT_BEFORE_ACTION, function(ActionEvent $event) {
            if ($event->action->id === 'generate-transform') {
                $handle = Craft::$app->request->getBodyParam('handle');
                if ($handle && !is_string($handle)) {
                    throw new BadRequestHttpException('Invalid transform handle.');
                }
            }
        });
    }
}
