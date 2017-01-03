<?php


class ClassController extends \BaseController {

    public function create_class()
    {
        return View::make('classroom_management.create_class');
    }

    public function create_class2()
    {
        //return Input::all();
//        $section = Input::get('section' . 1);
        $class_name = Input::get('class_name');
        for ($j = 1; $j <= 90; $j++) {

            $addclass = new Addclass();
            $addclass->class_name = $class_name;
            $addclass->section = Input::get('section' . $j);
            $addclass->shift = Input::get('shift' . $j);

            if ($addclass->class_name != null && $addclass->section != null) {
                $addclass->save();
            }
        }

        return Redirect::to('classroom_management/create_class');
    }

    public function edit_class()
    {
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('classroom_management.edit_class')->with('classes',$class);
    }

    public function editable_class($class_id)
    {
        return View::make('classroom_management.editable_class')->with('classe_id',$class_id);
    }

    public function editable_class2()
    {
        //return Input::all();
        $i=0;
        $preclass_name=Input::get('previous_class_name');
        $class_name=Input::get('class_name');
        $classes=Addclass::where('class_name','=',$preclass_name)->get();
        foreach($classes as $class){
            $i++;

            Addclass::where('class_id', $class->class_id)->update(array(
                'class_name'=>$class_name,
                'section'=>Input::get('section' . $i),
                'shift'=>Input::get('shift' . $i)
            ));

        }
        return Redirect::to('classroom_management/edit_class');

    }
    public function assign_teacher_to_section()
    {
        $classsection = Session::get('classsection');
        $section = Session::get('section');
        $year12 = Session::get('year');
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        if($classsection!=null)
        {
            return View::make('classroom_management.assign_teacher_to_section')->with('class', $class)->with('classsection',$classsection)->with('section',$section)->with('year12',$year12);
        }

        return View::make('classroom_management.assign_teacher_to_section')->with('class', $class)->with('classsection',null);

    }
    public function assign_teacher_to_section2()
    {
        //return Input::all();
        $idsubjects = Input::get('idsubject');
        $idteacherinfoes = Input::get('idteacherinfo');
        $t1 = Input::get('idteach');
        $t2 = Input::get('idteach1');
        $idclasss = Input::get('idclass');
        $year = Input::get('year12');
        $c = count(Input::get('idsubject'));

        $test1 = TeacherInfo::where('idteacherinfo', '=', $t1)->pluck('teacher_initial');
        $test2 = TeacherInfo::where('idteacherinfo', '=', $t2)->pluck('teacher_initial');
        
        $test3 = TeacherInfo::where('idteacherinfo', '=', $t2)->pluck('teacher_initial');


        $v = null;
        $s =null;
        $sub =null;
        $idcls = null;

        for ($i = 0; $i < $c; $i++) {
            $courseteacher = CourseTeacher::where('idsubject','=',$idsubjects[$i])->where('idclasssection','=',$idclasss[$i])->where('year','=',$year)->first();
            if($courseteacher!=null && $courseteacher!="")
            {
                $test2 = TeacherInfo::where('idteacherinfo', '=', $idteacherinfoes[$i])->first();
                $input['idteacherinfo'] = $test2->idteacherinfo;
                $input['teacher_initial'] = $test2->teacher_initial;
                $subject2 = Subject::where('idsubject', '=', $idsubjects[$i])->first();
                $input['short_name'] = $test2->teacher_initial . ' ' . $subject2->subject_name;
                if($idteacherinfoes[$i]!=null)
                    CourseTeacher::where('idcourseteacher','=',$courseteacher->idcourseteacher)->update($input);
            }
            else {


                $course = new CourseTeacher();
                $course->idsubject = $idsubjects[$i];
                $test = TeacherInfo::where('idteacherinfo', '=', $idteacherinfoes[$i])->first();
                $course->idteacherinfo = $test->idteacherinfo;
                $course->teacher_initial = $test->teacher_initial;
                $course->year = $year;
                $course->idclasssection = $idclasss[$i];
                $subject = Subject::where('idsubject', '=', $idsubjects[$i])->first();

                if($subject->type == 'R') {
                    $v = $test->teacher_initial;
                    $s = $subject->idsubject;

                    $idcls = $course->idclasssection;
                    $course->type = 'RM';
                    $course->short_name = $v . '/' . $test1 . ' ' . $subject->subject_name;
                }
                elseif($subject->type == 'A'){


                    $v1 = $test->teacher_initial;
                    $s1 = $subject->idsubject;
                    $sub = $subject->type;
                    $idcls = $course->idclasssection;
                    $course->type = 'AG';
                    $course->short_name = $v1 . '/' . $test3 . ' ' . $subject->subject_name;

                }else{


                    $course->type = 'N';
                    $course->short_name = $test->teacher_initial . ' ' . $subject->subject_name;

                }
                if ($subject != null) {
                    $course->save();
                }
            }


        }


        if($t1) {
            $course = new CourseTeacher();
            $course->idsubject = $s;
            $test2 = TeacherInfo::where('idteacherinfo', '=', $t1)->pluck('teacher_initial');
            $course->idteacherinfo = $t1;
            $course->teacher_initial = $test2;

            $course->year = $year;
            $course->idclasssection = $idcls;
            $subject = Subject::where('idsubject', '=', $s)->first();

            $course->type = 'RH';
            $course->short_name = $v . '/' . $test1 . ' ' . $subject->subject_name;
            if ($subject != null) {
                $course->save();
            }

        }

        if($t2 && $sub =='A') {
            $course = new CourseTeacher();
            $course->idsubject = $s1;
            $test3 = TeacherInfo::where('idteacherinfo', '=', $t2)->pluck('teacher_initial');
            $course->idteacherinfo = $t2;
            $course->teacher_initial = $test3;
            $course->year = $year;
            $course->idclasssection = $idcls;
            $subject = Subject::where('idsubject', '=', $course->idsubject)->first();

            $course->type = 'HS';
            $course->short_name = $v1 . '/' . $test3 . ' ' . $subject->subject_name;
            if ($subject != null) {
                $course->save();
            }

        }




        return Redirect::to('classroom_management/assign_teacher_to_section');

    }

