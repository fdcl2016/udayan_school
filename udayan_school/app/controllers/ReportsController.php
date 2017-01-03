<?php

class ReportsController extends BaseController {

    public function report()
    {
        return View::make('reports.report');
    }

    public function report_class($data)
    {
        return View::make('reports.classes')->with('class',$data);
    }
    public function report_st($data,$data1)
    {

        $st = StudentToSectionUpdate::where('class','=',$data)->where('section','=',$data1)->orderBy('st_roll')->get();
        $st_count = StudentToSectionUpdate::where('section','=',$data1)->get();
        $male = ClassWiseStd::where('std_gender','=','Male')->where('std_class','=',$data)->where('std_section','=',$data1)->get();
        $count = count($st_count);
        $male_std = count($male);
        $feml_std = $count - $male_std;
        $class_teacher = ClassTeacherInfo::where('section','=',$data1)->where('class_name','=',$data)->pluck('teacher_name');
        return View::make('reports.st_report')->with('st',$st)->with('cls',$data)->with('sec',$data1)->with('count',$count)->with('male',$male_std)->with('female',$feml_std)->with('class_teacher',$class_teacher);
    }

    public function report_all_students()
    {
        $allclass=ClassTeacherInfo::Select('class_name')->groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('reports.reportAllStudents')->with('allclass',$allclass);
    }


/******** STATIC REPORT CARD *********************/

public function download($idreport)
    {
       // $assign = Assignment::where('idassignment','=',$idassignment)->first();
  

    	$v = $idreport.".pdf";
        $file= public_path('uploads/'.$v);
       // $file= $assign->filename;
        $headers = array(
            'Content-Type: application/pdf',
        );
        //return Response::download($file, $assign->filename);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
    

       // return $idassignment;


    }


   public function downloadst($idreport,$year12,$term12)
    {
        // $assign = Assignment::where('idassignment','=',$idassignment)->first();

/*
        $v = $idreport.".pdf";
        $file= public_path('uploads/'.$v);
        // $file= $assign->filename;
        $headers = array(
            'Content-Type: application/pdf',
        );
        //return Response::download($file, $assign->filename);

        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($file));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            ob_clean();
            flush();
            readfile($file);
            exit;
        }
*/


    $st = StudentToSectionUpdate::where('student_idstudentinfo', '=', $idreport)->pluck('section');
       $clsval = Addclass::where('section', '=', $st)->pluck('value');

       if ($clsval > 10) {

           return View::make('result_management.report_hy')->with('idstudent', $idreport)->with('year', $year12)->with('term', $term12);

       }elseif($clsval > 8 && $clsval < 11){

           return "class 10";
       }else{
               return "class less 8";

          //  return View::make('result_management.report_hy_jnr')->with('idstudent', $idreport)->with('year', $year12)->with('term', $term12);
       }


        // return $idassignment;


    }

    public function getStudentReportCard() {
        $year = Session::get('year');
        $term = Session::get('term');
        $class_name = Session::get('class_name');
        $section = Session::get('section');
        $student_id = Auth::user()->email;
        $username = Auth::user()->username;
        /* message */
        (count(Session::get('msg')) ? $msg = Session::get('msg') : $msg = "" );
        
        return View::make('result_management.student_report_card')
            ->with('class',$class_name)
            ->with('students',$student_id)
            ->with('year12',$year)
            ->with('term12',$term)
            ->with('msg', $msg);
    }

    public function postStudentReportCard() {

        /* check for result */
        /* To check result check if result is published */
        /* Check using term, year, section and class in table publish_result */
        $class = Input::get('class');
        $section = Input::get('section');
        $term = Input::get('term');
        $year = Input::get('year');
        $msg = "";
        $class_val = Addclass::where('class_name', $class)->pluck('value');

        $publish_status = PublishResult::where('class', $class)
                            ->where('section', $section)
                            ->where('term', $term)
                            ->where('year', $year)
                            ->where('published', 'Y')
                            ->first();
       
        if(isset($publish_status)) {
            // get student roll
            $student_roll = StudentToSectionUpdate::where('student_idstudentinfo', Auth::user()->email)->pluck('st_roll');

            $msg = "";

            /* redirect according to class value */
            if($class_val < 9) {
                return View::make('result_management.report_hy')
                        ->with('class', $class)
                        ->with('section', $section)
                        ->with('term', $term)
                        ->with('year', $year)
                        ->with('student_roll', $student_roll);
            } else {
                return View::make('result_management.report_snr')
                        ->with('class', $class)
                        ->with('section', $section)
                        ->with('term', $term)
                        ->with('year', $year)
                        ->with('student_roll', $student_roll);
            }
        } else {
            $msg = "<div class='alert alert-danger'><strong><h3 style='color:black' align='center'>Your result is not publisehd yet</h3></strong></div>";
        }

        return Redirect::to('result_management/student_report_card')
            ->with('year',Input::get('year'))
            ->with('term',Input::get('term'))
            ->with('class_name',Input::get('class'))
            ->with('section',Input::get('section'))
            ->with('msg', $msg);
    }

    function getCustomReport () {
        
        return View::make('result_management/custom_report');
    }

    function postCustomReport () {
        $msg = "";
        $term = Input::get('term');
        $year = Input::get('year');
        $arr = explode(" ", Input::get('class_section'));
        $class = $arr[0];
        $section = $arr[1];

        $publish_status = PublishResult::where('class', $class)
                            ->where('term', $term)
                            ->where('year', $year)
                            ->where('published', 'Y')
                            ->first();

        if(empty($publish_status)) {
            // return with error message
            $msg = "<div class='alert alert-danger'><strong><h3 style='color:black' align='center'>Your result is not publisehd yet</h3></strong></div>";

            return View::make('result_management/custom_report')
                    ->with('msg', $msg);
        } 

        return Redirect::to('report_management/custom_report_pdf')
                ->with('class', $class)
                ->with('section', $section)
                ->with('term', $term)
                ->with('year', $year);
    }

    function getAdminCustomReport () {
        
        return View::make('result_management/admin_custom_report');
    }

    function postAdminCustomReport() {
        
        $class = Input::get('cat');
        $section = Input::get('sub');
        $gender = Input::get('gender');
        $term = Input::get('term');
        $year = Input::get('year');

        /* check if result is published */
        $publish_status = PublishResult::where('class', $class)
                            ->where('term', $term)
                            ->where('year', $year)
                            ->where('published', 'Y')
                            ->first();

        if(empty($publish_status)) {
            // return with error message
            $msg = "<div class='alert alert-danger'><strong><h3 style='color:black' align='center'>Result is not publisehd yet</h3></strong></div>";

            return View::make('result_management/admin_custom_report')
                        ->with('msg', $msg);
        } else {
            return Redirect::to('report_management/admin_custom_report_pdf')
                ->with('class', $class)
                ->with('section', $section)
                ->with('term', $term)
                ->with('year', $year)
                ->with('gender', $gender);
        }
        
    }
}
