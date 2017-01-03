<?php

//////////////////////////////////Ajax Here
Route::get('/ajax','AjaxController@ajax');
Route::get('/ajax3','AjaxController@ajax3');
Route::get('/ajax2','AjaxController@ajax2');
Route::get('/district','AjaxController@district');
Route::get('//thana','AjaxController@thana');
Route::get('/ajax4','AjaxController@ajax4');
Route::get('/ajax5','AjaxController@ajax5');
Route::post('/testfee','AjaxController@testfee');
Route::post('/testfee1','AjaxController@testfee1');
Route::get('/ajax6','AjaxController@ajax6');
Route::get('/ajax20','AjaxController@ajax20');
Route::get('/ajaxfees','AjaxController@ajaxfees');
Route::get('/ajaxchange','AjaxController@ajaxchange');
Route::get('/ajaxresult','AjaxController@ajaxresult');
Route::get('/ajaxboolean','AjaxController@ajaxboolean');
Route::get('/ajaxsection','AjaxController@ajaxsection');
Route::get('/ajaxshift','AjaxController@ajaxshift');
Route::get('/ajaxpass','AjaxController@ajaxpass');
Route::get('/classsectionsubjectss','AjaxController@classsectionsubjectss');
Route::get('/ajax22','AjaxController@ajax22');

Route::get('path',function(){
    return public_path('uploads/');
});

Route::get('/', function()
{
    
if(substr(URL::current(), 7,3) == "www" || substr(URL::current(), 0,3) == "www"){
       return Redirect::to('http://udayan.iteams.com.bd');
}

if(Auth::user()->type=="admin")
        return Redirect::to('home/adminhome');

    if(Auth::user()->type=="student")
        return Redirect::to('home/studenthome');

    if(Auth::user()->type=="teacher")
        return Redirect::to('home/teacherhome');
    if(Auth::user()->type=="bank")
        return Redirect::to('home/banker_payslip');
})->before('auth');

Route::get('password', function()
{
    if(Auth::user()->type=="admin")
        return View::make('master/password');
    else return ('<div style=" font-size: 30px; color: red; margin-top: 20%; text-align: center;" > Sorry, You are not eligible to access this arena. </div>');

})->before('auth');

Route::post('password',function(){

    ini_set('max_execution_time', 1500);
    DB::table('passwords')->truncate();
    $user = User::where('type','!=','admin')->get();
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $pass_len =10;
    foreach($user as $u)
    {
        $u_id=$u->email;
        $u_type=$u->type;

        $pass = '';
        for ($i = 0; $i < $pass_len; $i++) {
            $pass .= $characters[rand(0, strlen($characters) - 1)];
        }

        $passtbl= new Passwords();

        $passtbl->user_id=$u_id;
        $passtbl->user_password= $pass;
        $passtbl->user_type=$u_type;
        $passtbl->sms_status='N';

        $passtbl->save();

        $data['password']=Hash::make($pass);

        User::where('type','!=','admin')->where('email','=',$u_id)->update($data);

    }

    //PublishResult::where('term','=',$t)->where('year','=',$y)->where('approved','=','Y')->update($data);

    //$message = "Approved successfully";
    return ('<div style=" font-size: 30px; color: green; margin-top: 20%; text-align: center;" > Password has generated and changed successfully. </div>');

});

Route::get('home/adminhome',function()
{
    $month = Session::get('month');
    if ( $month != null) {

        return View::make('main_menu_top.adminhome')
            ->with('month', $month);
    } else {

        return View::make('main_menu_top.adminhome')
            ->with('month', null);
    }

})->before('auth');


Route::get('home/studenthome',function()
{

    $month = Session::get('month');
    $year = Session::get('admission_year');
    if ( $month != null) {

        return View::make('main_menu_top.studenthome')
            ->with('month', $month);

    } else {

        return View::make('main_menu_top.studenthome')
            ->with('month', null);
    }

})->before('auth');

// Route::get('home/bank',function()
// {
// 	$month = Session::get('month');
// 	if ( $month != null) {

// 		return View::make('fees_management.bank_payment')
// 			->with('month', $month);
// 	} else {

// 		return View::make('fees_management.bank_payment')
// 			->with('month', null);
// 	}

// });


Route::get('home/teacherhome',function()
{
    $month = Session::get('month');
    if ( $month != null) {

        return View::make('main_menu_top.teacherhome')
            ->with('month', $month);
    } else {

        return View::make('main_menu_top.teacherhome')
            ->with('month', null);
    }
})->before('auth');

Route::get('profile',function()
{
    if(Auth::user()->type=='admin')
        $profile = TeacherInfo::where('idteacherinfo','=',Auth::user()->email)->first();

    if(Auth::user()->type=='teacher'){
      return Redirect::to('/profile_individual/'.Auth::user()->user_id); }

    if(Auth::user()->type=='bank')
        $profile = TeacherInfo::where('idteacherinfo','=',Auth::user()->email)->first();

    if(Auth::user()->type=='student')
        $profile = Studentinfo::where('idstudentinfo','=',Auth::user()->email)->first();

    return View::make('main_menu_top.profile')->with('profile',$profile);
})->before('auth');

Route::get('profile_individual/{idteacherinfo}',function($idteacherinfo)
{
    $profile = TeacherInfo::where('idteacherinfo','=',$idteacherinfo)->first();
    return View::make('main_menu_top.profile_individual')->with('profile',$profile);
})->before('auth');

Route::get('principle_and_teacher',function()
{
    $headmaster = TeacherInfo::where('designation','=','PRINCIPAL')->first();
    $asstheadmaster = TeacherInfo::where('designation','=','Asstt. Headmaster')->orderBy('teacher_name')->get();
    $department = Department::orderBy('department_name')->get();
    return View::make('main_menu_top.principle_and_teacher')->with('headmaster',$headmaster)->with('asstheadmaster',$asstheadmaster)->with('department',$department);
})->before('auth');

Route::get('courseteacher',function()
{
    return View::make('test.courseteacher');
})->before('auth');

/////////////////////Student here
Route::get('student_management/addstudent','StudentInfoController@addstudent')->before('auth');
Route::post('create_student','StudentInfoController@createStudent');
Route::get('student_management/listeditstudent','StudentInfoController@studentEditList')->before('auth');



Route::get('student_management/liststudent','StudentInfoController@studentInfo')->before('auth');
Route::post('student_management/liststudent2','ClassController@studentInfo2')->before('auth');







Route::post('classroom_management/attendance_info','AttendanceController@attendance_info1');
Route::get('classroom_management/attendance_info','AttendanceController@attendance_info');
Route::post('classroom_management/attendance_info2','AttendanceController@attendance_info2');


Route::get('district','AjaxController@district')->before('auth');
Route::get('student_management/listeditstudent/editstudent/{id}','StudentInfoController@studentEdit')->before('auth');
Route::post('edit_student','StudentInfoController@studentEditPost');
Route::get('student_management/assign_student_to_section','StudentInfoController@assignStudenttoSection')->before('auth');
Route::post('changeshift','StudentInfoController@changeShift');
Route::post('postchangeshift','StudentInfoController@changeShiftpost');

Route::get('student_management/listeditstudent/viewstudent/{id}','StudentInfoController@studentView')->before('auth');

//////teacher
Route::get('staff_management/addteacher','TeacherInfoController@addTeacher')->before('auth');
Route::post('teacherinfostore','TeacherInfoController@addTeacherpost');


Route::get('staff_management/listeditteacher','TeacherInfoController@listTeacher')->before('auth');


Route::get('staff_management/editteacher/{id}','TeacherInfoController@editTeacher')->before('auth');
Route::post('editteacher','TeacherInfoController@updateTeacher');

Route::post('studentsearch',function()
{
    $year = Input::get('year');
    return Redirect::to('student_management/assign_student_to_class_section')->with('year', $year);
});
Route::get('student_management/assign_student_to_class_section',function()
{
    $academic_year = Session::get('year');
    $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
    //return $academic_year;
    if($academic_year!=null)
    {
        $studentInfos = Studentinfo::where('admission_year','=',$academic_year)
            ->where('admission_flag','=','0')->get();
        return View::make('student_management.assign_student_to_class_section')->with('studentInfos',$studentInfos)->with('class', $class);

    }else
    {

        return View::make('student_management.assign_student_to_class_section')->with('studentInfos',null)->with('class', $class);

    }
})->before('auth');


Route::post('assign_studentto_class',function()
{

//return Input::all();
    //  $count=Input::get('count');
    $academicyear=AcademicYear::OrderBy('idacademic_year','desc')->first();
    $class=Input::get('class');
    $section=Input::get('section');
    $student_id=Input::get('student_id');
    $count = sizeof($class);
    for ($i=0; $i < $count; $i++) {
        $student_to_section_update = new StudentToSectionUpdate;
        $student_to_section = new StudentToSection;

        $student_to_section_update->student_idstudentinfo=$student_id[$i];
        $student_to_section_update->class=$class[$i];
        $student_to_section_update->section=$section[$i];


        $shift=Addclass::where('class_name','=',$class[$i])->where('section','=',$section[$i])->first();

        $student_to_section_update->shift=$shift->shift;
        $student_to_section_update->year=$academicyear->academic_year;
        $student_to_section_update->save();

        $student_to_section->student_idstudentinfo=$student_id[$i];
        $student_to_section->class=$class[$i];
        $student_to_section->section=$section[$i];
        $student_to_section->shift=$shift->shift;
        $student_to_section->year=$academicyear->academic_year;
        $student_to_section->save();
        $student['admission_flag'] = "1";
        $id = $student_id[$i];
        Studentinfo::where('idstudentinfo','=',$id)->update($student);
    }


    return Redirect::to('student_management/assign_student_to_class_section');
});
/////////////////////////////feees  


Route::get('fees_management/fees_configuration','FeesController@feesconfiguration')->before('auth');
Route::post('feesconfiguration','FeesController@feesconfiguration2');

Route::get('fees_management/classwise_fees_configuration','FeesController@classwiseconfiguration')->before('auth');
Route::post('classwiseconfiguration','FeesController@classwiseconfiguration2');

Route::get('fees_management/monthly_fees_configuration','FeesController@monthwiseadditionalamount')->before('auth');
Route::post('monthwiseadditionalamount','FeesController@monthwiseadditionalamount2');

Route::get('studentwiseadditional/{id}','FeesController@studentwiseadditional')->before('auth');
Route::post('studentwiseadditional','FeesController@studentwiseadditional2');
Route::get('fees_management/studentwise_fees_configuration','FeesController@linkstudentwiseadditionalamount')->before('auth');
Route::post('banker_payslip_search','FeesController@banker_payslip_search');

Route::get('fees_management/student_fees_payslip_monthwise_view','FeesController@linkstudentwiseadditionalamount')->before('auth');
Route::get('payslip/{month}/{monthnumber}','FeesController@payslip')->before('auth');

Route::post('payslip','FeesController@payslip_pdf');

Route::get('home/banker_payslip','FeesController@banker_payslip')->before('auth');
Route::get('pay_slip_monthwise_view','FeesController@pay_slip_monthwise_view')->before('auth');
Route::post('paid','FeesController@paid');
///////////////teacher routine




function twoDisitMode($firstNumber , $secondNumber)
{
    if ($firstNumber==0) {
        $modeValue=$firstNumber%$secondNumber;
    }

    else if ($secondNumber==0) {
        $modeValue=$secondNumber%$firstNumber;
    }else
    {
        $modeValue=$firstNumber%$secondNumber;
    }

    if ($modeValue==0) {
        $modeValue="00";
    } else if($modeValue/10<1){
        $modeValue="0" . $modeValue;
    }
    else{
        $modeValue=$modeValue;
    }


    return $modeValue;
}

function actualDisitMode($firstNumber , $secondNumber)


{
    if ($firstNumber==0) {
        $modeValue=$firstNumber%$secondNumber;
    }

    else if ($secondNumber==0) {
        $modeValue=$secondNumber%$firstNumber;
    }else
    {
        $modeValue=$firstNumber%$secondNumber;
    }



    return $modeValue;
}

function integerParse($arraySize , $array)
{
    for ($i=0; $i < $arraySize; $i++) {
        $str[$i] = (int) $array[$i];
    }

    return $str;
}

function lastdisiteTeacher($array,$arraySize){


    $size=$arraySize-1;
    $value=0;
    for ($i = $size; $i > 0; $i--) {

        if ($i==$size) {
            $value=$array[$i]+1;


            if ($value>9) {
                $array[$i]=0;

            }else{
                $array[$i]=$value;
            }

        }

        if ($value>9) {
            $value=$array[$i-1]+1;

            if ($value>9) {
                $array[$i-1]=0;
            }else{
                $array[$i-1]=$value;
            }


        }


    }


    return $array;

}



Route::get('result_management/prepare_marksheet/{term}/{year}/{class_name}/{class_sec}/{course_teacher_id}/', 'ResultController@prepare_marksheet')->before('auth');

////////////////////Classroom Management Here

Route::get('classroom_management/create_class','ClassController@create_class')->before('auth');
Route::post('classroom_management/post_create_class','ClassController@create_class2');
Route::get('classroom_management/edit_class','ClassController@edit_class')->before('auth');
Route::get('classroom_management/editable_class/{id}','ClassController@editable_class')->before('auth');
Route::post('classroom_management/editable_class','ClassController@editable_class2');
Route::get('classroom_management/assign_teacher_to_section','ClassController@assign_teacher_to_section')->before('auth');
Route::post('classroom_management/assign_teacher_to_section','ClassController@assign_teacher_to_section2');
Route::post('classroom_management/courseteacher12','ClassController@courseteacher12');
Route::get('classroom_management/assign_class_teacher','ClassController@assign_class_teacher')->before('auth');
Route::post('classroom_management/assign_class_teacher','ClassController@assign_class_teacher2');
Route::post('classroom_management/search_courseteacher','ClassController@search_courseteacher');


///////////////Subject Here
Route::get('subject_management/create_subject','SubjectController@create_subject')->before('auth');
Route::post('subject_management/post_create_subject','SubjectController@post_create_subject');
Route::get('subject_management/edit_subject','SubjectController@list_of_subject')->before('auth');
Route::get('subject_management/edit_subject/{idsubject}','SubjectController@edit_subject')->before('auth');
Route::post('subject_management/post_edit_subject','SubjectController@post_edit_subject');
Route::get('subject_management/assign_subject_to_teacher','SubjectController@assign_subject_to_teacher')->before('auth');
Route::post('subject_management/post_assign_subject_to_teacher','SubjectController@post_assign_subject_to_teacher');
Route::get('subject_management/classwise_subject','SubjectController@classwise_subject')->before('auth');
Route::post('subject_management/saveSubjectToClass','SubjectController@saveSubjectToClass');
Route::get('subject_management/classwise_subject_list','SubjectController@classwise_subject_list')->before('auth');
Route::get('subject_management/edit_subject_classwise/{idsubjecttoclass}','SubjectController@edit_subject_classwise')->before('auth');
Route::post('subject_management/edit_subject_classwise','SubjectController@edit_subject_classwise2');

/////////////////Holiday Here updated on 24 Nov 15

Route::get('holiday_management/create_events','HolidayController@events_create')->before('auth');
Route::post('holiday_management/create_events','HolidayController@create_event2');
Route::get('holiday_management/create_annual_calender','HolidayController@create_annual_calender')->before('auth');
Route::post('holiday_management/create_annual_calender','HolidayController@create_annual_calender2');

Route::get('holiday_management/show_events','HolidayController@events_show')->before('auth');
Route::post('holiday_management/create_events','HolidayController@show_event');
Route::get('holiday_management/view_annual_calender','HolidayController@view_annual_calender')->before('auth');
Route::post('holiday_management/view_annual_calender','HolidayController@view_annual_calender2');

Route::get('calender','HolidayController@calender')->before('auth');
Route::post('calender','HolidayController@calender2');


Route::post('holiday_management/edit_events','HolidayController@edit_event');

Route::get('holiday_management/edit_events/{idevents}',function($idevents)
{
    $st= EventsManagement::where('idevents','=',$idevents)->first();


    return View::make('holiday_management.edit_events')->with('events',$st);
})->before('auth');

Route::get('holiday_management/edit_annual_calender/{idevents}', function($idevents)
{
    $st= AnnualCalender::where('idannualcalender','=',$idevents)->first();


    return View::make('holiday_management.edit_annual_calender')->with('events',$st);
})->before('auth');

Route::post('holiday_management/edit_annual_calender','HolidayController@edit_annual_calender');



function range12($from , $to) {
    $begin = new DateTime( $from);
    $end = new DateTime( $to);
    $end = $end->modify( '+1 day' );

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);

    foreach($daterange as $date) {
        $some[] = $date->format("d F Y");
    }
    return $some;
}

////////////////Email and 

Route::get('email_and_sms_management/email','ServiceController@emailservice')->before('auth');
Route::get('email_and_sms_management/sms','ServiceController@smsservice')->before('auth');

Route::post('email_and_sms_management/email','ServiceController@emailservice')->before('auth');
Route::post('sms_service',function()
{
    //return Input::all();
    $recipient = Input::get('recipient');
    $mobile = Input::get('mobile');
    $file = Input::file('file');
    $destination = public_path('sms/');

    $sms_body = Input::get('message');

    $encoded_message = urlencode($sms_body);
    $message_size = substr($encoded_message, 0, 159);

    if($recipient!=null&&$recipient!="")
    {
        $arr_mobileNumber = array();
        

        if($recipient=="teacher")
        {
            
//$teacher = TeacherInfo::all();
//foreach($teacher as $t)
 //{
 // $arr_mobileNumber = '88'.$t->teacher_mobile1;
  $sendResult = SendSMSFuntion('8801551811666', $sms_body);
// }

        }
        else
        {
            $student = StudentToSectionUpdate::where('class','=',$recipient)->get();
            foreach($student as $st)
            {
                $arr_mobileNumber = Studentinfo::where('idstudentinfo','=',$st->student_idstudentinfo)->first()->mobile1;
                $sendResult = SendSMSFuntion($arr_mobileNumber, $sms_body);
            }
            //$mobileNumber_list = implode(",", $arr_mobileNumber);
        }
    }
    elseif($mobile!=null&&$mobile!="")
    {
        $arr_mobileNumber = '88'.$mobile;
        $sendResult = SendSMSFuntion($arr_mobileNumber, $sms_body);
    }
    elseif($file!=null) {
        $file_data = file_get_contents($file->getRealPath());


        $arr_mobileNumber = array();
        $a=0;
        $arr_mobileNumbers = explode(PHP_EOL, $file_data);

        foreach($arr_mobileNumbers as $number)
        {
            $arr_mobileNumber = '88'.$number;
            $sendResult = SendSMSFuntion($arr_mobileNumber, $sms_body);
        }
        //$mobileNumber_list = implode(",", $arr_mobileNumber);

    }

    

    return Redirect::to('email_and_sms_management/sms')->with('shohag_msg',$sendResult);
});


/*
Route::post('sms_service',function()
{
    //return Input::all();
    $recipient = Input::get('recipient');
    $mobile = Input::get('mobile');
    $file = Input::file('file');
    $destination = public_path('sms/');
    if($recipient!=null&&$recipient!="")
    {
        $arr_mobileNumber = array();
        if($recipient=="teacher")
        {
           
$teacher = TeacherInfo::all();
foreach($teacher as $t)
 {
  $arr_mobileNumber[] = '88'.$t->teacher_mobile1;
 }
$mobileNumber_list = implode(",", $arr_mobileNumber);
$arr_mobileNumber[] = '8801719358457';
$arr_mobileNumber[] = '8801670239891';
$arr_mobileNumber[] = '8801621585871';
$arr_mobileNumber[] = '8801671506959';
$mobileNumber_list = implode(",", $arr_mobileNumber);
        }
        else
        {
            $student = StudentToSectionUpdate::where('class','=',$recipient)->get();
            foreach($student as $st)
            {
                $arr_mobileNumber[] = Studentinfo::where('idstudentinfo','=',$st->student_idstudentinfo)->first()->mobile1;
            }
            $mobileNumber_list = implode(",", $arr_mobileNumber);
        }
    }
    elseif($mobile!=null&&$mobile!="")
    {
        $mobileNumber_list = '88'.$mobile;
    }
    elseif($file!=null) {
        $file_data = file_get_contents($file->getRealPath());


        $arr_mobileNumber = array();
        $a=0;
        $arr_mobileNumbers = explode(PHP_EOL, $file_data);

        foreach($arr_mobileNumbers as $number)
        {
            $arr_mobileNumber[] = '88'.$number;
        }
        $mobileNumber_list = implode(",", $arr_mobileNumber);

    }

    $sms_body = Input::get('message');

    $encoded_message = urlencode($sms_body);
    $message_size = substr($encoded_message, 0, 159);


    $sendResult = SendSMSFuntion($mobileNumber_list, $sms_body);

    return Redirect::to('email_and_sms_management/sms')->with('shohag_msg',$sendResult);
});
/*
function SendSMSFuntion($to, $txt) {
    //--------------------------
    $message_get = $txt;
    $mobile = $to;
//$message_get = "Hello Jesy.......$mobile";
    $message_url = urlencode($message_get);
    $message_final = substr($message_url, 0, 159);

//fixed parameter
    $host = "manage.muthofun.com";
//$port = "8080";
    $username = "iftekhar@comfosys.com";
    $password = "ifteeCFS2014";
    $sender = "UDAYAN";
    $msgtype = "0";
    $dlr ="1";

//http://manage.muthofun.com//bulksms/bulksend.go?username=iftekhar@comfosys.com&password=ifteeCFS2014&originator=comfosys&phone=8801727208714&msgtext=test+message

//$live_url = "http://$host:$port/bulksms/bulksms?username=$username&password=$password&type=$msgtype&dlr=$dlr&destination=$mobile&source=$sender&message=$message_final";
//$directURl = "http://121.241.242.114:8080/bulksms/bulksms?username=mfn-demo&password=demo321&type=0&dlr=0&destination=8801823146626&source=TSMTS&message=This+is+test";
    $ch = curl_init("http://$host/bulksms/bulksend.go?");
    //echo "CH= ".$ch. "<br/>";
    curl_setopt($ch, CURLOPT_POST, True);
    //curl_setopt($ch, CURLOPT_POSTFIELDS,"username=$username&password=$password&type=0&dlr=1&destination=$mobile&source=$sender&message=$message_final");
    //curl_setopt($ch, CURLOPT_POSTFIELDS,"username=$username&password=$password&originator=$sender&phone=$mobile&msgtext=$message_final");
curl_setopt($ch, CURLOPT_POSTFIELDS,"user=$username&password=$password&mobiles=$mobile&sms=$message_final&group=-1&unicode=0&clientsmsid=10001&senderid=$sender&scheduletime=0");
    curl_setopt($ch, CURLOPT_TIMEOUT,60);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $contents = curl_exec($ch);

    //var_dump(curl_getinfo($ch));

    curl_close ($ch);
    return $contents;
    //---------------------------
}
*/

