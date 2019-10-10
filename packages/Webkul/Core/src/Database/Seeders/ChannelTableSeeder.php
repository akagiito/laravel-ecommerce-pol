<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ChannelTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('channels')->insert([
                'id' => 1,
                'code' => 'default',
                'name' => 'Default',
                'root_category_id' => 1,
                'home_page_content' => '<p>@include("shop::home.slider") @include("shop::home.featured-products") @include("shop::home.new-products")</p><div class="banner-container"><div class="left-banner"><img src="https://s3-ap-southeast-1.amazonaws.com/cdn.uvdesk.com/website/1/201902045c581f9494b8a1.png" /></div><div class="right-banner"><img src="https://s3-ap-southeast-1.amazonaws.com/cdn.uvdesk.com/website/1/201902045c581fb045cf02.png" /> <img src="https://s3-ap-southeast-1.amazonaws.com/cdn.uvdesk.com/website/1/201902045c581fc352d803.png" /></div></div>',
                'footer_content' => '@include("shop::cms.footer.footer-links") <div class="list-container"><span class="list-heading">Connect With Us</span><ul class="list-group"><li><a href="#"><span class="icon icon-facebook"></span>Facebook </a></li><li><a href="#"><span class="icon icon-twitter"></span> Twitter </a></li><li><a href="#"><span class="icon icon-instagram"></span> Instagram </a></li><li><a href="#"> <span class="icon icon-google-plus"></span>Google+ </a></li><li><a href="#"> <span class="icon icon-linkedin"></span>LinkedIn </a></li></ul></div>',
                'name' => 'Default',
                'default_locale_id' => 1,
                'base_currency_id' => 1
            ]);

        DB::table('channel_currencies')->insert([
                'channel_id' => 1,
                'currency_id' => 1,
            ]);

        DB::table('channel_locales')->insert([
                'channel_id' => 1,
                'locale_id' => 1,
            ]);

        DB::table('channel_inventory_sources')->insert([
                'channel_id' => 1,
                'inventory_source_id' => 1,
            ]);
    }
}