<?php

use Faker\Generator as Faker;
use App\User;
use App\Models\Shipment;
use App\Models\Country;
use App\Models\Region;
use App\Models\Distillery;
use App\Models\Tax;
use App\Models\Suggestion;
use App\Models\Product;
use App\Models\Price;
use App\Models\Inventory;
use App\Models\Basket;
use App\Models\BasketStatus;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderStatus;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function(Faker $faker) {
    return [
        'sex' => $faker->randomElement($array = array(0, 1, 2, 9)),
        'name_first' => $faker->firstName,
        'name_second' => $faker->randomElement($array = array('middlename', null)),
        'name_last' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'birthday' => $faker->dateTimeBetween($startDate = '-80 years', $endDate = '-18 years'),
        'phone' => $faker->phoneNumber,
    ];
});

$factory->define(Shipment::class, function (Faker $faker) {
    return [
        'price' => $faker->numberBetween($min = 0, $max = 15),
    ];
});

$factory->define(Country::class, function (Faker $faker) {
    return [
        CreateShipmentsTable::FOREIGN_KEY => Shipment::all()->random()->{CreateShipmentsTable::PRIMARY_KEY},
        'name' => $faker->unique()->country,
        'code' => $faker->unique()->countryISOAlpha3,
    ];
});

$factory->define(Region::class, function (Faker $faker) {
    return [
        CreateCountriesTable::FOREIGN_KEY => Country::all()->random()->{CreateCountriesTable::PRIMARY_KEY},
        'title'       => $faker->unique()->word(),
        'description' => $faker->paragraph($nbSentences = 3),
    ];
});

$factory->define(Distillery::class, function(Faker $faker) {
    return [
        CreateRegionsTable::FOREIGN_KEY => Region::all()->random()->{CreateRegionsTable::PRIMARY_KEY},
        'name'        => $faker->words($nb = rand(1,3), $asText = true)." Distillery",
        'description' => $faker->paragraph($nbSentences = rand(2, 5)),
        'latitude'    => $faker->latitude(),
        'longitude'   => $faker->longitude(),
    ];
});

$factory->define(Tax::class, function(Faker $faker) {
    return [
        'title'       => "BTW",
        'description' => "Belasting op de Toegevoegde Waarde",
        'priority'    => "1",
        'rate'        => "0.2100",
    ];
});

$factory->define(Suggestion::class, function(Faker $faker) {
    return [
        'title'   => $faker->sentence($nbwords = rand(2,4)),
        'content' => $faker->paragraph($nbSentences = rand(1, 5)),
    ];
});

$factory->define(Product::class, function(Faker $faker) {
    return [
        CreateSuggestionsTable::FOREIGN_KEY  => Suggestion::all()->random()->{CreateSuggestionsTable::PRIMARY_KEY},
        CreateDistilleriesTable::FOREIGN_KEY => Distillery::all()->random()->{CreateDistilleriesTable::PRIMARY_KEY},
        CreateTaxesTable::FOREIGN_KEY        => Tax::all()->random()->{CreateTaxesTable::PRIMARY_KEY},
        'name'               => $faker->words($nb = rand(1,3), $asText = true),
        'description'        => $faker->paragraph($nbSentences = rand(2, 5)),
        'stock'              => $faker->numberBetween($min = 10, $max = 750),
        'price'              => $faker->randomFloat($nbMaxDecimals = 3, $min = 25, $max = 1500),
        'volume'             => $faker->randomElement($array = array (50, 75, 100, 150 )),
        'age'                => $faker->numberBetween($min = 5, $max = 125),
        'color'              => $faker->randomElement($array = array ('amber brown', 'gold', 'golden yellow', 'light gold', 'amber' )),
        'smell'              => $faker->randomElement($array = array ('light', 'fruity', 'sharp', 'soft', 'smokey' )),
        'taste'              => $faker->randomElement($array = array ('sweet', 'soft', 'fruity', 'subtle', 'honey' )),
        'alcohol_percentage' => $faker->numberBetween($min = 35, $max = 50),
        'packaging'          => $faker->numberBetween($min = 0, $max = 3),
        'image'              => 'demo_image_bottle.jpg',
        'image_packaging'    => $faker->randomElement($array = array ('demo_image_packaging.jpg', null )),
    ];
});

$factory->define(Price::class, function(Faker $faker) {
    return [
        CreateProductsTable::FOREIGN_KEY => Product::all()->random()->{CreateProductsTable::PRIMARY_KEY},
        'price'              => $faker->randomFloat($nbMaxDecimals = 3, $min = 25, $max = 1500),
        'created_at'           => $faker->dateTimeThisYear($max = 'now')
    ];
});

$factory->define(Inventory::class, function(Faker $faker) {
    return [
        CreateProductsTable::FOREIGN_KEY => Product::all()->random()->{CreateProductsTable::PRIMARY_KEY},
        'stock'      => $faker->numberBetween($min = 0, $max = 1000),
        'created_at' => $faker->dateTimeThisYear($max = 'now')
    ];
});

$factory->define(Basket::class, function(Faker $faker) {
    return [
        CreateUsersTable::FOREIGN_KEY => User::all()->random()->{CreateUsersTable::PRIMARY_KEY},
        CreateBasketStatusesTable::FOREIGN_KEY => BasketStatus::all()->random()->{CreateBasketStatusesTable::PRIMARY_KEY},
    ];
});

$factory->define(Address::class, function(Faker $faker) {
    return [
        CreateCountriesTable::FOREIGN_KEY => Country::all()->random()->{CreateCountriesTable::PRIMARY_KEY},
        CreateUsersTable::FOREIGN_KEY => User::all()->random()->{CreateUsersTable::PRIMARY_KEY},
        'street'            => $faker->streetName,
        'number'            => $faker->buildingNumber,
        'bus'               => $faker->numberBetween($min = 0 , $max = 25),
        'postalcode'        => $faker->postcode,
        'city'              => $faker->city,
        'state_or_province' => $faker->state,
        'type'              => $faker->randomElement($array = array('Home', 'Work', 'Neighbours', 'Other')),
    ];
});

$factory->define(Order::class, function(Faker $faker) {
    return [
        CreateUsersTable::FOREIGN_KEY => User::all()->random()->{CreateUsersTable::PRIMARY_KEY},
        CreateOrderStatusesTable::FOREIGN_KEY => OrderStatus::all()->random()->{CreateOrderStatusesTable::PRIMARY_KEY},
        'address_billing_id'  => Address::all()->random()->{CreateaddressesTable::PRIMARY_KEY},
        'address_delivery_id' => Address::all()->random()->{CreateaddressesTable::PRIMARY_KEY},
        'reference'           => $faker->unique()->numberBetween($min = 000000000000000, $max = 999999999999999),
        'name_billing'        => $faker->name,
        'name_delivery'       => $faker->name,
    ];
});
