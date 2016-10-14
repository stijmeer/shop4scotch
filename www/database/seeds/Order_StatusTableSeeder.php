<?php

use Illuminate\Database\Seeder;
use App\Models\OrderStatus;

class Order_StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderStatus::create(array(
            'title'        => 'Pending',
            'description' => 'Customer started the checkout process, but did not complete it.',
        ));
        OrderStatus::create(array(
            'title'        => 'Awaiting Payment',
            'description' => 'Customer has completed checkout process, but payment has yet to be confirmed.',
        ));
        OrderStatus::create(array(
            'title'        => 'Awaiting Fulfillment',
            'description' => 'customer has completed the checkout process and payment has been confirmed',
        ));
        OrderStatus::create(array(
            'title'        => 'Awaiting Shipment',
            'description' => 'order has been pulled and packaged, and is awaiting collection from a shipping provider',
        ));
        OrderStatus::create(array(
            'title'        => 'Awaiting Pickup',
            'description' => 'order has been pulled, and is awaiting customer pickup from a seller-specified location',
        ));
        OrderStatus::create(array(
            'title'        => 'Partially Shipped',
            'description' => 'only some items in the order have been shipped, due to some products being pre-order only or because of other reasons',
        ));
        OrderStatus::create(array(
            'title'        => 'Completed',
            'description' => 'order has been shipped/picked up, and receipt is confirmed; client has paid for their product',
        ));
        OrderStatus::create(array(
            'title'        => 'Shipped',
            'description' => 'order has been shipped, but receipt has not been confirmed; seller has used the Ship Items action',
        ));
        OrderStatus::create(array(
            'title'        => 'Cancelled',
            'description' => 'seller has cancelled an order, due to a stock inconsistency or other reasons',
        ));
        OrderStatus::create(array(
            'title'        => 'Declined',
            'description' => 'seller has marked the order as declined for lack of manual payment, or other reasons',
        ));
        OrderStatus::create(array(
            'title'        => 'Refunded',
            'description' => 'seller has used the Refund action',
        ));
        OrderStatus::create(array(
            'title'        => 'Disputed',
            'description' => 'customer has initiated a dispute resolution process for the order',
        ));
        OrderStatus::create(array(
            'title'        => 'Verification Required',
            'description' => 'order on hold while some aspect (e.g. tax-exempt documentation) needs to be manually confirmed',
        ));
    }
}
