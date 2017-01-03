<?php

class AttendanceController extends \BaseController {

    public function teacher_give_attendance()
    {
        $classname = Session::get('cat');
        $y = Session::get('year');

        $addclass = Addclass::where('class_id','=',$classname)->first();
        $class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
        $shohag_msg = Session::get('shohag_msg');

        if($addclass!="") {
            $student = StudentToSectionUpdate::where('class', '=', $addclass->class_name)->where('year',$y)->where('section', '=', $addclass->section)->orderBy('st_roll','ASC')->get();
            if ($student != "[]")
                return View::make('attendance_management.teacher_give_attendance')->with('section',$addclass->section)->with('student', $student)->with('class', $class)->with('class_name',$addclass->class_name)->with('shohag_msg',$shohag_msg);
            else
                return View::make('attendance_management.teacher_give_attendance')->with('student', null)->with('class', $class)->with('shohag_msg',$shohag_msg);
        }
        else
        {
            return View::make('attendance_management.teacher_give_attendance')->with('student', null)->with('class', $class)->with('shohag_msg',$shohag_msg);
        }
    }

    public function teacher_give_attendance3()
    {
        $cat = Input::get('cat');
        $sub = Input::get('sub');
        $y = Input::get('year');
 
        return Redirect::to('attendance_management/teacher_give_attendance')->with('cat',$cat)->with('year',$y);
    }