function SendSMSFuntion($to, $txt) {
    //--------------------------
    $message_get = $txt;
    $mobile = $to;
    $message_url = urlencode($message_get);
    $message_final = $message_url;

//fixed parameter
    $host = "sms.iteams.com.bd";
//$port = "8080";
    $username = "udayan";
    $password = "udayan20";
    $sender = "UDAYAN";
    $msgtype = "0";
    $dlr ="1";

   $ch = curl_init("http://$host/sendsms.jsp?");
    //echo "CH= ".$ch. "<br/>";
    curl_setopt($ch, CURLOPT_POST, True);
    //curl_setopt($ch, CURLOPT_POSTFIELDS,"username=$username&password=$password&type=0&dlr=1&destination=$mobile&source=$sender&message=$message_final");
    //curl_setopt($ch, CURLOPT_POSTFIELDS,"user=$username&password=$password&mobiles=$mobile&sms=$message_final&clientsmsid=10001&senderid=$sender&unicode=0");
curl_setopt($ch, CURLOPT_POSTFIELDS,"user=$username&password=$password&mobiles=$mobile&sms=$message_final&unicode=0&clientsmsid=10001&senderid=$sender&scheduletime=0");
    curl_setopt($ch, CURLOPT_TIMEOUT,360);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

    $contents = curl_exec($ch);

    var_dump(curl_getinfo($ch));

    curl_close ($ch);

    return $contents;

}



//Route::get('fees_management/fees_configuration',function()
//{
//	return View::make('fees_management.fees_configuration');
//});
//
//Route::get('fees_management/classwise_fees_configuration',function()
//{
//	return View::make('fees_management.classwise_fees_configuration');
//});
//Route::get('fees_management/monthly_fees_configuration',function()
//{
//	return View::make('fees_management.monthly_fees_configuration');
//});
//Route::get('fees_management/studentwise_fees_configuration',function()
//{
//	return View::make('fees_management.studentwise_fees_configuration');
//});

Route::get('attendance_management/student_attendance_view',function()
{
    return View::make('attendance_management.student_attendance_view');
})->before('auth');
Route::get('attendance_management/teacher_give_attendance','AttendanceController@teacher_give_attendance')->before('auth');
Route::post('attendance_management/teacher_give_attendance','AttendanceController@teacher_give_attendance2');
Route::post('attendance_management/teacher_give_attendance3','AttendanceController@teacher_give_attendance3');


/*
Route::get('assignment_management/student_assignment',function()
{
    return View::make('assignment_management.student_assignment');
})->before('auth');


*/






// 26 - 03 -2016 FOURTH SUBJECT



Route::post('subject_management/fourth_subject',function(){


    $class = Input::get('cat');
    $section = Input::get('sub');

    return Redirect::to('/subject_management/fourth_subject')
        ->with('classname', $class)
        ->with('sectionname', $section);
});



Route::get('subject_management/fourth_subject',function(){


   // return View::make('subject_management/fourth_subject')->with('class_data',null);


    $classname = Session::get('classname');
    $sectionname = Session::get('sectionname');
     $y= date('Y'); $yn= date('Y')+1;
     $current_year =$y."-".$yn;

    if($classname != null || $classname!=[] && $sectionname != null || $sectionname!=[]) {

        $idcls = Addclass::where('section','=',$sectionname)->pluck('class_id');
        $class = ClassWiseStd::where('std_section', '=', $sectionname)->where('std_class', '=', $classname)->orderby('std_roll')->get();
    }
    else{

        $class = null;
        $idcls = null;
    }



    return View::make('subject_management/fourth_subject')->with('class_data',$class)->with('clsid',$idcls)->with('year',$current_year);
});




Route::post('subject_management/assign_fs','SubjectController@fourthsub');



// ENDS HERE






Route::get('book',function()
{
    return View::make('classroom_management.booklist');
})->before('auth');


Route::get('assignment_management/getfile/{idassignment}','AssignmentController@download')->before('auth');


Route::get('fees_management/student_fees_payslip_monthwise_view',function()
{
    return View::make('fees_management.student_fees_payslip_monthwise_view');
})->before('auth');
////////////////////Routine Here
Route::get('routine/create_configuration','RoutineController@create_configuration')->before('auth');
Route::post('routine/create_configuration','RoutineController@create_configuration2');
Route::get('routine/list_of_configuration','RoutineController@list_of_configuration')->before('auth');
Route::get('routine/edit_config/{id}','RoutineController@edit_config')->before('auth');
Route::post('routine/edit_configuration','RoutineController@edit_configuration');
Route::get('routine/view_routine','RoutineController@view_routine')->before('auth');

Route::get('routine/create_routine','RoutineController@create_routine')->before('auth');
Route::post('routine/create_routine','RoutineController@create_routine2');
Route::get('routine/routine', function () {
    return View::make('routine.routine');
})->before('auth');

Route::get('result_management/report_blank',function(){

    return View::make('result_management.blank_page_for_report');

})->before('auth');




Route::get('result_management/mark_sheet_mahbub/{year2}/{term}/{classname}/{sectionname}/{subjectname}', function($year2,$term,$classname, $sectionname , $subjectname){

             

  return View::make('result_management.mark_sheet_mahbub')->with('year2',$year2
    )
        ->with('term',$term)
        ->with('classname',$classname)
        ->with('sectionname',$sectionname)
        ->with('subjectname',$subjectname);
      
        


})->before('auth');



Route::post('routine/routine','RoutineController@routine2');

Route::get('routine/student_routine','StudentInfoController@student_routine')->before('auth');
Route::get('routine/teacher_routine','TeacherInfoController@teacher_routine')->before('auth');

Route::get('result_management/configure_result','ResultController@configure_result')->before('auth');
Route::post('result_management/configure_result','ResultController@postresultconfiguration');
Route::get('result_management/list_of_config','ResultController@list_of_config')->before('auth');
Route::get('result_management/edit_config/{name}','ResultController@edit_config')->before('auth');
Route::post('result_management/edit_config','ResultController@edit_config2');

Route::get('result_management/student_result','ResultController@resultindividual')->before('auth');
Route::post('showresultlink','ResultController@showresultlink');
Route::get('showresultdetails/{data1}/{data2}','ResultController@showresultdetails')->before('auth');
Route::get('failedstudentdetails/{std_id}/{std_term}/{std_year}','ResultController@failedstudentdetails')->before('auth');


Route::get('result_management/teacher_result_insert','ResultController@teacher_result_insert')->before('auth');
Route::post('result_management/teacher_result_insert','ResultController@teacher_result_insert2');
Route::get('regular_assesment/{data}/{data1}/{data2}/{year}/{term}/{sec}/{idcourse}','ResultController@regular_assesment')->before('auth');
Route::post('regular_assesment','ResultController@regular_assesment2');
///////////////Notice Here
Route::get('notice_management/add_notice','NoticeController@add_notice')->before('auth');
Route::post('postnotice','NoticeController@store');
Route::get('notice_management/show_notice','NoticeController@show_notice')->before('auth');
Route::get('notice_management/individual_notice/{idnotice}','NoticeController@show')->before('auth');
Route::get('notice_management/show_individual_notice/{idnotice}','NoticeController@show_individual')->before('auth');

Route::get('notice_management/show_notice_all','NoticeController@show_notice_student')->before('auth');
Route::get('notice_management/individual_notice_student/{idnotice}','NoticeController@show_student')->before('auth');
Route::get('notice_management/getfile/{idnotice}','NoticeController@download')->before('auth');
/////////////////////////////Authentication Here
Route::get('login',function()
{
if(substr(URL::current(), 7,3) == "www" || substr(URL::current(), 0,3) == "www"){
       return Redirect::to('http://udayan.iteams.com.bd');
}    
return View::make('authentication.login');
})->before('guest');

Route::post('postlogin',function()
{
    $input = Input::all();
    $attempt = Auth::attempt([
        'email' => $input['email'],
        'password' => $input['password']
    ]);

    if ($attempt)
    {
        if(Auth::user()->type=="admin")
            return Redirect::to('home/adminhome');
        else if(Auth::user()->type=="student")
            return Redirect::to('home/studenthome');
        else if(Auth::user()->type=="teacher")
            return Redirect::to('home/teacherhome');
        else if(Auth::user()->type=="bank")
            return Redirect::to('home/banker_payslip');
    }

    else {

        $errors ="Username and/or password invalid.";

        return Redirect::back()->withInput()->with('errors',$errors);

    }
});

Route::get('logout',function()
{
    Auth::logout();
    return Redirect::intended('/login');
})->before('auth');

Route::get('change_password',function()
{
    return View::make('authentication.change_password');
})->before('auth');

Route::post('post_change_password',function()
{
    //return Input::all();
    $old_password = Input::get('old_password');
    $new_password = Input::get('new_password');
    $confirm_new_password = Input::get('confirm_new_password');
    if($new_password==$confirm_new_password)
    {
        //return Auth::user()->password;
        if (Hash::check($old_password, Auth::user()->password))
        {
            $input['password'] = Hash::make($new_password);
            User::where('email','=',Auth::user()->email)->update($input);
        }

    }
    return Redirect::to('/');


});




Route::post('info', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');

    return Redirect::to('/info')
        ->with('classname', $class)
        ->with('sectionname', $section);


});




Route::get('info', function ()
{
    $classname = Session::get('classname');
    $sectionname = Session::get('sectionname');

    $class = ClassWiseStd::where('std_section', '=', $sectionname)->where('std_class', '=', $classname)->get();
    return View::make('student_management.listEditstudent')->with('class_data', $class);



});



Route::post('tabulationsheet', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');
    $year = Input::get('year');
    $subject = Input::get('subject');
    $term = Input::get('term');
    return Redirect::to('/tabulationsheet')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('subject', $subject)
        ->with('term', $term)
        ->with('year', $year);
});



Route::get('tabulationsheet', function () {

    $classname = Session::get('classname');
    $sectionname = Session::get('sectionname');
    $year = Session::get('year');
    $subject = Session::get('subject');
    $term = Session::get('term');

        if ($classname!= null || $sectionname!=null || $year!=null || $subject!=null) {


            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            $class_section= Addclass::where('class_name','=',$classname)->where('section','=', $sectionname)->pluck('class_id');
            //$configuration_id=SubjectToClass::where('idclass','=',$class_section)->pluck('markconfiguration_name');
            //return $configuration_id;
            //  $configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
            // return $configuration_names;

            $result=TStudentResult::where('class', '=', $classname)
                ->where('subject','=',$subject)
                ->where('section','=',$sectionname)
                ->where('academic_year','=',$year)
                ->orderby('st_id', 'ASC')->get();
            $c_teacher = CourseTeacher::where('idcourseteacher','=',$result[0]->idcourseteacher)->pluck('idteacherinfo');
            $c_teacher = TeacherInfo::where('idteacherinfo','=',$c_teacher)->first();

            /*
            $result=StudentResult::where('idclasssection','=',$class_section)
                ->where('subject_name','=',$subject)
                ->where('term','=',$term)
                ->where('Year','=',$year)->get();

            $resultMarks =StudentResult::where('idclasssection','=',$class_section)
                ->where('subject_name','=',$subject)
                ->where('term','=',$term)
                ->where('Year','=',$year)->get();
            $resultRegularAssesment=StudentResult::where('idclasssection','=',$class_section)
                ->where('subject_name','=',$subject)
                ->where('Year','=',$year)->select('RT_Marks')->get();
            $resultLabTest=StudentResult::where('idclasssection','=',$class_section)
                ->where('subject_name','=',$subject)
                ->where('Year','=',$year)->select('LT_Marks')->get();
            $mcqTest=StudentResult::where('idclasssection','=',$class_section)
                ->where('subject_name','=',$subject)
                ->where('Year','=',$year)->select('MCQ_Marks')->get();
            $hallTest=StudentResult::where('idclasssection','=',$class_section)
                ->where('subject_name','=',$subject)
                ->where('Year','=',$year)->select('HT_Marks')->get(); */

            $ct=0;
            $rt=0;
            $lt=0;
            $mcq=0;
            $ht=0;

            if ($result[0]->h_ct !=null && $result[1]->h_ct !=null) $ct=1;
            if ($result[0]->h_ra !=null && $result[1]->h_ra !=null) $rt=1;
            if ($result[0]->h_lab !=null && $result[1]->h_lab !=null)  $lt=1;
            if ($result[0]->h_mcq !=null && $result[1]->h_mcq !=null) $mcq=1;
            if ($result[0]->h_ht !=null && $result[1]->h_ht !=null)   $ht=1;


            //$grade_table = GradingTable::all();

            //$idsubject = Subject::where('subject_name','=',$subject)->pluck('idsubject');
            // return $idsubject;

            return View::make('result_management.tabulation_sheet')
                ->with('classname', $classname)
                ->with('sectionname', $sectionname)
                ->with('year2', $year)
                ->with('class', $class)
                ->with('results', $result)
                ->with('cteacher', $c_teacher)
                ->with('ct', $ct)
                ->with('ht', $ht)
                ->with('lt', $lt)
                ->with('mcq', $mcq)
                ->with('rt', $rt)
                ->with('term', $term)
                ->with('subjectname',$subject);

        } else {
            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            $subjects=Subject::groupby('subject_name')->get();
            return View::make('result_management.tabulation_sheet')
                ->with('classname', null)
                ->with('sectionname', null)
                ->with('year2', null)
                ->with('class', $class)
                ->with('results', null)
                ->with('ct', null)
                ->with('ht', null)
                ->with('lt', null)
                ->with('mcq', null)
                ->with('rt', null)
                ->with('subjectname',null)
                ->with('subjects', $subjects);


    }

})->before('auth');


Route::post('view_marksheet', function ()
{
    $class = Input::get('cat');
    $year = Input::get('year');
    $term = Input::get('term');
    $subject = Input::get('subject');
    return Redirect::to('/view_marksheet')
        ->with('classname', $class)
        ->with('subject', $subject)
        ->with('year', $year)
        ->with('term', $term);
});


/*Route::get('view_marksheet',function()
{

    $msg = Session::get('shohag_msg');

    $classname = Session::get('classname');
    $year = Session::get('year');
    $term = Session::get('term');
    $subject = Session::get('subject');

$idsubject = Subject::where('subject_name','=',$subject)->pluck('idsubject');

    if ($classname!=null || $year!=null||$subject!=null) {


        $classsec = Addclass::where('class_id','=',$classname)->first();
        $cls_name = $classsec->class_name;
        $sec_name = $classsec->section;
        $idclasssection = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
        $course_idcourseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)
            ->where('year','=', $year)
            ->where('idsubject','=',$idsubject)
            ->where('idclasssection','=', $classname)->pluck('idcourseteacher');
        $subjects = Subject::groupby('subject_name')->get();
        $teacherinfo = TeacherInfoView::where('subject_name', '=', $subject)->where('idclasssection', '=', $classname)->first();



        //$configuration_id=SubjectToClass::where('idclass','=',$classname)->pluck('markconfiguration_name');
        //$configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
        //  return $configuration_names;
        $result=TStudentResult::distinct()->where('idclasssection','=',$classname)
            ->where('subject','=',$subject)
            ->where('academic_year','=',$year)->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 't_st_result.st_id')
            ->orderby('student_to_section_update.st_roll', 'ASC')->get();
        
$c_teacher = CourseTeacher::where('idsubject','=',$idsubject)->where('idclasssection','=',$classname)->where('year','=',$year)->pluck('idteacherinfo');
        $c_teacher = TeacherInfo::where('idteacherinfo','=',$c_teacher)->first();



        $idsubject = Subject::where('subject_name','=',$subject)->pluck('idsubject');
        // return $idsubject;
//		$course = CourseTeacher::where('idclasssection','=',$classname)->where('idsubject','=',$idsubject)->where('year','=',$year)->where('idteacherinfo','=',Auth::user()->user_id)->first();
//		return Auth::user()->user_id;
        $course = ClassTeacher::where('idclasssection','=',$classname)->where('idteacherinfo','=',Auth::user()->user_id)->first();
        $is_teacher = CourseTeacher::where('idsubject','=',$idsubject)->where('idteacherinfo','=',Auth::user()->user_id)->first();
        $is_course_teacher = count($is_teacher);
        $submitted = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$course_idcourseteacher)->where('flag','=','editable')->where('term','=',$term)->where('academic_year','=',$year)->where('idsubject','=',$idsubject)->first();
        $is_submit = count($submitted);
        if(count($course)){
            $edit = TabulationSheetEditable::where('idcourseteacher','=',Auth::user()->user_id)->where('flag','=','non_editable')->where('term','=',$term)->where('academic_year','=',$year)->where('idsubject','=',$idsubject)->first();

            if(count($edit))
            {
                $data = $edit;
            }else{
                $data=null;
            }
        }
        else{
            $data=null;
        }
        //$test= "idcourseteacher = ".Auth::user()->user_id.", term = ".$term.", academic_year = ".$year.", idsubject = ".$idsubject."-->>";

            $ct=0;
            $rt=0;
            $lt=1;
            $mcq=0;
            $ht=0;
  if(count($result)){
            if ($result[0]->h_ct !=null && $result[1]->h_ct !=null) $ct=1;
            if ($result[0]->h_ra !=null && $result[1]->h_ra !=null) $rt=1;
            if ($result[0]->h_lab !=null && $result[1]->h_lab !=null)  $lt=1;
            if ($result[0]->h_mcq !=null && $result[1]->h_mcq !=null) $mcq=1;
            if ($result[0]->h_ht !=null && $result[1]->h_ht !=null)   $ht=1; }
 //return $result;
        
     
return View::make('result_management.teacher_tabulation_sheet')
            ->with('shohag_msg',$msg)
            ->with('classname', $cls_name)
            ->with('sectionname', $sec_name)
           
            ->with('year2', $year)
            ->with('class', $idclasssection)
            ->with('results', $result)
            ->with('subjectname',$subject)
            ->with('subjects', $subjects)
            ->with('cteacher', $c_teacher)
            ->with('editable',$data)
            ->with('ct', $ct)
            ->with('ht', $ht)
            ->with('lt', $lt)
            ->with('mcq', $mcq)
            ->with('rt', $rt)
            ->with('term',$term)
            ->with('teacher',$teacherinfo)
            ->with('idsubject',$idsubject)
            ->with('is_submit', $is_submit)
            ->with('course_idcourseteacher',$course_idcourseteacher)
            ->with('is_course_teacher',$is_course_teacher);
    } else
    {

        $idclasssection = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
        $subjects=Subject::groupby('subject_name')->get();
        return View::make('result_management.teacher_tabulation_sheet')
            ->with('shohag_msg',$msg)
            ->with('classname', null)
            ->with('year2', null)
            ->with('class', $idclasssection)
            ->with('results', null)
            ->with('configs', null)
            ->with('subjectname',null)
            ->with('subjects', $subjects)
            ->with('editable',null)
            ->with('teacher',null)
            ->with('term',null)
            ->with('idsubject',null)
            ->with('is_course_teacher',null);
    }

})->before('auth'); */

Route::get('view_marksheet',function()
{

    $msg = Session::get('shohag_msg');

    $classname = Session::get('classname');
    $year = Session::get('year');
    $term = Session::get('term');
    $subject = Session::get('subject');

$idsubject = Subject::where('subject_name','=',$subject)->pluck('idsubject');

    if ($classname!=null || $year!=null||$subject!=null) {


        $classsec = Addclass::where('class_id','=',$classname)->first();
        $cls_name = $classsec->class_name;
        $sec_name = $classsec->section;
        $idclasssection = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
        $course_idcourseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)
            ->where('year','=', $year)
            ->where('idsubject','=',$idsubject)
            ->where('idclasssection','=', $classname)->pluck('idcourseteacher');
        $subjects = Subject::groupby('subject_name')->get();
        $teacherinfo = TeacherInfoView::where('subject_name', '=', $subject)->where('idclasssection', '=', $classname)->first();



        //$configuration_id=SubjectToClass::where('idclass','=',$classname)->pluck('markconfiguration_name');
        //$configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
        //  return $configuration_names;

$result=TStudentResult::distinct()->where('idclasssection','=',$classname)
            ->where('subject','=',$subject)
            ->where('academic_year','=',$year)->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 't_st_result.st_id')
            ->orderby('student_to_section_update.st_roll', 'ASC')->get();


       if($classsec->value >8){

           $conv_result = ConvertedMarks::distinct()->where('class_id','=',$classname)
               ->where('subjectid','=',$idsubject)
               ->where('converted_marks.year',$year)
               ->where('term','=',$term)
->where('student_to_section_update.class','=',$cls_name)
               ->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'converted_marks.st_id')
               ->orderby('student_to_section_update.st_roll', 'ASC')->get();
           //$result ="[]";

       }
        else {

            
            $conv_result = "[]";
        }

$c_teacher = CourseTeacher::where('idsubject','=',$idsubject)->where('idclasssection','=',$classname)->where('year','=',$year)->pluck('idteacherinfo');
        $c_teacher = TeacherInfo::where('idteacherinfo','=',$c_teacher)->first();



        $idsubject = Subject::where('subject_name','=',$subject)->pluck('idsubject');
        // return $idsubject;
//		$course = CourseTeacher::where('idclasssection','=',$classname)->where('idsubject','=',$idsubject)->where('year','=',$year)->where('idteacherinfo','=',Auth::user()->user_id)->first();
//		return Auth::user()->user_id;
        $course = ClassTeacher::where('idclasssection','=',$classname)->where('idteacherinfo','=',Auth::user()->user_id)->first();
        $is_teacher = CourseTeacher::where('idsubject','=',$idsubject)->where('idteacherinfo','=',Auth::user()->user_id)->first();
        $is_course_teacher = count($is_teacher);
        $submitted = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$course_idcourseteacher)->where('flag','=','editable')->where('term','=',$term)->where('academic_year','=',$year)->where('idsubject','=',$idsubject)->first();
        $is_submit = count($submitted);
        if(count($course)){
            $edit = TabulationSheetEditable::where('idcourseteacher','=',Auth::user()->user_id)->where('flag','=','non_editable')->where('term','=',$term)->where('academic_year','=',$year)->where('idsubject','=',$idsubject)->first();

            if(count($edit))
            {
                $data = $edit;
            }else{
                $data=null;
            }
        }
        else{
            $data=null;
        }
        //$test= "idcourseteacher = ".Auth::user()->user_id.", term = ".$term.", academic_year = ".$year.", idsubject = ".$idsubject."-->>";

            $ct=0;
            $rt=0;
            $lt=1;
            $mcq=0;
            $ht=0;
  if(count($result)){
            if ($result[0]->h_ct !=null && $result[1]->h_ct !=null) $ct=1;
            if ($result[0]->h_ra !=null && $result[1]->h_ra !=null) $rt=1;
            if ($result[0]->h_lab !=null && $result[1]->h_lab !=null)  $lt=1;
            if ($result[0]->h_mcq !=null && $result[1]->h_mcq !=null) $mcq=1;
            if ($result[0]->h_ht !=null && $result[1]->h_ht !=null)   $ht=1; }
 //return $result;
        
     
