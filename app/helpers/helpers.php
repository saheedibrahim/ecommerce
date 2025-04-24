<?php

use App\Models\Category;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\GeneralSetting;
use App\Models\SocialNetwork;

// SEND EMAIL FUNCTION USING PHPMAILER LIBRARY

IF(!function_exists('sendEMail')){
    function sendEmail($mailConfig){
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $email = new PHPMailer(true);
        $email->SMTPDebug = 0;
        $email->isSMTP();
        $email->Host = env('EMAIL_HOST');
        $email->SMTPAuth = true;
        $email->Username = env('EMAIL_USERNAME');
        $email->Password = env('EMAIL_PASSWORD');
        $email->SMTPSecure = env('EMAIL_ENCRYPTION');
        $email->Port = env('EMAIL_PORT');
        $email->setFrom($mailConfig['mail_from_email'], $mailConfig['mail_from_name']);
        $email->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $email->isHTML(true);
        $email->Subject = $mailConfig['mail_subject'];
        $email->Body = $mailConfig['mail_body'];
        if ($email->send()) {
            return true;
        } else {
            return false;
        }
    }
}

/** Get General Settings */
if (!function_exists('get_settings')) {
    function get_settings(){
        $results = null;
        $settings = new GeneralSetting();
        $settings_data = $settings->first();

        if ($settings_data) {
            $results = $settings_data;
        } else {
            $settings->insert([
                'site_name'=>'saidbyte',
                'site_email' => 'info@saidbyte.com'
            ]);
            $new_settings_data = $settings->first();
            $results = $new_settings_data;
        }
        return $results;
    }
}

/** Get Social Networks */
if (!function_exists('get_social_network')) {
    function get_social_network(){
        $results = null;
        $social_network = new SocialNetwork();
        $social_network_data = $social_network->first();

        if ($social_network_data) {
            $results = $social_network_data;
        } else {
            $social_network->insert([
                'facebook_url' => null,
                'twitter_url' => null,
                'instagram_url' => null,
                'youtube_url' => null,
                'github_url' => null,
                'linkedin_url' => null,
            ]);
            $new_social_network_data = $social_network->first();
            $results = $new_social_network_data;
        }
        return $results;
    }
}

//FRONTEND::
/** GET FRONTEND CATEGORIES */
if (!function_exists('get_categories')) {
    function get_categories(){
        $categories = Category::with('subcategories')->orderBy('ordering', 'asc')->get();
        return !empty($categories) ? $categories : [];
    }
}