    public function teacher_give_attendance2()
    {
        //return Input::all();
      

     $clssec = Addclass::where('section','=',Input::get('section'))->pluck('class_id');
      $subid = CourseTeacher::where('idclasssection','=',$clssec)->where('idteacherinfo','=',Auth::user()->user_id)->pluck('idsubject');


        $dates = getdate();
        $monthc = $dates['month'];
        $cday = $dates['mday'];
        $cyear = $dates['year'];
        $count =count(Input::get('idstudentinfo'));
        $idstudentinfo = Input::get('idstudentinfo');
        $date = Input::get('date');
        list($monthNum,$day,  $year) = explode('/', $date);
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $month = $dateObj->format('F');
        $shohag_msg = '<font color=red >Error While Saving Attendance</font>';

        if($monthc==$month && $cday>=$day && $year==$cyear) {

            for ($i = 0; $i < $count; $i++) {
                $da = 'day' . $day;
                $dayc = Input::get('day' . $i);
                if ($dayc != null && $dayc != "") {
                    $input = 'p';
                } else {
                    $input = 'a';
                }

$ct1 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->whereBetween('idclasssection', array(50, 56))
             ->first();



            $ct11 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();;

$cn = count($ct1);




                $student = AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudentinfo[$i])->where('classsection_id','=',$clssec )->where('idteacher','=',Auth::user()->user_id)->where('month', '=', $month)->where('year', '=', $year)->first();
                if ($student != null && $student != "") {
                    $st['day' . $day] = $input;
                    AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudentinfo[$i])->where('month', '=', $month)->where('year', '=', $year)->update($st);
                    Session::flash('flash_message', 'Data Updated');
                    $shohag_msg = 'Attendance Updated Successfully';

                } else {
                    $studentinfo = new AttendanceSheet();
                    $studentinfo->studentinfo_idstudentinfo = $idstudentinfo[$i];
                    $studentinfo->idteacher = Auth::user()->user_id;
                    $studentinfo->idsubject = $subid;
                    $studentinfo->dateofattendance= Input::get('date');
                    $studentinfo->classsection_id = $clssec;
                    $studentinfo->month = $month;
                    $studentinfo->year = $year;
                    $studentinfo->$da = $input;
                    $studentinfo->save();
                    Session::flash('flash_message', 'Data Saved');
                    $shohag_msg = 'Attendance Saved Successfully';
                }

            }
        }
        return Redirect::to('attendance_management/teacher_give_attendance')->with('shohag_msg',$shohag_msg);
    }

     


     
    public function attendance_info2()
    {
      //  return Input::all();

        $sb = Subject::where('subject_name','=',Input::get('subject'))->pluck('idsubject');

$val =Addclass::where('section','=',Input::get('section'))->pluck('value');
        $clssec = Addclass::where('section','=',Input::get('section'))->where('class_name','=',Input::get('class'))->pluck('class_id');


      if($val < 11) {
          $ct = ClassTeacher::where('idclasssection', '=', $clssec)->pluck('idteacherinfo');
      }else{

          $ct = CourseTeacher::where('idclasssection','=',$clssec)->where('idsubject','=',$sb)->pluck('idteacherinfo');
      }

        $suid = ClassTeacher::where('idclasssection','=',$clssec)->where('idteacherinfo','=',$ct)->first();

        $subid = CourseTeacher::where('idclasssection','=',$clssec)->where('idteacherinfo','=',$ct)->pluck('idsubject');


        $dates = getdate();
        $date1 = date('M/d/y');
        $monthc = $dates['month'];
        $cday = $dates['mday'];
        $cyear = $dates['year'];
        $count =count(Input::get('idstudentinfo'));
        $idstudentinfo = Input::get('idstudentinfo');
        $date = Input::get('date');
        list($monthNum,$day,  $year) = explode('/', $date);
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $month = $dateObj->format('F');
        $shohag_msg = '<font color=red >Error While Saving Attendance</font>';

       if($monthc==$month  && $year==$cyear) {
//if($date <= $date1){
            for ($i = 0; $i < $count; $i++) {
                $da = 'day' . $day;
                $dayc = Input::get('day' . $i);
                if ($dayc != null && $dayc != "") {
                    $input = 'p';
                } else {
                    $input = 'a';
                }

                $ct1 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->whereBetween('idclasssection', array(50, 56))
                    ->first();



                $ct11 = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->first();;

                $cn = count($ct1);




                $student = AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudentinfo[$i])->where('classsection_id','=',$clssec )->where('month', '=', $month)->where('year', '=', $year)->first();
                if ($student != null && $student != "") {
                    $st['day' . $day] = $input;
                    AttendanceSheet::where('studentinfo_idstudentinfo', '=', $idstudentinfo[$i])->where('month', '=', $month)->where('year', '=', $year)->update($st);
                    Session::flash('flash_message', 'Data Updated');
                    $shohag_msg = 'Attendance Updated Successfully';

                } else {
                    $studentinfo = new AttendanceSheet();
                    $studentinfo->studentinfo_idstudentinfo = $idstudentinfo[$i];
                    $studentinfo->idteacher = '6159000';
                    $studentinfo->idsubject = Input::get('subject');
                    $studentinfo->dateofattendance= Input::get('date');
                    $studentinfo->classsection_id = $clssec;
                    $studentinfo->month = $month;
                    $studentinfo->year = $year;
                    $studentinfo->$da = $input;
                    $studentinfo->save();
                    Session::flash('flash_message', 'Data Saved');
                    $shohag_msg = 'Attendance Saved Successfully';
                }

            }
       }
        return Redirect::to('classroom_management/attendance_info')->with('shohag_msg',$shohag_msg);
    }


        public function attendance_info1()
    {
        $cat = Input::get('cat');
        $sub = Input::get('sub');
        $sb = Input::get('subj');
        return Redirect::to('classroom_management/attendance_info')->with('cat',$cat)->with('sub',$sub)->with('sb',$sb);
    }


    
    public function attendance_info()
    {
        $classname = Session::get('cat');
        $section = Session::get('sub');
        $subject = Session::get('sb');

        $addclass = Addclass::where('class_id','=',$classname)->first();
        //$class = ClassTeacher::where('idteacherinfo','=',Auth::user()->user_id)->get();
       // $shohag_msg = Session::get('shohag_msg');
        if($classname!="") {
            $student = StudentToSectionUpdate::where('class', '=', $classname)->where('section', '=', $section)->orderBy('st_roll','ASC')->get();
            if ($student != "[]")
                return View::make('classroom_management/attendance_info')->with('section',$section)->with('student', $student)->with('class_name',$classname)->with('section',$section)->with('subject',$subject);
            else
                return View::make('classroom_management/attendance_info')->with('student', null);
        }
        else
        {
            return View::make('classroom_management/attendance_info')->with('student', null);
        }
    }

        


}