return View::make('result_management.teacher_tabulation_sheet')
            ->with('shohag_msg',$msg)
            ->with('classname', $cls_name)
            ->with('sectionname', $sec_name)
           
            ->with('year2', $year)
            ->with('class', $idclasssection)
            ->with('results', $result)
            ->with('conv_marks', $conv_result)
            ->with('subjectname',$subject)
            ->with('subjects', $subjects)
            ->with('cteacher', $c_teacher)
            ->with('editable',$data)
            ->with('ct', $ct)
            ->with('ht', $ht)
            ->with('lt', $lt)
            ->with('mcq', $mcq)
            ->with('rt', $rt)
            ->with('term',$term)
            ->with('teacher',$teacherinfo)
            ->with('idsubject',$idsubject)
            ->with('is_submit', $is_submit)
            ->with('course_idcourseteacher',$course_idcourseteacher)
            ->with('is_course_teacher',$is_course_teacher);
    } else
    {

        $idclasssection = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
        $subjects=Subject::groupby('subject_name')->get();
        return View::make('result_management.teacher_tabulation_sheet')
            ->with('shohag_msg',$msg)
            ->with('classname', null)
            ->with('year2', null)
            ->with('class', $idclasssection)
            ->with('results', null)
            ->with('conv_marks', null)
            ->with('configs', null)
            ->with('subjectname',null)
            ->with('subjects', $subjects)
            ->with('editable',null)
            ->with('teacher',null)
            ->with('term',null)
            ->with('idsubject',null)
            ->with('is_course_teacher',null);
    }

})->before('auth');



Route::post('submitted',function()
{
    //return Input::all();
    $apterm=Input::get('term');
    $apyear=Input::get('year2');
    $apclass=Input::get('tclass');
    $apsec=Input::get('tsection');
    $idsub = Input::get('idsubject');
    $u_id=Auth::user()->email;
    $apat=date('Y-m-d h:i:s');

    $edit = TabulationSheetEditable::where('flag','=','editable')->where('term','=',$apterm)->where('academic_year','=',$apyear)->where('idsubject','=',$idsub)->where('class','=',$apclass)->where('section','=',$apsec)->get();
//$c = count($edit);
    foreach($edit as $e)
    {
        $data['flag'] = 'non_editable';
        $data['submitted_by']=$u_id;
        $data['submitted_at']=$apat;
        TabulationSheetEditable::where('idtabulation_sheet_editable','=',$e->idtabulation_sheet_editable)->update($data);
    }
    return Redirect::to('/view_marksheet')->with('shohag_msg','<font color="green">Marks Successfully Submitted to Class Teacher</font>');
});


Route::post('approved',function()
{
    //return Input::all();
    $apterm=Input::get('term');
    $apyear=Input::get('year2');
    $apclass=Input::get('tclass');
    $apsec=Input::get('tsection');
    $u_id=Auth::user()->email;
    $apat=date('Y-m-d h:i:s');

    $edit = TabulationSheetEditable::where('idcourseteacher','=',Input::get('idcourseteacher'))->where('flag','=','non_editable')->where('term','=',$apterm)->where('academic_year','=',$apyear)->where('idsubject','=',Input::get('idsubject'))->where('class','=',$apclass)->where('section','=',$apsec)->get();
    //$approved=


    foreach($edit as $e)
    {
        $data['flag'] = 'non_editable';
        $data['approved_by']=$u_id;
        $data['approved_at']=$apat;
        TabulationSheetEditable::where('idtabulation_sheet_editable','=',$e->idtabulation_sheet_editable)->update($data);
    }
    return Redirect::to('view_marksheet')->with('shohag_msg','<font color="green">Marks Approved</font>');
});

Route::post('req_change',function()
{
    //return Input::all();
    $apterm=Input::get('term');
    $apyear=Input::get('year2');
    $apclass=Input::get('tclass');
    $apsec=Input::get('tsection');
    $u_id=Auth::user()->email;
    $apat=date('Y-m-d h:i:s');

    $edit = TabulationSheetEditable::where('idcourseteacher','=',Input::get('idcourseteacher'))->where('flag','=','non_editable')->where('term','=',$apterm)->where('academic_year','=',$apyear)->where('idsubject','=',Input::get('idsubject'))->where('class','=',$apclass)->where('section','=',$apsec)->get();
    //$approved=


    foreach($edit as $e)
    {
        $data['flag'] = 'editable';
        $data['approved_by']="0";
        $data['approved_at']="0";
        TabulationSheetEditable::where('idtabulation_sheet_editable','=',$e->idtabulation_sheet_editable)->update($data);
    }
    return Redirect::to('view_marksheet')->with('shohag_msg','Request sent. Subject teacher of this subject will be able to edit marks again.');;
});



Route::post('publish',function(){
    $y = Input::get('year');
    $t = Input::get('term');
    $u_id = Input::get('user_id');


    $data['published']='Y';
    $data['published_by']=$u_id;
    $data['published_at']= date('Y-m-d h:i:s');
    PublishResult::where('term','=',$t)->where('year','=',$y)->where('approved','=','Y')->update($data);

    //$message = "Approved successfully";
    return Redirect::to('result_management/publish_result');
});





Route::post('list_st',function(){

    $classname = Input::get('cls');
    $sectionname = Input::get('sec');


 //return $classname;

  $year = date('Y')."-".(date('Y')+1);

    // return $classname;

       // $st = ClassWiseStd::where('std_class','=',$classname )->where('std_section','=',$sectionname)->where('year',$year)->get();
        $st = StudentToSectionUpdate::where('section','=',$sectionname)->where('class','=',$classname)->where('year',$year)->orderBy('st_roll')->get();

 $clas = StudentToSectionUpdate::where('section','=',$sectionname)->where('class','=',$classname)->where('year',$year)->pluck('class');

    $st_count = StudentToSectionUpdate::where('section','=',$sectionname)->where('class','=',$classname)->where('year',$year)->get();

    $male = ClassWiseStd::where('std_gender','=','Male')->where('std_class','=',$classname)->where('year',$year)->where('std_section','=',$sectionname)->get();
    $count = count($st_count);
    $male_std = count($male);
    $feml_std = $count - $male_std;
    $class_teacher = ClassTeacherInfo::where('section','=',$sectionname)->pluck('teacher_name');

$c=1;


//return $st;


    $html = '<html><body style="background-color: #d0e9c6"><center> <img src="../public/image/4d.gif" width="100" height="80"><br/><h2 style="color:blue"> UDAYAN UCHCHA MADHYAMIK BIDYALAYA</h2></center><br/>
                        <div class="widget ">

                            <div class="widget-header"  style="margin-left:15px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3>Class Name : ' . $clas . ' ('.$sectionname .') ; Class Teacher :'.$class_teacher.'</h3>
                                        <h4>Total Students: ' .$count.'  <br/>Total Male Students: ' .$male_std.'   <br/> Total Female Students: ' .$feml_std.'</h4>
                                    </div>


                                </div>
                            </div>
                            <!-- /widget-header -->



                                <table class="table table-bordered" border="1" style="margin-left:15px;border-collapse:collapse">
                                    <thead>

                                    <tr>
                                        <th style="text-align: center" width="100px">Roll</th>
                                        <th style="text-align: center">Student Name</th>
                                        <th style="text-align: center">Mothers Mobile</th>
                                        





                                    </tr>
                                    </thead>

                                    <tbody>';

                                    foreach($st as $sub){

if($sectionname  == 'TULIP-A' || $sectionname  == 'MAGNOLIA-A' || $sectionname  == 'SHIMUL' || $sectionname  == 'SHIULI' || $sectionname  == 'SHAPLA'){
                                     


                                     $html.= '<tr><td style="text-align: center">'.$c++.'</td>';
                                            
 }else{

    $html.= '<tr><td style="text-align: center">'.$sub->st_roll.'</td>';

}

  $cl = ClassWiseStd::where('std_reg_no','=',$sub->student_idstudentinfo)->pluck('std_name');
$clm = ClassWiseStd::where('std_reg_no','=',$sub->student_idstudentinfo)->pluck('mobile');


$html.='<td style="text-align: left">'.$cl.'</td>
                                            <td style="text-align: left">'."0".$clm.'</td>
                                            



                                        </tr>';
                                    }
                                 $html.='</tbody>
                                </table>



                            <!-- /widget-content -->

                        </div></body></html>';

$p_class='student_info_'.$clas.'_'.$sectionname;

    return PDF::load($html, 'A4', 'Portrait')->download($p_class);



});




Route::post('pdfcls08',function()
{
    //return Input::all();
      $classname = Input::get('classname');
    $sectionname = Input::get('sectionname');
    $subjectname = Input::get('subjectname');
    $term = Input::get('term');
    $year = Input::get('year');
    $ht = Input::get('ht');
    $ctec = Input::get('tec');
    $rt = Input::get('rt');
    $lt = Input::get('lt');
    $mt = Input::get('mt');
    $ct = Input::get('ct');


    $class_val = Addclass::where('section','=',$sectionname)->pluck('value');

    $subjects=Subject::groupby('subject_name')->get();

    $class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');

    $configuration_id=SubjectToClass::where('idclass','=',$class_section)->pluck('markconfiguration_name');
    $configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
    //  return $configuration_names;
    $results=TStudentResult::where('idclasssection','=',$class_section)
        ->where('subject','=',$subjectname)
        ->where('academic_year','=',$year)->get();
    $result=StudentResult::where('idclasssection','=',$class_section)
        ->where('subject_name','=',$subjectname)
        ->where('term','=',$term)
        ->where('Year','=',$year)->get();

    $resultMarks =StudentResult::where('idclasssection','=',$class_section)
        ->where('subject_name','=',$subjectname)
        ->where('term','=',$term)
        ->where('Year','=',$year)->get();


$results=TStudentResult::distinct()->where('idclasssection','=',$class_section)
            ->where('subject','=',$subjectname)
            ->where('academic_year','=',$year)->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 't_st_result.st_id')
            ->orderby('student_to_section_update.st_roll', 'ASC')->get();
        


    $c_teacher = CourseTeacher::where('idcourseteacher','=',$results[0]->idcourseteacher)->pluck('idteacherinfo');
    $c_teacher = TeacherInfo::where('idteacherinfo','=',$c_teacher)->pluck('teacher_name');


    $ct=0;
    $rt=0;
    $lt=0;
    $mcq=0;
    $ht=0;



    foreach ($resultMarks as $mark) {

        if ($mark->CT_Marks!=null) $ct=1;
        if ($mark->RT_Marks!=null) $rt=1;
        if ($mark->LT_Marks!=null)  $lt=1;
        if ($mark->MCQ_Marks!=null) $mcq=1;
        if ($mark->HT_Marks!=null)   $ht=1;

    }



  
if($term == 'Half Yearly') {
    foreach ($results as $mark) {

        if ($mark->h_ct != null) $ct = 1;
        if ($mark->h_ra != null) $rt = 1;
        if ($mark->h_lab != null) $lt = 1;
        if ($mark->h_mcq != null) $mcq = 1;
        if ($mark->h_ht != null) $ht = 1;

    }
}else{

    foreach ($results as $mark) {

        if ($mark->f_ct != null) $ct = 1;
        if ($mark->f_ra != null) $rt = 1;
        if ($mark->f_lab != null) $lt = 1;
        if ($mark->f_mcq != null) $mcq = 1;
        if ($mark->f_ht != null) $ht = 1;

    }

}





    $tst = TStudentResult::all();

    $html = '<html><body><div style="text-align: center;font-size:"><img type="image" src="../public/image/4d.gif"
                                                     style="height: 40px;width: 60px;">&nbsp;&nbsp;<b style="font-size: 26px; ">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</b><br/></div><br/><br/><br/>




                                               <h2 style="font-weight: bold;text-align: center">Mark Sheet </h2><hr><br/><b style="text-align: center;font-size: 16px">Class:&nbsp;'.$classname.' &nbsp;&nbsp;&nbsp;Section:&nbsp;'.$sectionname.'&nbsp;&nbsp;&nbsp;Subject:&nbsp;'.$subjectname.'&nbsp;&nbsp;&nbsp;Term:&nbsp;'.$term.'&nbsp;&nbsp;&nbsp;Course Teacher:&nbsp;'.$ctec.'</b>


                                        <br/><br/>

                                  <div class="wrap" style="width: 760px">
                                        <table class="head" border="1">

                                        <thead style="background-color: beige">
                                            <tr>
                                                <th style=" text-align: center;width:50px" >Student Roll</th>
                                                <th style=" text-align: center; width:300px;">Student Name</th>';
    

        $html.='  <th style = " text-align: center;width:80px" > Regular Assesment </th >';

        $html .= '<th style=" text-align: center;width:80px">Class Test</th>';


       $html.='<th style = " text-align: center;width:80px" > Hall Test </th >';

         $html.='<th style = " text-align: center;width:80px" > Lab</th >';

        $html .= ' <th style=" text-align: center;width:80px">MCQ</th>';
        

        $html.='<th style = " text-align: center;width:80px" > Total</th >';

    $html.='<th style="text-align: center;width:80px"> Grade</th>
                                                <th style="text-align: center;width:80px"> GPA</th>

                                            </tr>
                                        </thead>

                                            </table>

                                           <div class="inner_table">

                                                <table border="1">';

                                    $sum=0; $count=0; $cgpa=0; $total=0;

                                               // $grade = GradingTable::where('total','=',);


                   foreach($results as $result) {

                       $total_marks = $result->total;
                       $rclass = $result->class;
                       $rht = 0;
                       $rct = 0;
                       $rrt = 0;
                       $rlt = 0;
                       $rmcq = 0;
                       if ($term == "Half Yearly") {


                           if ($result->h_ra != null) $ra_marks = $result->h_ra; else $ra_marks = 0;
                           if ($result->h_ct != null) $ct_marks = $result->h_ct; else $ct_marks = 0;

                           if ($result->h_ht != null) $ht_marks = $result->h_ht; else $ht_marks = 0;
                           if ($result->h_lab != null) $lab_marks = $result->h_lab; else $lab_marks = 0;
                           if ($result->h_mcq != null) $mcq_marks = $result->h_mcq; else $mcq_marks = 0;
                           if ($result->h_total != null) $total = $result->h_total; else $total = 0;
                           $point = $result->h_gp;
                           $grade = $result->h_grade;

                       }

                       if ($term == "Final") {

                           if ($result->f_ra != null) $ra_marks = $result->f_ra; else $ra_marks = 0;
                           if ($result->f_ct != null) $ct_marks = $result->f_ct; else $ct_marks = 0;

                           if ($result->f_ht != null) $ht_marks = $result->f_ht; else $ht_marks = 0;
                           if ($result->f_lab != null) $lab_marks = $result->f_lab; else $lab_marks = 0;
                           if ($result->f_mcq != null) $mcq_marks = $result->f_mcq; else $mcq_marks = 0;
                           if ($result->f_total != null) $total = $result->f_total; else $total = 0;
                           $point = $result->f_gp;
                           $grade = $result->f_grade;

                       }
                       //$total_get_marks = ($rht + $rct + $rrt + $rlt + $rmcq);
                       $grade = GradingTable::where('total', '=', $total_marks)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();
                       //echo $result->sutdent_name." : ".$grade."--".$total_get_marks."------->";
                       $cls = $result->Class;
                       $gp = $grade->grade;
 
                      $gpa = $grade->gpa;



                       if ($cls != "Nine" && $cls != "Ten") {
                           if ($total < ($total_marks / 2)) {
                               $gpa = "0.00";
                               $gp = "F";

                           }

                       }



                       $html .= '<tr >';
                       $std = Studentinfo::where('idstudentinfo', '=', $result->st_id)->first();
                     //  $str = StudentToSectionUpdate::where('student_idstudentinfo','=',$result->st_id)->pluck('st_roll');

                       $html .= '<td style=" text-align: center;width: 50px">' . $result->st_roll . '</td>
                                                    <td style=" width:300px;">' . $std->sutdent_name . '</td>';

                          

                           $html .= '<td align="center;width:80px">' . $ra_marks . '</td>';


                           $html .= '<td align="center;width:80px">' . $ct_marks . '</td>';



                             $html .= '<td align="center;width:80px">' . $ht_marks . '</td>';
                           

                           $html .= ' <td align="center;width:80px">' . $lab_marks . '</td>';



                           $html .= '<td align="center;width:80px">' . $mcq_marks . '</td>';

                          


                           $html .= '<td style=" text-align: center;width:80px">' . $total . '</td>';


                       //$sum=$total_get_marks+$sum


                       $html .= '<td style=" text-align: center;width:80px">' . $gp . '</td>
                                                    <td style=" text-align: center;width:80px">' . $gpa . '</td>

                                                </tr>
                                                </a>';

                   }
                                       $html.='</table>


                                   <h4 style="text-align: center;margin-left:300px;font-weight: bold;"><img src="../public/image/fdcl.gif" width="28px" height="28px">&nbsp;&nbsp;Powered By : Four D Communications Limited</h4>
                                   </div></div></div></body></html>';
    return PDF::load($html, 'A3', 'potrait')->download($classname.'_'.$sectionname.'_'.$subjectname.'_pdf');

});










Route::post('pdf',function()
{
    //return Input::all();
    $classname = Input::get('classname');
    $sectionname = Input::get('sectionname');
    $subjectname = Input::get('subjectname');
    $term = Input::get('term');
    $year = Input::get('year');
    $ht = Input::get('ht');
    $ctec = Input::get('tec');
    $rt = Input::get('rt');
    $lt = Input::get('lt');
    $mt = Input::get('mt');
    $ct = Input::get('ct');

    $idsubject = Subject::where('subject_name','=',$subjectname)->pluck('idsubject');
 $class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');



    $sub = SubjectToClass::where('class','=',$classname)->where('idsubject','=',$idsubject)->pluck('markconfiguration_name');
    $cls_val = Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('value');


    $results=ConvertedMarks::where('class_id','=',$class_section)
            ->where('student_to_section_update.class',$classname)
            ->where('converted_marks.year','=',$year)
            ->where('subjectid','=',$idsubject)

      ->where('term',$term)
            ->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'converted_marks.st_id')
            ->orderby('student_to_section_update.st_roll', 'ASC')->get();
        
  $c_teacher = CourseTeacher::where('idcourseteacher','=',$results[0]->idcourseteacher)->pluck('idteacherinfo');
  $c_teacher = TeacherInfo::where('idteacherinfo','=',$c_teacher)->pluck('teacher_name');



    $html = '<html><body><div style="text-align: center;font-size:"><img type="image" src="../public/image/4d.gif"
                                                     style="height: 40px;width: 60px;">&nbsp;&nbsp;<b style="font-size: 32px; ">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</b><br/></div><br/>




                                               <h2 style="font-weight: bold;text-align: center">Mark Sheet </h2><hr><br/><div style="font-weight: bold; width: 100%; text-align: center;font-size: 20px">Class:&nbsp;'.$classname.' &nbsp;&nbsp;&nbsp;Section:&nbsp;'.$sectionname.'&nbsp;&nbsp;&nbsp;Subject:&nbsp;'.$subjectname.'&nbsp;&nbsp;&nbsp;Term:&nbsp;'.$term.'&nbsp;&nbsp;&nbsp;Course Teacher:&nbsp;'.$ctec.'</div>


                                        <br/><br/>

                                  <div class="wrap" >
                                       <table style="width:100%;margin-left:10px;border-collapse: collapse" border="1">


            <tr>
                <th width="80px"><h3>Roll</h3></th>
                <th style="width:110%"><h3>Student Name</h3></th>
                <th width="100%" style="" colspan="3">

                     <table>
                  <tr>
                  <h3 style="text-align: center"> CREATIVE</h2>
                 </tr>
                 </table>
                 <table style="border-collapse: collapse" border="1">
                  <tr>
                    <th width="85px"><h3>CT</h3></th><th width="85px"><h3>CQ</h3></th><th width="80px"><h3>TOTAL<br>(Conv.)</h3></th>
                  </tr>
                 </table>
                </th>
              <th width="100%" style="" colspan="3">

                     <table>
                  <tr>
                  <h3 style="text-align: center"> MCQ</h2>
                 </tr>
                 </table>
                 <table style="border-collapse: collapse" border="1">
                  <tr>
                    <th width="85px"><h3>CT</h3></th><th width="85px"><h3>MCQ</h3></th><th width="80px"><h3>TOTAL<br>(Conv.)</h3></th>
                  </tr>
                 </table>
                </th>

                <th width="100px" style=""><h3>Lab</h3></th>
                <th width="100px" style=""><h3>Total Marks</h3></th>
                <th width="100" style=""><h3>Grade</h3></th>
                <th width="100" style=""><h3>GPA</h3></th>
            </tr>';

    $sum=0; $count=0; $cgpa=0; $total=0;

    // $grade = GradingTable::where('total','=',);



    foreach($results as $result) {


        $std = Studentinfo::where('idstudentinfo', '=', $result->st_id)->first();

        $html .= '<tr style="font-size: 28px">
              <td width="80px" style="text-align:left">&nbsp;'.$result->st_roll.'</td>


                    <td width="40%">&nbsp;'.$std->sutdent_name.'</td><td style="text-align:center" width="26%">'.$result->cq_ct.'</td><td style="text-align:center" width="33%">'.$result->cq_total.'</td><td style="text-align:center" width="34%">'.$result->cq_conv.'</td>';

 $html .= '<td width="33%" style="text-align:center">'.$result->mcq_ct.'</td><td width="33%" style="text-align:center">'.$result->mcq_total.'</td><td width="34%" style="text-align:center">'.$result->mcq_conv.'</td><td width="80px" style="text-align:center">'.$result->practical.'</td>';


             $html .=   '</td>
                <td width="100px" style="text-align: center;font-weight:bold" >'.$result->total.'</td>
                <td width="100" style="text-align: center;font-weight:bold">'.$result->grade.'</td>
                <td width="100" style="text-align: center;font-weight:bold">'.$result->point.'</td>
            </tr>';

    }
    $html.='</table>


                                   <h4 style="text-align: center;font-weight: bold;"><img src="../public/image/fdcl.gif" width="28px" height="28px">&nbsp;&nbsp;Powered By : Four D Communications Limited</h4>


                                   </div></div></div></body></html>';
    return PDF::load($html, 'A2', 'potrait')->download($classname.'_'.$sectionname.'_'.$subjectname.'_pdf');




});


















Route::post('tabulationsheet_all', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');
    $year = Input::get('year');
    $term = Input::get('term');
    return Redirect::to('/tabulationsheet_all')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('term', $term)
        ->with('year', $year);
});

