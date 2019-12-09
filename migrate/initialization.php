<?php
namespace PoP\Media;

class Initialization
{
    public function initialize()
    {
        \load_plugin_textdomain('pop-media', false, dirname(\plugin_basename(__FILE__)).'/languages');

        /**
         * Load the Contracts
         */
        include_once 'contracts/load.php';

        /**
         * Load the Plugins Library
         */
        include_once 'plugins/load.php';
    }
}
