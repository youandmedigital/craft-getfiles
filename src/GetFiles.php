<?php
/**
 * GetFiles plugin for Craft CMS 3.x
 *
 * This Craft 3 plugin retrieves a list of files based on a specified folder path
 *
 * @author    You & Me Digital
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
    public $schemaVersion = '0.0.2';

    public function init()
    {
        parent::init();
        self::$plugin = $this;

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function(Event $event) {
                $variable = $event->sender;
                $variable->set('getfiles', GetFilesVariable::class);
            }
        );

    }

}
