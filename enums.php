<?php
/**
 * Created by PhpStorm.
 * User: jtbai
 * Date: 2016-09-05
 * Time: 10:03 PM
 */


class Sex extends BasicEnum{
    const MEN = 1;
    const WOMEN = 2;
}

class Role extends BasicEnum{
    const PARENT = 1;
    const CHILD = 2;
}

class Month extends BasicEnum{
    const JANUARY = 1;
    const FEBRUARY = 2;
    const MARCH = 3;
    const APRIL = 4;
    const MAY = 5;
    const JUNE = 6;
    const JULY = 7;
    const AUGUST = 8;
    const SEPTEMBER = 9;
    const OCTOBER = 10;
    const NOVEMBER = 11;
    const DECEMBER = 12;
}

class PaymentStatus extends BasicEnum{
    const NOT_RECIEVED = 0;
    const RECIVED = 1;
    const VALIDATED = 2;
}

class PaymentSource extends BasicEnum{
    const CHEQUE = 0;
    const ARGENT = 0;
    const B = 0;
    const CR = 0;
    const AG = 0;
    const SF = 0;
}