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
 * @since     1.0.0
 */
class GetFilesService extends Component
{

    public function list($settings): array
    {
        // get and set settings array
        $filePath = $settings['path'] ?? '';
        $filePattern = $settings['pattern'] ?? '*';
        $filePathFormat = $settings['pathformat'] ?? '2';

        // if filePath is not empty...
        if ($filePath !== '') {

            // get full base path
            $fullPath = \Yii::getAlias(GetFiles::getInstance()->getSettings()->publicRoot ?? '@webroot');

            // set default value of output to prevent errors
            $output[] = '';
            $asset[] = '';

            // process options...
            $path = $fullPath . $filePath;
            $pattern = $filePattern;

            // start new finder instance
            $finder = new Finder();

            // filter results
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

            // display absolute path
            if ($filePathFormat == '3') {
                // get sites base url
                $baseUrl = Craft::getAlias('@baseUrl');
                // for each result, set output to filename
                foreach ($finder as $file) {
                    $asset[] = $baseUrl . $filePath . $file->getFileName();
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
