<?php

class StudentInfoController extends \BaseController {
    public function createStudent()
    {
        $academic_info =Studentinfo::OrderBy('idstudentinfo','desc')->pluck('registration_id');
        if ($academic_info==null || $academic_info=="") {
            $academic_info="2015090001";
        }

        $current_year=date('Y');
        $arrayOfLastUpdateStudentRegistrationId = str_split($academic_info);
        $arrayOfCurrentYear = str_split($current_year);

        $arrayOfCurrentYearInteger=integerParse(4 , $arrayOfCurrentYear);
        $arrayOfLastUpdateStudentRegistrationIdInteger=integerParse(count($arrayOfLastUpdateStudentRegistrationId) , $arrayOfLastUpdateStudentRegistrationId);



        $lastdisite = lastdisiteTeacher($arrayOfLastUpdateStudentRegistrationIdInteger,count($arrayOfLastUpdateStudentRegistrationIdInteger));

        $lastdisite=$lastdisite[6] . $lastdisite[7] . $lastdisite[8] . $lastdisite[9];

        $countDisite=integerParse(4 , $lastdisite);

        $countYear=$arrayOfCurrentYearInteger[0]+$arrayOfCurrentYearInteger[1]+$arrayOfCurrentYearInteger[2]+$arrayOfCurrentYearInteger[3];
        $countLastFourdisitOfRegistrationId=$countDisite[0] + $countDisite[1] + $countDisite[2] + $countDisite[3];

        if ($countYear>$countLastFourdisitOfRegistrationId) {
            $middleTwoNumber=twoDisitMode($countYear , $countLastFourdisitOfRegistrationId);
        } else {
            $middleTwoNumber=twoDisitMode($countLastFourdisitOfRegistrationId , $countYear);
        }


        $studentRegistrationId=$current_year . $middleTwoNumber . $lastdisite;


        $reg = $studentRegistrationId;

        $student = new Studentinfo;

        $student->sutdent_name = Input::get('student_name');
        $student->registration_id =$reg;
        $student->gender= Input::get('gender');
        $student->blood_group = Input::get('bloodGroup');
        // $start_day_old = Input::get('date_of_birth');
        // $start_day = date("d-m-Y", strtotime($start_day_old));
        // $student->date_of_birth = $start_day;
        $student->date_of_birth = Input::get('studentdateofbirth');
        //$student->fathers_dateofbirth = Input::get('fatherdateofbirth');
        // $student->mothers_dateofbirth = Input::get('motherdateofbirth');

        $student->religion = Input::get('religion');
        $student->mobile1 = Input::get('mobile1');
        $student->mobile2 = Input::get('mobile2');
        $student->email = Input::get('email');
        $student->father_name = Input::get('fatherName');
        $student->mother_name = Input::get('motherName');
        $student['mothers_mobile'] = Input::get('mothers_mobile');
        $student['fathers_mobile'] = Input::get('fathers_mobile');
        // $student->fathers_dateofbirth = Input::get('fatherdateofbirth');
        // $student->mothers_dateofbirth = Input::get('motherdateofbirth');
        $student->fathers_occupation = Input::get('fatherOccupation');
        $student->mothers_occupation = Input::get('motherOccupation');
        $student->fathers_income = Input::get('fatherincome');
        $student->mothers_income = Input::get('motherincome');




        $student->preaddressline = Input::get('preaddressline');
        $student->p_district = Input::get('presentDistrict');
        $student->p_thana = Input::get('presentThana');
        $student->p_union = Input::get('presentUnion');
        if(Input::get('same_address_flag')==0) {
            $student->peraddressline = Input::get('peraddressline');
            $student->per_district = Input::get('parmanentDistrict');
            $student->per_thana = Input::get('parmanentThana');
            $student->per_union = Input::get('parmanentUnion');
        }
        else
        {
            $student->peraddressline = Input::get('preaddressline');
            $student->per_district = Input::get('presentDistrict');
            $student->per_thana = Input::get('presentThana');
            $student->per_union = Input::get('presentUnion');
        }


        $image1 = Input::file('studentimagefile');
        $destination = public_path('uploads/');
        if ($student->sutdent_name != null) {
            if ($image1 != null) {
                $filename = $image1->getClientOriginalName();
                $ex = $image1->getClientOriginalExtension();
                if(Image::make($image1->getRealPath())->resize(680,680)->save($destination.$reg.'.'.$ex)) {
                    $student->image = $reg.'.'.$ex;
                }
            }
        }

        $image2 = Input::file('fatherimagefile');
        $destination = public_path('uploads/');
        if ($student->sutdent_name != null) {
            if ($image2 != null) {
                $filename = $image2->getClientOriginalName();
                $ex = $image2->getClientOriginalExtension();
                if(Image::make($image2->getRealPath())->resize(680,680)->save($destination.$reg.'_father.'.$ex)) {
                    $student->fathers_image = $reg.'_father.'.$ex;
                }
            }
        }

        $image3 = Input::file('motherimagefile');
        $destination = public_path('uploads/');
        if ($student->sutdent_name != null) {
            if ($image3 != null) {
                $filename = $image3->getClientOriginalName();
                $ex = $image3->getClientOriginalExtension();
                if(Image::make($image3->getRealPath())->resize(680,680)->save($destination.$reg.'_mother.'.$ex)) {
                    $student->mothers_image = $reg.'_mother.'.$ex;
                }
            }
        }
        $academicyear=AcademicYear::OrderBy('idacademic_year','desc')->first();
        $student->admission_year=$academicyear->academic_year;
        $student->save();

        $student_info = Studentinfo::orderBy('idstudentinfo', 'desc')->first();
        $user=new User();
        $user->username = $student_info->sutdent_name;
        $user->email = $student_info->registration_id;
        $user->password = Hash::make($student_info->registration_id);
        $user->user_id = $student_info->idstudentinfo;
        $user->type = "student";
        $user->save();



        return Redirect::to('student_management/addstudent');

    }

