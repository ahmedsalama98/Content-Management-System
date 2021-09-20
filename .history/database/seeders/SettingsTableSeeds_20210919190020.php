<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsTableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data =[];


        $data[]= ['display_name'=>'App Title',
        'key'=>'app_title', 
        'value'=>'My Blog',
        'type'=>'text',
        'section'=>'genral',
        'ordering'=>1,];

        $data[]= ['display_name'=>'App Slogan','key'=>'app_slogan', 'value'=>'Amazzing App','type'=>'text','section'=>'genral','ordering'=>2,];
        $data[]= ['display_name'=>'App Descripion','key'=>'app_descripion', 'value'=>'Content Management System','type'=>'text','section'=>'genral','ordering'=>3,];
        $data[]= ['display_name'=>'App keywords','key'=>'app_keywords', 'value'=>'blog , post , author , content ','type'=>'text','section'=>'genral','ordering'=>4,];
        $data[]= ['display_name'=>'App status','key'=>'app_status', 'value'=>'active','type'=>'text','section'=>'genral','ordering'=>5,];
        $data[]= ['display_name'=>'App email','key'=>'app_email', 'value'=>'ahmed.test.div@gmail.com','type'=>'text','section'=>'genral','ordering'=>6,];
        $data[]= ['display_name'=>'App email Password','key'=>'app_email_password', 'value'=>'div88888888','type'=>'text','section'=>'genral','ordering'=>7,];
        $data[]= ['display_name'=>'Phone Number','key'=>'phone_number', 'value'=>'201020304050','type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>'Address','key'=>'address', 'value'=>'25 talaat harb , cairo , Egypt','type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>'Map latitude','key'=>'map_latitude', 'value'=>'26.666674','type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>'Map longitude','key'=>'map_longitude', 'value'=>'36.666674','type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Google Maps API Key','key'=>'google_maps_api_key', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Google Analytics Clint Id','key'=>'google_analytics_clint_id', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Google Recaptcha API Key','key'=>'google_recaptcha_api_key', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Facebook Id','key'=>'facebook_id', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Instagram Id','key'=>'instagram_id', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Twitter Id','key'=>'twitter_id', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Patreon Id','key'=>'patreon_id', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];
        $data[]= ['display_name'=>' Youtube Id','key'=>'youtube_id', 'value'=>null ,'type'=>'text','section'=>'genral','ordering'=>8,];

        Setting::insert( $data);
    }
}