Route::get('tabulationsheet_all', function () {

    ini_set('max_execution_time', 300);
    $classname = Session::get('classname');
    $sectionname = Session::get('sectionname');
    $year = Session::get('year');
    $term = Session::get('term');
    if ($classname!=null || $sectionname!=null|| $year!=null) {


        $timereq1 = date("h")*3600 + date("i")*60 + date("s");
        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        $class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');

        //$configuration_id=SubjectToClass::where('idclass','=',$class_section)->pluck('markconfiguration_name');
        //$configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
        //  return $configuration_names;
        /* $result = StudentResult::distinct()->where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)
                    ->where('term','=',$term)->get(); */
       // $subjects = StudentResult::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)
         //   ->groupby('subject_name')->get();
        $students=StudentToSection::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)->get();
        $student_result=TStudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('academic_year','=',$year)
            ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();
        /* $student_result=StudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('Year','=',$year)
            ->where('term','=',$term)
            ->orderby('S_ID', 'ASC')->orderby('subject_name', 'ASC')->get();


        $resultMarks =StudentResult::where('idclasssection','=',$class_section)
            ->where('term','=',$term)
            ->where('Year','=',$year)->get();

       $resultClassTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('CT_Marks')->get();
        $resultRegularAssesment=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('RT_Marks')->get();
        $resultLabTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('LT_Marks')->get();
        $mcqTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('MCQ_Marks')->get();
        $hallTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('HT_Marks')->get();

        $ct=0;
        $rt=0;
        $lt=0;
        $mcq=0;
        $ht=0;


        //$grade_table = GradingTable::all();

        foreach ($resultMarks as $mark) {
            if ($mark->CT_Marks!=null) $ct=1;
            if ($mark->RT_Marks!=null) $rt=1;
            if ($mark->LT_Marks!=null)  $lt=1;
            if ($mark->MCQ_Marks!=null) $mcq=1;
            if ($mark->HT_Marks!=null)   $ht=1;

        }
*/


        return View::make('result_management.tabulation_sheet_all')
            ->with('classname', $classname)
            ->with('class', $class)
            ->with('idclasssection', $class_section)
            ->with('year', $year)
            ->with('sectionname', $sectionname)
            ->with('stu_results', $student_result)
            ->with('timereq1', $timereq1)
            ->with('students', $students)
            ->with('term', $term);
     /*   ->with('ct', $ct)
            ->with('ht', $ht)
            ->with('lt', $lt)
            ->with('mcq', $mcq)
            ->with('rt', $rt) */

    } else
    {
        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        return View::make('result_management.tabulation_sheet_all')
            ->with('classname', null)
            ->with('sectionname', null)
            ->with('idclasssection', null)
            ->with('sectionname', null)
            ->with('year', null)
            ->with('stu_results', null)
            ->with('class', $class)
            ->with('results', null)
            ->with('subjects', null)
            ->with('students', null);
    }

})->before('auth');


Route::post('view_tabulationsheet', function ()
{
    $class = Input::get('cat');
    $year = Input::get('year');
    $term = Input::get('term');
    return Redirect::to('/view_tabulationsheet')
        ->with('classname', $class)
        ->with('term', $term)
        ->with('year', $year);
});



/*
    10/11/2016 updated by Siam
*/
Route::get('view_tabulationsheet', function () {

    ini_set('max_execution_time', 300);
    $class_section = Session::get('classname');
    $classname = Addclass::where('class_id','=',$class_section)->pluck('class_name');
    $sectionname = Addclass::where('class_id','=',$class_section)->pluck('section');
    $val = Addclass::where('class_id','=',$class_section)->pluck('value');
    $year = Session::get('year');
    $term = Session::get('term');


    if ($classname != null || $term != null|| $year != null) {

        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        //$class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');
        // $class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');

        //$configuration_id=SubjectToClass::where('idclass','=',$class_section)->pluck('markconfiguration_name');
        //$configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
        //  return $configuration_names;
        $students=StudentToSection::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)->get();

        if($val<9) {
            $student_result = TStudentResult::distinct()->where('idclasssection', '=', $class_section)
                ->where('academic_year', '=', $year)->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 't_st_result.st_id')
                ->orderby('student_to_section_update.st_roll', 'ASC')->orderby('t_st_result.subject', 'ASC')->get();

        }

        else{

            $student_result = ConvertedMarks::distinct()->where('class_id', '=', $class_section)->where('term',$term)
                ->where('converted_marks.year', '=', $year)->leftjoin('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'converted_marks.st_id')
                ->orderby('student_to_section_update.st_roll', 'ASC')->orderby('converted_marks.subjectid', 'ASC')->get();

        }


 /* $student_result=TStudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('academic_year','=',$year)
            ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();


          $student_result=StudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('Year','=',$year)
            ->where('term','=',$term)
            ->orderby('S_ID', 'ASC')->orderby('subject_name', 'ASC')->get();

                $resultMarks =StudentResult::where('idclasssection','=',$class_section)
                    ->where('term','=',$term)
                    ->where('Year','=',$year)->get();

               $resultClassTest=StudentResult::where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)->select('CT_Marks')->get();
                $resultRegularAssesment=StudentResult::where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)->select('RT_Marks')->get();
                $resultLabTest=StudentResult::where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)->select('LT_Marks')->get();
                $mcqTest=StudentResult::where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)->select('MCQ_Marks')->get();
                $hallTest=StudentResult::where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)->select('HT_Marks')->get();

                $ct=0;
                $rt=0;
                $lt=0;
                $mcq=0;
                $ht=0;


                //$grade_table = GradingTable::all();

                foreach ($resultMarks as $mark) {
                    if ($mark->CT_Marks!=null) $ct=1;
                    if ($mark->RT_Marks!=null) $rt=1;
                    if ($mark->LT_Marks!=null)  $lt=1;
                    if ($mark->MCQ_Marks!=null) $mcq=1;
                    if ($mark->HT_Marks!=null)   $ht=1;

                }
        */

        if($val >= 9) {
            if ($val == 9 && $term == "Final") {
                return View::make('result_management.teacher_tabulation_sheet_all_nine_final')
                ->with('classname', $classname)
                ->with('class', $class)
                ->with('idclasssection', $class_section)
                ->with('year', $year)
                ->with('sectionname', $sectionname)
                ->with('stu_results', $student_result)
                ->with('students', $students)
                ->with('term', $term);
            } else {
                return View::make('result_management.teacher_tabulation_sheet_all')
                ->with('classname', $classname)
                ->with('class', $class)
                ->with('idclasssection', $class_section)
                ->with('year', $year)
                ->with('sectionname', $sectionname)
                ->with('stu_results', $student_result)
                ->with('students', $students)
                ->with('term', $term);
            }
            
            /*   ->with('ct', $ct)
                   ->with('ht', $ht)
                   ->with('lt', $lt)
                   ->with('mcq', $mcq)
                   ->with('rt', $rt) */
        }else{
            // classes below 9
            return View::make('result_management.teacher_tabulation_sheet_all_jnr')
                ->with('classname', $classname)
                ->with('class', $class)
                ->with('idclasssection', $class_section)
                ->with('year', $year)
                ->with('sectionname', $sectionname)
                ->with('stu_results', $student_result)
                ->with('students', $students)
                ->with('term', $term);
        }

    } else
    {
        if($val > 9) {
            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            return View::make('result_management.teacher_tabulation_sheet_all')
                ->with('classname', null)
                ->with('sectionname', null)
                ->with('idclasssection', null)
                ->with('sectionname', null)
                ->with('year', null)
                ->with('stu_results', null)
                ->with('class', $class)
                ->with('results', null)
                ->with('subjects', null)
                ->with('students', null);

        }
        else{

            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            return View::make('result_management.teacher_tabulation_sheet_all_jnr')
                ->with('classname', null)
                ->with('sectionname', null)
                ->with('idclasssection', null)
                ->with('sectionname', null)
                ->with('year', null)
                ->with('stu_results', null)
                ->with('class', $class)
                ->with('results', null)
                ->with('subjects', null)
                ->with('students', null);
        }
    }

})->before('auth');




/***************************************************** 28-07-2016 (TABULATION SHEET PDF) *********************************************/

Route::post('pdf_tabulation_sheet_all_new',function(){

    /* check for term */
    $class = Input::get('classname');
    $term = Input::get('term');
    if ($class == "NINE" && $term == "Final") {
        $st = StudentToSectionUpdate::where('section',Input::get('sectionname'))->get();
        return View::make('result_management.teachertabulation_nine_final')->with('class',Input::get('classname'))
                                                            ->with('section',Input::get('sectionname'))
                                                            ->with('idclasssection',Input::get('idclasssection'))
                                                            ->with('year',Input::get('year'))
                                                            ->with('students',$st)
                                                            ->with('term',Input::get('term'));
    } else {
        $st = StudentToSectionUpdate::where('section',Input::get('sectionname'))->get();
        return View::make('result_management.teachertabulation')->with('class',Input::get('classname'))
                                                            ->with('section',Input::get('sectionname'))
                                                            ->with('idclasssection',Input::get('idclasssection'))
                                                            ->with('year',Input::get('year'))
                                                            ->with('students',$st)
                                                            ->with('term',Input::get('term'));
    }
    
})->before('auth');



Route::post('pdf_tabulation_sheet_all_new_jnr',function(){


    $st = StudentToSectionUpdate::where('section',Input::get('sectionname'))->get();

    return View::make('result_management.teachertabulation_jnr')->with('class',Input::get('classname'))
        ->with('section',Input::get('sectionname'))
        ->with('idclasssection',Input::get('idclasssection'))
        ->with('year',Input::get('year'))
        ->with('students',$st)
        ->with('term',Input::get('term'));
})->before('auth');




/***************************************************** 28-07-2016 (TABULATION SHEET PDF) *********************************************/








Route::post('grace_management_filter', function ()
{
    $class = Input::get('sclass');
    $section = Input::get('ssec');
    $year = Input::get('syear');
    $filter = Input::get('grace');
    Session::set('filters', $filter);
    return Redirect::to('/grace_management')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('year', $year);
});

Route::post('grace_management', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');
    $year = Input::get('year');
    Session::set('filters', 0);
    return Redirect::to('/grace_management')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('year', $year);
});

Route::get('grace_management', function () {

    if(Auth::user()->type=="admin") {

        ini_set('max_execution_time', 300);
        $classname = Session::get('classname');
        $sectionname = Session::get('sectionname');
        $year = Session::get('year');
        $filter = Session::get('filters');
        if ($classname != null || $sectionname != null || $year != null) {


            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            $class_section = Addclass::where('class_name', '=', $classname)->where('section', '=', $sectionname)->pluck('class_id');

            $students=StudentToSection::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)->get();
            $rank=StudentRank::where('class','=',$classname)
                ->where('section','=',$sectionname)
                ->where('year','=',$year)
                ->where('term','=','Final')
                ->orderby('student_id')->get();


            /*$result=StudentResult::where('idclasssection','=',$class_section)
               ->where('term','=','Final')
               ->where('Year','=',$year)
               ->orderby('S_ID')->orderby('subject_name')->get(); */

            $result = TStudentResult::distinct()->where('idclasssection','=',$class_section)
                ->where('academic_year','=',$year)
                ->orderby('st_id')->orderby('subject')->get();


            return View::make('result_management.grace_management')
                ->with('classname', $classname)
                ->with('idclasssection', $class_section)
                ->with('year', $year)
                ->with('sectionname', $sectionname)
                ->with('class', $class)
                ->with('rank', $rank)
                ->with('results', $result)
                ->with('is_pub', count($result))
                ->with('students', $students)
                ->with('filters', $filter);
        } else {
            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            return View::make('result_management.grace_management')
                ->with('classname', null)
                ->with('idclasssection', null)
                ->with('year', null)
                ->with('sectionname', null)
                ->with('class', $class)
                ->with('results', null)
                ->with('students', null)
                ->with('filters', null);

        }
    }
    else return ('<div style=" font-size: 30px; color: red; margin-top: 20%; text-align: center;" > Sorry, You are not eligible to access this arena. </div>');


})->before('auth');


Route::post('pdf_tabulation_sheet_all',function()
{
    $classname = Input::get('classname');
    $sectionname = Input::get('sectionname');
    $idclasssection = Input::get('idclasssection');
    $subjects=StudentResult::where('idclasssection','=',$idclasssection)
        ->select('subject_name')->groupby('subject_name')->get();

    $students=StudentResult::where('idclasssection','=',$idclasssection)
        ->select('S_ID','sutdent_name')->groupby('S_ID')->get();

    $year = Input::get('year');

    $html =    '<table width="100%" border="0" style="border-collapse: collapse">

              <thead>
              <tr>
                 <th><div></div></th> <th colspan="5">
                 <div style="float: left; width: 33%;">Class:&nbsp;' .$classname. '</div>
                  <div style="display: inline-block; width: 25%;">Section:&nbsp;' .$sectionname. '</div></th>


              </tr>
              </thead>
              </table>
      <br/>

 <table border="1" cellspacing="0"  border="1" style="border-collapse: ">

     <tr>
       <th rowspan="2" style=" padding-left: 10px;padding-right:10px">Roll</th>
       <th rowspan="2" style=" padding-left: 10px;">Student Name</th>';
    foreach($subjects as $subject){
        $html .= '<th style=" padding-left: 10px;">' .$subject->subject_name. '</th>';
    }
    $html .= '</tr>

      <tr>';
    foreach($subjects as $subject){
        $html .= '<td>
       <table border="0" style=" table-layout: fixed;width: 220px;" style="border-collapse: ">
         <tr>
           <td style=" padding-left: 10px;border-right: 1px solid black;">RT</td>
           <td style=" padding-left: 10px; border-right: 1px solid black;">LT</td>
           <td style=" padding-left: 10px;border-right: 1px solid black;">CT</td>
           <td style=" padding-left: 10px;border-right: 1px solid black;">HT</td>
           <td style=" padding-left: 10px;10px;">MCQ</td>
         </tr>
       </table>
      </td>';
    }
    $html .= '</tr>';
    foreach($students as $student){

        $html .= '<tr>
       <td style=" padding-left: 10px;">' .$student->S_ID. '</td>
       <td style=" padding-left: 10px;">' .$student->sutdent_name. '</td>';
        foreach($subjects as $subject){
            $result=StudentResult::where('idclasssection','=',$idclasssection)
                ->where('S_ID','=',$student->S_ID)
                ->where('subject_name','=',$subject->subject_name)
                ->where('Year','=',$year)->first();



            $html .= '<td >
       <table border="0" style=" table-layout: fixed;width: 220px;height:35px" style="border-collapse: ">
         <tr>
           <td style=" padding-left: 10px;border-right: 1px solid black;">' .$result->RT_Marks. '</td>
           <td style=" padding-left: 10px;border-right: 1px solid black;">' .$result->LT_Marks. '</td>
           <td style=" padding-left: 10px;border-right: 1px solid black;">' .$result->CT_Marks. '</td>
           <td style=" padding-left: 10px;border-right: 1px solid black;">' .$result->HT_Marks. '</td>
           <td style=" padding-left: 10px;">' .$result->MCQ_Marks. '</td>
         </tr>
       </table>
      </td>';
        }
        $html .= '</tr>';
    }

    $html .= '</table>';

    $html .= '</tbody></table><center><div style="position: relative">
            <p style="position: fixed; bottom: 20px; width:100%; text-align: center">House:43, Dhanmondi, Dhaka-1205, Bangladesh<br/>Phone: 01715065800
            </p>
        </div></center></body></html>';
    return PDF::load($html, 'A4', 'portrait')->download('result_pdf');

});


Route::get('email_and_sms_management/classwisemessage', function () {
    $shohag_msg = Session::get('shohag_msg');
    $class = Addclass::groupby('class_name')->get();
    return View::make('email_and_sms_management.class_wise_message')->with('class', $class)->with('shohag_msg',$shohag_msg);
})->before('auth');
Route::post('/classwisemessage', function () {
    //  return Input::all();\
    $class = Addclass::where('class_name','=',Input::get('cat'))->where('section','=',Input::get('sub'))->first();
    $message = new MessageCL();
    $title = Input::get('title');
    $description = Input::get('description');
    $user_id = Auth::user()->user_id;
    $time = \Carbon\Carbon::now();
    $message = new MessageCL();
    $message->message_subject =$title;
    $message->message_description =$description;
    $message->idteacherinfo =$user_id;
    $message->created_at =$time;
    $idclass = $class->class_id;
    $message->idclass = $idclass;
    $message->save();

    $students = StudentToSectionUpdate::where('class','=',$class->class_name)->where('section','=',$class->section)->get();

    $idmessage = MessageCL::orderBy('idmessage', 'desc')->first();


    if ($students!='[]') {

        foreach ($students as $student) {
            $messageflag = new FlagMessage();
            $messageflag->idmessage =$idmessage->idmessage;
            $messageflag->idstudentinfo=$student->student_idstudentinfo;
            $messageflag->flag='unseen';
            $messageflag->save();

        }
        $shohag_msg = "Message Successfuly Sent.";

    }
    else $shohag_msg = "";




    return Redirect::to('email_and_sms_management/classwisemessage')->with('shohag_msg',$shohag_msg);
});

Route::get('showmessage',function()
{

    $message = FlagMessage::where('idstudentinfo','=',Auth::user()->email)->orderBy('idmessage','desc')->get();
    return View::make('email_and_sms_management.showmessage')->with('messages',$message);
})->before('auth');
Route::get('message/{id}/{flag}',function($id,$flag)
{
    if ($flag=="unseen") {
        FlagMessage::where('idmessage', $id)->where('idstudentinfo', Auth::user()->email)->update(array('flag' =>'seen'));
    }


    return View::make('email_and_sms_management.individual_message')->with('id',$id)->with('flag',$flag);
})->before('auth');