    public function addstudent()
    {
        $district = AddressGeoCode::where('geolevel','=',1)->get();
        //return $district;
        $class = Addclass::groupby('class_name')->get();
        $subjects=Subject::lists('subject_name');

        $academic_info =Studentinfo::OrderBy('idstudentinfo','desc')->pluck('registration_id');

        if ($academic_info==null || $academic_info=="") {
            $academic_info="2015090001";
        }

        $current_year=date('Y');
        $arrayOfLastUpdateStudentRegistrationId = str_split($academic_info);
        $arrayOfCurrentYear = str_split($current_year);

        $arrayOfCurrentYearInteger=integerParse(4 , $arrayOfCurrentYear);
        $arrayOfLastUpdateStudentRegistrationIdInteger=integerParse(count($arrayOfLastUpdateStudentRegistrationId) , $arrayOfLastUpdateStudentRegistrationId);



        $lastdisite = lastdisiteTeacher($arrayOfLastUpdateStudentRegistrationIdInteger,count($arrayOfLastUpdateStudentRegistrationIdInteger));

        $lastdisite=$lastdisite[6] . $lastdisite[7] . $lastdisite[8] . $lastdisite[9];

        $countDisite=integerParse(4 , $lastdisite);

        $countYear=$arrayOfCurrentYearInteger[0]+$arrayOfCurrentYearInteger[1]+$arrayOfCurrentYearInteger[2]+$arrayOfCurrentYearInteger[3];
        $countLastFourdisitOfRegistrationId=$countDisite[0] + $countDisite[1] + $countDisite[2] + $countDisite[3];

        if ($countYear>$countLastFourdisitOfRegistrationId) {
            $middleTwoNumber=twoDisitMode($countYear , $countLastFourdisitOfRegistrationId);
        } else {
            $middleTwoNumber=twoDisitMode($countLastFourdisitOfRegistrationId , $countYear);
        }


        $studentRegistrationId=$current_year . $middleTwoNumber . $lastdisite;




        return View::make('student_management.addstudent', compact('district', $district))
            ->with('user', $class)
            ->with('studentRegistrationId', $studentRegistrationId);

    }






    public function studentInfo()

    {

        //$student = Studentinfo::all();
        //  return View::make('student_management.liststudent')-> with('student', $student);

        $class = Input::get('cat');
        $section = Input::get('sub');
        $cls = Addclass::where('class_name','=',$class)->where('section','=',$section)->first();
        $cl = Addclass::where('class_name','=',$class)->first();
        if($cl!="")
            $classsection = SubjectToClass::where('idclass','=',$cl->class_id)->get();


        return Redirect::to('student_management.liststudent')->with('classsection',$classsection)->with('section',$cls)->with('year',Input::get('year'));


        return Redirect::to('student_management.liststudent')->with('classsection',null);



    }



    public function studentInfo2()

