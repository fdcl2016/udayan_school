<?php

class SubjectController extends \BaseController {

    public function create_subject()
    {
        return View::make('subject_management.create_subject');
    }
    public function post_create_subject()
    {
        //return Input::all();
        $c = count(Input::get('subject_name'));
        $subject_name = Input::get('subject_name');
        for ($i = 0; $i < $c; ++$i) {
            $subject = new Subject();
            $subject->subject_name = $subject_name[$i];
            $test = Subject::where('subject_name', '=', $subject_name[$i])->first();
            if ($test == null) {
                $subject->save();
            }
        }

        return Redirect::to('subject_management/create_subject');

    }

    public function list_of_subject()
    {
        $subject = Subject::all();
        return View::make('subject_management.edit_subject',compact('subject'));
    }

    public function edit_subject($id)
    {
        $subject = Subject::where('idsubject', '=', $id)->first();
        return View::make('subject_management.edit_subject_individual', compact('subject', $subject));
    }

    public function post_edit_subject()
    {
        //return Input::all();
        $id = Input::get('id');
        $name['subject_name'] = Input::get('subject_name');
        Subject::where('idsubject', '=', $id)->update($name);
        return Redirect::to('subject_management/edit_subject');
    }

    public function assign_subject_to_teacher()
    {
        return View::make('subject_management.assign_subject_to_teacher');
    }
    public function post_assign_subject_to_teacher()
    {
        $c = count(Input::get('subject_name'));
        $subject_name = Input::get('subject_name');
        $teacher_name = Input::get('teacher_name');
        $date = Input::get('date');
        for ($i = 0; $i < $c; ++$i) {
            $subject = new SubjectAssign();
            $subject->subject_idsubject = $subject_name[$i];
            $subject->teacher_idteacherinfo = $teacher_name[$i];
            $test = SubjectAssign::where('subject_idsubject', '=', $subject_name[$i])->where('teacher_idteacherinfo', '=', $teacher_name[$i])->first();
            $subject->year = $date[$i];
            if ($test == null) {
                $subject->save();
            }
        }

        return Redirect::to('subject_management/assign_subject_to_teacher');

    }

    public function classwise_subject(){

        $subject = Subject::all();
        $classess = Addclass::groupBy('class_name')->get();
        $marks = MarksConfiguration::groupBy('configuration_name')->get();
        if($subject!=null&&$classess!=null) {
            return View::make('subject_management.classwise_subject')->with('subject', $subject)->with('classess', $classess)->with('marks', $marks);
        }
        else{
            return Redirect::to('subject_management.create_subject');
        }
    }

    public function saveSubjectToClass()
    {
        //return Input::all();
        $class = Input::get('class_name');
        $cl = Addclass::where('class_name','=',$class)->groupBy('class_name')->get();
        $count =count(Input::get('subject_name'));
        $subject_name = Input::get('subject_name');
        $conf_name = Input::get('conf_name');
        for($cout=0;$cout<$count;++$cout)
        {
            foreach($cl as $c) {
                $cc = new SubjectToClass();
                $cc->idclass = $c->class_id;
                $cc->class = $c->class_name;
                $cc->idsubject = $subject_name[$cout];
                $cc->markconfiguration_name = $conf_name[$cout];
                $cc->save();
            }
        }
        return Redirect::to('subject_management/classwise_subject');
    }

    public function classwise_subject_list()
    {
        $subject = SubjectToClass::all();
        return View::make('subject_management.classwise_subject_list',compact('subject'));
    }

    public function edit_subject_classwise($idsubjecttoclass)
    {
        $marks = MarksConfiguration::groupBy('configuration_name')->get();
        $subject = SubjectToClass::where('idsubjecttoclass','=',$idsubjecttoclass)->first();
        return View::make('subject_management.edit_subject_classwise')->with('marks',$marks)->with('subject',$subject);
    }

    public function edit_subject_classwise2()
    {
        // return Input::all();
        $input['markconfiguration_name'] = Input::get('conf_name');
        SubjectToClass::where('idsubjecttoclass','=', Input::get('idsubjecttoclass'))->update($input);
        return Redirect::to('/subject_management/classwise_subject_list');
    }

 public function fourthsub()
    {

      $count =count(Input::get('idstudentinfo'));
      $idstudentinfo = Input::get('idstudentinfo');
      $yr   = Input::get('yr');
      $clisd   = Input::get('clisd');
      $four = Input::get('fs');

     for ($i = 0; $i < $count; $i++) {

        $f = new AssignFourthSub();

        $f->st_id = $idstudentinfo[$i];
        $f->year = $yr;
        $f->idsubject = $four[$i];
        $f->class_id = $clisd;

        $f->save();


      }

       return Redirect::to('/subject_management/fourth_subject');

    }

}
