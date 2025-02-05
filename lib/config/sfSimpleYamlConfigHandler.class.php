<?php

/*
 * This file is part of the symfony package.
 * (c) 2004-2006 Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * sfSimpleYamlConfigHandler allows you to load simple configuration files formatted as YAML.
 *
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 *
 * @version    SVN: $Id$
 */
class sfSimpleYamlConfigHandler extends sfYamlConfigHandler
{
    /**
     * Executes this configuration handler.
     *
     * @param array $configFiles An array of absolute filesystem path to a configuration file
     *
     * @return string Data to be written to a cache file
     */
    public function execute($configFiles)
    {
        $config = static::getConfiguration($configFiles);

        // compile data
        $retval = "<?php\n".
                  "// auto-generated by %s\n".
                  "// date: %s\nreturn %s;\n";
        $retval = sprintf($retval, __CLASS__, date('Y/m/d H:i:s'), var_export($config, true));

        return $retval;
    }

    /**
     * @see sfConfigHandler
     * {@inheritdoc}
     */
    public static function getConfiguration(array $configFiles)
    {
        return static::parseYamls($configFiles);
    }
}
