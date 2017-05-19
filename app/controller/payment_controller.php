<?php

/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 19/05/17
 * Time: 2:26 PM
 */
class PaymentController
{

    public function obtain_inscription_payment($args){
        if(isset($args['ID'])){
            $inscription = new JoinFamilyMemberLesson($args['ID']);
            $inscription->get_payment();
            if($inscription->payment==[]){
                $payment = new Payment();
            }else{
                $payment = $inscription->payment;
            }
        }else{
            throw new Exception(MISSING_ID);
        }

        include_once('./app/view/payment/add_modifie_payment.php');
    }

}