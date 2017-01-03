<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class SubjectAssign extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    public $timestamps = false;
    protected $table = 'subject_assign_to_teacher';


    protected $hidden = array('password', 'remember_token');

}
