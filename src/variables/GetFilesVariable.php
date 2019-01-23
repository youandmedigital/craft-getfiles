<?php

/**
 * GetFiles plugin for Craft CMS 3.x
 *
 *
 * @link      https://github.com/youandmedigital/craft-getfiles
 * @copyright Copyright (c) 2019 You & Me Digital
 */

namespace youandmedigital\getfiles\variables;
use youandmedigital\getfiles\GetFiles;
use Symfony\Component\Finder\Finder;
class GetFilesVariable
{
    /**
     * Main GetFiles template variable.
     *
     * @param string $filePath
     * @param string $filePattern
     * @param string $filePathFormat
     *
     * @return array
     */

    public function options($filePath, $filePattern = '*', $filePathFormat = '1'): array
    {
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
