<?php
use Symfony\Component\Yaml\Yaml;
$domainUrl = trim(env('HTTP_HOST'), '/');
    // If scheme not included, prepend it
    if (!preg_match('#^http(s)?://#', $domainUrl)) {
        $domainUrl = 'http://' . $domainUrl;
    }
    $urlParts = parse_url($domainUrl);
    $domain = preg_replace('/^www\./', '', $urlParts['host']);
    if (file_exists(ROOT . DS . 'site_config' . DS . $domain .'.yml')) {
        $settings = Yaml::parse(file_get_contents(ROOT . DS . 'site_config' . DS . $domain .'.yml'));
    }else if(file_exists(ROOT . DS . 'site_config' . DS . 'settings.yml')){
        $settings = Yaml::parse(file_get_contents(ROOT . DS . 'site_config' . DS . 'settings.yml'));
    }

    $settings['domainUrl']	= $domain;

return [
'Setting' => $settings
];
