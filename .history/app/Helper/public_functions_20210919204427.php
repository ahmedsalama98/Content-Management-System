<?php

use Spatie\Valuestore\Valuestore;


function getSettings($key){


    $settings = Valuestore::make(config_path('settings.json'));
}