    public function courseteacher12(){
        //return Input::all();

        $class = Input::get('cat');
        $section = Input::get('sub');
        $cls = Addclass::where('class_name','=',$class)->where('section','=',$section)->first();
        $cl = Addclass::where('class_name','=',$class)->first();
        if($cl!="")
            $classsection = SubjectToClass::where('idclass','=',$cl->class_id)->get();

        if($classsection!="[]")
        {
            return Redirect::to('classroom_management/assign_teacher_to_section')->with('classsection',$classsection)->with('section',$cls)->with('year',Input::get('year'));
        }
        else
        {
            return Redirect::to('classroom_management/assign_teacher_to_section')->with('classsection',null);
        }

        //return Redirect::back();

    }
    public function search_courseteacher()
    {
        return Redirect::to('classroom_management/assign_class_teacher')->with('year2',Input::get('year'));
    }

    public function assign_class_teacher()
    {
        $year2 = Session::get('year2');
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('classroom_management.assign_class_teacher')->with('class', $class)->with('year2',$year2);

    }
    public function assign_class_teacher2()
    {
        //return Input::all();
        $classes = Input::get('idclasssection');
        $c = count(Input::get('idclasssection'));
        $years = Input::get('ac_year');
        $idteacherinfoes = Input::get('idteacherinfo');

        for ($i = 0; $i < $c; ++$i) {
            $class = ClassTeacher::where('idclasssection','=',$classes[$i])->where('academic_year','=',$years[$i])->first();
            if($class!=null&&$class!="")
            {
                $input['idteacherinfo'] = $idteacherinfoes[$i];
                if($idteacherinfoes[$i]!=null)
                    ClassTeacher::where('idclassteacher','=',$class->idclassteacher)->update($input);
            }
            else {
                $classteacher = new ClassTeacher();
                $classteacher->idclasssection = $classes[$i];
                $classteacher->idteacherinfo = $idteacherinfoes[$i];
                $classteacher->academic_year = $years[$i];
                if ($idteacherinfoes[$i] != null) {
                    $classteacher->save();
                }
            }
        }
        return Redirect::to('classroom_management/assign_class_teacher');

    }

//    public function changeshift()
//    {
//        $shift = Session::get('shift');
//        $class = Session::get('class');
//        if ($shift != null && $class != null) {
//            $classsection = StudentToSectionUpdate::where('class', '=', $class)->where('shift', '=', $shift)->get();
//            $shifts = Addclass::groupBy('shift')->get();
//            if($classsection!="[]")
//                return View::make('class.changeshift', compact('shifts', $shifts))->with('classsection', $classsection);
//            else
//                return View::make('class.changeshift', compact('shifts', $shifts))->with('classsection', null);
//        } else {
//            $shifts = Addclass::groupBy('shift')->get();
//            return View::make('class.changeshift', compact('shifts', $shifts))->with('classsection', null);
//        }
//    }
//    public function changeshift2()
//    {
//        $shift = Input::get('shift');
//        $class = Input::get('class');
//        return Redirect::to('student/changeshift')->with('shift', $shift)->with('class', $class);
//    }
//    public function postchangeshift()
//    {
//        //return Input::all();
//        $c = count(Input::get('student_idstudentinfo'));
//        $student_idstudentinfo = Input::get('student_idstudentinfo');
//        $merit_position = Input::get('merit_position');
//        $resultCGPA = Input::get('resultCGPA');
//        $marks = Input::get('marks');
//        $p_section = Input::get('p_section');
//        $p_class = Input::get('p_class');
//        $idUpdate = Input::get('idUpdate');
//        $class = Input::get('class');
//        $p_shift = Input::get('p_shift');
//        $section = Input::get('section');
//        $year = Input::get('year');
//        for ($i = 0; $i < $c; ++$i) {
//            $insert = new StudentToSection();
//            $insert->student_idstudentinfo = $student_idstudentinfo[$i];
//            $insert->merit_position = $merit_position[$i];
//            $insert->resultCGPA = $resultCGPA[$i];
//            $insert->marks = $marks[$i];
//            $insert->section = $section[$i];
//            $insert->class = $class[$i];
//            $insert->year = $year;
//            $insert->shift = $p_shift[$i];
//            $insert->save();
//            $u['class'] = $class[$i];
//            $u['section'] =$section[$i];
//            StudentToSectionUpdate::where('idStudentToSectionUpdate','=',$idUpdate[$i])->update($u);
//        }
//
//        return Redirect::to('student/changeshift');
//    }


}