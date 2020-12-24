<?php

namespace Olympus\Components\Handler;

use Composer\IO\IOInterface;

/**
 * Gets its own config via composer, inspired from Incenteev ParameterHandler script.
 *
 * @category   PHP
 * @package    Olympus
 * @subpackage Components\Handler\Processor
 * @author     Achraf Chouk <achrafchouk@gmail.com>
 * @license    https://github.com/GetOlympus/Olympus/blob/master/LICENSE MIT
 * @link       https://github.com/GetOlympus/Olympus
 * @see        https://github.com/Incenteev/ParameterHandler
 * @since      0.0.3
 */

class Processor
{
    /**
     * @var string
     */
    private $ext = '.dist';

    /**
     * @var IOInterface
     */
    private $io;

    /**
     * Constructor.
     *
     * @param IOInterface $ioi
     *
     * @since 0.0.3
     */
    public function __construct(IOInterface $ioi)
    {
        $this->io = $ioi;
    }

    /**
     * Starts creating file.
     *
     * @param  string  $realFile
     * @return bool    $exists
     *
     * @since 0.0.3
     */
    private function isExists($realFile)
    {
        // Check file
        $exists = is_file($realFile);
        $action = $exists ? 'Updating' : 'Creating';

        # Write
        $this->io->write(sprintf('<info>%s the "%s" file</info>', $action, $realFile));

        return $exists;
    }

    /**
     * Create `env.php` file.
     *
     * @param  string  $realFile
     *
     * @since 0.0.3
     */
    public function processEnv($realFile)
    {
        // Check if file exists and display headers
        $exists = $this->isExists($realFile);

        // Find the expected params from dist file
        $expectedParams = (array) require_once $realFile.$this->ext;
        $actualValues = [];

        // Update contents
        if ($exists) {
            $existingValues = (array) require_once $realFile;

            // Check validity
            if ($existingValues === null) {
                $existingValues = [];
            }

            // Params must be stored in an array
            if (!is_array($existingValues)) {
                throw new \InvalidArgumentException(sprintf(
                    'The existing "%s" file does not contain an array',
                    $realFile
                ));
            }

            $actualValues = $existingValues;
        }

        // Build Q&A
        $userValues = $this->getParams($expectedParams, $actualValues, $realFile);

        # Write
        $this->io->write(sprintf("<comment>All parameters are defined now in your '%s' file</comment>", $realFile));

        // Merge values
        $actualValues = array_merge_recursive($actualValues, $userValues);

        // Write in file
        $ctn = "<?php\n\n/**\n * This file is auto-generated\n */\n\nreturn ".var_export($actualValues, true).";\n";
        file_put_contents($realFile, $ctn);
    }

    /**
     * Create `salt.php` file.
     *
     * @param  string  $realFile
     *
     * @since 0.0.3
     */
    public function processSalt($realFile)
    {
        // Check if file exists and display headers
        $exists = $this->isExists($realFile);

        // Check file and rebuild it
        if ($exists) {
            unlink($realFile);
        }

        # Write
        $this->io->write(
            "<comment>Get values directly from 'https://api.wordpress.org/secret-key/1.1/salt/'</comment>"
        );

        // Get salt keys
        if (function_exists('curl_init')) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://api.wordpress.org/secret-key/1.1/salt/');
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_AUTOREFERER, true);
            $salt = curl_exec($ch);
            curl_close($ch);

