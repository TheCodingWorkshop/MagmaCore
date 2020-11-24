<?php

declare(strict_types=1);

namespace Magma\Yaml;

use Magma\Base\Exception\BaseException;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class YamlConfig
{

    /**
     * Check whether the specified yaml configuration file exists within
     * the specified directory else throw an exception
     *
     * @param string $filename
     * @return boolean
     * @throws BaseException
     */
    private function isFileExists(string $filename)
    {
        if (!file_exists($filename))
            throw new BaseException($filename . ' does not exists');
    }

    /**
     * Load a yaml configuration
     *
     * @param string $yamlFile
     * @return void
     * @throws ParseException
     */
    public function getYaml(string $yamlFile)
    {
        foreach (glob(CONFIG_PATH . DS . '*.yaml') as $file) {
            $this->isFileExists($file);
            $parts = parse_url($file);
            $path = $parts['path'];
            if (strpos($path, $yamlFile) !== false) {
                return Yaml::parseFile($file);
            }
        }
    }

    /**
     * Load a yaml configuration into the yaml parser
     *
     * @param string $yamlFile
     * @return void
     */
    public static function file(string $yamlFile) : array
    {
        return (array)(new YamlConfig)->getYaml($yamlFile);
    }

}