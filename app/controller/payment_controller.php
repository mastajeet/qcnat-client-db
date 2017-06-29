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
        if(isset($args['ID'])) {
            $inscription = new JoinFamilyMemberLesson($args['ID']);

            $inscription->get_payment();
            if ($inscription->get_payment() == []) {
                $payment = new Payment();
            } else {
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
            'validated'=>$prepared_data['validated'],
            'payment_id'=>$prepared_data['payment_id'],
        ];

        $payment = new Payment($payment_data);
        $payment->save();

        if(!is_array($prepared_data['join_family_member_lesson_id'])){
            $paid_inscriptions = [$prepared_data['join_family_member_lesson_id']];
        }else{
            $paid_inscriptions = $prepared_data['join_family_member_lesson_id'];
        }

        $payments = [];

        $last_lesson_id =0;
        foreach($paid_inscriptions  as $inscription ){
            $inscription = new JoinFamilyMemberLesson($inscription);
            $inscription->payment_id = $payment->payment_id;
            $inscription->save();
            $family_member = new FamilyMember($inscription->family_member_id);
            $payments[] = $family_member->lastname." ".$family_member->name;
            $last_lesson_id = $inscription->lesson_id;
        }
        $payments['total'] = $payment->amount." $";
        $current_pool = $inscription->lesson->pool;
        $current_session = $inscription->lesson->session;

        $uri_filter = "filter[pool]=".$current_pool."&filter[session]=".$current_session;
        $payments[] = "<a href=\"index.php?ressource=join_family_member_lesson&action=obtain_cahier&".$uri_filter."#".$last_lesson_id."\">Retour au cours</a>";


        $join_family_member_lesson_controller = new JoinFamilyMemberLessonController();
        $filters['filter']['pool'] = $inscription->lesson->pool;
        $filters['filter']['session'] = $inscription->lesson->session;


        echo add_notification(PAYMENT_RECIEVED,$payments);
        $join_family_member_lesson_controller->obtain_cahier($filters);


    }

}