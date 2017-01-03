<?php

class TeacherInfoController extends \BaseController {

	public function addTeacher()
   {
     $departments=Department::groupby('department_name')->get();
     $district=AddressGeoCode::where('geolevel','=',1)->get();
	 return View::make('staff_management.addteacher')->with('departments',$departments)->with('district',$district);


  }
public function addTeacherpost()
{

 $teacher =TeacherInfo::OrderBy('idteacherinfo','desc')->pluck('teacher_id');

 $teacher_type='teacher';
   
 $type="6";
  
 $typeInt = (int) $type;
 $typeString = (int) $type;

if ($teacher==null || $teacher=="") {
 $teacher="1560001";
}

$current_year=date('Y');
$arrayOfLastUpdateTeacherId = str_split($teacher);
$arrayOfCurrentYear = str_split($current_year);

$arrayOfCurrentYearInteger=integerParse(4 , $arrayOfCurrentYear);
$arrayOfLastUpdateTeacherIdInteger=integerParse(count($arrayOfLastUpdateTeacherId) , $arrayOfLastUpdateTeacherId);

$lastdisite = lastdisiteTeacher($arrayOfLastUpdateTeacherIdInteger,count($arrayOfLastUpdateTeacherIdInteger));

 $lastdisite1=$lastdisite[4] . $lastdisite[5] . $lastdisite[6];
 $lastdisite2=$lastdisite[3] . $lastdisite[4] . $lastdisite[5] . $lastdisite[6];

$countDisite=integerParse(4 , $lastdisite2);

$countYear=$arrayOfCurrentYearInteger[0]+$arrayOfCurrentYearInteger[1]+$arrayOfCurrentYearInteger[2]+$arrayOfCurrentYearInteger[3];
$countLastFourdisitOfTeacherId=$countDisite[0]+$countDisite[1]+$countDisite[2]+$countDisite[3];

$middleOneNumber=actualDisitMode( actualDisitMode($countLastFourdisitOfTeacherId , $countYear) , $typeInt);

//return $countLastFourdisitOfTeacherId;

$teacherId=$typeString . $arrayOfCurrentYear[2] . $arrayOfCurrentYear[3] . $middleOneNumber . $lastdisite1;
$teacherId = (string) $teacherId;

    $subject="";
    $flag=0;
    for ($i=1; $i < 100; $i++) {
        $sub=Input::get('subject' . $i);
        if ($sub!=null) {
            if ($flag==0) {
                $subject=$sub;
                $flag=1;
            }
            $subject=$subject ."," . $sub;
        }
    }


    $teacherinfo = new TeacherInfo();
    $teacherinfo->subject =$subject;
    $teacherinfo->teacher_id =$teacherId;

    $teacherinfo->teacher_type = 'teacher';//Input::get('type');

    $teacherinfo->teacher_name = Input::get('teachername');
    $teacherinfo->gender = Input::get('gender');
    $teacherinfo->blood_group = Input::get('blood_group');
    $teacherinfo->designation = Input::get('dateofbirth');
    $teacherinfo->religion = Input::get('religion');
    $teacherinfo->maraital_status = Input::get('marraige');
    $teacherinfo->father_name = Input::get('fathers_name');
    $teacherinfo->mother_name = Input::get('mothers_name');
    $teacherinfo->fathers_occupation = Input::get('fathers_occupation');
    $teacherinfo->mothers_occupation = Input::get('mothers_occupation');
     $teacherinfo->fathers_mobile = Input::get('fathers_mobile');
    $teacherinfo->mothers_mobile = Input::get('mothers_mobile');

    $teacherinfo->teacher_mobile1 = Input::get('mobile1');
    $teacherinfo->teacher_mobile2 = Input::get('mobile2');
    $teacherinfo->email = Input::get('email');
    $teacherinfo->teacher_initial = Input::get('teacher_initial');
    $teacherinfo->joining_date = Input::get('joining_date');
    $teacherinfo->designation = Input::get('designation');
     $teacherinfo->department = Input::get('department');
    $teacherinfo->teacher_salary = Input::get('salary');

    $teacherinfo->dateofbirth = Input::get('dateofbirth');
    $teacherinfo->joining_date = Input::get('joining_date');



//    $teacherinfo->image = Input::get('');
//     $start_day_old = Input::get('date_of_birth');
//     $start_day = date("d-m-Y", strtotime($start_day_old));
//     $teacherinfo->date_of_birth =$start_day;
//
//     $start_day_old1 = Input::get('txtDateOfJoin');
//     $start_day1 = date("d-m-Y", strtotime($start_day_old1));
//     $teacherinfo->date_of_join =$start_day1;
//
    $image = Input::file('imagefile');
  $destination = public_path('uploads/');

    if($image!=null) {
      $filename = Str::lower(
        pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
        . '-'
        . uniqid()
        . '.'
        . $image->getClientOriginalExtension()
      );

      $image->move($destination, $filename);
      $teacherinfo->image = $filename;

    }
//
//
   $cv = Input::file('cv');
    $destination1 = public_path('uploads');
    if($cv!=null) {
      $filename1 = Str::lower(
        pathinfo($cv->getClientOriginalName(), PATHINFO_FILENAME)
        . '-'
        . uniqid()
        . '.'
        . $cv->getClientOriginalExtension()
      );

      $cv->move($destination1, $filename1);
      $teacherinfo->cv = $filename1;

    }



    $teacherinfo->preaddress_line = Input::get('preaddressline');
     $teacherinfo->p_district = Input::get('presentDistrict');
    $teacherinfo->p_union = Input::get('presentUnion');
     $teacherinfo->p_thana = Input::get('presentThana');
    if(Input::get('same_address_flag')==0) {
        $teacherinfo->peraddress_line = Input::get('paraddressline');
        $teacherinfo->per_district = Input::get('parmanentDistrict');
        $teacherinfo->per_thana = Input::get('parmanentThana');
        $teacherinfo->per_union = Input::get('parmanentUnion');
}
    else{
         $teacherinfo->peraddress_line = Input::get('preaddressline');
         $teacherinfo->per_district = Input::get('presentDistrict');
         $teacherinfo->per_thana = Input::get('presentThana');
         $teacherinfo->per_union = Input::get('presentUnion');

    }
    $teacherinfo->save();

    $teacherinfo1 = TeacherInfo::orderBy('idteacherinfo','desc')->first();
    $user=new User();
    $user->username = $teacherinfo1->teacher_name;
    $user->email = $teacherinfo1->teacher_id;
    $user->password = Hash::make($teacherinfo1->teacher_id);
    $user->user_id = $teacherinfo1->idteacherinfo;
    $user->type = "teacher";
    $user->save();
    

    $temp=0;
    for ( $i=1; $i< 100; ++$i) {
      $value=Input::get('degree' . $i);
      if($value!=null&&$value!=''){
   
      $reserve = new TeacherAcademicInfo();
      $reserve->name_of_degree = Input::get('degree' . $i);
      $reserve->session = Input::get('session' . $i);
      $reserve->passing_year= Input::get('passingYear' . $i);
      $reserve->result = Input::get('result' . $i);
      $reserve->institution = Input::get('institute' . $i);
      $reserve->boardname = Input::get('board' . $i);
      $t = TeacherInfo::orderBy('idteacherinfo','desc')->first();
      $reserve->teacherinfo_idteacherinfo = $t->idteacherinfo;
      $reserve->save();
    }
    }

    for ( $i=1; $i< 100; ++$i) {
      $value=Input::get('orgName' . $i);
      if($value!=null&&$value!=''){
      $reserve = new TeacherWorkingExperience();
      $reserve->organization_name = Input::get('orgName' . $i);
      $reserve->position = Input::get('position' . $i);
      $reserve->description= Input::get('jobDesc' . $i);
      $reserve->length_of_service = Input::get('duration' . $i);
      $t = TeacherInfo::orderBy('idteacherinfo','desc')->first();
      $reserve->teacherinfo_idteacherinfo = $t->idteacherinfo;
      $reserve->save();
    }
    }
    return Redirect::to('staff_management/addteacher');
}

