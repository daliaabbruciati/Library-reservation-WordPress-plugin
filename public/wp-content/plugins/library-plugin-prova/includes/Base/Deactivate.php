<?php

function deactivate(): void
{
    flush_rewrite_rules();

}