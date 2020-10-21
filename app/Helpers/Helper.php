<?php

use App\Setting;

function getConfigValueByConfigKey($configKey)
{
    $config = Setting::where('config_key', $configKey)->first();
    return (!empty($config) ? $config->config_value : null);
}
