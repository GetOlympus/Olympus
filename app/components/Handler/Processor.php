<?php

namespace Olympus\Handler;

use Composer\IO\IOInterface;

/**
 * Gets its own config via composer, inspired from Incenteev ParameterHandler script.
 * @see https://github.com/Incenteev/ParameterHandler
 *
 * @package Olympus
 * @subpackage Handler\Processor
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.3
 *
 */

class Processor
{
    /**
     * @var IOInterface
     */
    private $io;

    /**
     * Constructor.
     *
     * @param IOInterface $io
     *
     * @since 0.0.3
     */
    public function __construct(IOInterface $io)
    {
        $this->io = $io;

        // Update XDebug warning
        putenv("COMPOSER_DISABLE_XDEBUG_WARN=1");
        $_ENV['COMPOSER_DISABLE_XDEBUG_WARN'] = '1';
        $_SERVER['COMPOSER_DISABLE_XDEBUG_WARN'] = '1';

        // Remove composer no interaction
        putenv("COMPOSER_NO_INTERACTION");
        unset($_ENV['COMPOSER_NO_INTERACTION'], $_SERVER['COMPOSER_NO_INTERACTION']);
    }

    /**
     * Starts creating file.
     *
     * @param string $realFile
     *
     * @since 0.0.3
     */
    private function _start($realFile)
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
     * @param string $realFile
     *
     * @since 0.0.3
     */
    public function processEnv($realFile)
    {
        // Check if file exists and display headers
        $exists = $this->_start($realFile);

        // Find the expected params from dist file
        $expectedParams = (array) require_once $realFile.'.dist';
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
                throw new \InvalidArgumentException(sprintf('The existing "%s" file does not contain an array', $realFile));
            }

            $actualValues = $existingValues;
        }

        // Build Q&A
        $userValues = $this->getParams($expectedParams, $actualValues);

        # Write
        $this->io->write(sprintf("<comment>All parameters are defined now in your '%s' file</comment>", $realFile));

        // Merge values
        $actualValues = array_merge_recursive($actualValues, $userValues);

        // Write in file
        file_put_contents($realFile, "<?php\n\n// This file is auto-generated during the composer install\n\nreturn ".var_export($actualValues, true).";\n");
    }

    /**
     * Create `salt.php` file.
     *
     * @param string $realFile
     *
     * @since 0.0.3
     */
    public function processSalt($realFile)
    {
        // Check if file exists and display headers
        $exists = $this->_start($realFile);

        // Check file and rebuild it
        if ($exists) {
            unlink($realFile);
        }

        # Write
        $this->io->write("<comment>Get values directly from 'http://api.wordpress.org/secret-key/1.1/salt/'</comment>");

        // Get salt keys
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.wordpress.org/secret-key/1.1/salt/');
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        $salt = curl_exec($ch);
        curl_close($ch);

        // Write in file
        file_put_contents($realFile, "<?php\n\n// This file is auto-generated during the composer install\n\n".$salt."\n");
    }

    /**
     * Create `config.rb` file.
     *
     * @param string $realFile
     *
     * @since 0.0.3
     */
    public function processConfig($realFile)
    {
        // Check if file exists and display headers
        $exists = $this->_start($realFile);

        // Check file and rebuild it
        if ($exists) {
            # Write
            $this->io->write(sprintf("<comment>Your '%s' already exists</comment>", $realFile));

            return;
        }

        # Write
        $this->io->write(sprintf("<comment>Your '%s' is copied from '%s'</comment>", $realFile, $realFile.'.dist'));

        // Get contents, simply
        $contents = file_get_contents($realFile.'.dist');

        // Write in file
        file_put_contents($realFile, "# This file is auto-generated during the composer install\n\n" . $contents);
    }

    /**
     * Get actual params and display Q&A.
     *
     * @param array $expectedParams
     * @param array $actualValues
     *
     * @since 0.0.3
     */
    private function getParams(array $expectedParams, array $actualValues)
    {
        // Simply use the expectedParams value as default for the missing params.
        if (!$this->io->isInteractive()) {
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
     * @param array $array
     * @param array $compare
     * @return array $diffs
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
     * @param array $expectedKeys
     * @param boolean $isStarted
     * @param string $prefix
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
            }
            else {
                // Display a first message before treating params
                if (!$isStarted) {
                    $isStarted = true;

                    # Write
                    $this->io->write("\n<comment>Some parameters are missing. Please provide them.</comment>");
                }

                // Display prefix when its needed, treat special boolean case
                $p = !empty($prefix) ? $prefix.' ' : '';
                $m = is_bool($message) && !$message ? '0' : $message;

                # Read
                $value = $this->io->ask(sprintf("<question>%s%s</question> (<comment>%s</comment>): ", $p, $key, $m), $message);
                $value = is_bool($message) ? (boolean) $value : (is_int($message) ? (int) $value : $value);

                // Special case: 'debug'
                if ('debug' === $key && $value) {
                    $params[$key] = $this->treatParams([
                        'savequeries' => true,
                        'script_debug' => true,
                        'wp_debug_display' => true,
                        'wp_debug' => true,
                    ], false, $key);
                }
                else {
                    $params[$key] = $value;
                }
            }
        }

        return $params;
    }
}
