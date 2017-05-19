<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 19/05/17
 * Time: 2:13 PM
 */
class payment extends BaseModel
{

    public $payment_id;
    public $amount;
    public $payer;
    public $source;

    static function define_data_types()
    {
        return array(
            'payment_id' => 'ID',
            'amount' => 'float',
            'payer' => 'string',
            'source' => 'string',
        );
    }

    static function define_table_info()
    {
        return array(
            'model_table' => "payment",
            'model_table_id' => "payment_id");
    }

}