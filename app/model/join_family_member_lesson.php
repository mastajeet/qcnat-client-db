<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-03
 * Time: 12:07 PM
 */
include_once('base_model.php');
class JoinFamilyMemberLesson extends BaseModel
{
    public $join_family_member_lesson_id;
    public $family_member_id;
    public $lesson_id;
    public $prefix;
    public $family_member;
    public $lesson;
    public $payment_id;

    //status

    public $payment;

    function __construct($Arg)
    {
        parent::__construct($Arg);
        $this->family_member = new FamilyMember($this->family_member_id);
        $this->lesson = new Lesson($this->lesson_id);
    }

    static function define_data_types()
    {
        return array(
            'join_family_member_lesson_id' => 'ID',
            'lesson_id' => 'int',
            'family_member_id' => 'int',
            'prefix' => 'string'
        );
    }

    static function define_table_info(){
        return array(
            'model_table' =>"join_family_member_lesson",
            'model_table_id'=> "join_family_member_lesson_id");
    }

    static function join($family_member, $lesson)
    {
        $join = new self(array('family_member_id'=>$family_member->family_member_id,'lesson_id'=>$lesson->lesson_id));
        $join->save();

        return $join;
    }

    private function obtain_payment(){
        if($this->payment_id==0){
            $payment= new payment();
        }else{
            $payment = new Payment($this->payment_id);
        }

        $this->payment = $payment;
    }

    public function get_payment(){
        $this->obtain_payment();
        return $this->payment;
    }


    public function get_payment_status(){
        if(is_null($this->payment)){
            $this->get_payment();
        }
        if($this->payment_id==0){
            return PaymentStatus::NOT_RECIEVED;
        }elseif(!$this->payment->validated){
            return PaymentStatus::RECIVED;
        }else{
            return PaymentStatus::VALIDATED;
        }
    }


}