    {

        // $student = Studentinfo::all();
        // return View::make('student_management.liststudent')-> with('student', $student);

        $class = Input::get('cat');
        $section = Input::get('sub');
        $cls = Addclass::where('class_name','=',$class)->where('section','=',$section)->first();
        $cl = Addclass::where('class_name','=',$class)->first();
        if($cl!="")
            $classsection = SubjectToClass::where('idclass','=',$cl->class_id)->get();

        if($classsection!="[]")
        {
            return Redirect::to('student_management.liststudent')->with('classsection',$classsection)->with('section',$cls)->with('year',Input::get('year'));
        }
        else
        {
            return Redirect::to('student_management.liststudent')->with('classsection',null);
        }



    }



    public function studentEdit($id)
    {
        $district=AddressGeoCode::where('geolevel','=',1)->get();
        $student = Studentinfo::where('idstudentinfo', '=', $id)->first();
        if($student!=null) {
            return View::make('student_management.editstudent', compact('student', $student))->with('district', $district);
        }
        else{
            return Redirect::to('student_management.listEditstudent');
        }
    }

    public function studentView($id)
    {
        $district=AddressGeoCode::where('geolevel','=',1)->get();
        $student = Studentinfo::where('idstudentinfo', '=', $id)->first();
        if($student!=null) {
            return View::make('student_management.viewstudent', compact('student', $student))->with('district', $district);
        }
        else{
            return Redirect::to('student_management.listEditstudent');
        }
    }


    public function studentEditPost()
    {
        //return Input::all();
        $name=Input::get('student_name');
        $reg=Input::get('student_id');
        $student['sutdent_name'] = Input::get('student_name');
        $student['registration_id'] = Input::get('student_id');
        $student['gender']= Input::get('gender');
        $student['blood_group'] = Input::get('bloodGroup');
        // $start_day_old = Input::get('date_of_birth');
        // $start_day = date("d-m-Y", strtotime($start_day_old));
        // $student->date_of_birth = $start_day;
        $student['religion'] = Input::get('religion');
        $student['mobile1'] = Input::get('mobile1');
        $student['mobile2'] = Input::get('mobile2');
        $student['email'] = Input::get('email');
        $student['father_name'] = Input::get('fatherName');
        $student['mother_name'] = Input::get('motherName');

        // $student['fathers_dateofbirth'] = Input::get('fatherdateofbirth');
        // $student['mothers_dateofbirth'] = Input::get('motherdateofbirth');
        $student['mothers_mobile'] = Input::get('mothers_mobile');
        $student['fathers_mobile'] = Input::get('fathers_mobile');

        $student['fathers_occupation'] = Input::get('fatherOccupation');
        $student['mothers_occupation'] = Input::get('motherOccupation');
        $student['fathers_income'] = Input::get('fatherincome');
        $student['mothers_income'] = Input::get('motherincome');

        $student['preaddressline'] = Input::get('preaddressline');
        $student['p_district'] = Input::get('presentDistrict');
        $student['p_thana'] = Input::get('presentThana');
        $student['p_union'] = Input::get('presentUnion');

        if(Input::get('same_address_flag')==0) {
            //  return "egr3g";
            $student['peraddressline'] = Input::get('peraddressline');
            $student['per_district'] = Input::get('parmanentDistrict');
            $student['per_thana'] = Input::get('parmanentThana');
            $student['per_union'] = Input::get('parmanentUnion');
        }
        else
        {
            $student['peraddressline'] = Input::get('preaddressline');
            $student['per_district'] = Input::get('presentDistrict');
            $student['per_thana'] = Input::get('presentThana');
            $student['per_union'] = Input::get('presentUnion');
        }


        $student['date_of_birth'] = Input::get('studentdateofbirth');
        $student['fathers_dateofbirth'] = Input::get('fatherdateofbirth');
        $student['mothers_dateofbirth'] = Input::get('motherdateofbirth');

        $image1 = Input::file('studentimagefile');
        $destination = public_path('uploads/');
        if ($name != null) {
            if ($image1 != null) {
                $filename = $image1->getClientOriginalName();
                $ex = $image1->getClientOriginalExtension();
                if(Image::make($image1->getRealPath())->resize(680,680)->save($destination.$reg.'.'.$ex)) {
                    $student['image'] = $reg.'.'.$ex;
                }
            }
        }

        $image1 = Input::file('fatherimagefile');
        $destination = public_path('uploads/');
        if ($name != null) {
            if ($image1 != null) {
                $filename = $image1->getClientOriginalName();
                $ex = $image1->getClientOriginalExtension();
                if(Image::make($image1->getRealPath())->resize(680,680)->save($destination.$reg.'_father.'.$ex)) {
                    $student['fathers_image'] = $reg.'_father.'.$ex;
                }
            }
        }

        $image1 = Input::file('motherimagefile');
        $destination = public_path('uploads/');
        if ($name != null) {
            if ($image1 != null) {
                $filename = $image1->getClientOriginalName();
                $ex = $image1->getClientOriginalExtension();
                if(Image::make($image1->getRealPath())->resize(680,680)->save($destination.$reg.'_mother.'.$ex)) {
                    $student['mothers_image'] = $reg.'_mother.'.$ex;
                }
            }
        }
        $id = Input::get('id');
        Studentinfo::where('idstudentinfo','=',$id)->update($student);



        //return Redirect::to('student_management/listeditstudent');
         return Redirect::to('/info');

    }


