<?php

namespace Database\Seeders;

use DB;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("settings")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        $general = [
            [
                "key" => "name",
                "data" => "khazen",
            ],
            [
                "key" => "description",
                "data" => "website description en",
            ],
            [
                "key" => "keywords",
                "data" => "khazen",
            ],
        ];

        $social = [
            [
                "key" => "facebook",
                "data" => "https://www.facebook.com",
            ],
            [
                "key" => "instagram",
                "data" => "https://www.instagram.com",
            ],
            [
                "key" => "twitter",
                "data" => "https://twitter.com",
            ],
            [
                "key" => "linkedin",
                "data" => "https://www.linkedin.com",
            ],
            [
                "key" => "youtube",
                "data" => "https://www.youtube.com",
            ],
        ];

        $contactUs = [
            [
                "key" => "map_address",
                "data" => "map_address",
            ],
            [
                "key" => "map_lat",
                "data" => "30.0510093",
            ],
            [
                "key" => "map_lng",
                "data" => "31.349499700000024",
            ],
            [
                "key" => "phone",
                "data" => "01122002864",
            ],
            [
                "key" => "email",
                "data" => "support@khazen.com",
            ],
        ];

        $contactUsHeader = [
            [
                "key"  => "contact_us_title",
                "data" => "contact us title",
            ],
            [
                "key"  => "contact_us_description",
                "data" => "contact us description",
            ],
        ];

        $aboutUsHeader = [
            [
                "key"  => "about_us_title",
                "data" => "about us title",
            ],
            [
                "key"  => "about_us_description",
                "data" => "about us description",
            ],
        ];

        $mutli = array_merge(
            $general,
            $aboutUsHeader,
            $contactUsHeader,
        );
        $multi_lang_data = [];
        foreach ($mutli as $item) {
            foreach (AppLanguages() as $lang) {
                $multi_lang_data[] = [
                    "key"  => $item["key"]."_".$lang,
                    "data" => $item["data"],
                ];
            }
        }

        $normal_data = [
            [
                "key"  => "theme",
                "data" => "theme_2",
            ],
        ];
        $normal_data = array_merge(
            $normal_data,
            $contactUs,
            $social,
        );

        $settings = array_merge($multi_lang_data, $normal_data, );
        foreach ($settings as $data) {
            Setting::create($data);
        }
    }
}