Route::get('report_card',function()
{
    $idstudent = '70';
    $st= Studentinfo::where('idstudentinfo','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->get();
    return View::make('result_management.report_card')->with('student_name',$student_name)->with('classsection',$classsection)->with('result',$result);
})->before('auth');

Route::post('report_card',function()
{
    $idstudent = '70';
    $st= Studentinfo::where('idstudentinfo','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->get();
    $html = '<html><head>
					</head>
							<body>
							<table>
							<tr>
							<td width="100px;"><img src="public/image/4d.gif" height="50px;" width="50px;"></td>
							<td width="100px;"></td>
							<td width="500px;" style="text-align: center"><h2>'.Config::get('schoolname.school').'</h2></td>
</tr>
</table><br/><br/>
                      						<table>
							<tr style="background-color: #ededed;">
							<td width="50px;"></td>
							<td width="800px;"><b>Student Name </b>: '.$student_name.'</td>
</tr>
</table>
		<table>';
    if($classsection!="") {
        $html .= '
					<tr style="background-color: #ededed;">
							<td width="50px;"></td>
							<td width="275px;"><b>Class </b>: '.$classsection->class.'</td>
							<td width="275px;"><b>Section </b>: '.$classsection->section.'</td>
							<td width="250px;"><b>Roll </b>: 117</td>
</tr>

			<tr style="background-color: #ededed;">
							<td width="50px;"></td>
							<td width="275px;"><b>Shift </b>: '.$classsection->shift.'</td>
							<td width="275px;"><b>Session </b>: '.AcademicYear::orderBy('academic_year','DESC')->first()->academic_year.'</td>
							<td width="250px;"><b>Term </b>: Final</td>
</tr>';
    }
    else
    {
        $html .= '
					<tr style="background-color: #ededed;">
							<td width="50px;"></td>
							<td width="275px;"><b>Class </b>: </td>
							<td width="275px;"><b>Section </b>: </td>
							<td width="250px;"><b>Roll </b>: 117</td>
</tr>

			<tr style="background-color: #ededed;">
							<td width="50px;"></td>
							<td width="275px;"><b>Shift </b>: </td>
							<td width="275px;"><b>Session </b>: '.AcademicYear::orderBy('academic_year','DESC')->first()->academic_year.'</td>
							<td width="250px;"><b>Term </b>: Final</td>
</tr>';
    }

    $html .='</table><br/><br/>
				<table width="100%">
				<tr>
				<td valign="top" width="500px;">
				<table style="border: 1px solid black;text-align: center;border-collapse: collapse;background-color: #CCFF33;">
                                            <thead>
                                            <tr>
                                                <th width="300px;"  style="border: 1px solid black;">Subject</th>
                                                <th width="100px;"  style="border: 1px solid black;">Mark</th>
                                                <th width="100px;"   style="border: 1px solid black;">Grade</th>
                                            </tr>
                                            </thead>
                                            <tbody>';
    foreach($result as $r){
        $html .='    <tr>
                                                <td   style="border: 1px solid black;">'.$r->subject_name.'</td>
                                                <td  style="border: 1px solid black;">'.$r->HT_Marks.'</td>
                                                <td  style="border: 1px solid black;">4.75</td>
                                            </tr>';}
    $html .='      </tbody>
                                            <tfoot>
                                            <tr>
                                                <th  style="border: 1px solid black;">Total</th>
                                                <th  style="border: 1px solid black;">723</th>
                                                <th  style="border: 1px solid black;">4.35</th>
                                            </tr>
                                            </tfoot>
                                        </table>
</td>
				<td width="200px;">
			<div style="float: right; width:200px;border:1px solid;background-color: #33AD33">
<center><b>Remarks</b></center>
<hr/>
<div>This have to be verified by guardian and class teacher</div>
<hr/>
<table>
<tr>
<td><br/><br/>___________</td>
<td></td>
<td><br/><br/>___________</td>
</tr>
<tr>
<td>Guardian</td>
<td></td>
<td>Class Teacher</td>
</tr>
</table>
</div>

                </td>
                </tr>
               </table>
<center><div style="position: relative">
            <p style="position: fixed; bottom: 20px; width:100%; text-align: center">House:43, Dhanmondi, Dhaka-1205, Bangladesh<br/>Phone: 01715065800
            </p>
        </div></center>
</body></html>';
    return PDF::load($html, 'A4', 'portrait')->show();

});

Route::get('result_management/search_report_card',function()
{

    if(Auth::user()->type=="admin") {

        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        $search_class = Session::get('src_class');
        $search_section = Session::get('src_section');


        $term = PublishResult::where('published','=','Y')->where('term','=','Half Yearly')->where('class','=',$search_class)->first();
        
        $y= date('Y'); $yn= date('Y')+1;
        $current_year =$y."-".$yn;
        $term_count= count($term);
        if(!$term_count) $current_term = "Half Yearly"; else $current_term = "Final";
        $classes = ClassTeacher::where('academic_year','=',$current_year)->get();

        return View::make('result_management.search_report_card')->with('pterm',$current_term)
            ->with('pyear',$current_year)
            ->with('classes',$classes)
            ->with('class',$class)
            ->with('search_class',$search_class)
            ->with('search_section',$search_section);


    }
    else return ('<div style=" font-size: 30px; color: red; margin-top: 20%; text-align: center;" > Sorry, You are not eligible to access this arena. </div>');

})->before('auth');


Route::post('result_management/search_report_card',function()
{
    //return Input::all();
    $class = Input::get('cat');
    $sec = Input::get('sub');

    return Redirect::to('/result_management/search_report_card')->with('src_class', $class)->with('src_section', $sec);
});


Route::get('result_management/st_report_card2',function()
{
    $year = Session::get('year');
    $term = Session::get('term');
    $class_name = Session::get('class_name');
    $section = Session::get('section');
    $student_id = Session::get('student_id');

    if($section!=null )
    {
        //if($section=='all')
       // {
            $student_info = StudentToSectionUpdate::where('section','=',$section)->get();
       // }
       /* else
        {
            $classsection = Addclass::where('class_name','=',$class_name)->where('section','=',$section)->first();
            if($classsection!="")
            {
                $student_info = TStudentResult::where('idclasssection','=',$classsection->class_id)->where('academic_year','=',$year)->groupBY('st_id')->get();
            }
            else
            {
                $student_info = null;
            }
        }*/
    }

/*
    elseif($student_id!=null)
    {
        $idstudent = Studentinfo::where('registration_id','=',$student_id)->first();
        if($idstudent!="")
            $student_info = TStudentResult::where('st_id','=',$idstudent->idstudentinfo)->where('academic_year','=',$year)->groupBY('st_id')->get();
        else
            $student_info = null;
    }
*/

    else
{
        $student_info = null;
        $section = null;
}
    $courseteacher = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->pluck('idclasssection');

    $class = Addclass::groupBy('class_name')->where('class_id','=',$courseteacher)->get();
   $class_name = Addclass::groupBy('class_name')->where('class_id','=',$courseteacher)->pluck('class_name');
   $section = Addclass::groupBy('class_name')->where('class_id','=',$courseteacher)->pluck('section');

   // $student_info = StudentToSectionUpdate::where('class','=',$class_name)->where('section','=',$section)->get();

    

       return View::make('result_management.st_report_card2')->with('class',$class_name)->with('sec',$section)->with('students',$student_info)->with('year12',$year)->with('term12',$term)->with('cor',$courseteacher);
})->before('auth');



/*************************** 12  07 2016 ****************************/

Route::get('reportcard_management/getfile/{class}/{sec}/{term}/{year}','PdfControllerC@pdf')->before('auth');

Route::get('reportcard_management/getfile12/{class}/{sec}/{term}/{year}','PdfControllerC@pdf')->before('auth');



/*************************** 12  07 2016 ****************************/


Route::get('pdfall/{term}', 'PdfController@pdf');

Route::get('reportcard_management/getfile/{reportid}','ReportsController@download')->before('auth');

Route::get('st_reportcard_management/getfile/{reportid}/{year}/{term}','ReportsController@downloadst')->before('auth');



Route::post('result_management/st_report_card2',function()
{
 //   return Input::all();

// return Input::get('student_id');

    return Redirect::to('result_management/st_report_card2')->with('year',Input::get('year'))->with('term',Input::get('term'))->with('section',Input::get('cat'));
});








Route::get('result_management/student_report_card',function()
{
    $year = Session::get('year');
    $term = Session::get('term');
    $class_name = Session::get('class_name');
    $section = Session::get('section');
    $student_id = Auth::user()->email;
    $username = Auth::user()->username;

  $pb = PublishResult::where('class','=',$class_name)->where('section','=',$section)->where('term',$term)->where('year',$year)->where('published','=','Y')->first();

    $p = count($pb);

    if($class_name!=null&& $section!=null)
    {
        if($section=='all')
        {
            $student_info = StudentToSectionUpdate::where('class','=',$class_name)->get();
        }
        else
        {
            $classsection = Addclass::where('class_name','=',$class_name)->where('section','=',$section)->first();
            if($classsection!="")
            {
                $student_info = TStudentResult::where('idclasssection','=',$classsection->class_id)->where('st_id','=',$student_id)->groupBY('st_id')->get();
           
            }
            else
            {
                $student_info = null;
            }
        }
    }
    elseif($student_id!=null) {
        //$idstudent = Studentinfo::where('registration_id', '=', $student_id)->first();
        //if ($idstudent != "")
        $student_info = Studentinfo::where('registration_id', '=', $student_id)->where('admission_year','=',$year)->get();
        // else
        //    $student_info = null;
    }
    else
        $student_info = null;
    $class = Addclass::groupBy('class_name')->orderBy('value','ASC')->get();

    return View::make('result_management.student_report_card')->with('class',$class)->with('students',$student_info)->with('year12',$year)->with('term12',$term)->with('pub',$p);
})->before('auth');

Route::post('result_management/student_report_card',function()
{
    //return Input::all();
    return Redirect::to('result_management/student_report_card')->with('year',Input::get('year'))->with('term',Input::get('term'))->with('class_name',Input::get('cat'))->with('section',Input::get('sub'))->with('student_id',Input::get('student_id'));
});



Route::get('report12/{idstudent}/{year}/{term}/{idclasssection}',function($idstudent,$year,$term,$idclasssection)
{
     $st= Studentinfo::where('idstudentinfo','=',$idstudent)->first();

    if($st!="")
    {
        $student_name = $st->sutdent_name;
        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }

    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());
    $result = StudentResult::where('S_ID','=',$idstudent)->where('Year','=',$year)->where('term','=',$term)->get();
    $rank = StudentRank::where('student_id','=',$idstudent)->where('term','=',$term)->first();

    $tst = TStudentResult::where('st_id','=',$st_id)->get();

if($term == 'Final') {
    return View::make('result_management.report')->with('student_name', $student_name)->with('classsection', $classsection)->with('result', $result)->with('term', $term)->with('year', $year)->with('idclasssection', $idclasssection)->with('idstudent', $idstudent)->with('st_roll', $st_roll)->with('rank', $rank)->with('std_no', $stdno)->with('stid', $st_id)->with('tst', $tst);
}else{

    return View::make('result_management.report_hy')->with('student_name', $student_name)->with('classsection', $classsection)->with('result', $result)->with('term', $term)->with('year', $year)->with('idclasssection', $idclasssection)->with('idstudent', $idstudent)->with('st_roll', $st_roll)->with('rank', $rank)->with('std_no', $stdno)->with('stid', $st_id)->with('tst', $tst);

}
})->before('auth');



/*

Route::post('report',function()
{
    //return Input::all();
    $idstudent = Input::get('sid');
    $idclasssection = Input::get('idclasssection');
    $term = Input::get('term');
    $year = Input::get('year');

    $st= Studentinfo::where('idstudentinfo','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;
      
        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->where('year','=',$year)->where('term','=',$term)->get();
    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());

    $sum=0;$count=0;$cgpa=0;
    $html = '<html>
<head>
</head>
<body>
    <div style="margin-left: auto;margin-right: auto;width: 970px;background-color: #deeaf6">
        <div style="width: 160px;float: left;margin-left: 10px;margin-top: 25px">';

          

   
$im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

$imcnt = count($im);

if($imcnt!=0){

 $html.='<img src="../public/image/maleandfemale.jpg" width="150" height="150">';

}
else{


        
 $html.='<img src="../public/uploads/'. $st_id .'.PNG" width="150" height="150">';

 }


$sr = StudentToSectionUpdate::where('student_idstudentinfo','=',$st_id)->pluck('st_roll');


$html.='<p style="text-align: center; margin-top: 5px;">ID:'.$st_id.'</p>
      </div>
      <div style="width: 80px; height:80px; float: left;" >

      </div>

      <div style="width: 550px;float: left;text-align: center" >
          <img src="../public/image/4d.gif" width="112px" height="68px">&nbsp;<h2 >'. Config::get('schoolname.school').'</h2>
          <h3>Progress Report</h3>
          <p ><b>Academic Year :</b>'.$year.'</p>
          <p ><b>Term :</b>'.$term.'</p>

      </div>

    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <table style="background-color: #f7cbac">
            <tr>
                <td width="200px"><b>Roll :</b> '.$sr.'</td>
                <td width="350px"><b>Name :</b> '.$student_name.'</td>
                <td width="200px"><b>Class :</b> '.$classsection->class_name.'</td>
                <td width="200px"><b>Section :</b> '.$classsection->section.'</td>
            </tr>
        </table>
         </div>

               <div style="margin-left: auto;margin-right: auto;width: 970px;">
               <table>
               <tr>
              <td style="width: 560px;background-color: #dbdbdb">
                <table style="text-align: center;">
                    <thead>
                    <tr>
                        <th width="150" style="text-align: left;">Subject Name</th>
                        <th width="70">Total Marks</th>
                        <th width="70">Obtain Marks</th>
                        <th width="70">Grade</th>
                        <th width="70">GPA</th>
                    </tr>
                    </thead>
                    <tbody>';
                 $sum=0; $count=0; $cgpa=0;

                    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();

     foreach($tst as $r) {


         $html .= '<tr>
                                    <td style="text-align: left;border:1px solid">' . $r->subject . '</td>
                                    <td style="border: 1px solid;">' . $r->total . '</td>
                                    <td style="border: 1px solid;">' . $r->h_total . '</td>';

         $sum = $sum + $r->h_total;
         $cgpa = $cgpa + $r->h_gp;

         $count++;

         $html .= '<td style="border: 1px solid;">' . $r->h_grade . '</td>


                                    <td style="border: 1px solid;">' . $r->h_gp . '</td>


                                </tr>




                    </tbody>';

     }
                  $html.='<tfoot>
                    <tr>
                        <td></td>
                        <td>Total :</td>
                        <td><b>'.$sum.'</b></td>
                        <td>GPA :</td>
                        <td><b>'.$st_rank->cgpa.'</b></td>
                    </tr>
                    <tr>
                        <td></td>

                        <td></td>
                    </tr>
                    </tfoot>
                </table>

</td>
<td  style="width:360px;background-color: beige">
            <table width="360px;">
                  <tr>
                        <td></td>

                        <td>Rank</td> <td style="border: 1px solid;text-align: center">'.$st_rank->rank.' </td>
                    </tr>
                     <tr>

                        <td></td>
                        <td>Grade</td> <td style="border: 1px solid;text-align: center">'.$st_rank->grade.' </td>
                    </tr>
                     <tr>

                        <td></td>
                        <td>No. Of Student</td> <td style="border: 1px solid;text-align: center">'.$stdno.' </td>
                    </tr>
                      <tr>

                        <td></td>
                        <td>Days Attended</td> <td style="border: 1px solid;text-align: center">N/A </td>
                    </tr>
                      <tr>

                        <td></td>
                        <td>Merit</td> <td style="border: 1px solid;text-align: center">'.$st_rank->counter_position.' </td><td></td>
                    </tr>

            </table>
</td>
</tr>
</table>
           </div>
        <div style="width: 970px;margin-left: auto;margin-right: auto;background-color: honeydew">
            <table width="100%" style="text-align: center;">
                <thead>
                <tr>
                <th width="360px" style="text-align: left;"><br/><br/>

                  <h3 style="margin-top: 1px;"> <b style="font-size:18px;"> Remarks :</b> '.$st_rank->comment.'</h3></th>
                <th width="200px">
                    <br/><br/><br/><br/>
                    <hr style="width: 150px;"/>
                    <p>Headmaster Signature</p>
                </th>

                <th width="200px"> <br/><br/><br/><br/>
                    <hr style="width: 150px;"/>
                    <p>Class Teacher Signature</p></th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <td colspan="4"><br/><img src="../public/image/fdcl.gif" width="24px" height="24px" align="top">&nbsp;&nbsp;Powered By : Four D Communications Limited, 2015<br/></td>
                </tr>
                </tbody>
                <tbody>
            </table>
        </div>

</body>
</html>';
    return PDF::load($html, 'A3', 'potrait')->download(''.$student_name.'');


});

*/




/************************* REPORT CARD ***************************/



/*

Route::post('report',function()
{
    //return Input::all();
    $idstudent = Input::get('sid');
    $idclasssection = Input::get('idclasssection');
    $term = Input::get('term');
    $year = Input::get('year');

    $st= Studentinfo::where('idstudentinfo','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;

        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->where('year','=',$year)->where('term','=',$term)->get();
    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());

    $sum=0;$count=0;$cgpa=0;
    $html = '<html>
<head>
</head>
<body>
<br/><br/><br/>
    <div style="margin-left: auto;margin-right: auto;width: 100%;background-color: #deeaf6">
        <div style="width: 160px;float: left;margin-left: 10px;margin-top: 25px">';




    $im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

    $imcnt = count($im);

    if($imcnt!=0){

        $html.='<img src="../public/image/maleandfemale.jpg" width="150" height="150">';

    }
    else{



        $html.='<img src="../public/uploads/'. $st_id .'.PNG" width="150" height="150">';

    }


    $html.='<p style="text-align: center;background-color: #CCC0DA; margin-top: 5px;">ID:'.$st_id.'</p>
      </div>


      <div style="width: 100%;text-align: center;margin-right:20px">
          <img src="../public/image/4d.gif" width="118px" height="85px">&nbsp;<br/><div style="margin-right:50px;margin-top:10px;font-weight:bold;font-size:40px">'. Config::get('schoolname.school').'</div>
          <h2 style="text-align:center">Progress Report</h2>
          <h2 style="margin-left:10px"> Term :' . $term .'</h2>


      </div>
<br/>
          <table width="100%" height="10px" style="background-color: #f7cbac">
        <tr>
            <td width="200px"></td>
            <td width="340px"></td>
            <td width="200px"></td>
            <td width="200px"></td>
        </tr>
    </table>
         </div>

<div style="margin-left: auto;minheight:400px;margin-right: auto;width: 100%;background-color:cornsilk">

    <br/>
<table>

    <tr>

    <td width="800px" style="padding-left:3px;background-color:#d8e4bc">
    <table style="padding-left: 3px;text-align:center;font-weight: bold;border-collapse: collapse;border-radius:2px" border="1">
';



    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$st_id)->first();

    $sn = Studentinfo::where('registration_id','=',$st_id)->pluck('sutdent_name');


    $html.='


         <tr >
            <td width="250px" ><h2>Name</h2></td> <td style="letter-spacing:3px" width="660px" style="padding-left: 5px"><h2>'.$sn.'</h2></td>

        </tr>



        <tr>
            <td width="250px" ><h2>Class</h2></td> <td  width="660px" style="padding-left: 5px"><h2>'.$s->class.'</h2></td>

        </tr>

        <tr>
            <td width="250px" ><h2>Section</h2></td> <td  width="660px" style="padding-left: 5px"><h2>'.$s->section.'</h2></td>

        </tr>

        <tr>
            <td width="250px" ><h2>Class Roll</h2></td> <td  width="660px" style="padding-left: 5px" ><h2>'.$s->st_roll.'</h2></td>

        </tr>


        <tr>
           <td width="250px" ><h2>Student ID</h2></td> <td  width="660px" style="padding-left: 5px"><h2>'.$st_id.'</h2></td>

        </tr>

        <tr>
            <td width="250px" ><h2>Session</h2></td> <td  width="660px" style="padding-left: 5px"><h2>'.$s->year.'</h2></td>

        </tr>

        <tr>

            <td width="250px" ><h2>Version</h2></td>';

    if($s->class == 'SHISHU-EV') {

        $html .= '<td  style="padding-left: 5px"><h2>ENGLISH</h2></td>';

    }else{
        $html.='<td  style="padding-left: 5px"><h2>BANGLA</h2></td>';

    }

    $html.='</tr>
        <tr>
            <td width="250px"><h2>Shift</h2></td> <td  width="660px" style="padding-left: 5px"><h2>'.$s->shift.'</h2></td>

        </tr>




    </table>
</td>


    <td width="490px" style="padding-left:100px">
    <table style="border-collapse:collapse;text-align:center;background-color:#f2dcdb" border="1">

        <tr style="font-weight:bold">
           <td width="160px" ><h2>Grade Interval</h2></td> <td  width="140px"><h2>Letter Grade</h2></td><td width="140px" ><h2>Grade Point</h2></td>

        </tr>
      <tr>
           <td width="160px" ><h2>80 - 100</h2></td> <td  width="140px"><h2>A+</h2></td><td width="140px" ><h2>5</h2></td>

     </tr>

         <tr >
           <td width="160px" ><h2>70 - 79</h2></td> <td  width="140px"><h2>A</h2></td><td width="140px" ><h2>4</h2></td>

        </tr>

        <tr>
           <td width="160px" ><h2>60 - 69</h2></td> <td  width="140px"><h2>A-</h2></td><td width="140px" ><h2>3.5</h2></td>

        </tr>

        <tr>
           <td width="160px" ><h2>50 - 59</h2></td> <td  width="140px"><h2>B</h2></td><td width="140px" ><h2>3</h2></td>

        </tr>

        <tr>
           <td width="160px" ><h2>40 - 49</h2></td> <td  width="140px"><h2>C</h2></td><td width="140px" ><h2>2</h2></td>

        </tr>
      <tr>
           <td width="160px" ><h2>33 - 39</h2></td> <td  width="140px"><h2>D</h2></td><td width="140px" ><h2>1</h2></td>

        </tr>
       <tr>
           <td width="160px" ><h2>00 - 32</h2></td> <td  width="140px"><h2>F</h2></td><td width="140px" ><h2>0</h2></td>

        </tr>



    </table>
</td>


</tr>
</table>

<br/>
               <table>
               <tr>
              <td style="width: 900px;background-color: #f2f2f2;">
                <table style="padding:5px">
                    <thead>
                    <tr>
                        <th width="200"  style="text-align: center;border:1px solid"><h2>&nbsp;&nbsp;&nbsp;Subject Name</h2></th>
                        <th width="110" style="text-align: left;border:1px solid"><h2>Total Marks</h2></th>
                        <th width="110" style="text-align: left;border:1px solid"><h2>Obtain Marks</h2></th>
                        <th width="110" style="text-align: center;border:1px solid"><h2>Grade</th></h2></th>
                        <th width="110" style="text-align: center;border:1px solid"><h2>GPA</h2></th>
                    </tr>
                    </thead>
                    <tbody>';
    $sum=0; $count=0; $cgpa=0;

    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();

    foreach($tst as $r) {


        $html .= '<tr>
                                    <td width="250" style="border:1px solid;margin-left:10px"><h2>&nbsp;&nbsp;'."".$r->subject.'</h2></td>
                                    <td width="110" style="border: 1px solid;text-align:center"><h2>' . $r->total . '</h2></td>
                                    <td width="110" style="border: 1px solid;text-align:center"><h2>' . $r->h_total . '</h2></td>';

        $sum = $sum + $r->h_total;
        $cgpa = $cgpa + $r->h_gp;

        $count++;

        $html .= '<td width="110" style="border: 1px solid;text-align:center"><h2>' . $r->h_grade . '</h2></td>


                                    <td width="110" style="border: 1px solid;text-align:center"><h2>' . $r->h_gp . '</h2></td>


                                </tr>




                    </tbody>';

    }
    $html.='<tfoot>
                    <tr>
                        <td style="border:1px solid"></td>
                        <td style="border:1px solid;text-align:center"><h3>Total :</h3></td>
                        <td style="border:1px solid;text-align:center"><b><h2>'.$sum.'</h2></b></td>
                        <td style="border:1px solid;text-align:center"><h3>GPA :</h3></td>
                        <td style="border:1px solid;text-align:center"><b><h2>'.$st_rank->cgpa.'</h2></b></td>
                    </tr>
                    <tr>
                        <td></td>

                        <td></td>
                    </tr>
                    </tfoot>
                </table>

</td>
<td  style="width:493px;padding-left:35px">
            <table width="300px" style=";background-color: #e4dfec">
                  <tr>
                        <td></td>

                        <td width="100px" ><b><h2>Rank</h2></b></td> <td width="150px"  style="border: 1px solid;text-align: center"><h2>'.$st_rank->rank.'</h2> </td>
                    </tr>
                     <tr>

                        <td></td>
                        <td width="200px" ><b><h2>Grade</h2></b></td> <td width="200px"  style="border: 1px solid;text-align: center"><h2>'.$st_rank->grade.'</h2></td>
                    </tr>
                     <tr>

                        <td></td>
                        <td width="200px" ><b><h2>No. Of Student</h2></b></td> <td width="200px"  style="border: 1px solid;text-align: center"><h2>'.$stdno.'</h2></td>
                    </tr>
                      <tr>

                        <td></td>
                        <td width="200px" ><b><h2>Days Attended</h2></b></td> <td width="200px"  style="border: 1px solid;text-align: center"><h2>N/A</h2></td>
                    </tr>
                      <tr>

                        <td></td>
                        <td width="200px" ><b><h2>Merit</h2></b></td> <td width="200px"  style="border: 1px solid;text-align: center"><h2>'.$st_rank->counter_position.'</h2></td><td></td>
                    </tr>

            </table>
</td>
</tr>
</table>
           </div>
        <div style="width:100%;margin-left: auto;margin-right: auto;background-color: honeydew">
        <br/><br/>
            <table width="100%" style="text-align: center;">
            <tr>

        <h2 style="margin-top: 1px;border:1px solid;padding:10px"> <b> Remarks :</b> '.$st_rank->comment.'</h2>
         </tr>

            </table>


            <table width="100%" style="background-color: #b7dee8">
<br/><br/>

<tr>
                <th width="200px">
                    <br/><br/><br/><br/>
                    <hr style="width: 220px;"/>
                    <h2>Principal'."'".'s Signature</h2>
                </th>

                <th width="200px"> <br/><br/><br/><br/>
                    <hr style="width: 220px;"/>
                    <h2>Class Teacher'."'".'s Signature</h2>

                    </th>

                       <th width="200px"> <br/><br/><br/><br/>
                    <hr style="width: 220px;"/>
                    <h2>Guardian'."'".'s Signature</h2>

                    </th>
                               </tr>
            </table>


            <table width="100%">

            <tr>
                    <br/><h4 style="text-align:center"><img src="../public/image/fdcl.gif" width="24px" height="24px" align="top">&nbsp;&nbsp;Powered By : Four D Communications Limited<br/></h4>
                </tr>
            </table>

        </div>

</body>
</html>';
    return PDF::load($html, 'A2', 'potrait')->show(''.$student_name.'');


});


*/



/*


Route::post('report',function()
{
    //return Input::all();
    $idstudent = Input::get('sid');
    $idclasssection = Input::get('idclasssection');
    $term = Input::get('term');
    $year = Input::get('year');

    $st= Studentinfo::where('idstudentinfo','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;

        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->where('year','=',$year)->where('term','=',$term)->get();
    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());

    $sum=0;$count=0;$cgpa=0;
    $html = '<html>
<head>
</head>
<body>
<br/><br/>
<font face="segoe ui">
    <div style="margin-left: auto;margin-right: auto;width: 100%;background-color:#fefff1">
        <div style="width: 160px;float: left;margin-left: 12px;margin-top: 25px">';




    $im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

    $imcnt = count($im);

    if($imcnt!=0){

        $html.='<img src="../public/image/maleandfemale.jpg" width="150" height="150">';

    }
    else{



        $html.='<img src="../public/uploads/'. $st_id .'.PNG" width="150" height="150">';

    }


    $html.='<p style="text-align: center;background-color: #CCC0DA; margin-top: 5px;">ID:'.$st_id.'</p>
      </div>


      <div style="width: 100%;text-align: center;margin-right:20px">
          <img style="margin-left:-100px" src="../public/image/4d.gif" width="128px" height="95px">&nbsp;<br/><div style="margin-right:55px;margin-top:10px;font-family:Tahoma;font-weight:bold;font-size:40px">'. Config::get('schoolname.school').'</div>
          <h1 style="margin-left:-100px">Progress Report</h1>
          <h1 style="margin-left:70px"> Term :' . $term .'</h1>


      </div>
<br/>

         </div>

<div style="margin-left: auto;min-height:400px;margin-right: auto;width: 100%;background-color:#fefff1">

    <br/>
<table style="border-radius:5px">

    <tr>

    <td width="800px" >
    <table style="padding-left: 3px;border-collapse: collapse" border="1">
';



    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$st_id)->first();

    $sn = Studentinfo::where('registration_id','=',$st_id)->pluck('sutdent_name');


    $html.='


         <tr >
            <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Name</p></td> <td style="letter-spacing:3px" width="660px" style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$sn.'</p></td>

        </tr>



        <tr>
            <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Class</p></td> <td  width="660px" style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$s->class.'</p></td>

        </tr>

        <tr>
            <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Section</p></td> <td  width="660px" style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$s->section.'</p></td>

        </tr>

        <tr>
            <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Class Roll</p></td> <td  width="660px" style="padding-left: 5px" ><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$s->st_roll.'</p></td>

        </tr>


        <tr>
           <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Student ID</p></td> <td  width="660px" style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$st_id.'</p></td>

        </tr>

        <tr>
            <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Session</p></td> <td  width="660px" style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$s->year.'</p></td>

        </tr>

        <tr>

            <td width="250px" ><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Version</p></td>';

    if($s->class == 'SHISHU-EV') {

        $html .= '<td  style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;ENGLISH</p></td>';

    }else{
        $html.='<td  style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;BANGLA</p></td>';

    }

    $html.='</tr>
        <tr>
            <td width="250px"><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Shift</p></td> <td  width="660px" style="padding-left: 5px"><p style="font-size:20px;letter-spacing: 5px">&nbsp;&nbsp;'.$s->shift.'</p></td>

        </tr>




    </table>
</td>


    <td width="480px" style="padding-left:80px;background-color:#fefff1">
    <table style="text-align:center" border="1" >

        <tr style="background-color:#0d6895;color:white;font-weight:bold">
           <td width="160px" ><p>Grade Interval</p> <td width="140px"><p>Letter Grade</p></td><td  width="140px" ><p>Grade Point</p></td>

        </tr>
      <tr >
           <td width="160px" ><p style="font-weight:bold;font-size:16px">80 - 100</p></td> <td  width="140px"><p style="font-size:16px">A+</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">5</p></td>

     </tr>

         <tr style="background-color: ">
           <td width="160px" ><p style="font-weight:bold;font-size:16px">70 - 79</p></td> <td  width="140px"><p style="font-size:16px">A</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">4</p></td>

        </tr>

        <tr style="background-color: ">
           <td width="160px" ><p style="font-weight:bold;font-size:16px">60 - 69</p></td> <td  width="140px"><p style="font-size:16px">A-</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">3.5</p></td>

        </tr>

        <tr style="background-color: ">
           <td width="160px" ><p style="font-weight:bold;font-size:16px">50 - 59</p></td> <td  width="140px"><p style="font-size:16px">B</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">3</p></td>

        </tr>

        <tr style="background-color: ">
           <td width="160px" ><p style="font-weight:bold;font-size:16px">40 - 49</p></td> <td  width="140px"><p style="font-size:16px">C</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">2</p></td>

        </tr>
      <tr style="background-color: ">
           <td width="160px" ><p style="font-weight:bold;font-size:16px">33 - 39</p></td> <td  width="140px"><p style="font-size:16px">D</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">1</p></td>

        </tr>
       <tr style="background-color: ">
           <td width="160px" ><p style="font-weight:bold;font-size:16px">00 - 32</p></td> <td  width="140px"><p style="font-size:16px">F</p></td><td width="140px" ><p style="font-weight:bold;font-size:18px">0</p></td>

        </tr>




    </table>
</td>


</tr>
</table>

<br/>
               <table>
               <tr>
              <td style="width: 800px;">
                <table style="padding:2px">
                    <thead>
                    <tr>
                        <th width="220"  style="text-align: center;border:1px solid"><h2>&nbsp;&nbsp;&nbsp;Subject Name</h2></th>
                        <th width="110" style="text-align: center;border:1px solid"><h2>Total Marks</h2></th>
                        <th width="110" style="text-align: left;border:1px solid"><h2>Obtain Marks</h2></th>
                        <th width="60" style="text-align: center;border:1px solid"><h2>Grade</h2></th>
                        <th width="60" style="text-align: center;border:1px solid"><h2>GPA</h2></th>
                    </tr>
                    </thead>
                    <tbody>';
    $sum=0; $count=0; $cgpa=0;

    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();

    foreach($tst as $r) {


        $html .= '<tr>
                                    <td width="250" style="border:1px solid;margin-left:10px"><h2 style="font-weight:bold ">&nbsp;&nbsp;'."".$r->subject.'</h2></td>
                                    <td width="110" style="border: 1px solid;text-align:center"><p style="font-size:20px;letter-spacing: 5px">' . $r->total . '</p></td>
                                    <td width="110" style="border: 1px solid;text-align:center"><p style="font-size:20px;letter-spacing: 5px">' . $r->h_total . '</p></td>';

        $sum = $sum + $r->h_total;
        $cgpa = $cgpa + $r->h_gp;

        $count++;

        $html .= '<td width="110" style="border: 1px solid;text-align:center"><p style="font-size:20px;letter-spacing: 5px">' . $r->h_grade . '</p></td>


                                    <td width="110" style="border: 1px solid;text-align:center"><h2>' . $r->h_gp . '</h2></td>


                                </tr>




                    </tbody>';

    }
    $html.='<tfoot>
                    <tr>
                        <td style="border:1px solid"></td>
                        <td style="border:1px solid;text-align:center"><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;Total :</p></td>
                        <td style="border:1px solid;text-align:center"><b><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;'.$sum.'</p></b></td>
                        <td style="border:1px solid;text-align:center"><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;GPA :</p></td>
                        <td style="border:1px solid;text-align:center"><b><p style="font-size:24px;font-weight: bold">&nbsp;&nbsp;'.$st_rank->cgpa.'</p></b></td>
                    </tr>
                    <tr>
                        <td></td>

                        <td></td>
                    </tr>
                    </tfoot>
                </table>

</td>
<td  style="width:493px;padding-left:38px;background-color:#fefff1">
            <table>
                  <tr>
                        <td></td>

                        <td width="100px" style="border: 1px solid;font-size:20px;font-weight:bold" ><p>&nbsp;&nbsp;Rank</p></td> <td width="150px"  style="border: 1px solid;text-align: center;font-size:25px"><p>'.$st_rank->rank.'</p> </td>
                    </tr>
                     <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;font-size:20px;font-weight:bold"><p>&nbsp;&nbsp;Grade</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:25px"><p>'.$st_rank->grade.'</p></td>
                    </tr>
                     <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;font-size:20px;font-weight:bold" ><p>&nbsp;No. Of Student</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:25px"><p>'.$stdno.'</p></td>
                    </tr>
                      <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;font-size:20px;font-weight:bold"><p>&nbsp;Days Attended</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:25px"><p>N/A</p></td>
                    </tr>
                      <tr>

                        <td></td>
                        <td width="200px" style="border: 1px solid;font-size:20px;font-weight:bold"><p>&nbsp;&nbsp;Merit</p></td> <td width="200px"  style="border: 1px solid;text-align: center;font-size:25px"><p>'.$st_rank->counter_position.'</p></td><td></td>
                    </tr>

            </table>
</td>
</tr>
</table>
           </div>
        <div style="width:100%;margin-left: auto;margin-right: auto;background-color:#fefff1">
        <br/><br/>
            <table width="100%" style="text-align: center;">
            <tr>

        <h2 style="margin-top: 1px;border:1px solid;padding:8px"> <b> Remarks :</b> '.$st_rank->comment.'</h2>
         </tr>

            </table>


            <table width="100%">
<br/>

<tr>
                <th width="200px">
                    <br/><br/><br/><br/>
                    <hr style="width: 220px;"/>
                    <h2>Principal'."'".'s Signature</h2>
                </th>

                <th width="200px"> <br/><br/><br/><br/>
                    <hr style="width: 220px;"/>
                    <h2>Class Teacher'."'".'s Signature</h2>

                    </th>

                       <th width="200px"> <br/><br/><br/><br/>
                    <hr style="width: 220px;"/>
                    <h2>Guardian'."'".'s Signature</h2>

                    </th>
                               </tr>
            </table>
                                <br/><h4 style="text-align:center"><img src="../public/image/fdcl.gif" width="24px" height="24px" align="top">&nbsp;&nbsp;Powered By : Four D Communications Limited</h4>



            <table width="100%">

            <tr>
                </tr>
            </table>

        </div>
</font>
</body>
</html>';
    return PDF::load($html, 'A2', 'potrait')->download(''.$student_name.'');


});

*/




/*

Route::post('report',function()
{
    //return Input::all();
    $idstudent = Input::get('sid');
    $idclasssection = Input::get('idclasssection');
    $term = Input::get('term');
    $year = Input::get('year');

    $st= Studentinfo::where('registration_id','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;

        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->where('year','=',$year)->where('term','=',$term)->get();
    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());

    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();

    $sum=0;$count=0;$cgpa=0;
    $html = '<html>
<head>
</head>
<body>
<br/><br/>
<font face="segoe ui">
    <div style="margin-left: auto;margin-right: auto;width: 100%;">
        <div style="width: 160px;float: left;margin-left:150px;margin-top:3px">';




    $im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

    $imcnt = count($im);

   // if($imcnt!=0){

     //   $html.='<img src="../public/image/maleandfemale.jpg" width="150" height="150">';

  //  }
 //   else{



        $html.=' <img style="margin-left:-100px" src="../public/image/4d.gif" width="150px" height="115px">';

  //  }


    $html.='
      </div>


      <div style="width: 100%;text-align:;margin-right:20px">
         &nbsp;<br/><div style="margin-right:70px;margin-top:10px;font-family:Tahoma;font-weight:bold;font-size:45px">'. Config::get('schoolname.school').'</div>
          <h1 style="margin-left:180px"> 3/3 ,  Fuller Road, Dhaka University Campus</h1>
          <h1 style="margin-left:570px">ACADEMIC TRANSCRIPT<hr width="400px;margin-right:700px"></h1>
          <h1 style="margin-left:70px"></h1>


      </div>
<br/>

         </div>
<div style="width: 100%;">

    <br/><br/><br/>
<table style="border-radius:5px">

    <tr>

    <td width="200px" style="margin-left:50px">';

$im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

$imcnt = count($im);

if($imcnt!=0){

 $html.='<img src="../public/image/maleandfemale.jpg" width="160" height="180" style="margin-left: 60px;margin-top:-80px">';

}
else{



 $html.='<img src="../public/uploads/'. $st_id .'.PNG" width="160" height="180" style="margin-left: 60px">';

 }

    if($classsection->value != -1){
        $v = "BANGLA";
    }else{
        $v = "ENGLISH";
    }


   $html.=' </td>



    <td width="600px" style="padding-left:40px;">
     <table style="margin-top: -40px">
 <tr>

               <td style="font-size: 26px" height="30"><br/><b>Name :</b> &nbsp;&nbsp;&nbsp;'.$student_name.'</td>

           </tr>

           <tr height="20">

               <td style="font-size: 26px" height="30"><b>Class :</b> &nbsp;&nbsp;&nbsp;'.$classsection->class_name.'&nbsp;&nbsp;&nbsp;<b>Section :</b> &nbsp;&nbsp;&nbsp;'.$classsection->section.'</td>

           </tr>
           <tr>

               <td style="font-size: 26px" height="30"><b>Roll :</b> '.$s->st_roll.'&nbsp;&nbsp;<b>Student ID :</b> &nbsp;&nbsp;'.$idstudent.'</td>

           </tr>

            <tr>

               <td style="font-size: 26px" height="30"><b>Version :</b> '.$v.'&nbsp;&nbsp;<b>Year :</b> &nbsp;&nbsp;'.$year.'&nbsp;&nbsp;<b>Term :</b> &nbsp;&nbsp;'.$term.'</td>

           </tr>



        </table>

    </td>

    <td width="300px" style="padding-left:180px">

    <div style="margin-top: -150px;margin-left: 30px;position: relative"><img src="../public/image/grade.png" width="250" height="350" style="margin-left: 60px">
    </div>

</td>



 </div>
<br/>


<div style="width:990px;margin-left:50px;height: 100px">
     <table style="margin-left:10px;border-collapse: collapse" border="1">


            <tr>
                <th width="380px"><h3>Subject Name</h3></th>
                <th width="400px" style="" colspan="3">

                     <table>
                  <tr>
                  <h3 style="text-align: center"> Marks in Percentage (%)</h3>
                 </tr>
                 </table><hr/>
                 <table>
                  <tr>
                    <th width="150px"><h3>Creative</h3></th><th width="150px"><h3>MCQ</h3></th><th width="100px"><h3>Practical<h2></th>
                 </tr>
                 </table>
                </th>
                <th width="180px" style=""><h3>Total Marks</h3></th>
                <th width="150" style=""><h3>Grade</h3></th>
                <th width="150" style=""><h3>GPA</h3></th>
            </tr>';

    $sum=0; $count=0; $cgpa=0;  $gp = 0;

    $tst = TStudentResult::where('st_id','=',$idstudent)
        ->leftjoin('subject',"subject.subject_name",'=',  't_st_result.subject','left')
        ->orderBy('subject.priority','ASC')
        ->get();
$c = count($tst);

    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();



    if($c < 9) {

        foreach ($tst as $r) {

            $html .= '  <tr style="font-size: 26px;padding:15px">
                <td width="380px" >&nbsp;&nbsp;' . $r->subject . '</td>
                <td width="380px" style="" colspan="3">

                 <table>
                  <tr style="text-align: center">
                    <td width="150px">' . $r->h_ht . '</td><td width="150px">' . $r->h_mcq . '</td><td width="100px">' . $r->h_lab . '</td>
                 </tr>
                 </table>
                </td>
                <td width="160px" style="text-align: center">' . $r->h_total . '</td>
                <td width="120" style="text-align: center">' . $r->h_grade . '</td>
                <td width="120" style="text-align: center">' . $r->h_gp . '</td>
            </tr>

            ';
            $gp = $gp + $r->h_gp;

        }
    }else {

      foreach ($tst as $r) {

            $html .= '  <tr style="font-size: 24px">
              <td width="380px" >' .$r->subject.'</td>
                <td width="380px" style="" colspan="3">

                 <table>
                  <tr style="text-align: center">
                    <td width="150px">' .$r->h_ht. '</td><td width="150px">' . $r->h_mcq. '</td><td width="100px">' . $r->h_lab. '</td>
                 </tr>
                 </table>
                </td>
                <td width="160px" style="text-align: center">' . $r->h_total . '</td>
                <td width="120" style="text-align: center">' . $r->h_grade . '</td>
                <td width="120" style="text-align: center">' . $r->h_gp . '</td>
            </tr>';
          $gp = $gp + $r->h_gp;

       }


    }

            $html.='<tr style="text-align:center;font-weight:bold;">

            <td colspan="4">

           <h2> Total Marks And Total Grade</h2>
            </td>
            <td style="text-align: center"><h2>
'.$st_rank->total_mark.'
           </h2> </td>
              <td></td>
              <td style="text-align: center"><h2>'.$gp.'

            </h2></td>

            </tr>';




       $html.='</table>

    </td>

    <div style="width:990px;margin-left:12px;height: 100px;margin-top: 35px">

<table style="margin-left:0px;border-collapse: collapse;font-size: 24px" border="1">';
                    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();




                $html.='
  <tr>
                <td style="padding:10px" width="345px">&nbsp;&nbsp;<b>Grade Point Average (GPA</b>)</td ><td style="text-align: center">'.$st_rank->cgpa .'</td><td style="text-align: center" width="350px"><b>Merit Position</b></td><td colspan="2" style="text-align: center" width="340px">Attendance</td>

            </tr>

            <tr>
                <td style="padding:10px">&nbsp;&nbsp;Letter Grade</td><td style="text-align: center" width="330px">'.$st_rank->grade.'</td><td rowspan="2" style="text-align: center">'.$st_rank->rank.'</td><td style="text-align: center">Attendance</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td style="padding:10px">&nbsp;&nbsp;Total Marks</td><td style="text-align: center;font-weight: bold" width="330px">'.$st_rank->total_mark.'</td><td style="text-align: center" >Attendance</td><td style="text-align: center">N/A</td>

            </tr>

</table>

<div style="width:990px;margin-left:12px;height: 100px;margin-top: 335px">

<table>
<tr>
<td width="980px">
<h4>Powered By : &nbsp;<img src="../public/image/fdcl.gif" width="24" height="24" >&nbsp;&nbsp;Four D Communications Limited, 2015</h4>
</td>

<td width="300px" style="margin-left:430px">
<h4 style="margin-left:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Published On : 12.04.2016</h4>
</td>
</tr>
</table>

</div>




</div>

<div style="width:990px;margin-left:12px;height: 100px;margin-top: 70px">

<table style="border-radius:25%;border: 1px solid;">
<tr ><td style="width: 1380px"><h2 style="text-align: left;border-radius: 2px;padding: 15px"> &nbsp;Remarks : '.$st_rank->comment.'</h2></td></tr>
</table>
</div>

<div style="width:990px;margin-left:70px;height: 100px;margin-top: 35px">

 <table width="990px" style="text-align:center">
        <tr>


            <th width="400px">
                <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Principal\'s Signature</p>
            </th>

            <th width="15px"></th>

            <th width="400px"> <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Class Teacher\'s Signature</p></th>

            <th width="15px"></th>

            <th width="300px"> <br/><br/><br/><br/>
                <hr style="width: 180px;"/>
                <p>Parents/Guardian  Signature</p></th>

        </tr>





    </table>
</div>
</div>
<div style="width:990px;margin-left:50px;height: 100px">

</div>



</font>
</html>';
 return PDF::load($html, 'A2', 'potrait')->show(''.$student_name.'');


});


*/

/*

Route::post('report',function()
{
    //return Input::all();
    $idstudent = Input::get('sid');
    $idclasssection = Input::get('idclasssection');
    $term = Input::get('term');
    $year = Input::get('year');

    $st= Studentinfo::where('registration_id','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;

        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->where('year','=',$year)->where('term','=',$term)->get();
    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());

    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();

    $sum=0;$count=0;$cgpa=0;
    $html = '<html>
<head>
</head>
<body>
<br/><br/>
<font face="segoe ui">
    <div style="margin-left: auto;margin-right: auto;width: 100%;">
        <div style="width: 160px;float: left;margin-left:150px;margin-top:3px">';




    $im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

    $imcnt = count($im);

    // if($imcnt!=0){

    //   $html.='<img src="../public/image/maleandfemale.jpg" width="150" height="150">';

    //  }
    //   else{



    $html.=' <img style="margin-left:-100px" src="../public/image/4d.gif" width="150px" height="115px">';

    //  }


    $html.='
      </div>


      <div style="width: 100%;text-align:;margin-right:20px">
         &nbsp;<br/><div style="margin-right:70px;margin-top:10px;font-family:Tahoma;font-weight:bold;font-size:47px">'. Config::get('schoolname.school').'</div>
          <h1 style="margin-left:180px"> 3/3 ,  Fuller Road, Dhaka University Campus</h1>
          <h1 style="margin-left:570px">ACADEMIC TRANSCRIPT<hr width="400px;margin-right:700px"></h1>
          <h1 style="margin-left:70px"></h1>


      </div>
<br/>

         </div>
<div style="width: 100%;">

    <br/><br/><br/>
<table style="border-radius:5px">

    <tr>

    <td width="200px" style="margin-left:50px">';

    $im = StudentInfo::where('idstudentinfo','=',$st_id)->where('image','=','')->get();

    $imcnt = count($im);

    if($imcnt!=0){

        $html.='<img src="../public/image/maleandfemale.jpg" width="160" height="180" style="margin-left: 60px;margin-top:-80px">';

    }
    else{



        $html.='<img src="../public/uploads/'. $st_id .'.PNG" width="160" height="180" style="margin-left: 60px">';

    }

    if($classsection->value != -1){
        $v = "BANGLA";
    }else{
        $v = "ENGLISH";
    }


    $html.=' </td>



    <td width="600px" style="padding-left:40px;">
     <table style="margin-top: -40px">
 <tr>

               <td style="font-size: 26px" height="30"><br/><b>Name :</b> &nbsp;&nbsp;&nbsp;'.$student_name.'</td>

           </tr>

           <tr height="20">

               <td style="font-size: 26px" height="30"><b>Class :</b> &nbsp;&nbsp;&nbsp;'.$classsection->class_name.'&nbsp;&nbsp;&nbsp;<b>Section :</b> &nbsp;&nbsp;&nbsp;'.$classsection->section.'</td>

           </tr>
           <tr>

               <td style="font-size: 26px" height="30"><b>Roll :</b> '.$s->st_roll.'&nbsp;&nbsp;<b>Student ID :</b> &nbsp;&nbsp;'.$idstudent.'</td>

           </tr>

            <tr>

               <td style="font-size: 26px" height="30"><b>Version :</b> '.$v.'&nbsp;&nbsp;<b>Year :</b> &nbsp;&nbsp;'.$year.'&nbsp;&nbsp;<b>Term :</b> &nbsp;&nbsp;'.$term.'</td>

           </tr>



        </table>

    </td>

    <td width="300px" style="padding-left:180px">

    <div style="margin-top: -150px;margin-left: 30px;position: relative"><img src="../public/image/grade.png" width="270" height="360" style="margin-left: 60px">
    </div>

</td>



 </div>
<br/>


<div style="width:990px;margin-left:50px;height: 100px">
     <table style="margin-left:10px;border-collapse: collapse" border="1">


            <tr>
                <th width="380px"><h1>Subject Name</h1></th>
                <th width="400px" style="" colspan="3">

                     <table>
                  <tr>
                  <h2 style="text-align: center"> Marks in Percentage (%)</h2>
                 </tr>
                 </table><hr/>
                 <table>
                  <tr>
                    <th width="150px"><h2>Creative</h2></th><th width="150px"><h2>MCQ</h2></th><th width="100px"><h2>Practical<h2></th>
                 </tr>
                 </table>
                </th>
                <th width="180px" style=""><h2>Total Marks</h2></th>
                <th width="150" style=""><h2>Grade</h2></th>
                <th width="150" style=""><h2>GPA</h2></th>
            </tr>';

    $sum=0; $count=0; $cgpa=0;  $gp = 0;

    $tst = TStudentResult::where('st_id','=',$idstudent)
        ->leftjoin('subject',"subject.subject_name",'=',  't_st_result.subject','left')
        ->orderBy('subject.priority','ASC')
        ->get();
    $c =count($tst);

    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();



    if($c < 9) {

        foreach ($tst as $r) {

            $html .= '  <tr style="font-size: 26px;padding:15px">
                <td width="380px" style="font-weight: bold">&nbsp;&nbsp;' . $r->subject . '</td>
                <td width="380px" style="" colspan="3">

                 <table>
                  <tr style="text-align: center">
                    <td width="150px">' . $r->h_ht . '</td><td width="150px">' . $r->h_mcq . '</td><td width="100px">' . $r->h_lab . '</td>
                 </tr>
                 </table>
                </td>
                <td width="160px" style="text-align: center">' . $r->h_total . '</td>
                <td width="120" style="text-align: center">' . $r->h_grade . '</td>
                <td width="120" style="text-align: center">' . $r->h_gp . '</td>
            </tr>

            ';
            $gp = $gp + $r->h_gp;

        }
    }else {

        foreach ($tst as $r) {

            $html .= '  <tr style="font-size: 23px">
              <td width="380px" style="font-weight: bold">&nbsp;' .$r->subject.'</td>
                <td width="380px" style="" colspan="3">

                 <table>
                  <tr style="text-align: center">
                    <td width="150px">' .$r->h_ht. '</td><td width="150px">' . $r->h_mcq. '</td><td width="100px">' . $r->h_lab. '</td>
                 </tr>
                 </table>
                </td>
                <td width="160px" style="text-align: center;font-weight:bold">' . $r->h_total . '</td>
                <td width="120" style="text-align: center;font-weight:bold">' . $r->h_grade . '</td>
                <td width="120" style="text-align: center;font-weight:bold">' . $r->h_gp . '</td>
            </tr>




            ';
            $gp = $gp + $r->h_gp;

        }





    }


    $html.='<tr style="text-align:center;font-weight:bold;">

            <td colspan="4">

           <h2> Total Marks And Total Grade</h2>
            </td>
            <td style="text-align: center"><h1>
'.$st_rank->total_mark.'
           </h1> </td>
              <td></td>
              <td style="text-align: center"><h1>'.$gp.'

            </h1></td>

            </tr>';




    $html.='</table>

    </td>

    <div style="width:990px;margin-left:12px;height: 100px;">';
if($c <9){
    $html.='<br/><br/>';
} else{
    $html.='<br/>';
}
$html.='<table style="margin-left:0px;border-collapse: collapse;font-size: 24px" border="1">';
    $st_rank = StudentRank::where('term','=','Half yearly')->where('student_id','=',$st_id)->first();




    $html.='
  <tr>
                <td style="padding:10px" width="345px">&nbsp;&nbsp;<b>Grade Point Average (GPA</b>)</td ><td style="text-align: center">'.$st_rank->cgpa .'</td><td style="text-align: center" width="350px"><b>Merit Position</b></td><td colspan="2" style="text-align: center" width="340px">Attendance</td>

            </tr>

            <tr>
                <td style="padding:10px">&nbsp;&nbsp;Letter Grade</td><td style="text-align: center" width="330px">'.$st_rank->grade.'</td><td rowspan="2" style="text-align: center">'.$st_rank->rank.'</td><td style="text-align: center">Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td style="padding:10px">&nbsp;&nbsp;Total Marks</td><td style="text-align: center;font-weight: bold" width="330px">'.$st_rank->total_mark.'</td><td style="text-align: center" >Attendance</td><td style="text-align: center">N/A</td>

            </tr>

</table>

<div style="width:990px;margin-left:12px;height: 100px;margin-top: 335px">';

   if($c < 9) {
       $html .= '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
   }else{

       $html .= '<br/><br/><br/><br/><br/>';
   }

$html.='<table style="position: relative">
<tr>
<td width="980px">
<h4>Powered By : &nbsp;<img src="../public/image/fdcl.gif" width="24" height="24" >&nbsp;&nbsp;Four D Communications Limited, 2015</h4>
</td>

<td width="300px" style="margin-left:430px">
<h4 style="margin-left:20px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Published On : 12.04.2016</h4>
</td>
</tr>
</table>

</div>




</div>

<div style="width:990px;margin-left:12px;height: 100px;">';

    if($c<9) {
        $html .= '<br/><br/><br/><br/><br/><br/><br/><br/>';
    }
    else {
        $html .= '<br/><br/><br/><br/><br/><br/><br/>';
    }

$html.='<table style="border-radius:25%;border: 1px solid;">
<tr ><td style="width: 1380px"><h2 style="text-align: left;border-radius: 2px;padding: 15px"> &nbsp;Remarks : '.$st_rank->comment.'</h2></td></tr>
</table>
</div>';

if($c<9) {
    $html .= '<div style="width:990px;margin-left:70px;height: 100px;margin-top: 55px"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
}
else{
    $html .= '<div style="width:990px;margin-left:70px;height: 100px;margin-top: 55px"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';

}
 $html.='

    <table width="990px" style="text-align:center;position: relative">
        <tr>


            <th width="400px">
                <br/><br/><br/><br/>
                <hr style="width: 210px;"/>
                <h2>Principal\'s Signature</h2>
            </th>

            <th width="15px"></th>

            <th width="400px"> <br/><br/><br/><br/>
                <hr style="width: 210px;"/>
                <h2>Class Teacher\'s Signature</h2></th>

            <th width="15px"></th>

            <th width="300px"> <br/><br/><br/><br/>
                <hr style="width: 210px;"/>
                <h2>Parents/Guardian  Signature</h2></th>

        </tr>





    </table>
</div>
</div>
<div style="width:990px;margin-left:50px;height: 100px">

</div>



</font>
</html>';
    return PDF::load($html, 'A2', 'potrait')->show(''.$student_name.'');


});

*/




Route::post('report',function()
{
    //return Input::all();
    $idstudent = Input::get('sid');
    $idclasssection = Input::get('idclasssection');
    $term = Input::get('term');
    $year = Input::get('year');

    $st= Studentinfo::where('registration_id','=',$idstudent)->first();
    if($st!="")
    {
        $student_name = $st->sutdent_name;

        $st_roll = $st->student_roll;
        $st_id = $st->registration_id;
    }
    else
    {
        $student_name = 'Name not found';
    }
    $classsection = Addclass::where('class_id','=',$idclasssection)->first();
    $result = StudentResult::where('S_ID','=',$idstudent)->where('year','=',$year)->where('term','=',$term)->get();
    $tst = TStudentResult::where('st_id','=',$st_id)->get();
    $stdno= count(StudentToSection::where('class','=',$classsection->class_name)->where('section','=',$classsection->section)->get());

    $s = StudentToSectionUpdate::where('student_idstudentinfo','=',$idstudent)->first();

    $sum=0;$count=0;$cgpa=0;



        $html = '<html>
<head>
</head>';
    for($i=0; $i <1 ;$i++) {
$html.='<body>
<br/><br/>
<font face="segoe ui">
    <div style="margin-left: auto;margin-right: auto;width: 100%;">
        <div style="width: 160px;float: left;margin-left:150px;margin-top:3px">';


        $im = StudentInfo::where('idstudentinfo', '=', $st_id)->where('image', '=', '')->get();

        $imcnt = count($im);

        // if($imcnt!=0){

        //   $html.='<img src="../public/image/maleandfemale.jpg" width="150" height="150">';

        //  }
        //   else{


        $html .= ' <img style="margin-left:-100px" src="../public/image/4d.gif" width="150px" height="115px">';

        //  }


        $html .= '
      </div>


      <div style="width: 100%;text-align:;margin-right:20px">
         &nbsp;<br/><div style="margin-right:70px;margin-top:10px;font-family:Tahoma;font-weight:bold;font-size:47px">' . Config::get('schoolname.school') . '</div>
          <h1 style="margin-left:180px"> 3/3 ,  Fuller Road, Dhaka University Campus</h1><br/>
          <h1 style="margin-left:570px">ACADEMIC TRANSCRIPT<hr width="400px;margin-right:700px"></h1>
          <h1 style="margin-left:70px"></h1>


      </div>
<br/>

         </div>
<div style="width: 100%;">

    <br/><br/>
<table style="border-radius:5px">

    <tr>

    <td width="200px" style="margin-left:50px">';

        $im = StudentInfo::where('idstudentinfo', '=', $st_id)->where('image', '=', '')->get();

        $imcnt = count($im);

        if ($imcnt != 0) {

            $html .= '<img src="../public/image/maleandfemale.jpg" width="160" height="180" style="margin-left: 60px;margin-top:-80px">';

        } else {


            $html .= '<img src="../public/uploads/' . $st_id . '.PNG" width="160" height="180" style="margin-left: 60px">';

        }

        if ($classsection->value != -1) {
            $v = "BANGLA";
        } else {
            $v = "ENGLISH";
        }


        $html .= ' </td>



    <td width="600px" style="padding-left:40px;">
     <table style="margin-top: -40px">
 <tr>

               <td style="font-size: 26px" height="30"><br/><b>Name :</b> &nbsp;&nbsp;' . $student_name . '</td>

           </tr>

           <tr height="20">

               <td style="font-size: 26px" height="30"><b>Class :</b> &nbsp;&nbsp;' . $classsection->class_name . '&nbsp;&nbsp;&nbsp;<b>Section :</b> &nbsp;&nbsp;&nbsp;' . $classsection->section . '</td>

           </tr>
           <tr>

               <td style="font-size: 26px" height="30"><b>Roll &nbsp;&nbsp;:</b> &nbsp;&nbsp;' . $s->st_roll . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Student ID :</b> &nbsp;&nbsp;' . $idstudent . '</td>

           </tr>

            <tr>

               <td style="font-size: 26px" height="30"><b>Version :</b> ' . $v . '&nbsp;&nbsp;<b>Year :</b> &nbsp;&nbsp;' . $year . '&nbsp;&nbsp;<b>Term :</b> &nbsp;&nbsp;' . $term . '</td>

           </tr>



        </table>

    </td>

    <td width="300px" style="padding-left:160px">

    <div style="margin-top: -150px;margin-left: 30px;position: relative"><img src="../public/image/grade.png" width="310" height="360" style="margin-left: 60px">
    </div>

</td>



 </div>
<br/>


<div style="width:990px;margin-left:50px;height: 100px">
     <table style="margin-left:10px;border-collapse: collapse" border="1">


            <tr>
                <th width="380px"><h1>Subject Name</h1></th>
                <th width="400px" style="" colspan="3">

                     <table>
                  <tr>
                  <h2 style="text-align: center"> Marks in Percentage (%)</h2>
                 </tr>
                 </table>
                 <table style="border-collapse: collapse" border="1">
                  <tr>
                    <th width="150px"><h2>Creative</h2></th><th width="150px"><h2>MCQ</h2></th><th width="100px"><h2>Practical<h2></th>
                 </tr>
                 </table>
                </th>
                <th width="180px" style=""><h1>Total Marks</h1></th>
                <th width="150" style=""><h1>Grade</h1></th>
                <th width="150" style=""><h1>GPA</h1></th>
            </tr>';

        $sum = 0;
        $count = 0;
        $cgpa = 0;
        $gp = 0;

        $tst = TStudentResult::where('st_id', '=', $idstudent)
            ->leftjoin('subject', "subject.subject_name", '=', 't_st_result.subject', 'left')
            ->orderBy('subject.priority', 'ASC')
            ->get();
        $c = count($tst);

        $st_rank = StudentRank::where('term', '=', 'Half yearly')->where('student_id', '=', $st_id)->first();


        if ($c < 9) {

            foreach ($tst as $r) {

                $html .= '  <tr style="font-size: 26px;padding:15px">
                <td width="380px" style="font-weight: bold">&nbsp;&nbsp;' . $r->subject . '</td>
                <td width="380px" style="" colspan="3">

                 <table style="border-collapse: collapse" border="1">
                  <tr style="text-align: center">
                    <td width="150px" style="border-right:1px solid">' . $r->h_ht . '</td><td width="150px" style="border-right:1px solid">' . $r->h_mcq . '</td><td width="100px">' . $r->h_lab . '</td>
                 </tr>
                 </table>
                </td>
                <td width="160px" style="text-align: center;font-weight:bold">' . $r->h_total . '</td>
                <td width="120" style="text-align: center;font-weight:bold">' . $r->h_grade . '</td>
                <td width="120" style="text-align: center;font-weight:bold">' . $r->h_gp . '</td>
            </tr>

            ';
                $gp = $gp + $r->h_gp;

            }
        } else {

            foreach ($tst as $r) {

                $html .= '  <tr style="font-size: 23px">
              <td width="380px" style="font-weight: bold">&nbsp;' . $r->subject . '</td>
                <td width="380px" style="" colspan="3">

                 <table style="border-collapse: collapse;text-align: center;letter-spacing: 1px;width: 100%;" border="1">
                  <tr style="text-align: center">
                    <td width="150px">' . $r->h_ht . '</td><td width="150px">' . $r->h_mcq . '</td><td width="100px">' . $r->h_lab . '</td>
                 </tr>
                 </table>
                </td>
                <td width="160px" style="text-align: center;font-weight:bold" >' . $r->h_total . '</td>
                <td width="120" style="text-align: center;font-weight:bold">' . $r->h_grade . '</td>
                <td width="120" style="text-align: center;font-weight:bold">' . $r->h_gp . '</td>
            </tr>




            ';
                $gp = $gp + $r->h_gp;

            }




        }


        $html .= '<tr style="text-align:center;font-weight:bold;">

            <td colspan="4">

           <h2> Total Marks and Total Grade</h2>
            </td>
            <td style="text-align: center"><h1>
' . $st_rank->total_mark . '
           </h1> </td>
              <td></td>
              <td style="text-align: center"><h1>' . $gp . '

            </h1></td>

            </tr>';


        $html .= '</table>

    </td>

    <div style="width:990px;margin-left:12px;height: 100px;">';
        if ($c < 9) {
            $html .= '<br/><br/>';
        } else {
            $html .= '<br/>';
        }
        $html .= '<table style="margin-left:0px;border-collapse: collapse;font-size: 24px" border="1">';
        $st_rank = StudentRank::where('term', '=', 'Half yearly')->where('student_id', '=', $st_id)->first();


        $html .= '
  <tr>
                <td style="padding:5px;font-size:25px" width="345px" >&nbsp;&nbsp;<b>Grade Point Average (GPA</b>)</td ><td style="text-align: center;font-size:25px;font-weight:bold">' . $st_rank->cgpa . '</td><td style="text-align: center;font-size:25px" width="350px"><b>Merit Position</b></td><td colspan="2" style="text-align: center;font-size:25px" width="340px"><b>Attendance</b></td>

            </tr>

            <tr>
                <td style="padding:10px">&nbsp;&nbsp;Letter Grade</td><td style="text-align: center;font-size:25px" width="330px"><b>' . $st_rank->grade . '</b></td><td rowspan="2" style="text-align: center;font-weight:bold;font-size:32px">' . $st_rank->rank . '</td><td style="text-align: left">&nbsp;Working Days</td><td style="text-align: center">N/A</td>

            </tr>

            <tr>
                <td style="padding:10px">&nbsp;&nbsp;Total Marks</td><td style="text-align: center;font-weight: bold" width="330px">' . $st_rank->total_mark . '</td><td style="text-align: left">&nbsp;Attendance</td><td style="text-align: center">N/A</td>

            </tr>

</table>

<div style="width:990px;margin-left:12px;height: 100px;margin-top: 335px">';

        if ($c < 9) {
            $html .= '<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
        } else {

            $html .= '<br/><br/><br/><br/>';
        }

        $html .= '<br/><br/><table style="position: relative">
<tr>
<td width="980px" style="font-size:20px">
<h4>Powered By : &nbsp;&nbsp;Four D Communications Limited</h4>
</td>

<td width="300px" style="margin-left:430px;font-size:18px">
<h4 style="margin-left:10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Result Published On : 12.04.2016</h4>
</td>
</tr>
</table>

</div>




</div>

<div style="width:990px;margin-left:12px;height: 100px;">';

        if ($c < 9) {
            $html .= '<br/><br/><br/><br/><br/><br/><br/><br/>';
        } else {
            $html .= '<br/><br/><br/><br/><br/><br/><br/>';
        }

        $html .= '<table style="border-radius:25%;border: 1px solid;">
<tr ><td style="width: 1380px"><p style="text-align: left;border-radius: 2px;padding: 15px;font-size:25px"> &nbsp;<b>Remarks</b> : ' . $st_rank->comment . '</p></td></tr>
</table>
</div>';

        if ($c < 9) {
            $html .= '<div style="width:990px;margin-left:70px;height: 100px;margin-top: 55px"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';
        } else {
            $html .= '<div style="width:990px;margin-left:70px;height: 100px;margin-top: 55px"><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>';

        }
        $html .= '

    <table width="990px" style="text-align:center;position: relative">
        <tr>


            

           

            <th width="400px"> <br/><br/><br/><br/>
                <hr style="width: 250px;"/>
                <h2>Class Teacher\'s Signature</h2></th>
                 <th width="15px"></th>

            <th width="20px"></th>

            <th width="300px"> <br/><br/><br/><br/>
                <hr style="width: 250px;"/>
                <h2>Parents/Guardian  Signature</h2></th>

                <th width="400px">
                <br/><br/><br/><br/>
                <hr style="width: 250px;"/>
                <h2>Principal\'s Signature</h2>
            </th>

        </tr>





    </table>
</div>
</div>
<div style="width:990px;margin-left:50px;height: 100px">

</div>



</font>
</body>';
    }
$html.='</html>';


    return PDF::load($html, 'A2', 'potrait')->show(''.$student_name.'');


});














/*******************************************************************/






Route::post('attendance_management/attendance_book',function(){

    $month = Input::get('month');
    $classsection = Input::get('classsection');
    $idsubject = Input::get('idsubject');
    $year = Input::get('year');

    return Redirect::to('attendance_management/attendance_book')->with('month',$month)->with('classsection',$classsection)->with('year',$year);
});




Route::get('attendance_management/attendance_book',function()
{

    $month = Session::get('month');
    $year= Session::get('year');
    
    $classsection = Session::get('classsection');
    $clsName = Addclass::where('class_id','=', $classsection)->pluck('class_name');
    $secName = Addclass::where('class_id','=', $classsection)->pluck('section');
    if ($classsection!=null) {


      $subid = CourseTeacher::where('idclasssection','=',$classsection)->where('idteacherinfo','=',Auth::user()->user_id)->pluck('idsubject');

        $attendance = AttendanceView::distinct()->where('Month','=',$month)->where('Class_Section_Id','=',$classsection)->where('idsubject','=',$subid)->get();
        $attendancestd = AttendanceView::distinct()->where('Month','=',$month)->where('Class_Section_Id','=',$classsection)->get();

        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
        if ($attendance!='[]') {
            return View::make('attendance_management.attendance_book')->with('class',$class)
                ->with('month',$month)
                ->with('classsection',$classsection)
                ->with('clsName',$clsName)
                ->with('secName',$secName)
                ->with('atten',$attendancestd)
                ->with('year',$year)
                ->with('attendances',$attendance);
        } else
        {
            return View::make('attendance_management.attendance_book')->with('class',$class)
                ->with('attendances',null)
                ->with('clsName',null)
                ->with('secName',null)
                ->with('month',null)
                ->with('year',null)
                ->with('classsection',null)
                ->with('shohag_msg',"<font color=red>There's appears to be a data error! Make sure you have provided attendance for this month.</font>");

        }
    }
    else{
        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
        return View::make('attendance_management.attendance_book')->with('class',$class)
            ->with('month',null)
            ->with('classsection',null)
            ->with('year',null)
            ->with('attendances',null);
    }


});



/*
Route::get('attendance_management/attendance_book',function()
{


    $month = Session::get('month');
    $classsection = Session::get('classsection');
    $clsName = Addclass::where('class_id','=', $classsection)->pluck('class_name');
    $secName = Addclass::where('class_id','=', $classsection)->pluck('section');
    if ($classsection!=null) {

      //  $attendance = AttendanceView::where('Month','=',$month)->where('Class_Section_Id','=',$classsection)->get();

         $attendance = AttendanceView::distinct()->where('Month','=',$month)->where('Class_Section_Id','=',$classsection)->get();
        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
        if ($attendance!='[]') {
            return View::make('attendance_management.attendance_book')->with('class',$class)
                ->with('month',$month)
                ->with('classsection',$classsection)
                ->with('clsName',$clsName)
                ->with('secName',$secName)
                ->with('attendances',$attendance);
        } else
        {
            return View::make('attendance_management.attendance_book')->with('class',$class)
                ->with('attendances',null)
                ->with('clsName',null)
                ->with('secName',null)
                ->with('month',null)
                ->with('classsection',null)
                ->with('shohag_msg',"<font color=red>There's appears to be a data error! Make sure you have provided attendance for this month.</font>");

        }
    }
    else{
        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
        return View::make('attendance_management.attendance_book')->with('class',$class)
            ->with('month',null)
            ->with('classsection',null)
            ->with('attendances',null);
    }


});

*/

Route::get('/attendance_management/attendance_bookmahbub/{classsection}/{month}/{idsubject}/{year}', function($classsection,$month,$idsubject,$year){



    $clsName = Addclass::where('class_id','=', $classsection)->pluck('class_name');
    $secName = Addclass::where('class_id','=', $classsection)->pluck('section');



    return View::make('attendance_management.attendance_bookmahbub')->with('classsection',$classsection)
        ->with('month',$month)
        ->with('idsubject',$idsubject)
        ->with('year',$year)

        ->with('clsName',$clsName)
        ->with('secName',$secName);



});



Route::post('attendance_management/attendance_book_pdf',function(){

  
 
/*


$month=Input::get('month');
    $classsection_id=Input::get('classsection');
$cl = Addclass::where('class_id','=',$classsection_id)->first();

    $attendances = AttendanceView::distinct()->where('Month','=',$month)->where('Class_Section_Id','=',$classsection_id)->get();
    $html = '<html><body>

<h3> Attendance Report Of Class : ' . $cl->class_name . "($cl->section ) ". " " . $month . '</h3><br/>


<table border="1" style="width:100%;border-collapse: collapse">
      <tr>
        <th><b>Roll</b></th>
        <th ><b>Name</b></th>';

    $at = AttendanceSheet::where('month','=',$month)->groupBy('dateofattendance')->get();

    $cn = count($at);

    $mn = substr($month , 0,3);

    foreach($at as $a){

        $c = substr($a->dateofattendance, 0,2);

        $html .='<th>' . $c . " " .$mn. '</th>';
    }


    $html .='<th><b>Total</b></th>
      </tr>';
    foreach($attendances as $attendance){

  $roll = StudentToSectionUpdate::where('student_idstudentinfo','=',$attendance->Student_id)->orderBy('st_roll')->pluck('st_roll');

        $count=0;
        $html .='<tr>
        <td><b>' . $roll . '</b></td>
        <td ><b>' . Studentinfo::where('idstudentinfo',$attendance->Student_id)->pluck('sutdent_name') . '</b></td>';
        for($i=1;$i<=25;$i++){
            $var="Day" . $i;
            if($attendance->$var=='0'){
                $html .='<td align="center">a</td>';
            }elseif($attendance->$var=='1'){
                $count++;
                $html .='<td align="center">p</td>';
            }
        }
        $html .='<td><b>' . $count . '</b></td>
      </tr>';
    }
    $html .=' </table>

</body></html>';
    return PDF::load($html, 'A4', 'landscape')->download('attendance_pdf');




*/





    $month=Input::get('month');

    $dates = getdate();
     $cyear = $dates['year'];

    $classsection_id=Input::get('classsection');
    $attendances = AttendanceSheet::where('month','=',$month)->where('classsection_id','=',$classsection_id)->get();
   
 $atten = AttendanceSheet::where('month','=',$month)->where('classsection_id','=',$classsection_id)->groupBy('dateofattendance')->pluck('dateofattendance');

    $cls = Addclass::where('class_id','=',$classsection_id)->first();
    $html = '<html><body>

     <h2> Attendance Reoport Of Class : ' .$cls->class_name . " (  $cls->section  )" . "  "  .$month . "," .$cyear .'</h2><br/><br/>
<table border="1" style="width:100%">
      <tr>
        <th><b>Id</b></th>
        <th ><b>Name</b></th>';

 //$v = substr($month,0,2);

    for($i=1;$i<=23;$i++){

        $html .='<th>day' .$i . '</th>';
    }


    $html .='<th><b>Total</b></th>
      </tr>';
    foreach($attendances as $attendance){
        $count=0;
     
$roll = StudentToSectionUpdate::where('student_idstudentinfo','=',$attendance->studentinfo_idstudentinfo)->orderBy('st_roll')->pluck('st_roll');


        $html .='<tr>
        <td><b>' . $roll . '</b></td>
        <td ><b>' . Studentinfo::where('idstudentinfo',$attendance->studentinfo_idstudentinfo)->pluck('sutdent_name') . '</b></td>';
        for($i=1;$i<=23;$i++){

            $d = str_pad($i,2,"0", STR_PAD_LEFT);

            $var="day".$d;

            if($attendance->$var =='0'){
                $html .='<td align="center">a</td>';
            }elseif($attendance->$var=='1'){
                $count++;
                $html .='<td align="center">p</td>';
            }
        }

        $html .='<td><b>'.$count.'</b></td>
      </tr>';
    }
    $html .=' </table>

</body></html>';
    return PDF::load($html, 'A1', 'portrait')->show();





/*



   $month = Input::get('month');
    $classsection_id = Input::get('classsection');
    $attendances = AttendanceView::where('Month', '=', $month)->where('Class_Section_Id', '=', $classsection_id)->get();

    $count = 0;
    $var = null;

    $html = '<html><body><table border="1" style="width:100%;border-collapse: collapse">
      <tr>
        <th><b>Id</b></th>
        <th ><b>Name</b></th>';
    for($i=1;$i<=31;$i++){
        $html .='<th>day' . $i . '</th>';
    }


    $html .='<th><b>Total</b></th>
      </tr>';
    foreach($attendances as $attendance){
        $roll = StudentToSectionUpdate::where('student_idstudentinfo', '=', $attendance->Student_id)->orderBy('st_roll')->pluck('st_roll');

        $count=0;
        $html .='<tr>
        <td><b>' . $roll . '</b></td>
        <td ><b>' . Studentinfo::where('idstudentinfo',$attendance->Student_id)->pluck('sutdent_name') . '</b></td>';
        for($i=1;$i<=31;$i++){
            $var="Day" . $i;
            if($attendance->$var=='0'){
                $html .='<td align="center">a</td>';
            }elseif($attendance->$var=='1'){
                $count++;
                $html .='<td align="center">p</td>';
            }
        }
        $html .='<td><b>' . $count . '</b></td>
      </tr>';
    }
    $html .=' </table>

</body></html>';

    return PDF::load($html, 'A1', 'portrait')->download('attendance_pdf');

*/


});


Route::get('reports/report','ReportsController@report')->before('auth');
Route::get('reports/report/class/{data}','ReportsController@report_class')->before('auth');
Route::get('reports/student_sec/{data}/{data1}','ReportsController@report_st')->before('auth');

Route::get('reports/allstudenst','ReportsController@report_all_students')->before('auth');


// Shohag's Updated on and after 24 Nov 15 -----------

Route::get('submit_marks',function()
{
    if(Auth::user()->type=="teacher") {

        $clsTeacher_id = Auth::user()->user_id;
        $class_section_id = ClassTeacher::where('idteacherinfo','=', $clsTeacher_id)->pluck('idclasssection');
        $class_sec = Addclass::where('class_id','=',$class_section_id)->first();
        if(count($class_sec)) {
            $class_name = $class_sec->class_name;
            $section = $class_sec->section;
        }
        else {
            $class_name = 0;
            $section = 0;
        }

        $term = PublishResult::where('published','=','Y')->where('class','=',$class_name)->where('section','=',$section)->where('term','=','Half Yearly')->first();
        $y= date('Y'); $yn= date('Y')+1;
       // $current_year =$y."-".$yn;
       $current_year ='2015-2016';  
        $term_count= count($term);
        if(!$term_count) $current_term = "Half Yearly"; else $current_term = "Final";
         if($class_sec->value > 10 )
{
 $cur_mon=date("m");
if($cur_mon == 3 || $cur_mon == 4 )
$current_term = "Final";
else
$current_term = "Half Yearly";
}


        $plist = TabulationSheetEditable::distinct()->where('exam_type','=','HT')->where('term','=',$current_term)->where('academic_year','=',$current_year)->where('class','=',$class_name)->where('section','=',$section)->get();

        return View::make('result_management.submit_all_marks')->with('class',$class_name)->with('section',$section)->with('year12',$current_year)->with('term12',$current_term)->with('plist',$plist);
    }
    else return ('<div style=" font-size: 30px; color: red; margin-top: 20%; text-align: center;" > Sorry, You are not eligible to access this arena. </div>');

})->before('auth');

Route::post('post_submitted_marks','ResultController@submit_mark')->before('auth');

Route::get('result_management/publish_result',function()
{
    if(Auth::user()->type=="admin") {

        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        $search_class = Session::get('src_class');
        $current_term = Session::get('term');

        //$term = PublishResult::where('published','=','Y')->where('term','=','Half Yearly')->where('class','=',$search_class)->first();
$class_sec= Addclass::where('class_name', '=',$search_class )->orderBy('value')->first();
        
        $y= date('Y'); $yn= date('Y')+1;
        $current_year =$y."-".$yn;
   /*     $term_count= count($term);
        if(!$term_count) $current_term = "Half Yearly"; else $current_term = "Final";
if(count($class_sec)){if($class_sec->value > 10 )
{
 $cur_mon=date("m");
if($cur_mon == 3 || $cur_mon == 4 )
$current_term = "Final";
else
$current_term = "Half Yearly";
}} */


        $classes = ClassTeacher::where('academic_year','=',$current_year)->get();
        $sel_class = Addclass::where('class_name','=', $search_class)->orderby('class_id')->get();

        return View::make('result_management.publish_result')->with('pterm',$current_term)
            ->with('pyear',$current_year)
            ->with('classes',$classes)
            ->with('sel_classes',$sel_class)
            ->with('class',$class)
            ->with('src_class', $search_class);
    }
    else return ('<div style=" font-size: 30px; color: red; margin-top: 20%; text-align: center;" > Sorry, You are not eligible to access this arena. </div>');

})->before('auth');

Route::post('result_management/publish_result',function()
{
    //return Input::all();
    $class = Input::get('cat');
    $term = Input::get('term');
    return Redirect::to('result_management/publish_result')->with('src_class', $class)->with('term', $term);
});

Route::post('final_tabulationsheet', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');
    $year = Input::get('year');

    return Redirect::to('/final_tabulationsheet')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('year', $year);
});

Route::get('final_tabulationsheet', function () {

    ini_set('max_execution_time', 300);
    $classname = Session::get('classname');
    $sectionname = Session::get('sectionname');
    $year = Session::get('year');

    if ($classname!=null || $sectionname!=null|| $year!=null) {


        $timereq1 = date("h")*3600 + date("i")*60 + date("s");
        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        $class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');

        //$configuration_id=SubjectToClass::where('idclass','=',$class_section)->pluck('markconfiguration_name');
        //$configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
        //  return $configuration_names;
        /* $result = StudentResult::distinct()->where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)
                    ->where('term','=',$term)->get(); */
        // $subjects = StudentResult::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)
        //   ->groupby('subject_name')->get();
        $students=StudentToSection::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)->get();

        $student_result=TStudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('academic_year','=',$year)
            ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();

        $st_rankH = StudentRank::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('term','=','Half Yearly')
            ->where('year','=',$year)
            ->orderby('student_id')->get();

        $st_rankF = StudentRank::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('term','=','Final')
            ->where('year','=',$year)
            ->orderby('student_id')->get();

        /* $student_result=StudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('Year','=',$year)
            ->where('term','=',$term)
            ->orderby('S_ID', 'ASC')->orderby('subject_name', 'ASC')->get();


        $resultMarks =StudentResult::where('idclasssection','=',$class_section)
            ->where('term','=',$term)
            ->where('Year','=',$year)->get();

       $resultClassTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('CT_Marks')->get();
        $resultRegularAssesment=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('RT_Marks')->get();
        $resultLabTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('LT_Marks')->get();
        $mcqTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('MCQ_Marks')->get();
        $hallTest=StudentResult::where('idclasssection','=',$class_section)
            ->where('Year','=',$year)->select('HT_Marks')->get();

        $ct=0;
        $rt=0;
        $lt=0;
        $mcq=0;
        $ht=0;


        //$grade_table = GradingTable::all();

        foreach ($resultMarks as $mark) {
            if ($mark->CT_Marks!=null) $ct=1;
            if ($mark->RT_Marks!=null) $rt=1;
            if ($mark->LT_Marks!=null)  $lt=1;
            if ($mark->MCQ_Marks!=null) $mcq=1;
            if ($mark->HT_Marks!=null)   $ht=1;

        }
*/


        return View::make('result_management.final_tabulation_sheet')
            ->with('classname', $classname)
            ->with('class', $class)
            ->with('idclasssection', $class_section)
            ->with('year', $year)
            ->with('sectionname', $sectionname)
            ->with('stu_results', $student_result)
            ->with('rankH',$st_rankH)
            ->with('rankF',$st_rankF)
            ->with('timereq1', $timereq1)
            ->with('students', $students);
        /*   ->with('ct', $ct)
               ->with('ht', $ht)
               ->with('lt', $lt)
               ->with('mcq', $mcq)
               ->with('rt', $rt) */

    } else
    {
        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        return View::make('result_management.final_tabulation_sheet')
            ->with('classname', null)
            ->with('sectionname', null)
            ->with('idclasssection', null)
            ->with('sectionname', null)
            ->with('year', null)
            ->with('stu_results', null)
            ->with('class', $class)
            ->with('results', null)
            ->with('subjects', null)
            ->with('students', null);
    }

})->before('auth');


