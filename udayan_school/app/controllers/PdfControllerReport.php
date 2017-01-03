<?php

ini_set('max_execution_time', 300);

ini_set('memory_limit', '-1');

include("mpdf60/mpdf.php");

class PdfControllerReport extends \BaseController {

    public function section_report_pdf() {
        ini_set('max_execution_time', '300M');
        
        $class = Session::get('class');
        $section = Session::get('section');
        $term = Session::get('term');
        $year = Session::get('year');


        $student_result_info = RankModel::where('rank_stud.class', $class)
                                ->where('rank_stud.section', $section)
                                ->where('rank_stud.term', $term)
                                ->where('rank_stud.year', $year)
                                ->join('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'rank_stud.stid')
                                ->join('studentinfo', 'studentinfo.registration_id', '=', 'rank_stud.stid')
                                ->orderby('rank_stud.cgpa', 'desc')
                                ->orderby('rank_stud.total', 'desc')
                                ->get();
        
        if ($class == "ELEVEN" || $class == "TWELVE") {
            $term = ($term == "Half Yearly" ? "First Semester" : "Final");
        } else {
            $term = ($term == "Half Yearly" ? "Half Yearly" : "Annual");
        }

        $count = count ($student_result_info);

        ob_start();
        ini_set('memory_limit', '-1');

        $html = ob_get_clean();
        $html = utf8_encode($html);

        $html = '<html>
                    <head>  
                        <style>
                            table, th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                                text-align: center;
                            }
                            th {
                                background-color: #C0C0C0;
                            }
                        </style>
                    </head>
                    <body>
                        
                        <div style="text-align: center; ">
                            <img src="../public/image/4d.gif" width="60" height="40" />
                            <span style="font-weight: bold; font-size: 18px;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</span><br/>
                            <span style="font-weight: bold; font-size: 16px;">Exam: '.$term.'&nbsp;&nbsp;&nbsp;Year: '.substr($year, 0, 4).'</span><br/>
                            <span style="font-weight: bold; font-size: 14px;">Class: '.$class.' ( '.$section.' )</span><br/>
                            <span style="font-weight: bold; font-size: 18px;">Merit List</span><br/><br/>
                        </div>

                        <table style="width: 100%">
                            <tr>
                                <th>SL</th>
                                <th>Roll</th>
                                <th>Student Name</th>
                                <th>Total</th>
                                <th>CGPA</th>
                                <th>Rank</th>
                            </tr>';
                            for($i = 0; $i < $count; $i++) {
                                $html .='<tr>
                                    <td>'.($i+1).'</td>
                                    <td>'.$student_result_info[$i]->st_roll.'</td>
                                    <td style="text-align: left">'.strtoupper($student_result_info[$i]->sutdent_name).'</td>
                                    <td>'.$student_result_info[$i]->total.'</td>
                                    <td>'.$student_result_info[$i]->cgpa.'</td>
                                    <td>'.$student_result_info[$i]->rank.'</td>
                                </tr>';
                            }
                    $html .= '</table>
                    </body>
                </html>';




        $mpdf = new mPDF();
        $mpdf->AddPage();


        $mpdf->allow_charset_convertion=true;

        $mpdf->charset_in = 'UTF-8';

        $mpdf->writeHTML($html);


        $mpdf->Output(''.$class.'_'.$section.'.pdf','I');

        exit();

    }

