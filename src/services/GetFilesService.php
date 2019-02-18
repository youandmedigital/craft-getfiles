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

namespace youandmedigital\getfiles\services;

use youandmedigital\getfiles\GetFiles;
use Symfony\Component\Finder\Finder;

use Craft;
use craft\base\Component;

/**
 * GetFilesService Service
 *
 * @author    You & Me Digital
 * @package   GetFiles
 * @since     0.0.2
 */
class GetFilesService extends Component
{

    public function list($settings): array
    {
        // get and set settings array
        $filePath = isset($settings['filepath']) ? $settings['filepath'] : '';
        $filePattern = isset($settings['pattern']) ? $settings['pattern'] : '*';
        $filePathFormat = isset($settings['pathformat']) ? $settings['pathformat'] : '2';

        // if filePath is not empty...
        if ($filePath !== '') {

            // get full base path
            $fullPath = \Yii::getAlias(GetFiles::getInstance()->getSettings()->publicRoot ?? '@webroot');

            // set default value of output to prevent errors
            $output[] = '';

            // process options...
            $path = $fullPath . $filePath;
            $pattern = $filePattern;

            // start new finder instance
            $finder = new Finder();

            // filter results based on some options
            // https://symfony.com/doc/current/components/finder.html
            $finder
                ->files()
                ->in($path)
                ->name($filePattern)
                ->depth('== 0');

            $finder->sortByName();

            // display filenames only...
            if ($filePathFormat == '1') {
                // for each result, set output to filename
                foreach ($finder as $file) {
                    $asset[] = $file->getFileName();
                }

            }

            // display filenames prefixed with base path...
            if ($filePathFormat == '2') {
                // for each result, set output to filename
                foreach ($finder as $file) {
                    $asset[] = $filePath . $file->getFileName();
                }

            }

            // remove empty array results
            $output = array_filter($asset);

            // output array
            return $output;

        }

        // otherwise return nothing
        return [];

    }

}
