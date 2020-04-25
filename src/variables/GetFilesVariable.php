<?php
/**
 * GetFiles plugin for Craft CMS 3.1
 *
 * Retrieve a list of files based on a specified folder path.
 *
 * @author    You & Me Digital
 * @link      https://github.com/youandmedigital/craft-getfiles
 * @copyright Copyright (c) 2019 You & Me Digital
 */

namespace youandmedigital\getfiles\variables;

use youandmedigital\getfiles\GetFiles;
use Craft;

class GetFilesVariable
{

    public function config($settings = null)
    {
        return GetFiles::$plugin->getFilesService->list($settings);
    }

}
