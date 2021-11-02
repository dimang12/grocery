<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $currentDate = new DateTime();
        $availableAt = new DateTime('2021-07-11');
        DB::table('products')->insert([
            [
                "product_name" => "Beemster Royaal Grand Cru Gouda",
                "slug" => "beemster-royaal-grand-cru-gouda",
                "details" => "An excellent addition to your holiday cheese-board; melts well for sandwiches; pairs well with India Pale Ales, and full-bodied reds",
                "profile" => "Rich ochre color; bold, savory, earthy aroma; firm texture with a rich, nutty flavor and creamy finish",
                "category_id" => 4,
                "size" => "varies; most pieces will be between 7-8oz",
                "price" => 10.99,
                "views" => 0,
                "interested" => 0,
                "available_at" => $availableAt->format('Y-m-d'),
                "created_at" => $currentDate->format('Y-m-d H:m:s'),
                "updated_at" => $currentDate->format('Y-m-d H:m:s'),
            ],
            [
                "product_name" => "Gran Capitan Reserva",
                "slug" => "gran-capitan-reserva",
                "details" => "serve sliced as part of a cheese board or hors d’oeuvres plate; pairs well with nuts, dried fruit, and crusty bread; serve alongside a glass of La Sonriente [sku 53692] or other fruity red wine",
                "profile" => "Ripe, full-flavored, well-aged cheese made from sheep and cow’s milk; semi-firm and crumbly in texture, with a deep, nutty, slightly sweet flavor profile ",
                "category_id" => 4,
                "size" => "Random-weight pieces",
                "price" => 13.99,
                "views" => 0,
                "interested" => 0,
                "available_at" => $availableAt->format('Y-m-d'),
                "created_at" => $currentDate->format('Y-m-d H:m:s'),
                "updated_at" => $currentDate->format('Y-m-d H:m:s'),
            ],
            [
                "product_name" => "Mushroom & Truffle Flavored Pesto",
                "slug" => "mushroom-and-truffle-flavored-pesto",
                "details" => " keep refrigerated; add flavor to your burger or pizza; mix into mashed potatoes or risotto; fold into room temp butter, then roll into a log, and chill; spread it on sandwiches or wraps; toss with pasta, like Quite Possibly the World’s Largest Fusilli [sku 71878]; smear a spoonful atop Brie en Croute [sku 95656] for a cracker-friendly appetizer",
                "profile" => "mushroom-based pesto with intense, umami flavor; includes portabella, cremini, and shiitake mushrooms, with romano cheese, and white truffle oil; suspended in an oil blend and seasoned with salt, pepper, and Italian parsley; pine nuts added for crunch",
                "category_id" => 11,
                "size" => "6 oz. package",
                "price" => 4.99,
                "views" => 0,
                "interested" => 0,
                "available_at" => $availableAt->format('Y-m-d'),
                "created_at" => $currentDate->format('Y-m-d H:m:s'),
                "updated_at" => $currentDate->format('Y-m-d H:m:s'),
            ],
            [
                "product_name" => "Organic Dried & Pitted Deglet Noor Dates",
                "slug" => "organic-dried-and-pitted-deglet-nor-dates",
                "details" => "An apt inclusion for charcuterieboards and cheese platters; makes a satisfyingly sweet, anytime snack, or a great pre-workout pick-me-up",
                "profile" => " sweet, slightly firm, dried, pitted Deglet Noor dates; eatch date has a slit from the pit removal process, which can be used to hold cheese, bacon, or other accoutrements ",
                "category_id" => 12,
                "size" => "8 oz. resealable pouch",
                "price" => 2.99,
                "views" => 0,
                "interested" => 0,
                "available_at" => $availableAt->format('Y-m-d'),
                "created_at" => $currentDate->format('Y-m-d H:m:s'),
                "updated_at" => $currentDate->format('Y-m-d H:m:s'),
            ],
        ]);
    }
}
