<?php

namespace Plugin\Base;
class Deactivate
{

    function __construct($file)
    {
        register_deactivation_hook($file, [$this, 'deactivate']);
    }


    function deactivate(): void
    {
        flush_rewrite_rules();

    }
}
