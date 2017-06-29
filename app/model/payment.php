<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 19/05/17
 * Time: 2:13 PM
 */
class Payment extends BaseModel
{

    public $payment_id;
    public $amount;
    public $payer;
    public $source;

    private $paid_inscriptions = null;

    static function define_data_types()
    {
        return array(
            'payment_id' => 'ID',
            'amount' => 'float',
            'payer' => 'string',
            'source' => 'string',
            'nb_balloon' => 'int',
            'nb_cap' => 'int',
            'validated'=>'bool',
        );
    }

    static function define_table_info()
    {
        return array(
            'model_table' => "payment",
            'model_table_id' => "payment_id");
    }

    private function obtain_paid_inscriptions(){
        if(is_null($this->paid_inscriptions) and $this->payment_id !=0 ){
            $inscription_info = JoinFamilyMemberLesson::define_table_info();
            $payment_info = self::define_table_info();

            $inscription_query = "SELECT ".$inscription_info['model_table_id']." FROM ".$inscription_info['model_table']." where ".$payment_info['model_table_id']." = ".$this->payment_id;
            $this->paid_inscriptions = [];

            $rep = self::select($inscription_query);
            $paid_inscriptions = array();
            if($rep){
                foreach($rep as $values){

                    $current_inscription = new JoinFamilyMemberLesson($values[$inscription_info['model_table_id']]);
                    $paid_inscriptions[] = $current_inscription->family_member->name." (".$current_inscription->lesson->level.")";
                }
            }
            $this->paid_inscriptions =  $paid_inscriptions;
        }
    }

    public function get_paid_inscriptions(){
        $this->obtain_paid_inscriptions();
        return $this->paid_inscriptions;
    }

}