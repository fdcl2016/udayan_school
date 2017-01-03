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


}