 public function listTeacher()
{
  $teachers = TeacherInfo::all();
  return View::make('staff_management.listEditTeacher', compact('teachers', $teachers));
}
public function editTeacher($id)
{
  $departments=Department::groupby('department_name')->get();
  $district=AddressGeoCode::where('geolevel','=',1)->get();
  $teacher = TeacherInfo::where('idteacherinfo', '=', $id)->first();
  $academics = TeacherAcademicInfo::where('teacherinfo_idteacherinfo', '=', $id)->get();
  $works = TeacherWorkingExperience::where('teacherinfo_idteacherinfo', '=', $id)->get();
	return View::make('staff_management.editteacher')
              ->with('departments',$departments)
              ->with('teacher',$teacher)
              ->with('district',$district);
}

public function updateTeacher()
{

  
    
    $teacherinfo['teacher_id'] =Input::get('registration_id');
    $teacherinfo['teacher_type'] = 'teacher';//Input::get('type');

    $teacherinfo['teacher_name']= Input::get('teachername');
    $teacherinfo['gender'] = Input::get('gender');
    $teacherinfo['blood_group'] = Input::get('blood_group');
    $teacherinfo['designation'] = Input::get('dateofbirth');
    $teacherinfo['religion'] = Input::get('religion');
    $teacherinfo['maraital_status'] = Input::get('marraige');
    $teacherinfo['father_name'] = Input::get('fathers_name');
    $teacherinfo['mother_name'] = Input::get('mothers_name');
    $teacherinfo['fathers_occupation'] = Input::get('fathers_occupation');
    $teacherinfo['mothers_occupation'] = Input::get('mothers_occupation');
     $teacherinfo['fathers_mobile'] = Input::get('mobile1');
    $teacherinfo['mothers_mobile'] = Input::get('mobile2');
     $teacherinfo['fathers_mobile'] = Input::get('fathers_mobile');
    $teacherinfo['mothers_mobile'] = Input::get('mothers_mobile');

    $teacherinfo['teacher_mobile1'] = Input::get('mobile1');
    $teacherinfo['teacher_mobile2'] = Input::get('mobile2');
    $teacherinfo['email'] = Input::get('email');
    $teacherinfo['teacher_initial'] = Input::get('teacher_initial');
    $teacherinfo['joining_date'] = Input::get('joining_date');
    $teacherinfo['designation'] = Input::get('designation');
     $teacherinfo['department'] = Input::get('department');
    $teacherinfo['teacher_salary'] = Input::get('salary');

     $subject="";
    $flag=0;
    for ($i=1; $i < 100; $i++) {
        $sub=Input::get('subject' . $i);
        if ($sub!=null) {
            if ($flag==0) {
                $subject=$sub;
                $flag=1;
            }
            $subject=$subject ."," . $sub;
        }
    }
    
    $teacherinfo['subject'] =$subject;
    //$teacherinfo->image = Input::get('');
    // $start_day_old = Input::get('date_of_birth');
    // $start_day = date("d-m-Y", strtotime($start_day_old));
    // $teacherinfo->date_of_birth =$start_day;

    // $start_day_old1 = Input::get('txtDateOfJoin');
    // $start_day1 = date("d-m-Y", strtotime($start_day_old1));
    // $teacherinfo->date_of_join =$start_day1;

    // $image = Input::file('image');
    // $destination = 'public/uploads/';
    // if($image!=null) {
    //   $filename = Str::lower(
    //     pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
    //     . '-'
    //     . uniqid()
    //     . '.'
    //     . $image->getClientOriginalExtension()
    //   );

    //   $image->move($destination, $filename);
    //   $teacherinfo->image = $filename;

    // }

     $teacherinfo['dateofbirth'] = Input::get('dateofbirth');
    $teacherinfo['joining_date'] = Input::get('joining_date');



//    $teacherinfo->image = Input::get('');
//     $start_day_old = Input::get('date_of_birth');
//     $start_day = date("d-m-Y", strtotime($start_day_old));
//     $teacherinfo->date_of_birth =$start_day;
//
//     $start_day_old1 = Input::get('txtDateOfJoin');
//     $start_day1 = date("d-m-Y", strtotime($start_day_old1));
//     $teacherinfo->date_of_join =$start_day1;
//
    $image = Input::file('imagefile');
  $destination = 'uploads/';
    if($image!=null) {
      $filename = Str::lower(
        pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
        . '-'
        . uniqid()
        . '.'
        . $image->getClientOriginalExtension()
      );

      $image->move($destination, $filename);
      $teacherinfo['image'] = $filename;

    }




    $teacherinfo['preaddress_line'] = Input::get('preaddressline');
    $teacherinfo['p_district'] = Input::get('presentDistrict');
    $teacherinfo['p_union'] = Input::get('presentUnion');
     $teacherinfo['p_thana'] = Input::get('presentThana');
    if(Input::get('same_address_flag')==0) {
        $teacherinfo['peraddress_line'] = Input::get('paraddressline');
        $teacherinfo['per_district'] = Input::get('parmanentDistrict');
        $teacherinfo['per_thana'] = Input::get('parmanentThana');
        $teacherinfo['per_union'] = Input::get('parmanentUnion');
}
    else{
         $teacherinfo['peraddress_line'] = Input::get('preaddressline');
         $teacherinfo['per_district'] = Input::get('presentDistrict');
         $teacherinfo['per_thana'] = Input::get('presentThana');
         $teacherinfo['per_union'] = Input::get('presentUnion');

    }
    $id=Input::get('id');
    TeacherInfo::where('idteacherinfo','=',$id)->update($teacherinfo);
 

	return Redirect::to('staff_management/listeditteacher');
}

   public function teacher_routine()
    {
      
        $idconfiguration = Configuration::select('idconfiguration')->get();
       
        return View::make('routine.teacher_routine')->with('idconfiguration',$idconfiguration);
    }

}