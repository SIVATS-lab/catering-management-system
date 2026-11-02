<?php

function site_settings_file_path() {
    return __DIR__ . '/site_settings.json';
}

function get_site_settings() {
    $defaults = [
        'site_name' => 'Catering Pro',
        'site_tagline' => 'Professional catering for every celebration',
        'site_logo_url' => '',
        'hero_title' => 'Exceptional Catering for Extraordinary Moments',
        'hero_subtitle' => 'From intimate gatherings to grand celebrations, we craft culinary experiences that create lasting memories.',
        'about_heading' => 'About Catering Pro',
        'about_subtitle' => 'Crafting culinary excellence since 2009',
        'services_heading' => 'Our Services',
        'services_subtitle' => 'Comprehensive catering solutions for every occasion',
        'faq_heading' => 'Frequently Asked Questions',
        'faq_subtitle' => 'Everything you need to know about our catering services',
        'contact_heading' => 'Contact Us',
        'contact_subtitle' => 'Get in touch for your catering needs',
        'contact_phone' => '(555) 123-4567',
        'contact_email' => 'info@cateringpro.com',
        'contact_address' => '123 Culinary Street, Food District, NY 10001',
        'contact_hours' => 'Mon-Fri: 8AM-6PM | Sat-Sun: 9AM-4PM',
        'social_facebook' => '#',
        'social_instagram' => '#',
        'social_twitter' => '#',
        'social_youtube' => '#',
        'admin_brand_name' => 'Catering Admin'
    ];

    $file = site_settings_file_path();
    if (!file_exists($file)) {
        return $defaults;
    }

    $raw = file_get_contents($file);
    $data = json_decode($raw, true);

    if (!is_array($data)) {
        return $defaults;
    }

    return array_merge($defaults, $data);
}

function save_site_settings($data) {
    $defaults = get_site_settings();
    $allowedKeys = array_keys($defaults);
    $filtered = [];
    foreach ($allowedKeys as $key) {
        if (isset($data[$key])) {
            $filtered[$key] = trim($data[$key]);
        } else {
            $filtered[$key] = $defaults[$key];
        }
    }

    $json = json_encode($filtered, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    if ($json === false) {
        return false;
    }

    return (bool) file_put_contents(site_settings_file_path(), $json);
}
