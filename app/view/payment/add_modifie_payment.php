<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 19/05/17
 * Time: 2:26 PM
 */


/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 16/05/17
 * Time: 11:43 AM
 */



$output = new HTMLHelper();

$output->addform(ADD_MODIFY_PAYMENT);

$output->inputhidden_env('ressource','payment');
$output->inputhidden('payment_id',$inscription->payment_id);
$output->inputtext('payer',PAYER,10,$payment->payer);
$output->inputtext('amount',PAYMENT_AMOUNT,10,$payment->amount);
$output->inputtext('nb_balloon',PAYMENT_BALLOON,2,$payment->nb_balloon,0);
$output->inputtext('nb_cap',PAYMENT_CAP,2,$payment->nb_cap,0);
$output->inputselect('source',PaymentSource::get_constants(),$payment->source,PAYMENT_SOURCE);
$output->flag('validated',$payment->validated,VALIDATED);

$output->inputselectmultiple('join_family_member_lesson_id[]',$family->inscriptions,$payment->get_paid_inscriptions(),INSCRIPTION);


$output->formsubmit(ADD_MODIFY);

echo $output->send(1);