Route::post('grace_grant', 'ResultController@grant_grace');
Route::post('spc_grant', 'ResultController@grant_spc');

Route::post('onesubject_tabulationsheet', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');
    $year = Input::get('year');
    $subject = Input::get('subject');

    return Redirect::to('/onesubject_tabulationsheet')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('year', $year)
        ->with('subject', $subject);
});

Route::get('onesubject_tabulationsheet', function () {

    ini_set('max_execution_time', 300);
    $classname = Session::get('classname');
    $sectionname = Session::get('sectionname');
    $year = Session::get('year');
    $subject = Session::get('subject');

    if ($classname!=null || $sectionname!=null|| $year!=null) {


        $timereq1 = date("h")*3600 + date("i")*60 + date("s");
        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        $class_section= Addclass::where('class_name','=',$classname)->where('section','=',$sectionname)->pluck('class_id');

        //$configuration_id=SubjectToClass::where('idclass','=',$class_section)->pluck('markconfiguration_name');
        //$configuration_names=MarksConfiguration::where('configuration_name','=',$configuration_id)->groupby('configuration_type')->lists('configuration_type');
        //  return $configuration_names;
        /* $result = StudentResult::distinct()->where('idclasssection','=',$class_section)
                    ->where('Year','=',$year)
                    ->where('term','=',$term)->get(); */
        // $subjects = StudentResult::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)
        //   ->groupby('subject_name')->get();
        $students=StudentToSection::where('class','=',$classname)->where('section','=',$sectionname)->where('year','=',$year)->get();

        $student_result=TStudentResult::where('class', '=', $classname)
            ->where('section','=',$sectionname)
            ->where('academic_year','=',$year)
            ->where('subject','=',$subject)
            ->orderby('st_id', 'ASC')->get();




        return View::make('result_management.onesubject_tabulation_sheet')
            ->with('classname', $classname)
            ->with('class', $class)
            ->with('idclasssection', $class_section)
            ->with('year', $year)
            ->with('sectionname', $sectionname)
            ->with('stu_results', $student_result)
            ->with('timereq1', $timereq1)
            ->with('students', $students);
        /*   ->with('ct', $ct)
               ->with('ht', $ht)
               ->with('lt', $lt)
               ->with('mcq', $mcq)
               ->with('rt', $rt) */

    } else
    {
        $class = Addclass::groupby('class_name')->orderBy('value')->get();
        return View::make('result_management.onesubject_tabulation_sheet')
            ->with('classname', null)
            ->with('sectionname', null)
            ->with('idclasssection', null)
            ->with('sectionname', null)
            ->with('year', null)
            ->with('stu_results', null)
            ->with('class', $class)
            ->with('results', null)
            ->with('subjects', null)
            ->with('students', null);
    }

})->before('auth');

