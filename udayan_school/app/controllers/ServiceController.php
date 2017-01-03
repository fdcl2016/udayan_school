<?php

class ServiceController extends BaseController {

    public function emailservice()
    {
        $class  = Addclass::groupby('class_name')->get();
        return View::make('email_and_sms_management.email')->with('class',$class);
    }

    public function smsservice()
    {
        $class  = Addclass::groupby('class_name')->get();
        $is_sent = Session::get('shohag_msg');
        $shohag_msg = "";
        if($is_sent == "OK")
            $shohag_msg = "Message Sent Successfully.";
        else
            if($is_sent != "") $shohag_msg = "<font color='red'>".$is_sent." Message not Sent!</font>";
        return View::make('email_and_sms_management.sms')->with('class',$class)->with('shohag_msg',$shohag_msg);
    }

}
