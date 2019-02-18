<?php
/**
 * GetFiles plugin for Craft CMS 3.x
 *
 *
 * @link      https://github.com/youandmedigital/craft-getfiles
 * @copyright Copyright (c) 2019 You & Me Digital
 */

namespace youandmedigital\getfiles;

use craft\base\Plugin;
use youandmedigital\getfiles\variables\GetFilesVariable;
use craft\web\twig\variables\CraftVariable;

use yii\base\Event;


class GetFiles extends Plugin
{

    public static $plugin;

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(CraftVariable::class, CraftVariable::EVENT_INIT, function(Event $event) {
            /** @var CraftVariable $variable */
            $variable = $event->sender;
            $variable->set('getfiles', GetFilesVariable::class);
        });
    }

}