Route::get('studentwisedetails/{std_id}/{std_year}','ResultController@studentwisedetails')->before('auth');

Route::post('studentwise_tabulationsheet', function ()
{
    $class = Input::get('cat');
    $section = Input::get('sub');
    $year = Input::get('year');


    return Redirect::to('/studentwise_tabulationsheet')
        ->with('classname', $class)
        ->with('sectionname', $section)
        ->with('year', $year);
});

Route::get('studentwise_tabulationsheet', function () {

    if(Auth::user()->type=="admin") {

        ini_set('max_execution_time', 300);
        $classname = Session::get('classname');
        $sectionname = Session::get('sectionname');
        $year = Session::get('year');

        if ($classname != null || $sectionname != null || $year != null) {


            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            $class_section = Addclass::where('class_name', '=', $classname)->where('section', '=', $sectionname)->pluck('class_id');

            /*$result=StudentResult::where('idclasssection','=',$class_section)
               ->where('term','=','Final')
               ->where('Year','=',$year)
               ->orderby('S_ID')->orderby('subject_name')->get(); */

            $result = TStudentResult::distinct()->where('idclasssection','=',$class_section)
                ->where('academic_year','=',$year)
                ->orderby('st_id')
                ->groupby('st_id')->get();


            return View::make('result_management.one_student_all_subject')
                ->with('classname', $classname)
                ->with('idclasssection', $class_section)
                ->with('year', $year)
                ->with('sectionname', $sectionname)
                ->with('class', $class)
                ->with('resulting', $result)
                ->with('is_pub', count($result));

        } else {
            $class = Addclass::groupby('class_name')->orderBy('value')->get();
            return View::make('result_management.one_student_all_subject')
                ->with('classname', null)
                ->with('idclasssection', null)
                ->with('year', null)
                ->with('sectionname', null)
                ->with('class', $class)
                ->with('resulting', null)
                ->with('students', null);

        }
    }
    else return ('<div style=" font-size: 30px; color: red; margin-top: 20%; text-align: center;" > Sorry, You are not eligible to access this arena. </div>');


})->before('auth');