            // Write in file
            $ctn = "<?php\n\n/**\n * This file is auto-generated during the composer install\n */\n\n".$salt."\n";
            file_put_contents($realFile, $ctn);
        } else {
            $this->io->write(
                "<comment>curl module is not installed. Please, install it first or get values manually.</comment>\n"
            );
        }
    }

    /**
     * Create `config.rb` file.
     *
     * @param  string  $realFile
     * @param  bool    $intro
     *
     * @since 0.0.3
     */
    public function processConfig($realFile, $intro = true)
    {
        // Check if file exists and display headers
        $exists = $this->isExists($realFile);

        // Check file and rebuild it
        if ($exists) {
            # Write
            $this->io->write(sprintf(
                "<comment>Your '%s' already exists</comment>",
                $realFile
            ));

            return;
        }

        # Write
        $this->io->write(sprintf(
            "<comment>Your '%s' is copied from '%s'</comment>",
            $realFile,
            $realFile.$this->ext
        ));

        // Get contents, simply
        $contents = file_get_contents($realFile.$this->ext);

        // Write in file
        file_put_contents(
            $realFile,
            ($intro ? "# This file is auto-generated during the composer install\n\n" : '').$contents
        );
    }

    /**
     * Create `robots.txt` file.
     *
     * @param  string  $realFile
     * @param  string  $envFile
     *
     * @since 0.0.8
     */
    public function processRobots($realFile, $envFile)
    {
        // Check if file exists and display headers
        $exists = $this->isExists($realFile);

        // Check file and rebuild it
        if ($exists) {
            # Write
            $this->io->write(sprintf("<comment>Your '%s' already exists</comment>", $realFile));

            return;
        }

        # Write
        $this->io->write(sprintf("<comment>Your '%s' is copied from '%s'</comment>", $realFile, $realFile.$this->ext));

        // Get contents and environments, simply
        $contents = file_get_contents($realFile.$this->ext);
        $env = include_once $envFile;

        // Replace default URL by the configured one
        $contents = str_replace('https://www.domain.tld', $env['wordpress']['home'], $contents);

        // Write in file
        file_put_contents($realFile, "# This file is auto-generated\n\n".$contents);
    }

    /**
     * Get actual params and display Q&A.
     *
     * @param  array   $expectedParams
     * @param  array   $actualValues
     * @param  string  $realFile
     * @return array   $values
     *
     * @since 0.0.3
     */
    private function getParams(array $expectedParams, array $actualValues, $realFile)
    {
        // Simply use the expectedParams value as default for the missing params.
        if (!$this->io->isInteractive()) {
            $ctn = "Interactions are not permitted.\nPlease, edit your \"%s\" file";
            $ctn .= " manually to define properly your parameters.";

            $this->io->write(sprintf(
                "<comment>".$ctn."</comment>\n",
                $realFile
            ));
            return array_replace($expectedParams, $actualValues);
        }

        // Get forgotten keys
        $keys = $this->keyMatch($expectedParams, $actualValues);

        // Iterate on expectedParams and display Q&A
        return $this->treatParams($keys);
    }

    /**
     * Return an array that contains keys do not match between $array and $compare.
     *
     * @param  array   $array
     * @param  array   $compare
     * @return array   $diffs
     *
     * @since 0.0.4
     */
    private function keyMatch(array $array, array $compare)
    {
        $diffs = [];

        foreach ($array as $k => $value) {
            if (!array_key_exists($k, $compare)) {
                $diffs[$k] = $value;
                continue;
            }

            if (is_array($value)) {
                $diff = $this->keyMatch($value, $compare[$k]);

                if (count($diff)) {
                    $diffs[$k] = $diff;
                }
            }
        }

        return $diffs;
    }

    /**
     * Treat params and display Q&A.
     *
     * @param  array   $expectedKeys
     * @param  bool    $isStarted
     * @param  string  $prefix
     *
     * @since 0.0.3
     */
    private function treatParams(array $expectedKeys, $isStarted = false, $prefix = '')
    {
        $params = [];

        // Iterate on expected keys
        foreach ($expectedKeys as $key => $message) {
            if (is_array($message)) {
                $params[$key] = $this->treatParams($message, $isStarted, $key);
                continue;
            }

            // Display a first message before treating params
            if (!$isStarted) {
                $isStarted = true;

                # Write
                $this->io->write("\n<comment>Some parameters are missing. Please provide them.</comment>");
            }

            // Update message
            $message = $this->updateMessage($key, $message, $params);

            // Display prefix when its needed, treat special boolean case
            $p = !empty($prefix) ? $prefix.' ' : '';
            $m = is_bool($message) && !$message ? '0' : $message;

            # Read
            $value = $this->io->ask(sprintf(
                "<question>%s%s</question> (<comment>%s</comment>): ",
                $p,
                $key,
                $m
            ), $message);

            $value = is_bool($message) ? (boolean) $value : $value;
            $value = is_int($message) ? (int) $value : $value;

            // Update params
            $params = $this->updateParams($params, $key, $value);
        }

        return $params;
    }

    /**
     * Update message.
     *
     * @param  string  $key
     * @param  integer $message
     * @param  array   $params
     * @return integer $message
     *
     * @since 0.0.25
     */
    private function updateMessage($key, $message, $params)
    {
        if ('https' !== $key) {
            return $message;
        }

        $url = parse_url($params['wordpress']['home']);
        $message = 'https' === $url['scheme'] ? true : $message;
    }

    /**
     * Update params key's value.
     *
     * @param  array   $params
     * @param  string  $key
     * @param  string  $value
     * @return string  $value
     *
     * @since 0.0.25
     */
    private function updateParams($params, $key, $value)
    {
        $params[$key] = $value;

        // Home case
        if ('home' === $key && $value) {
            $url = parse_url($value);
            $params[$key] = isset($url['scheme']) ? $value : 'https://'.preg_replace('{^\/\/}', '', $value);

            return $params;
        }

        // Debug case
        if ('debug' === $key && $value) {
            $params[$key] = $this->treatParams([
                'savequeries' => true,
                'script_debug' => true,
                'wp_debug_display' => true,
                'wp_debug' => true,
            ], false, $key);

            return $params;
        }

        return $params;
    }
}
