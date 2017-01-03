<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class TeacherAcademicInfo extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    public $timestamps = false;
    protected $table = 'teacher_academicinfo';


    protected $hidden = array('password', 'remember_token');

}