// shohag's appended functions end -----







Route::get('result_management/st_report_card',function()
{
    $year = Session::get('year');
    $term = Session::get('term');
    $class_name = Session::get('class_name');
    $section = Session::get('section');
    $student_id = Session::get('student_id');

    if($class_name!=null&& $section!=null)
    {
        if($section=='all')
        {
            $student_info = StudentToSectionUpdate::where('class','=',$class_name)->get();
        }
        else
        {
            $classsection = Addclass::where('class_name','=',$class_name)->where('section','=',$section)->first();
            if($classsection!="")
            {
                $student_info = TStudentResult::where('idclasssection','=',$classsection->class_id)->where('academic_year','=',$year)->groupBY('st_id')->get();
            }
            else
            {
                $student_info = null;
            }
        }
    }
    elseif($student_id!=null)
    {
        $idstudent = Studentinfo::where('registration_id','=',$student_id)->first();
        if($idstudent!="")
            $student_info = TStudentResult::where('st_id','=',$idstudent->idstudentinfo)->where('academic_year','=',$year)->groupBY('st_id')->get();
        else
            $student_info = null;
    }
    else
        $student_info = null;
    $class = Addclass::groupBy('class_name')->orderBy('value','ASC')->get();

    return View::make('result_management.st_report_card')->with('class',$class)->with('students',$student_info)->with('year12',$year)->with('term12',$term);
})->before('auth');


Route::post('result_management/st_report_card',function()
{
    //return Input::all();
    return Redirect::to('result_management/st_report_card')->with('year',Input::get('year'))->with('term',Input::get('term'))->with('class_name',Input::get('cat'))->with('section',Input::get('sub'))->with('student_id',Input::get('student_id'));
});




/************** PALAK ROUTES ********************/




Route::get('attendance_management/student_attendance_view',function(){

    $month = Session::get('month');
    $classsection = Session::get('classsection');
    $clsName = Addclass::where('class_id','=', $classsection)->pluck('class_name');
    $secName = Addclass::where('class_id','=', $classsection)->pluck('section');
    if ($classsection!=null) {

        $attendance = AttendanceView::where('Month','=',$month)->where('Class_Section_Id','=','19')->where('Student_id','=',Auth::user()->email)->first();
        $class = Studentinfo::where('idstudentinfo','=',Auth::user()->email)->get();
        if ($attendance!='[]') {
            return View::make('attendance_management.student_attendance_view')->with('class',$class)
                ->with('month',$month)
                ->with('classsection',$classsection)
                ->with('clsName',$clsName)
                ->with('secName',$secName)
                ->with('attendances',$attendance);
        } else
        {
            return View::make('attendance_management.student_attendance_view')->with('class',$class)
                ->with('attendances',null)
                ->with('clsName',null)
                ->with('secName',null)
                ->with('month',null)
                ->with('classsection',null);

        }
    }
    else{

        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();

        return View::make('attendance_management.student_attendance_view')->with('class',$class)
            ->with('month',null)
            ->with('classsection',null)
            ->with('attendances',null);
    }


});





Route::get('assignment_management/teacher_give_assignment', function () {

  /*  $profile = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();
    $class = Addclass::where('class_id','=',$profile->idclasssection)->first();
    return View::make('assignment_management.teacher_give_assignment')->with('class', $class);
*/


    $profile = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();
    $class = Addclass::where('class_id','=',$profile->idclasssection)->get();
    //$profile1 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
     
       $profile1 = CourseTeacher:: where('idteacherinfo','=',Auth::user()->user_id)
        ->leftjoin('addclass',"addclass.class_id",'=',  'courseteacher.idclasssection','left')
        ->groupBy('addclass.class_name')
        ->get();

    return View::make('assignment_management.teacher_give_assignment')->with('class', $profile1);
})->before('auth');





Route::get('assignment_management/view_assignment',function(){

    //$usr = Auth::user()->user_id;
    // $class = ClassWiseStd::where('std_section', '=', $sectionname)->where('std_class', '=', $classname)->get();
        return View::make('assignment_management.assignment_view')->with('yr', null);




});


Route::post('assignment_management/view_assignment',function(){




    // $class = ClassWiseStd::where('std_section', '=', $sectionname)->where('std_class', '=', $classname)->get();
    return Redirect::to('/assignment_management/view_assignment');



});


Route::get('assignment_management/student_assignment',function()
{
    return View::make('assignment_management.student_assignment');
})->before('auth');


Route::post('classwiseassignment','AssignmentController@store');

Route::post('view_assignment','AssignmentController@show');


Route::get('attendance_management/stattendance_book',function()
{

    return View::make('attendance_management.att_view');
});





Route::get('attendance_management/stattendance_book',function()
{
    $month = Session::get('month');

    return View::make('attendance_management.att_view')->with('month',$month);
});




Route::post('attendance_management/att',function(){

    $month = Input::get('month');
    return Redirect::to('attendance_management/stattendance_book')->with('month',$month);

});



/*

Route::get('attendance_management/student_attendance_view',function()
{
    return View::make('attendance_management.student_attendance_view');
})->before('auth');

*/

Route::post('attendance_management/student_attendance_view',function(){

    $month = Input::get('month');
    $classsection = Input::get('classsection');
    return Redirect::to('attendance_management/student_attendance_view')->with('month',$month)->with('classsection',$classsection);
});




Route::get('attendance_management/student_attendance_view',function(){

    $month = Session::get('month');
    $classsection = Session::get('classsection');
    $clsName = Addclass::where('class_id','=', $classsection)->pluck('class_name');
    $secName = Addclass::where('class_id','=', $classsection)->pluck('section');
    if ($classsection!=null) {

        $attendance = AttendanceView::where('Month','=',$month)->where('Class_Section_Id','=',$classsection)->where('Student_id','=',Auth::user()->email)->get();
        $class = Studentinfo::where('idstudentinfo','=',Auth::user()->email)->get();
        if ($attendance!='[]') {
            return View::make('attendance_management.student_attendance_view')->with('class',$class)
                ->with('month',$month)
                ->with('classsection',$classsection)
                ->with('clsName',$clsName)
                ->with('secName',$secName)
                ->with('attendances',$attendance);
        } else
        {
            return View::make('attendance_management.student_attendance_view')->with('class',$class)
                ->with('attendances',null)
                ->with('clsName',null)
                ->with('secName',null)
                ->with('month',null)
                ->with('classsection',null);

        }
    }
    else{

        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();

        return View::make('attendance_management.student_attendance_view')->with('class',$class)
            ->with('month',null)
            ->with('classsection',null)
            ->with('attendances',null);
    }


});





Route::get('assignment/{id}',function($id)
{



    return View::make('assignment_management.individual_assignment')->with('id',$id);
})->before('auth');



Route::get('assignment_management/student_assignment',function()
{
    $st = StudentToSectionUpdate::where('student_idstudentinfo','=',Auth::user()->email)->pluck('section');

    $ac = Addclass::where('section','=',$st)->first();

    $msg = Assignment::where('idclass','=',$ac->class_id)->get();

    return View::make('assignment_management.showassignment_student')->with('message',$msg);
})->before('auth');


Route::get('attendance_management/teacher_give_attendance','AttendanceController@teacher_give_attendance')->before('auth');
Route::post('attendance_management/teacher_give_attendance','AttendanceController@teacher_give_attendance2');
Route::post('attendance_management/teacher_give_attendance3','AttendanceController@teacher_give_attendance3');


    