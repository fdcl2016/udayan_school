<?php

class AjaxController extends BaseController {


    public function ajax_refresh()
    {

        $keyword = '%'.$_POST['keyword'].'%';
        echo $keyword;

        $list = University::where('univ_name','like','%'.$keyword.'%')->get();

        foreach ($list as $rs) {
            // put in bold the written text
            $name = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $rs['univ_name']);
            // add new option
            echo '<li onclick="set_item(\''.str_replace("'", "\'", $rs['univ_name']).'\')">'.$name.'</li>';
        }
    }

    public function getPositions($id)
    {
        return $id;
        if (Request::ajax())
        {
            $positions = DB::table('sports_positions')->select('position_id','name')->where('sport_id', '=', $id)->get();
            return Response::json( $positions );
        }
    }
    public  function ajax()
{
    $cat = Input::get('cat_id');
    $sub = Addclass::where('class_name', '=', $cat)->get();
    return Response::json($sub);
}
    public  function ajax3()
    {
        $cat = Input::get('cat_id');
        $sub = Addclass::where('class_name', '=', $cat)->get();
        return Response::json($sub);
    }
    public  function ajax2()
    {
        $cat = Input::get('shift_id');
        $sub = Addclass::where('shift', '=', $cat)->get();
        return Response::json($sub);
    }
    public  function district()
    {
          $cat = Input::get('cat_id');
        $id  = AddressGeoCode::where('goname','=',$cat)->where('geolevel', '=', 1)->first();
        $sub = AddressGeoCode::where('georef', '=', $id->idgeocode)->where('geolevel', '=', 2)->get();
        return Response::json($sub);
    }

    public function thana()
    {
      
        $cat = Input::get('cat_id');
        $id  = AddressGeoCode::where('goname','=',$cat)->where('geolevel', '=', 2)->first();
        $sub = AddressGeoCode::where('georef', '=', $id->idgeocode)->where('geolevel', '=', 3)->get();
        return Response::json($sub);

    }
   public function classsectionsubjectss()
    {
       
     $class =Input::get('classs');
     $section =Input::get('section');;
       
        $classid = Addclass::where('class_name', '=', $class)->first();
        $subid = SubjectToClass::where('idclass', '=', $classid->class_id)->lists('idsubject');
        $subject = Subject::whereIn('idsubject',  $subid)->get();

        return Response::json($subject); 
    }
    
    public function ajax22()
    {
        $count=0;
        $cat = Input::get('cat_id');
        $classteacher = ClassTeacher::where('idclasssection','=',$cat)->where('idteacherinfo','=',Auth::user()->user_id)->first();
        if($classteacher!="")
        {
            $addclass  = Addclass::where('class_id','=',$cat)->first();
            $classinfo = Addclass::where('class_name','=',$addclass->class_name)->first();
            $sub = SubjectToClass::where('idclass', '=',$classinfo->class_id)->get();
        }

        else
            $sub = CourseTeacher::where('idclasssection', '=', $cat)->where('idteacherinfo','=',Auth::user()->user_id)->get();
        foreach($sub as $s) {
            $s = Subject::where('idsubject','=',$s->idsubject)->first();
            $so[$count++] = $s;
        }
        return Response::json($so);
    }

    public  function ajax4()
    {
        $cat = Input::get('cat_id');
        $sub = Studentinfo::where('idstudentinfo', '=', $cat)->get();
        return Response::json($sub);
    }
    public  function ajax5()
    {
        $cat = Input::get('cat_id');
        $sub = Addclass::where('class_name', '=', $cat)->get();
        return Response::json($sub);
    }
    public  function testfee()
    {
        $class = Input::get('cat');
        $section = Input::get('sub');
        return Redirect::to('fees_management/studentwise_fees_configuration')->with('class', $class)->with('section', $section);
    }
    public  function testfee1()
    {
        $student_id = Input::get('student_id');
        return Redirect::to('fees_management/studentwise_fees_configuration')->with('student_id', $student_id);
    }
    public  function ajax6()
    {
        $cat = Input::get('cat1_id');
        $section = Input::get('sub_id');
        $sub = Studentacademicinfo::where('class', '=', $cat)->where('section', '=', $section)->get();
        return Response::json($sub);
    }
    public  function ajax20()
{
    $cat = Input::get('cat_id');
    $sub = Addclass::where('shift', '=', $cat)->distinct()->orderBy('value','ASC')->get(array('class_name'));
    return Response::json($sub);
}
    public  function ajaxfees()
    {
        $cat = Input::get('cat_id');
        $sub = Addclass::where('class_name','=',$cat)->get();
        return Response::json($sub);
    }
    public  function ajaxchange()
    {
        $cat = Input::get('cat_id');
        $sub = Addclass::where('class_name','=',$cat)->get();
        return Response::json($sub);
    }

/*
    public  function ajaxresult()
    {
        $count=0;
        $cat = Input::get('cat_id');
        $sub = CourseTeacher::where('idclasssection', '=', $cat)->where('idteacherinfo','=',Auth::user()->user_id)->get();
        foreach($sub as $s) {
            $s = Subject::where('idsubject','=',$s->idsubject)->first();
            $so[$count++] = $s;
        }
        return Response::json($so);
    }
*/


   public  function ajaxresult()
    {
        $count=0;
        $cat = Input::get('cat_id');
        $sub = CourseTeacher::where('idclasssection', '=', $cat)->where('idteacherinfo','=',Auth::user()->user_id)
                 ->leftjoin('subject', 'subject.idsubject', '=', 'courseteacher.idsubject')
                 ->get();
        foreach($sub as $s) {
          //  $s = Subject::where('idsubject','=',$s->idsubject)->first();
            $so[$count++] = $s;
        }
        return Response::json($so);
    }


    public  function ajaxboolean()
    {
        $type = Input::get('a');
        $name = Input::get('b');
        $exam = Input::get('c');
        $value = Input::get('d');

        $config = MarksConfiguration::where('configuration_name','=',$name)->where('configuration_type','=',$type)->where('exam_name','=',$exam)->first();
        if(is_numeric($value))
        {
            if($value>=0&&$value<=$config->weighted_marks)
            {
                $sub=1;
            }
            else{
                $sub=2;
            }
        }
        else{
            $sub=0;
        }

        return Response::json($sub);
    }
    public  function ajaxsection()
    {
        $classname = Input::get('classname');
        $section = Input::get('sectionname');
        $sub = Addclass::where('class_name', '=', $classname)->where('section', '=', $section)->first();
        $teacher = CourseTeacher::where('idclasssection','=',$sub->class_id)->groupBy('teacher_initial')->get();
        return Response::json($teacher);
    }
    public  function ajaxshift()
    {
        $classname = Input::get('classname');
        $section = Input::get('sectionname');
        $shifts= Addclass::where('class_name', '=', $classname)->where('section', '=', $section)->get();
        return Response::json($shifts);
    }
    
      public  function ajaxpass()
    {
        $password = Input::get('password');
        if (Hash::check($password, Auth::user()->password))
        {
            $pass = 'true';
        }
        else
        {
            $pass = 'false';
        }
        return Response::json($pass);
    }

    public function ajaxyearsection () {
        $academic_year = Input::get('academic_year');
        $class_info = ClassTeacher::where('idteacherinfo', Auth::user()->user_id)
                        ->where('classteacher.academic_year', $academic_year)
                        ->join('addclass', 'addclass.class_id', '=', 'classteacher.idclasssection')
                        ->get();

        return Response::json($class_info);
    }


}