    public function assignStudenttoSection()
    {

        $shift = Session::get('shift');
        $class = Session::get('class');

        if ($shift != null && $class != null) {
            $classsection = StudentToSectionUpdate::where('class', '=', $class)->where('shift', '=', $shift)->get();
            $shifts = Addclass::groupBy('shift')->get();
            if($classsection!="[]")
                return View::make('student_management/assign_student_to_section', compact('shifts', $shifts))->with('classsection', $classsection);
            else
                return View::make('student_management/assign_student_to_section', compact('shifts', $shifts))->with('classsection', null);
        } else {
            $shifts = Addclass::groupBy('shift')->get();
            return View::make('student_management/assign_student_to_section', compact('shifts', $shifts))->with('classsection', null);
        }

    }

    public function changeShift()
    {
        $shift = Input::get('shift');
        $class = Input::get('class');
        return Redirect::to('student_management/assign_student_to_section')->with('shift', $shift)->with('class', $class);

    }

    public function changeShiftpost()
    {
        $c = count(Input::get('student_idstudentinfo'));
        $student_idstudentinfo = Input::get('student_idstudentinfo');
        $merit_position = Input::get('merit_position');
        $resultCGPA = Input::get('resultCGPA');
        $marks = Input::get('marks');
        $p_section = Input::get('p_section');
        $p_class = Input::get('p_class');
        $idUpdate = Input::get('idUpdate');
        $class = Input::get('class');
        $p_shift = Input::get('p_shift');
        $section = Input::get('section');
        $year = Input::get('year');
        for ($i = 0; $i < $c; ++$i) {
            $insert = new StudentToSection();
            $insert->student_idstudentinfo = $student_idstudentinfo[$i];
            $insert->merit_position = $merit_position[$i];
            $insert->resultCGPA = $resultCGPA[$i];
            $insert->marks = $marks[$i];
            $insert->section = $section[$i];
            $insert->class = $class[$i];
            $insert->year = $year;
            $insert->shift = $p_shift[$i];
            $insert->save();
            $u['class'] = $class[$i];
            $u['section'] =$section[$i];
            StudentToSectionUpdate::where('idStudentToSectionUpdate','=',$idUpdate[$i])->update($u);
        }

        return Redirect::to('student_management/assign_student_to_section');

    }

    public function student_routine()
    {
        $id = Auth::user()->id;
        $currentuser = User::find($id);
        $idstudent_info = $currentuser->email;
        $student_academic = StudentToSectionUpdate::where('student_idstudentinfo', '=', $idstudent_info)->first();

        $shift = $student_academic->shift;
        // return $shift;
        $class = $student_academic->class;
        $section = $student_academic->section;


        $class_section = Addclass::where('class_name', '=', $class)->where('section', '=', $section)->first();

        $class_section_id = $class_section->class_id;

        $routine_confuguration = Configuration::where('shift', '=', $shift)->first();

        if ($routine_confuguration!=null) {

            $routine_confuguration_id = $routine_confuguration->idconfiguration;
            $number_of_class = $routine_confuguration->number_period;
            $class_start_time = $routine_confuguration->class_start_time;
            $class_duration = $routine_confuguration->class_duration;
            $tiffin_breake = $routine_confuguration->tiffin_breake;
            $tiffin_duration = $routine_confuguration->tiffin_duration;

            $routine = RoutineCreate::where('course_section_id', '=', $class_section_id)->get();

            //return $tiffin_breake;
            return View::make('routine.student_routine')->with('routines', $routine)
                ->with('number_of_period', $number_of_class)
                ->with('class_start_time', $class_start_time)
                ->with('class_duration', $class_duration)
                ->with('tiffin_break', $tiffin_breake)
                ->with('tiffin_duration', $tiffin_duration);
        }
        else
        {
            return View::make('routine.student_routine')->with('routines', null)
                ->with('number_of_period', null)
                ->with('class_start_time', null)
                ->with('class_duration', null)
                ->with('tiffin_break', null)
                ->with('tiffin_duration', null);
        }

    }
}