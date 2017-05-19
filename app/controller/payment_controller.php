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
            $inscription->family_member->get_family();
            $family = new family($inscription->family_member->family->family_id);
            $family->get_inscriptions_session($inscription->lesson->session);
        }else{
            throw new Exception(MISSING_ID);
        }

        include_once('./app/view/payment/add_modifie_payment.php');
    }

    public function post($request_data){
        $prepared_data = prepare_post_request_data($request_data);
        $payment_data = [
            'payer'=>$prepared_data['payer'],
            'amount'=>$prepared_data['amount'],
            'source'=>$prepared_data['source'],
            'validated'=>$prepared_data['validated']
        ];

        $payment = new Payment($payment_data);

        $payment->save();
//        foreach($prepared_data['inscription_id'] as $inscription ){
//            $inscription = new JoinFamilyMemberLesson($inscription);
//            $inscription->payment_id = $payment->payment_id;
//            $inscription->save();
//        }

    }

}