    function admin_report_pdf () {
        ini_set('max_execution_time', '300M');
        
        $class = Session::get('class');
        $section = Session::get('section');
        $term = Session::get('term');
        $year = Session::get('year');
        $gender = Session::get('gender');

        if($gender == "combined" && $section == "combined") {
            $student_result_info = RankModel::where('rank_stud.class', $class)
                                ->where('rank_stud.term', $term)
                                ->where('rank_stud.year', $year)
                                ->join('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'rank_stud.stid')
                                ->join('studentinfo', 'studentinfo.registration_id', '=', 'rank_stud.stid')
                                ->orderby('rank_stud.section', 'asc')
                                ->orderby('rank_stud.cgpa', 'desc')
                                ->orderby('rank_stud.total', 'desc')
                                ->get();
        } else if ($gender != "combined" && $section == "combined") {
            $student_result_info = RankModel::where('rank_stud.class', $class)
                                ->where('rank_stud.term', $term)
                                ->where('rank_stud.year', $year)
                                ->join('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'rank_stud.stid')
                                ->join('studentinfo', 'studentinfo.registration_id', '=', 'rank_stud.stid')
                                ->where('studentinfo.gender', $gender)
                                ->orderby('rank_stud.section', 'asc')
                                ->orderby('rank_stud.cgpa', 'desc')
                                ->orderby('rank_stud.total', 'desc')
                                ->get();    
        } else if ($gender == "combined" && $section != "combined") {
            $student_result_info = RankModel::where('rank_stud.class', $class)
                                ->where('rank_stud.section', $section)
                                ->where('rank_stud.term', $term)
                                ->where('rank_stud.year', $year)
                                ->join('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'rank_stud.stid')
                                ->join('studentinfo', 'studentinfo.registration_id', '=', 'rank_stud.stid')
                                ->orderby('rank_stud.cgpa', 'desc')
                                ->orderby('rank_stud.total', 'desc')
                                ->get();    
        } else {
            $student_result_info = RankModel::where('rank_stud.class', $class)
                                ->where('rank_stud.section', $section)
                                ->where('rank_stud.term', $term)
                                ->where('rank_stud.year', $year)
                                ->join('student_to_section_update', 'student_to_section_update.student_idstudentinfo', '=', 'rank_stud.stid')
                                ->join('studentinfo', 'studentinfo.registration_id', '=', 'rank_stud.stid')
                                ->where('studentinfo.gender', $gender)
                                ->orderby('rank_stud.cgpa', 'desc')
                                ->orderby('rank_stud.total', 'desc')
                                ->get();    
        }
        
        if ($class == "ELEVEN" || $class == "TWELVE") {
            $term = ($term == "Half Yearly" ? "First Semester" : "Final");
        } else {
            $term = ($term == "Half Yearly" ? "Half Yearly" : "Annual");
        }

        $count = count ($student_result_info);

        ob_start();
        ini_set('memory_limit', '-1');

        $html = ob_get_clean();
        $html = utf8_encode($html);

        $html = '<html>
                    <head>  
                        <style>
                            table, th, td {
                                border: 1px solid black;
                                border-collapse: collapse;
                                text-align: center;
                            }
                            th {
                                background-color: #C0C0C0;
                            }
                        </style>
                    </head>
                    <body>

                        <div style="text-align: center; ">
                            <img src="../public/image/4d.gif" width="60" height="40" />
                            <span style="font-weight: bold; font-size: 18px;">UDAYAN UCHCHA MADHYAMIK BIDYALAYA</span><br/>
                            <span style="font-weight: bold; font-size: 16px;">Exam: '.$term.'&nbsp;&nbsp;&nbsp;Year: '.substr($year, 0, 4).'</span><br/>
                            <span style="font-weight: bold; font-size: 14px;">Class: '.$class.'';
                        if ($section != "combined") {
                            $html .= ' ( '.$section.' )';
                        }

                        $html .= '</span><br/>
                            <span style="font-weight: bold; font-size: 18px;">Merit List';

                        if ($gender != "combined") {
                            $html .= ' ( '.strtoupper($gender).' )';
                        }

                        $html .='</span><br/><br/>
                        </div>

                        <table style="width: 100%">
                            <tr>
                                <th>SL</th>
                                <th>Roll</th>
                                <th>Student Name</th>';

                        if($section == "combined") {
                            $html .= '<th>Section</th>';
                        }

                        if($gender == "combined") {
                            $html .= '<th>Gender</th>';
                        }

                        $html .='<th>Total</th>
                                <th>CGPA</th>
                                <th>Rank</th>
                            </tr>';
                            for($i = 0; $i < $count; $i++) {
                                $html .='<tr>
                                    <td>'.($i+1).'</td>
                                    <td>'.$student_result_info[$i]->st_roll.'</td>
                                    <td style="text-align: left">'.strtoupper($student_result_info[$i]->sutdent_name).'</td>';

                                if($section == "combined") {
                                    $html .= '<td>'.$student_result_info[$i]->section.'</td>';
                                }

                                if($gender == "combined") {
                                    $html .= '<td>'.strtoupper($student_result_info[$i]->gender).'</td>';
                                }

                                $html .='<td>'.$student_result_info[$i]->total.'</td>
                                    <td>'.$student_result_info[$i]->cgpa.'</td>
                                    <td>'.$student_result_info[$i]->rank.'</td>
                                </tr>';
                            }
                    $html .= '</table>
                    </body>
                </html>';




        $mpdf = new mPDF();
        $mpdf->AddPage();


        $mpdf->allow_charset_convertion=true;

        $mpdf->charset_in = 'UTF-8';

        $mpdf->writeHTML($html);

        $mpdf->Output(''.$class.'_'.$section.'.pdf','I');

        exit();

    }
}

