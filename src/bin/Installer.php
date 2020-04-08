<?php
/**
 * Part of CodeIgniter Composer Installer
 *
 * @author     Arif RH <https://bitbucket.org/arif-rh>
 * @license    MIT License
 * @copyright  2015 Arif RH
 * @link       https://bitbucket.org/arif-rh/ci3-installer
 */

namespace Arifrh\Packages\Bin;

use Composer\Script\Event;

class Installer
{
    /**
     * Composer post install script
     *
     * @param Event $event
     */
    public static function postInstall(Event $event = null)
    {
        copy('src/bin/.gitattributes', './.gitattributes');
        copy('src/bin/.gitignore', './.gitignore');
        copy('src/bin/LICENSE', './LICENSE');
        copy('src/bin/phpunit.xml.dist', './phpunit.xml.dist');
        copy('src/bin/README.md', './README.md');

        // Show message
        self::showMessage($event);

        // Delete unneeded files
        self::deleteSelf();
    }

    private static function composerUpdate()
    {
        passthru('composer update');
    }

    /**
     * Composer post install script
     *
     * @param Event $event
     */
    private static function showMessage(Event $event = null)
    {
        $io = $event->getIO();
        $io->write('==================================================');
        $io->write(
            '<info>Composer Package Starter is Ready!</info>'
        );
        $io->write('==================================================');
    }

    private static function deleteSelf()
    {
        self::recursiveRemoveDir('src/bin');
    }

    private static function recursiveRemoveDir($dir) 
    {
        if (is_dir($dir)) { 
          $objects = scandir($dir); 
          foreach ($objects as $object) { 
            if ($object != "." && $object != "..") { 
              if (is_dir($dir."/".$object))
              {
                self::recursiveRemoveDir($dir."/".$object);
              }
              else
              {
                unlink($dir."/".$object); 
              }
            } 
          }
          rmdir($dir); 
        } 
    }

    /**
     * Recursive Copy
     *
     * @param string $src
     * @param string $dst
     */
    private static function recursiveCopy($src, $dst)
    {
        mkdir($dst, 0755);
        
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($src, \RecursiveDirectoryIterator::SKIP_DOTS),
            \RecursiveIteratorIterator::SELF_FIRST
        );
        
        foreach ($iterator as $file) {
            if ($file->isDir()) {
                mkdir($dst . '/' . $iterator->getSubPathName());
            } else {
                copy($file, $dst . '/' . $iterator->getSubPathName());
            }
        }
    }
}
