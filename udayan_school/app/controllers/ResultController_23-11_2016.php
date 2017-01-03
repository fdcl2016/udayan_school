<?php

class ResultController extends BaseController {


    /* function is_type_exist($mark_conf, $type)
     {
         $mark_conf = MarksConfiguration::where('configuration_name','=',$mark_conf)->where('configuration_type','=',$type)->get();

         return count($mark_conf);

     } */

    function gradeTotal($class_val, $mark, $total_mark)
    {
        $mark = ceil($mark);

       //  return $mark. " " .$total_mark;

        $grade = GradingTable::where('total','=',$total_mark)->where('highest_range', '>=', $mark)->where('lowest_range', '<=', $mark)->first();
        $letter= $grade->grade;
        $point = $grade->gpa;

        if($class_val < 11)
        {
            if($class_val == 9 || $class_val == 10) $percent = 40;
            if($class_val < 9) $percent = 50;
            $pass_range= ($percent * $total_mark) / 100;
            if($mark < $pass_range)
            {
                $letter= "F";
                $point = 0.0;

            }

        }
        $grading['letter'] = $letter;
        $grading['point'] = $point;

        return $grading;

    }

    //debug
    function is_pass($mark_conf, $cls_val, $mark, $type)
    {
    	$mark_config = MarksConfiguration::where('configuration_name','=',$mark_conf->configuration_name)->where('configuration_type','=',$type)->first();
        if(!count($mark_config) || !$mark_conf ) return 1;
        if (isset($mark_config->converted_marks)) $range = $mark_config->converted_marks; else return 1;
        if($mark_config->configuration_type == "LT" || $cls_val == 9 || $cls_val == 10)
            $percent = 40;
        else
            $percent = 33;

        $pass_limit = round(($range * $percent) / 100);
        
        if($mark < $pass_limit)
            return 0;
        else
            return 1;

    }


    public function ShohagModifiedConfCT($ht_conf,$ct_conf, $ht , $st_id, $term, $idsub, $year, $class)
    {

        $conv_mark = 0; $configuration_total = 100;
        /* if($configuration_name == "confcls09ict") { $conv_mark = 5; $ct_total=40; $ht_mark =20; $configuration_total = 50;}
         if( $configuration_name == "confcls09phy") { $conv_mark = 10; $ct_total=35; $ht_mark =40; }
         if($configuration_name == "confcls09ban1st") { $conv_mark = 10; $ct_total=50; $ht_mark =60; }
         if($configuration_name == "confcls09ban2nd") { $conv_mark = 20; $ct_total=70; $ht_mark =100; }
         if($configuration_name == "confcls09com") { $conv_mark = 10; $ct_total=50; $ht_mark =60;} */

        //   $ht_conf = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',"HT")->first();
        // $ct_conf = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',"CT")->orderby('exam_name')->get();

        $ct = ResultClassTest::where('studentinfo_idstudentinfo','=',$st_id)->where('idsubject','=',$idsub)->where('idclasssection','=',$class)->where('term','=',$term)->where('academic_year','=',$year)->first();

        if(count($ct_conf))$conv_mark = $ct_conf[0]->total_marks;
        if(count($ht_conf)) $ht_mark = $ht_conf->converted_marks;

        $ct1 =0; $ct2=0;
        if (isset($ct->ct1)) $ct1 = $ct->ct1;

        if(count($ct_conf) > 2)
        {
            $ct_total = $ct_conf[0]->weighted_marks + $ct_conf[2]->weighted_marks;
            if(isset($ct->ct3)) $ct2 = $ct->ct3;
        }
        else
        {
            $ct_total = $ct_conf[0]->weighted_marks + $ct_conf[1]->weighted_marks;
            if(isset($ct->ct2)) $ct2 = $ct->ct2;
 if($ct_conf[0]->ct_type == 3) { $ct_total = $ct_conf[0]->weighted_marks; $ct2 = 0;}
        }

        if(!$conv_mark) return 0;



        /*
                if($configuration_name == "confcls09ban2nd")
                {
                    if(isset($ct->ct2)) $ct2 = $ct->ct2;
                }
                else
                {
                    if(isset($ct->ct3)) $ct2 = $ct->ct3;
                }

        */
        $ct_given_mark = $ct1+ $ct2;

        $ct_conv_given_mark = ceil(($ct_given_mark * $conv_mark) / $ct_total);

        $ht_conv_given_mark = ((($ct_conv_given_mark + $ht) * $ht_mark) / ($conv_mark+$ht_mark));

        return ceil($ht_conv_given_mark);

    }

    public function ShohagModifiedConfMCQ($mt_conf,$ct_conf, $mt , $st_id, $term, $idsub, $year, $class)
    {

        $conv_mark = 0; $configuration_total = 100;
        /*  if($configuration_name == "confcls09ict") { $conv_mark = 5; $ct_total=20; $mcq_mark =15; $configuration_total = 50;}
          if( $configuration_name == "confcls09phy") { $conv_mark = 10; $ct_total=35; $mcq_mark =35; }
          if($configuration_name == "confcls09ban1st") { $conv_mark = 10; $ct_total=30; $mcq_mark =40; }
          if($configuration_name == "confcls09com") { $conv_mark = 10; $ct_total=30; $mcq_mark =40;} */

        $ct = ResultClassTest::where('studentinfo_idstudentinfo','=',$st_id)->where('idsubject','=',$idsub)->where('idclasssection','=',$class)->where('term','=',$term)->where('academic_year','=',$year)->first();

        if(!count($ct)) return $mt;

        if(count($ct_conf))$conv_mark = $ct_conf[0]->total_marks;
        if(count($mt_conf)) $mcq_mark = $mt_conf->converted_marks;

        $ct1 =0; $ct2=0;
        if (isset($ct->ct2)) $ct1 = $ct->ct2;

        if(count($ct_conf) > 2)
        {

$ct_total = $ct_conf[1]->weighted_marks + $ct_conf[3]->weighted_marks;
            if(isset($ct->ct4)) $ct2 = $ct->ct4;
        }
        else
        {

if($ct_conf[0]->ct_type == "4") { $ct_total = $ct_conf[0]->weighted_marks; $ct1 = $ct->ct1;  $ct2 = 0;} else {
$ct_total = $ct_conf[0]->weighted_marks + $ct_conf[1]->weighted_marks;
            if(isset($ct->ct2)) $ct2 = $ct->ct2;
 if($ct_conf[0]->ct_type == "3") { $ct_total = $ct_conf[1]->weighted_marks; $ct2 = 0;} }

        }

        if(!$conv_mark) return 0;


        $ct_given_mark = $ct1+ $ct2;

        $ct_conv_given_mark = ceil(($ct_given_mark * $conv_mark) / $ct_total);

        $mt_conv_given_mark = ((($ct_conv_given_mark + $mt) * $mcq_mark) / ($conv_mark+$mcq_mark));

        return ceil($mt_conv_given_mark);

    }

    public function ShohagModifiedConfCTOnly($ct_conf, $ct1 , $ct2, $ct3)
    {
        $conv_mark = 0; $configuration_total = 100;
        /* if($configuration_name == "confcls09ict") { $conv_mark = 5; $ct_total=40; $ht_mark =20; $configuration_total = 50;}
         if( $configuration_name == "confcls09phy") { $conv_mark = 10; $ct_total=35; $ht_mark =40; }
         if($configuration_name == "confcls09ban1st") { $conv_mark = 10; $ct_total=50; $ht_mark =60; }
         if($configuration_name == "confcls09ban2nd") { $conv_mark = 20; $ct_total=70; $ht_mark =100; }
         if($configuration_name == "confcls09com") { $conv_mark = 10; $ct_total=50; $ht_mark =60;} */

        //  $ht_conf = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('type','=',"HT")->first();

        //  $ct = ResultClassTest::where('studentinfo_idstudentinfo','=',$st_id)->where('idsubject','=',$idsub)->where('idclasssection','=',$class)->where('term','=',$term)->where('academic_year','=',$year)->first();

        if(count($ct_conf)) $conv_mark = $ct_conf[0]->total_marks;

        // $ct1 =0; $ct2=0;
        //  if (isset($ct->ct1)) $ct1 = $ct->ct1;

        if($ct_conf[0]->ct_type == "3") { $ct_total = $ct_conf[0]->weighted_marks; $ct2 = 0;}
        else
        {

        if(count($ct_conf) > 2)
        {
            $ct_total = $ct_conf[0]->weighted_marks + $ct_conf[2]->weighted_marks;
            $ct2 = $ct3;
        }
        else
        {
            $ct_total = $ct_conf[0]->weighted_marks + $ct_conf[1]->weighted_marks;
        }}

        if(!$conv_mark) return 0;



        /*
                if($configuration_name == "confcls09ban2nd")
                {
                    if(isset($ct->ct2)) $ct2 = $ct->ct2;
                }
                else
                {
                    if(isset($ct->ct3)) $ct2 = $ct->ct3;
                }

        */
        $ct_given_mark = $ct1+ $ct2;

        $ct_conv_given_mark = ceil(($ct_given_mark * $conv_mark) / $ct_total);


        // $ht_conv_given_mark = ((($ct_conv_given_mark + $ht) * $ht_mark) / ($conv_mark+$ht_mark));

        return ceil($ct_conv_given_mark);

    }

    public function ShohagModifiedConfMCQOnly($ct_conf, $ct1,$ct2)
    {
        $conv_mark = 0; $configuration_total = 100;
        /*  if($configuration_name == "confcls09ict") { $conv_mark = 5; $ct_total=20; $mcq_mark =15; $configuration_total = 50;}
          if( $configuration_name == "confcls09phy") { $conv_mark = 10; $ct_total=35; $mcq_mark =35; }
          if($configuration_name == "confcls09ban1st") { $conv_mark = 10; $ct_total=30; $mcq_mark =40; }
          if($configuration_name == "confcls09com") { $conv_mark = 10; $ct_total=30; $mcq_mark =40;} */


        //$mt_conf = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('type','=',"MT")->first();
        // $ct_conf = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',"CT")->orderby('exam_name')->get();

        //$ct = ResultClassTest::where('studentinfo_idstudentinfo','=',$st_id)->where('idsubject','=',$idsub)->where('idclasssection','=',$class)->where('term','=',$term)->where('academic_year','=',$year)->first();

        if(count($ct_conf))$conv_mark = $ct_conf[0]->total_marks;
        //if(count($mt_conf)) $mcq_mark = $mt_conf->converted_marks;

        // $ct1 =0; $ct2=0;
        //if (isset($ct->ct2)) $ct1 = $ct->ct2;
        if($ct_conf[0]->ct_type == "3") { $ct_total = $ct_conf[1]->weighted_marks; $ct2 = 0;}
        else {
            if (count($ct_conf) > 2) {
                $ct_total = $ct_conf[1]->weighted_marks + $ct_conf[3]->weighted_marks;
                //  if(isset($ct->ct4)) $ct2 = $ct->ct4;
            } else {
                if ($ct_conf[0]->ct_type == "4") {
                    $ct_total = $ct_conf[0]->weighted_marks;
                } else

                    $ct_total = $ct_conf[0]->weighted_marks + $ct_conf[1]->weighted_marks;
                //  if(isset($ct->ct2)) $ct2 = $ct->ct2;
            }
        }
        if(!$conv_mark) return 0;


        $ct_given_mark = $ct1+ $ct2;

        $ct_conv_given_mark = ceil(($ct_given_mark * $conv_mark) / $ct_total);

        //  $mt_conv_given_mark = ((($ct_conv_given_mark + $mt) * $mcq_mark) / ($conv_mark+$mcq_mark));

        return ceil($ct_conv_given_mark);

    }

    public function configure_result()
    {
        return View::make('result_management.configure_result');
    }

    public function postresultconfiguration()
    {
        //  return Input::all();
        $configuration_name = Input::get('configuration_name');
        $ra_marks = Input::get('ra_marks');
        $class_work = Input::get('class_work');
        $home_work = Input::get('home_work');
        $both = Input::get('both');
        $ct_marks = Input::get('ct_marks');
        $class_test1 = Input::get('class_test1');
        $class_test2 = Input::get('class_test2');
        $class_test3 = Input::get('class_test3');
        $class_test4 = Input::get('class_test4');
        $ht_marks = Input::get('ht_marks');
        $hall_test = Input::get('hall_test');
        $mcq_marks = Input::get('mcq_marks');
        $mcq = Input::get('mcq');
        $lab = Input::get('lab');
        $viva = Input::get('viva');
        $experiment = Input::get('experiment');
        $total = Input::get('total');
        if(($ra_marks+$ct_marks+$ht_marks+$mcq_marks+$lab)==$total&&$configuration_name!=null)
        {
            if($ra_marks!=null)
            {
                if($class_work!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'RT';
                    $mark->exam_name = 'class_work';
                    $mark->total_marks = $ra_marks;
                    $mark->weighted_marks = $class_work;
                    $mark->converted_marks = ($class_work*$ra_marks)/($class_work+$home_work+$both);
                    $mark->save();
                }
                if($home_work!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'RT';
                    $mark->exam_name = 'home_work';
                    $mark->total_marks = $ra_marks;
                    $mark->weighted_marks = $home_work;
                    $mark->converted_marks = ($home_work*$ra_marks)/($class_work+$home_work+$both);
                    $mark->save();
                }
                if($both!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'RT';
                    $mark->exam_name = 'bothe';
                    $mark->total_marks = $ra_marks;
                    $mark->weighted_marks = $both;
                    $mark->converted_marks = ($both*$ra_marks)/($class_work+$home_work+$both);
                    $mark->save();
                }
            }
            if($ct_marks!=null)
            {
                if($class_test1!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'CT';
                    $mark->exam_name = 'class_test_1';
                    $mark->total_marks = $ct_marks;
                    $mark->weighted_marks = $class_test1;
                    $mark->converted_marks = ($class_test1*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                    $mark->save();
                }
                if($class_test2!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'CT';
                    $mark->exam_name = 'class_test_2';
                    $mark->total_marks = $ct_marks;
                    $mark->weighted_marks = $class_test2;
                    $mark->converted_marks = ($class_test2*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                    $mark->save();
                }
                if($class_test3!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'CT';
                    $mark->exam_name = 'class_test_3';
                    $mark->total_marks = $ct_marks;
                    $mark->weighted_marks = $class_test3;
                    $mark->converted_marks = ($class_test3*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                    $mark->save();
                }
                if($class_test4!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'CT';
                    $mark->exam_name = 'class_test_4';
                    $mark->total_marks = $ct_marks;
                    $mark->weighted_marks = $class_test4;
                    $mark->converted_marks = ($class_test4*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                    $mark->save();
                }
            }
            if($ht_marks!=null)
            {
                if($hall_test!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'HT';
                    $mark->exam_name = 'Hall_Test';
                    $mark->total_marks = $ht_marks;
                    $mark->weighted_marks = $hall_test;
                    $mark->converted_marks = ($hall_test*$ht_marks)/($hall_test);
                    $mark->save();
                }
            }
            if($mcq_marks!=null)
            {
                if($mcq!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'MT';
                    $mark->exam_name = 'MCQ_Test';
                    $mark->total_marks = $mcq_marks;
                    $mark->weighted_marks = $mcq;
                    $mark->converted_marks = ($mcq*$mcq_marks)/($mcq);
                    $mark->save();
                }
            }
            if($lab!=null)
            {
                if($viva!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'LT';
                    $mark->exam_name = 'viva';
                    $mark->total_marks = $lab;
                    $mark->weighted_marks = $viva;
                    $mark->converted_marks = ($viva*$lab)/($viva+$experiment);
                    $mark->save();
                }

                if($experiment!=null)
                {
                    $mark = new MarksConfiguration();
                    $mark->configuration_name = $configuration_name;
                    $mark->configuration_type = 'LT';
                    $mark->exam_name = 'experiment';
                    $mark->total_marks = $lab;
                    $mark->weighted_marks = $experiment;
                    $mark->converted_marks = ($experiment*$lab)/($viva+$experiment);
                    $mark->save();
                }
            }
            $total_mark_conf = new TotalMarksConfiguration();
            $total_mark_conf->configuration_type = $configuration_name;
            $total_mark_conf->total = $total;
            $total_mark_conf->save();

            return Redirect::to('result_management/configure_result');
        }
        else
        {
            return Redirect::back()->withInput()->with('error', 'Please check if you are providing everything correctly.');
        }
    }

    public function list_of_config()
    {
        $lists = MarksConfiguration::groupBy('configuration_name')->get();
        return View::make('result_management.list_of_config')->with('lists',$lists);
    }

    public function edit_config($configuration_name)
    {
//        $lists =  MarksConfiguration::where('configuration_name','=',$configuration_name)->get();
        $data = array();
        $class_work = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','class_work')->first();
        if($class_work!="")
            $data['class_work'] = $class_work->weighted_marks;
        else
            $data['class_work'] = null;
        $home_work =  MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','home_work')->first();
        if($home_work!="")
            $data['home_work'] =$home_work->weighted_marks;
        else
            $data['home_work'] = null;
        $bothe = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','bothe')->first();
        if($bothe)
            $data['bothe'] = $bothe->weighted_marks;
        else
            $data['bothe'] = null;
        $ra_total_marks = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->first();
        if($ra_total_marks!="")
            $data['ra_total_marks'] = $ra_total_marks->total_marks;
        else
            $data['ra_total_marks']  = null;
        $class_test_1 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_1')->first();
        if($class_test_1!="")
            $data['class_test_1'] = $class_test_1->weighted_marks;
        else
            $data['class_test_1']  = null;
        $class_test_2 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_2')->first();
        if($class_test_2!="")
            //return $class_test_2;
            $data['class_test_2'] = $class_test_2->weighted_marks;
        else
            $data['class_test_2']  = null;
        $class_test_3 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_3')->first();
        if($class_test_3!="")
            $data['class_test_3'] = $class_test_3->weighted_marks;
        else
            $data['class_test_3']  = null;
        $class_test_4 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_4')->first();
        if($class_test_4!="")
            $data['class_test_4'] = $class_test_4->weighted_marks;
        else
            $data['class_test_4']  = null;

        $ct_total_marks = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->first();
        if($ct_total_marks!="")
            $data['ct_total_marks'] = $ct_total_marks->total_marks;
        else
            $data['ct_total_marks'] = null;

        $Hall_Test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','HT')->where('exam_name','=','Hall_Test')->first();
        if($Hall_Test!="")
            $data['Hall_Test'] = $Hall_Test->weighted_marks;
        else
            $data['Hall_Test']  = null;

        $ht_total_marks = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','HT')->first();
        if($ht_total_marks!="")
            $data['ht_total_marks'] = $ht_total_marks->total_marks;
        else
            $data['ht_total_marks'] = null;

        $MCQ_Test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','MT')->where('exam_name','=','MCQ_Test')->first();
        if($MCQ_Test!="")
            $data['MCQ_Test'] = $MCQ_Test->weighted_marks;
        else
            $data['MCQ_Test']  = null;

        $mt_total_marks = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','MT')->first();
        if($mt_total_marks!="")
            $data['mt_total_marks'] = $mt_total_marks->total_marks;
        else
            $data['mt_total_marks'] = null;

        $viva = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->where('exam_name','=','viva')->first();
        if($viva!="")
            $data['viva'] = $viva->weighted_marks;
        else
            $data['viva']  = null;

        $experiment = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->where('exam_name','=','experiment')->first();
        if($experiment!="")
            $data['experiment'] = $experiment->weighted_marks;
        else
            $data['experiment']  = null;

        $lt_total_marks = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->first();
        if($lt_total_marks!="")
            $data['lt_total_marks'] = $lt_total_marks->total_marks;
        else
            $data['lt_total_marks'] = null;

        return View::make('result_management.edit_config')->with('data',$data)->with('configuration_name',$configuration_name);
    }

    public function edit_config2()
    {
        //return Input::all();
        $configuration_name = Input::get('configuration_name');
        $ra_marks = Input::get('ra_marks');
        $class_work = Input::get('class_work');
        $home_work = Input::get('home_work');
        $both = Input::get('both');
        $ct_marks = Input::get('ct_marks');
        $class_test1 = Input::get('class_test1');
        $class_test2 = Input::get('class_test2');
        $class_test3 = Input::get('class_test3');
        $class_test4 = Input::get('class_test4');
        $ht_marks = Input::get('ht_marks');
        $hall_test = Input::get('hall_test');
        $mcq_marks = Input::get('mcq_marks');
        $mcq = Input::get('mcq');
        $lab = Input::get('lab');
        $viva = Input::get('viva');
        $experiment = Input::get('experiment');
        $total = Input::get('total');
        if(($ra_marks+$ct_marks+$ht_marks+$mcq_marks+$lab)==$total&&$configuration_name!=null)
        {
            if($ra_marks!=null)
            {
                if($class_work!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','class_work')->first();
                    if($test!="")
                    {
                        $input['total_marks'] = $ra_marks;
                        $input['weighted_marks'] = $class_work;
                        $input['converted_marks']  = ($class_work*$ra_marks)/($class_work+$home_work+$both);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','class_work')->update($input);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'RT';
                        $mark->exam_name = 'class_work';
                        $mark->total_marks = $ra_marks;
                        $mark->weighted_marks = $class_work;
                        $mark->converted_marks = ($class_work*$ra_marks)/($class_work+$home_work+$both);
                        $mark->save();
                    }
                }
                if($home_work!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','home_work')->first();
                    if($test!="") {
                        $input1['total_marks'] = $ra_marks;
                        $input1['weighted_marks'] = $home_work;
                        $input1['converted_marks'] = ($home_work * $ra_marks) / ($class_work + $home_work + $both);
                        MarksConfiguration::where('configuration_name', '=', $configuration_name)->where('configuration_type', '=', 'RT')->where('exam_name', '=', 'home_work')->update($input1);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'RT';
                        $mark->exam_name = 'home_work';
                        $mark->total_marks = $ra_marks;
                        $mark->weighted_marks = $home_work;
                        $mark->converted_marks = ($home_work * $ra_marks) / ($class_work + $home_work + $both);
                        $mark->save();
                    }
                }
                if($both!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','bothe')->first();
                    if($test!="") {
                        $input2['total_marks'] = $ra_marks;
                        $input2['weighted_marks']  = $both;
                        $input2['converted_marks']= ($both*$ra_marks)/($class_work+$home_work+$both);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','RT')->where('exam_name','=','bothe')->update($input2);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'RT';
                        $mark->exam_name = 'bothe';
                        $mark->total_marks = $ra_marks;
                        $mark->weighted_marks =  $both;
                        $mark->converted_marks = ($both*$ra_marks)/($class_work+$home_work+$both);
                        $mark->save();
                    }

                }
            }
            if($ct_marks!=null)
            {
                if($class_test1!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_1')->first();
                    if($test!="") {
                        $input21['total_marks']= $ct_marks;
                        $input21['weighted_marks']  = $class_test1;
                        $input21['converted_marks'] = ($class_test1*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_1')->update($input21);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'CT';
                        $mark->exam_name = 'class_test_1';
                        $mark->total_marks = $ct_marks;
                        $mark->weighted_marks =  $class_test1;
                        $mark->converted_marks = ($class_test1*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        $mark->save();
                    }
                }
                if($class_test2!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_2')->first();
                    if($test!="") {
                        $input22['total_marks']= $ct_marks;
                        $input22['weighted_marks'] = $class_test2;
                        $input22['converted_marks']= ($class_test2*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_2')->update($input22);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'CT';
                        $mark->exam_name = 'class_test_2';
                        $mark->total_marks = $ct_marks;
                        $mark->weighted_marks =  $class_test2;
                        $mark->converted_marks = ($class_test2*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        $mark->save();
                    }
                }
                if($class_test3!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_3')->first();
                    if($test!="") {
                        $input23['total_marks']= $ct_marks;
                        $input23['weighted_marks'] = $class_test3;
                        $input23['converted_marks']= ($class_test3*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_3')->update($input23);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'CT';
                        $mark->exam_name = 'class_test_3';
                        $mark->total_marks = $ct_marks;
                        $mark->weighted_marks =  $class_test3;
                        $mark->converted_marks = ($class_test3*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        $mark->save();
                    }
                }
                if($class_test4!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_4')->first();
                    if($test!="") {

                        $input24['total_marks']= $ct_marks;
                        $input24['weighted_marks'] = $class_test4;
                        $input24['converted_marks']= ($class_test4*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','CT')->where('exam_name','=','class_test_4')->update($input24);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'CT';
                        $mark->exam_name = 'class_test_4';
                        $mark->total_marks = $ct_marks;
                        $mark->weighted_marks =  $class_test4;
                        $mark->converted_marks = ($class_test4*$ct_marks)/($class_test1+$class_test2+$class_test3+$class_test4);
                        $mark->save();
                    }
                }
            }
            if($ht_marks!=null)
            {
                if($hall_test!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','HT')->where('exam_name','=','Hall_Test')->first();
                    if($test!="") {
                        $input3['total_marks']= $ht_marks;
                        $input3['weighted_marks']= $hall_test;
                        $input3['converted_marks']= ($hall_test*$ht_marks)/($hall_test);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','HT')->where('exam_name','=','Hall_Test')->update($input3);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'HT';
                        $mark->exam_name = 'Hall_Test';
                        $mark->total_marks = $ht_marks;
                        $mark->weighted_marks =  $hall_test;
                        $mark->converted_marks = ($hall_test*$ht_marks)/($hall_test);
                        $mark->save();
                    }
                }
            }
            if($mcq_marks!=null)
            {
                if($mcq!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','MT')->where('exam_name','=','MCQ_Test')->first();
                    if($test!="") {
                        $input4['total_marks']= $mcq_marks;
                        $input4['weighted_marks']= $mcq;
                        $input4['converted_marks']= ($mcq*$mcq_marks)/($mcq);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','MT')->where('exam_name','=','MCQ_Test')->update($input4);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'MT';
                        $mark->exam_name = 'MCQ_Test';
                        $mark->total_marks = $mcq_marks;
                        $mark->weighted_marks =  $mcq;
                        $mark->converted_marks =($mcq*$mcq_marks)/($mcq);
                        $mark->save();
                    }
                }
            }
            if($lab!=null)
            {
                if($viva!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->where('exam_name','=','viva')->first();
                    if($test!="") {
                        $input51['total_marks'] = $lab;
                        $input51['weighted_marks'] = $viva;
                        $input51['converted_marks'] = ($viva*$lab)/($viva+$experiment);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->where('exam_name','=','viva')->update($input51);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'LT';
                        $mark->exam_name = 'viva';
                        $mark->total_marks = $lab;
                        $mark->weighted_marks =  $viva;
                        $mark->converted_marks =($viva*$lab)/($viva+$experiment);
                        $mark->save();
                    }
                }

                if($experiment!=null)
                {
                    $test = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->where('exam_name','=','experiment')->first();
                    if($test!="") {
                        $input52['total_marks']= $lab;
                        $input52['weighted_marks'] = $experiment;
                        $input52['converted_marks']= ($experiment*$lab)/($viva+$experiment);
                        MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=','LT')->where('exam_name','=','experiment')->update($input52);
                    }
                    else
                    {
                        $mark = new MarksConfiguration();
                        $mark->configuration_name = $configuration_name;
                        $mark->configuration_type = 'LT';
                        $mark->exam_name = 'experiment';
                        $mark->total_marks = $lab;
                        $mark->weighted_marks =  $experiment;
                        $mark->converted_marks =($experiment*$lab)/($viva+$experiment);
                        $mark->save();
                    }
                }
            }
            return Redirect::to('result_management/list_of_config');
        }
        else
        {
            return Redirect::back()->withInput()->with('error', 'Error Message');
        }
    }


    public function prepare_marksheet($term, $year, $class_name, $class_sec, $course_teacher_id) {
        $courseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
        // get class information
        $class_info = Addclass::where('class_name', $class_name)->where('section', $class_sec)->first();
        $class_num = $class_info->value;
        // get course information
        $course_info = CourseTeacher::where('idcourseteacher', $course_teacher_id)->first();
        $type = $course_info->type;
        $subject_id = $course_info->idsubject;
        $class_section_id = $course_info->idclasssection;
        // get subject name
        $subject_name = Subject::where('idsubject', $subject_id)->pluck('subject_name');
        // get configuration name
        $mark_config_name = SubjectToClass::where('class', $class_name)->where('idsubject', $subject_id)->pluck('markconfiguration_name');
        // get configuration info and order in asc to calcute CT mark before MCQ and HT marks
        $mark_config = MarksConfiguration::where('configuration_name', $mark_config_name)->groupBy('configuration_type')->orderBy('configuration_type', 'asc')->get();
        /*
            Check for marksheet generation
        */

        /* check id_subject; if religion or agriculture run second query */

        //number of exam type
        $count_mark_config = count($mark_config);
        /* Count of number of exam type result found */
        /*
        New
        $tabulation_info = TabulationSheetEditable::where('flag', 'editable')->where('class', $class_info->class_name)->where('section', $class_info->section)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->where('courseteacher_idcourseteacher', $course_teacher_id)->groupBy('exam_type')->get();
        */

        $tabulation_info = TabulationSheetEditable::where('flag', 'editable')->where('class', $class_info->class_name)->where('section', $class_info->section)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->groupBy('exam_type')->get();

        $count_tabulation_info = count($tabulation_info);

        if(($class_info->value == 5 || $class_info->value == 8 || $class_info->value == 10) && strtolower(Input::get('term')) == 'final') {
            $count_tabulation_info++;
        }
        // >= to ignore manual input
      /*
        if(!($count_tabulation_info >= $count_mark_config)) {
            $msg = "<div class='alert alert-danger'><strong><h3 style='color:black' align='center'>Error! Mark sheet already generated or marks are yet to insert</h3></strong></div>";

            return View::make('result_management.teacher_result_insert')->with('courseteacher', $courseteacher)->with('course',null)->with('subject',null)->with('year',null)->with('term',$term)->with('msg', $msg);
        }
        /*
            Check for valid mark generation end
        */
        //get student info
        $student_info = StudentToSectionUpdate::where('shift', $class_info->shift)->where('class', $class_name)->where('section', $class_sec)->where('year', $year)->get();
        // for each student
        $subject_total = TotalMarksConfiguration::where('configuration_type', $mark_config_name)->first();

        if($class_num == 5 || $class_num == 8 || $class_num == 10 || $class_num == 11 || $class_num == 12) {
            $half_total = $subject_total->total;
            $final_total = $subject_total->f_total;
            $grand_total = $subject_total->gt_total;
        } else {
            $half_total = $subject_total->total;
            $final_total = $half_total;
            $grand_total = $half_total*2;
        }
        $result['total'] = $half_total;

        foreach ($student_info as $student_info) {
            $tmp2['ct_mcq'] = "";
            $tmp['ct_cq'] = $tmp['ct_mcq'] = "";
            if(strtolower($term) == 'final') {
                $result['f_ra'] = $result['f_ct'] = $result['f_mcq'] =  $result['f_lab'] = $result['f_ht'] = "";
                $result['gt_ra'] = $result['gt_ct'] = $result['gt_mcq'] =  $result['gt_lab'] = $result['gt_ht'] = "";
            } else {
                //half yearly
                $result['h_ra'] = $result['h_ct'] = $result['h_mcq'] =  $result['h_lab'] = $result['h_ht'] = "";
            }

            $stdnt_rslt = TStudentResult::where('st_id', $student_info->student_idstudentinfo)->where('idclasssection', $class_section_id)->where('subjectid', $subject_id)->where('academic_year', $year)->first();

            $pass_flag = true;

            if (!count($stdnt_rslt) && $class_num < 11) {
                $t_st_result = new TStudentResult();
                $t_st_result->st_id = $student_info->student_idstudentinfo;
                $t_st_result->class = $class_name;
                $t_st_result->section = $class_sec;
                $t_st_result->idclasssection = $class_section_id;
                $t_st_result->subjectid = $subject_id;
                $t_st_result->subject = $subject_name;
                $t_st_result->idcourseteacher = $course_teacher_id;
                $t_st_result->academic_year = $year;
                $t_st_result->save();
            }

            foreach($mark_config as $config) {
                if ($config->configuration_type == "RT") { // Regular assessment
                    // get student's regular assessment result
                    $st_rslt_rt = ResultRegularAssessment::where('studentinfo_idstudentinfo', $student_info->student_idstudentinfo)->where('class', $class_name)->where('section', $class_sec)->where('idclasssection', $class_section_id)->where('courseteacher_idcourseteacher', $course_teacher_id)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->first();
                    // get regular assessment marks
                    (isset($st_rslt_rt->classwork) ? $cw_mark = $st_rslt_rt->classwork : $cw_mark = 0);
                    (isset($st_rslt_rt->homework) ? $hw_mark = $st_rslt_rt->homework : $hw_mark = 0);
                    // total rt mark
                    $rt_mark = $cw_mark + $hw_mark;
                    // keep data to update to db
                    if((strtolower($term) == 'final') && (!(($class_num == 5 || $class_num == 8 || $class_num == 10) && strtolower($term) == 'final'))) {


                        $result['f_ra'] = $rt_mark;
                        // ignored for class 11 and 12 since they have individual terms
                        if($class_num < 11)
                            /* edited on 17/11/2016 */
                            if(isset($stdnt_rslt->h_ra)) {
                                $hr = $stdnt_rslt->h_ra;    
                            } else {
                                $hr = 0;
                            }
                            $result['gt_ra'] = $rt_mark + $hr;
                    } else {
                        $result['h_ra'] = $rt_mark;
                    }
                    //end of regular assessment if
                } else if ($config->configuration_type == "CT") { // Class test
                    // calculate for CT except for class 5,8,10 and term is final
                    if(!(($class_num == 5 || $class_num == 8 || $class_num == 10) && strtolower($term) == 'final'))
                    {
                        //student class test result details
                        $st_rslt_ct = ResultClassTest::where('studentinfo_idstudentinfo', $student_info->student_idstudentinfo)->where('class', $class_name)->where('section', $class_sec)->where('idclasssection', $class_section_id)->where('courseteacher_idcourseteacher', $course_teacher_id)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->first();

                        if ($class_num <= 8) {

                            // result details
                            (isset($st_rslt_ct->ct1) ? $ct1 = $st_rslt_ct->ct1 : $ct1 = 0);

                            $ct_mark = $ct1;
                        } else {
                            // get result details
                            (isset($st_rslt_ct->ct1) ? $ct_cq = $st_rslt_ct->ct1 : $ct_cq = 0);
                            (isset($st_rslt_ct->ct2) ? $ct_mcq = $st_rslt_ct->ct2 : $ct_mcq = 0);
                            // total CT marks
                            $ct_mark = $ct_cq + $ct_mcq;
                            /*
                                check for ICT and Career
                            */
                            if($mark_config_name == 'config09car') {
                                // if subject is ICT/Career save for direct; CT type MCQ only
                                // saved to add in converted marks if above class 8
                                $tmp2['ct_mcq'] = $ct_mcq;
                            } else {
                                // stored for hall test and mcq
                                $tmp['ct_cq'] = $ct_cq;
                                $tmp['ct_mcq'] = $ct_mcq;
                            }
                            //check for pass mark for class 9 and above
                            if($config->ct_type == 2) {
                                $pass_flag = (ResultController::is_pass($config, $class_num, $ct_cq, "CT") ? true : false);
                            } else if ($config->ct_type == 4) {
                                $pass_flag = (ResultController::is_pass($config, $class_num, $ct_mcq, "CT") ? true : false);
                            } else {
                            	// type 3
                            	if(!(ResultController::is_pass($config, $class_num, $ct_cq, "CT") && ResultController::is_pass($config, $class_num, $ct_mcq, "CT"))) {
                                		$pass_flag = true;
                                }
                            }
                        }
                        //keep data to update to db
                        if(strtolower($term) == 'final') {
                            $result['f_ct'] = $ct_mark;
                        // ignored for class 11 and 12 since they have individual terms
                            if($class_num < 11)
                                $result['gt_ct'] = $ct_mark + $stdnt_rslt->h_ct;
                        } else {
                            $result['h_ct'] = $ct_mark;
                        }
                    }
                    //end of class test else if
                } else if ($config->configuration_type == "MT") { // MCQ
                    //student mcq result details
                    $st_rslt_mcq = ResultMCQTest::where('studentinfo_idstudentinfo', $student_info->student_idstudentinfo)->where('class', $class_name)->where('section', $class_sec)->where('idclasssection', $class_section_id)->where('courseteacher_idcourseteacher', $course_teacher_id)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->first();
                    // get mcq mark
                    (isset($st_rslt_mcq->mcq_marks) ? $mcq_mark = $st_rslt_mcq->mcq_marks : $mcq_mark = 0);

                    if ($class_num > 8) {
                        if($pass_flag) {
                            $pass_flag = ResultController::is_pass($config, $class_num, $mcq_mark, "MT");
                        }
                        // ignored for class 10 and final term
                        if (!(($class_num == 10) && (strtolower($term) == 'final'))) {
                            $mcq_mark = $mcq_mark + $tmp['ct_mcq'];
                            //$tmp['ct_mcq'] = 0;
                        }
                    }

                    // keep data to update to db
                    if(strtolower($term) == 'final') {
                        $result['f_mcq'] = $mcq_mark;
                        // ignored for class 11 and 12 since they have individual terms
                        if($class_num < 11)

                            if(isset($stdnt_rslt->h_mcq)){

                            $result['gt_mcq'] = $mcq_mark + $stdnt_rslt->h_mcq;
                        }

                         else{

                            $result['gt_mcq'] = $mcq_mark + 0;
                        }


                    } else {
                        $result['h_mcq'] = $mcq_mark;
                    }
                    // end of MCQ else if
                } else if ($config->configuration_type == "HT") { // Hall test -> CQ
                    // get student hall test mark

                    // get hall test mark
                    $st_rslt_ht = ResultHallTest::where('studentinfo_idstudentinfo', $student_info->student_idstudentinfo)->where('class', $class_name)->where('section', $class_sec)->where('idclasssection', $class_section_id)->where('courseteacher_idcourseteacher', $course_teacher_id)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->first();

                    (isset($st_rslt_ht->hall_test_marks) ? $ht_mark = $st_rslt_ht->hall_test_marks : $ht_mark = 0);

                    if($class_num > 8) {
                    	if($pass_flag) {
                            $pass_flag = ResultController::is_pass($config, $class_num, $ht_mark, "HT");
                        }
                        if (!(($class_num == 10) && (strtolower($term) == 'final'))) {
                            $ht_mark = $ht_mark + $tmp['ct_cq'];
                            //$tmp['ct_cq'] = 0;
                        }
                    }

                    // keep data to update to db
                    if(strtolower($term) == 'final') {
                        $result['f_ht'] = $ht_mark;
                        // ignored for class 11 and 12 since they have individual terms
                        if($class_num < 11)

                            if(isset($stdnt_rslt->h_ht)){
                            $result['gt_ht'] = $ht_mark + $stdnt_rslt->h_ht;
                        }
                        else{

                            $result['gt_ht'] = $ht_mark + 0;
                        }


                    } else {
                        $result['h_ht'] = $ht_mark;
                    }
                    // end of hall test else if
                } else if ($config->configuration_type == "LT") { // Lab test
                    // get student lab test mark
                    $st_rslt_lt = ResultLabTest::where('studentinfo_idstudentinfo', $student_info->student_idstudentinfo)->where('class', $class_name)->where('section', $class_sec)->where('idclasssection', $class_section_id)->where('courseteacher_idcourseteacher', $course_teacher_id)->where('idsubject', $subject_id)->where('term', $term)->where('academic_year', $year)->first();
                    //get lab test mark
                    (isset($st_rslt_lt->viva_marks) ? $lt_mark = $st_rslt_lt->viva_marks : $lt_mark = 0);

                    // pass check
                    if($class_num > 8) {
                    	if($pass_flag) {
                            $pass_flag = ResultController::is_pass($config, $class_num, $lt_mark, "LT");
                        }
                       	// add later
                    }

                    // keep data to update to db
                    if(strtolower($term) == 'final') {
                        $result['f_lab'] = $lt_mark;
                        // ignored for class 11 and 12 since they have individual terms
                        if($class_num < 11)
                            $result['gt_lab'] = $lt_mark + $stdnt_rslt->h_lab;
                    } else {
                        $result['h_lab'] = $lt_mark;
                    }
                    // end of lab test else if
                } //end of config foreach
                

            if($class_num < 11) {
                if(strtolower($term) == 'final') {
                    if($class_num < 9) {
                        //total with ct
                        $result['f_total'] = $result['f_ra']+$result['f_ct']+$result['f_mcq']+$result['f_ht']+$result['f_lab'];
                    } else {
                        //total without ct since it is already added
                        $result['f_total'] = $result['f_ra']+$result['f_mcq']+$result['f_ht']+$result['f_lab'];
                    }

					 $r=0;
					 
					   if(!isset($stdnt_rslt->h_total) ){

					    $r = 0;
					   }else{

					    $r = $stdnt_rslt->h_total;
					   }

                    $result['gt_total'] = $r + $result['f_total'];

                    if($pass_flag) {
                        // final
                        $final_grade = ResultController::gradeTotal($class_num, $result['f_total'], $final_total);
                        $result['f_gp'] = $final_grade['point'];
                        $result['f_grade'] = $final_grade['letter'];
                        // grand total
                        $grand_grade = ResultController::gradeTotal($class_num, $result['gt_total'], $grand_total);
                        $result['gt_gp'] = $grand_grade['point'];
                        $result['gt_grade'] = $grand_grade['letter'];
                    } else {
                        //fail
                        $result['f_gp'] = "0.0";
                        $result['f_grade'] = "F";
                        $result['gt_gp'] = "0.0";
                        $result['gt_grade'] = "F";
                    }
                } else { // half yearly
                    if($class_num < 9) {
                        // total with ct marks
                        $result['h_total'] = $result['h_ra']+$result['h_ct']+$result['h_mcq']+$result['h_ht']+$result['h_lab'];
                    } else {
                        // total without ct marks since already added
                        $result['h_total'] = $result['h_ra']+$result['h_mcq']+$result['h_ht']+$result['h_lab'];
                    }
                    if($pass_flag) {
                        $half_grade = ResultController::gradeTotal($class_num, $result['h_total'], $half_total);
                        $result['h_gp'] = $half_grade['point'];
                        $result['h_grade'] = $half_grade['letter'];
                    } else {
                        $result['h_gp'] = "0.0";
                        $result['h_grade'] = "F";
                    }
                } //end of else (term check)
            } //end of foreach student
                TStudentResult::where('st_id', $student_info->student_idstudentinfo)->where('idclasssection', $class_section_id)->where('subjectid', $subject_id)->where('academic_year', $year)->update($result);
            }

            if($class_num > 8) {
                //cq
                $conv_res['cq_ct'] = $tmp['ct_cq'];
                $conv_res['cq_total'] = ((strtolower($term) == 'final') ? $result['f_ht'] : $result['h_ht'])-$tmp['ct_cq'];
                $conv_res['cq_conv'] = ((strtolower($term) == 'final') ? $result['f_ht'] : $result['h_ht']);
                //mcq
                /*
                    if config09car (ICT/Career) CT_MCQ is not added to hall test or mcq test.  thus $tmp2['ct_mcq'] is used to get                      CT mark for class 9 and above
                */
                $conv_res['mcq_ct'] = ($mark_config_name == 'config09car' ? $tmp2['ct_mcq'] : $tmp['ct_mcq']);
                $conv_res['mcq_total'] = ((strtolower($term) == 'final') ? $result['f_mcq'] : $result['h_mcq'])-$tmp['ct_mcq'];
                $conv_res['mcq_conv'] = ((strtolower($term) == 'final') ? $result['f_mcq'] : $result['h_mcq']);
                //lab
                $conv_res['practical'] = ((strtolower($term) == 'final')? $result['f_lab'] : $result['h_lab']);
                //total
                $conv_res['total'] = $conv_res['cq_conv'] + $conv_res['mcq_conv'] + $conv_res['practical'];
                //grade check grade for each term for class 11 and above
                if($class_num < 11) {
                    $conv_res['grade'] = ((strtolower($term) == 'final') ? $result['f_grade'] : $result['h_grade']);
                    $conv_res['point'] = ((strtolower($term) == 'final') ? $result['f_gp'] : $result['h_gp']);
                } else {
                    if(strtolower($term) == 'final')
                    {
                        $conv_grade = ResultController::gradeTotal($class_num, $conv_res['total'], $final_total);
                        $conv_res['grade'] = $conv_grade['letter'];
                        $conv_res['point'] = $conv_grade['point'];
                    } else { //half yearly
                    	if($pass_flag) {
	                    	$conv_grade = ResultController::gradeTotal($class_num, $conv_res['total'], $half_total);
	                        $conv_res['grade'] = $conv_grade['letter'];
	                        $conv_res['point'] = $conv_grade['point'];
                    	} else {
                    		$conv_grade = "F";
	                        $conv_res['grade'] = "F";
	                        $conv_res['point'] = "0.0";	
                    	}
                        
                    }
                }
                
                $conv_marks = ConvertedMarks::where('st_id', $student_info->student_idstudentinfo)->where('subjectid', $subject_id)->where('class_id', $class_info->class_id)->where('term', $term)->where('year', $year)->first();

                if(!count($conv_marks)) {
                    $con = new ConvertedMarks();
                    $con->st_id=$student_info->student_idstudentinfo;
                    $con->subjectid = $subject_id;
                    $con->class_id = $class_info->class_id;
                    $con->term = $term;
                    $con->year = $year;
                    $con->cq_ct = $conv_res['cq_ct'];
                    $con->cq_total = $conv_res['cq_total'];
                    $con->cq_conv = $conv_res['cq_conv'];
                    $con->mcq_ct = $conv_res['mcq_ct'];
                    $con->mcq_total = $conv_res['mcq_total'];
                    $con->mcq_conv = $conv_res['mcq_conv'];
                    $con->practical = $conv_res['practical'];
                    $con->total = $conv_res['total'];
                    $con->grade = $conv_res['grade'];
                    $con->point =  $conv_res['point'];
                    $con->save();
                } else {
                    ConvertedMarks::where('st_id', $student_info->student_idstudentinfo)->where('subjectid', $subject_id)->where('class_id', $class_info->class_id)->where('term', $term)->where('year', $year)->update($conv_res);
                }
            }
        } // end of foreach student
        $msg = "<div class='alert alert-success'><strong><h3 style='color:black' align='center'>Marksheet generated successfully</h3></strong></div>";

        return Redirect::to('result_management/teacher_result_insert')->with('course',$class_info->class_id)->with('subject',$course_teacher_id)->with('year',$year)->with('term',$term)->withMessage($msg);
    }

    public function teacher_result_insert()
    {
        $msg = Session::get('message');
        //check sub_name
        $course = Session::get('course');
        $subject = Session::get('subject');
        $year = Session::get('year');
        $term = Session::get('term');
        $clssec = Addclass::where('class_id','=',$course)->get();
        $sub_name = Subject::where('idsubject', '=', $subject)->pluck('subject_name');

        $clsname = Addclass::where('class_id','=',$course)->pluck('class_name');

        $aclass=null;
        $asec=null;
        foreach($clssec as $cs)
        {
            $aclass=$cs->class_name;
            $asec=$cs->section;
        }

        $isEditable= TabulationSheetEditable::where('academic_year','=',$year)->where('term','=',$term)->where('courseteacher_idcourseteacher','=',$subject)->where('class','=',$aclass)->where('section','=',$asec)->where('flag','=','non_editable')->get();

        $cnt= count($isEditable);
        // $cnt=5;
        if($course!=null && $subject != null && $year != null)
        {
            $courseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();

            return View::make('result_management.teacher_result_insert')->with('courseteacher', $courseteacher)->with('course',$clsname )->with('subject',$subject)->with('year',$year)->with('term',$term)->with('countedit',$cnt)->with('classnm',$aclass)->with('clssec',$asec)->with('sub_name',$sub_name)->with('msg', $msg);
        }
        else {
            $courseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();

            return View::make('result_management.teacher_result_insert')->with('courseteacher', $courseteacher)->with('course',null)->with('subject',null)->with('year',null)->with('term',$term)->with('msg', $msg);
        }
    }

    public function teacher_result_insert2()
    {
        // class_id............Input::get('cat');
        // academic_year.......Input::get('year');
        // final/half_yearly...Input::get('term');
        // idcourseteacher.....Input::get('sub');

        return Redirect::to('result_management/teacher_result_insert')->with('course',Input::get('cat'))->with('subject',Input::get('sub'))->with('year',Input::get('year'))->with('term',Input::get('term'));
    }


    public function regular_assesment($data,$data1,$data2,$year,$term,$sec,$idcourse)
    {
        //get
        if(!empty(Session::get('msg'))) {
            $msg = Session::get('msg');
        } else {
            $msg = "";
        }

        $subject_name = Subject::where('idsubject', $data2)->pluck('subject_name');
        // $course is a row from subjecttoclass table
        $course = Addclass::where('class_name','=',$data)->where('section','=',$sec)->first();
        return View::make('result_management.result_insert_individual')->with('type',$data1)->with('idcourse',$idcourse)->with('course',$course)->with('data2',$data2)->with('year',$year)->with('term',$term)->with('sec',$sec)->with('subject_name', $subject_name)->with('msg', $msg);

    }


    public function regular_assesment2()
    {
        //post
        //  return Input::all();
        ini_set('max_execution_time', 600);
        $type = Input::get('type');
        $idsubject = Input::get('subject');
        $term = Input::get('term');
        $clsname= Input::get('class');
        $secname=Input::get('section');
        $acayear=Input::get('year');
        $idcourseteacher = Input::get('idcourseteacher');
        $configuration_name = Input::get('configuration_name');

        $course = CourseTeacher::where('idclasssection','=',$idcourseteacher)->where('idsubject','=',$idsubject)->where('idteacherinfo','=',Auth::user()->user_id)->first();
        $classteacher = ClassTeacher::where('idclasssection','=',$idcourseteacher)->where('academic_year','=',$acayear)->first();
        if (!count($classteacher)) {
            return "Error! Teacher not assigned for the year.";
        }
        $stdcount= StudentToSectionUpdate::where('class','=',$clsname)->where('section','=',$secname)->where('year','=',$acayear)->get();
        $sc= count($stdcount);

        $subtoclass = SubjectToClass::where('idsubject','=',$idsubject)->where('class','=',$clsname)->first();

        $total = TotalMarksConfiguration::where('configuration_type','=',$subtoclass->markconfiguration_name)->pluck('total');

        $subname = Subject::where('idsubject','=',$idsubject)->pluck('subject_name');


        if($type=="RT") {

            $tabuExist = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('exam_type','=','RT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->first();

            if(!count($tabuExist)) {

                $tabulation = new TabulationSheetEditable();
                $tabulation->idcourseteacher = $classteacher->idteacherinfo;
                $tabulation->flag = "editable";
                $tabulation->exam_type = "RT";
                $tabulation->term = $term;
                $tabulation->academic_year = $acayear;
                $tabulation->class = $clsname;
                $tabulation->section = $secname;
                $tabulation->idsubject = $idsubject;
                $tabulation->approved_by = "0";
                $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
                $tabulation->save();
                //check for editable
                $editable = true;
            } else {
                if ($tabuExist->flag == "editable")
                    $editable = true;
                else
                    $editable = false;
            }

            if($editable) {

                for ($i = 1; $i <= $sc; $i++) {
                    $idstudentinfo = Input::get('idstudentinfo' . $i);
                    $class_work = Input::get('class_work' . $i);
                    if ($class_work != "" && $class_work != null)
                        $class_work1 = $class_work;
                    else $class_work1 = null;
                    $home_work = Input::get('home_work' . $i);
                    if ($home_work != "" && $home_work != null)
                        $home_work1 = $home_work;
                    else $home_work1 = null;
                    $bothe = Input::get('bothe' . $i);
                    if ($bothe != "" && $bothe != null)
                        $bothe1 = $bothe;
                    else $bothe1 = null;

                    if ($idstudentinfo != null) {

                        $exist = ResultRegularAssessment::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();

                        if ($exist != null) {

                            if($class_work1 != "" || $home_work1!= "" || $bothe != ""){
                                $data['classwork'] = $class_work1;
                                $data['homework'] = $home_work1;
                                $data['bothe'] = $bothe1;
                                $data['academic_year'] = Input::get('year');
                                $data['converted_marks'] = "0";
                                $data['last_update'] = Carbon\Carbon::now('+6');
                                ResultRegularAssessment::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject','=',$idsubject)->where('academic_year','=',$acayear)->where('term','=',$term)->update($data);
                            }

                        } else {
                            $reg = new ResultRegularAssessment();
                            $reg->studentinfo_idstudentinfo = $idstudentinfo;
                            $reg->class = $clsname;
                            $reg->section = $secname;
                            $reg->idclasssection = $idcourseteacher;
                            $reg->courseteacher_idcourseteacher = $course->idcourseteacher;
                            $reg->idsubject = $idsubject;
                            $reg->subject_name = $subname;
                            $reg->total = $total;

                            $reg->classwork = $class_work1;
                            $reg->homework = $home_work1;
                            $reg->bothe = $bothe1;
                            $reg->academic_year = Input::get('year');
                            $reg->term = $term;
                            $reg->converted_marks = "0";
                            $reg->insert_at = Carbon\Carbon::now('+6');
                            $reg->save();
                        }
                    }
                }
            }
            return Redirect::back()->with('msg', 'Regular assessment marks saved successfully!');
        }

        if($type=="CT") {

            $tabuExist = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('exam_type','=','CT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->first();

            if(!count($tabuExist)) {

                $tabulation = new TabulationSheetEditable();
                $tabulation->idcourseteacher = $classteacher->idteacherinfo;
                $tabulation->flag = "editable";
                $tabulation->exam_type = "CT";
                $tabulation->term = $term;
                $tabulation->academic_year = $acayear;
                $tabulation->class = $clsname;
                $tabulation->section = $secname;
                $tabulation->idsubject = $idsubject;
                $tabulation->approved_by = "0";
                $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
                $tabulation->save();

                //check for editable
                $editable = true;
            } else {
                if ($tabuExist->flag == "editable")
                    $editable = true;
                else
                    $editable = false;
            }

            if($editable) {
                    for ($i = 1; $i <= $sc; $i++) {
                        $idstudentinfo = Input::get('idstudentinfo' . $i);
                        $class_Test_1 = Input::get('class_test_1' . $i);
                        if ($class_Test_1 != "" && $class_Test_1 != null)
                            $class_Test_11 = $class_Test_1;
                        else $class_Test_11 = null;
                        $class_Test_2 = Input::get('class_test_2' . $i);
                        if ($class_Test_2 != "" && $class_Test_2 != null)
                            $class_Test_21 = $class_Test_2;
                        else $class_Test_21 = null;
                        $class_Test_3 = Input::get('class_test_3' . $i);
                        if ($class_Test_3 != "" && $class_Test_3 != null)
                            $class_Test_31 = $class_Test_3;
                        else $class_Test_31 = null;
                        $class_Test_4 = Input::get('class_test_4' . $i);
                        if ($class_Test_4 != "" && $class_Test_4 != null)
                            $class_Test_41 = $class_Test_4;
                        else $class_Test_41 = null;

                    if ($idstudentinfo != null) {

                        $exist = ResultClassTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->where('academic_year','=', Input::get('year'))->first();


                        if (count($exist)) {
                            if ($class_Test_11 != "" ||  $class_Test_21 != "" || $class_Test_31 != "" || $class_Test_41 != "") { //return $class_Test_11.$class_Test_21;
                                $data['ct1'] = $class_Test_11;
                                $data['ct2'] = $class_Test_21;
                                $data['ct3'] = $class_Test_31;
                                $data['ct4'] = $class_Test_41;
                                $data['academic_year'] = Input::get('year');
                                $data['converted_marks'] = "0";
                                $data['last_update'] = Carbon\Carbon::now('+6');
                                ResultClassTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('academic_year','=', Input::get('year'))->where('term','=',$term)->update($data);
                            }
                        } else {
                                $reg = new ResultClassTest();
                                $reg->studentinfo_idstudentinfo = $idstudentinfo;
                                $reg->class = $clsname;
                                $reg->section = $secname;
                                $reg->idclasssection = $idcourseteacher;
                                $reg->courseteacher_idcourseteacher = $course->idcourseteacher;
                                $reg->idsubject = $idsubject;
                                $reg->subject_name = $subname;
                                $reg->total = $total;
                                $reg->ct1 = $class_Test_11;
                                $reg->ct2 = $class_Test_21;
                                $reg->ct3 = $class_Test_31;
                                $reg->ct4 = $class_Test_41;
                                $reg->academic_year = Input::get('year');
                                $reg->term = $term;
                                $reg->converted_marks = "0";
                                $reg->insert_at = Carbon\Carbon::now('+6');
                                $reg->save();

                            }
                    }
                }
            }
            return Redirect::back()->with('msg', 'Class test marks saved successfully!');
        }
        if($type=="HT") {
            $tabuExist = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('exam_type','=','HT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->first();

            if(!count($tabuExist)) {
                $tabulation = new TabulationSheetEditable();
                $tabulation->idcourseteacher = $classteacher->idteacherinfo;
                $tabulation->flag = "editable";
                $tabulation->exam_type = "HT";
                $tabulation->term = $term;
                $tabulation->academic_year = $acayear;
                $tabulation->class = $clsname;
                $tabulation->section = $secname;
                $tabulation->idsubject = $idsubject;
                $tabulation->approved_by = "0";
                $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
                $tabulation->save();

                //check for editable
                $editable = true;
            } else {
                if ($tabuExist->flag == "editable")
                    $editable = true;
                else
                    $editable = false;
            }

            if($editable) {
                for ($i = 1; $i <= $sc; $i++) {
                    //$spc_ht = 0;
                    $idstudentinfo = Input::get('idstudentinfo' . $i);
                    $Hall_Test = Input::get('Hall_Test' . $i);
                    if ($Hall_Test != "" && $Hall_Test != null)
                        $Hall_Test1 = $Hall_Test;
                    else $Hall_Test1 = null;

                    if ($idstudentinfo != null) {

                        $exist = ResultHallTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher', '=', $course->idcourseteacher)->where('term', '=', $term)->where('academic_year','=', Input::get('year'))->first();

                        if (count($exist)) {
                            $data['hall_test_marks'] = $Hall_Test1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = "0";
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultHallTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject', '=', $idsubject)->where('academic_year', '=', $acayear)->where('term', '=', $term)->where('idclasssection', '=', $idcourseteacher)->update($data);
                        } else {
                            $reg = new ResultHallTest();
                            $reg->studentinfo_idstudentinfo = $idstudentinfo;
                            $reg->class = $clsname;
                            $reg->section = $secname;
                            $reg->idclasssection = $idcourseteacher;
                            $reg->courseteacher_idcourseteacher = $course->idcourseteacher;
                            $reg->idsubject = $idsubject;
                            $reg->subject_name = $subname;
                            $reg->total = $total;
                            $reg->hall_test_marks = $Hall_Test1;
                            $reg->academic_year = Input::get('year');
                            $reg->term = $term;
                            $reg->converted_marks = "0";
                            $reg->insert_at = Carbon\Carbon::now('+6');
                            $reg->save();

                        }
                    }
                }//end of for loop
            }//end of editable
            return Redirect::back()->with('msg', 'Hall test marks saved successfully!');
        }
        if($type=="LT") {

            $tabuExist = TabulationSheetEditable::where('courseteacher_idcourseteacher', '=', $course->idcourseteacher)->where('exam_type', '=', 'LT')->where('term', '=', $term)->where('academic_year', '=', Input::get('year'))->first();

            if (!count($tabuExist)) {

                $tabulation = new TabulationSheetEditable();
                $tabulation->idcourseteacher = $classteacher->idteacherinfo;
                $tabulation->flag = "editable";
                $tabulation->exam_type = "LT";
                $tabulation->term = $term;
                $tabulation->academic_year = $acayear;
                $tabulation->class = $clsname;
                $tabulation->section = $secname;
                $tabulation->idsubject = $idsubject;
                $tabulation->approved_by = "0";
                $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
                $tabulation->save();

                //check for editable
                $editable = true;
            } else {
                if ($tabuExist->flag == "editable")
                    $editable = true;
                else
                    $editable = false;
            }

            if($editable) {
                for ($i = 1; $i <= $sc; $i++) {
                    $idstudentinfo = Input::get('idstudentinfo' . $i);
                    $viva = Input::get('viva' . $i);
                    if ($viva != "" && $viva != null)
                        $viva1 = $viva;
                    else $viva1 = null;
                    $experiment = Input::get('experiment' . $i);
                    if ($experiment != "" && $experiment != null)
                        $experiment1 = $experiment;
                    else $experiment1 = null;

                    if ($idstudentinfo != null) {

                        $exist = ResultLabTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher', '=', $course->idcourseteacher)->where('term', '=', $term)->where('academic_year', '=', Input::get('year'))->first();

                        if ($exist != null) {
                            $data['viva_marks'] = $viva1;
                            $data['experiment_marks'] = $experiment1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = "0";
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultLabTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject', '=', $idsubject)->where('academic_year', '=', $acayear)->where('term', '=', $term)->update($data);
                        } else {
                            $reg = new ResultLabTest();
                            $reg->studentinfo_idstudentinfo = $idstudentinfo;
                            $reg->class = $clsname;
                            $reg->section = $secname;
                            $reg->idclasssection = $idcourseteacher;
                            $reg->courseteacher_idcourseteacher = $course->idcourseteacher;
                            $reg->idsubject = $idsubject;
                            $reg->subject_name = $subname;
                            $reg->total = $total;
                            $reg->viva_marks = $viva1;
                            $reg->experiment_marks = $experiment1;
                            $reg->academic_year = Input::get('year');
                            $reg->term = $term;
                            $reg->converted_marks = "0";
                            $reg->insert_at = Carbon\Carbon::now('+6');
                            $reg->save();
                        }
                    }
                }
            }
            return Redirect::back()->with('msg', 'Lab test marks saved successfully!');
        }
        if($type=="MT") {

            $tabuExist = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('exam_type','=','MT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->first();

            if(!count($tabuExist)) {
                $tabulation = new TabulationSheetEditable();
                $tabulation->idcourseteacher = $classteacher->idteacherinfo;
                $tabulation->flag = "editable";
                $tabulation->exam_type = "MT";
                $tabulation->term = $term;
                $tabulation->academic_year = $acayear;
                $tabulation->class = $clsname;
                $tabulation->section = $secname;
                $tabulation->idsubject = $idsubject;
                $tabulation->approved_by = "0";
                $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
                $tabulation->save();

                //check for editable
                $editable = true;
            } else {
                if ($tabuExist->flag == "editable")
                    $editable = true;
                else
                    $editable = false;
            }

            if($editable) {
                for ($i = 1; $i <= $sc; $i++) {

                    //$spc_mt =0;
                    $idstudentinfo = Input::get('idstudentinfo' . $i);

                    $MCQ_Test = Input::get('MCQ_Test' . $i);
                    if ($MCQ_Test != "" && $MCQ_Test != null)
                        $MCQ_Test1 = $MCQ_Test;
                    else $MCQ_Test1 = null;

                    if ($idstudentinfo != null) {

                        $exist = ResultMCQTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();


                        if ($exist != null) {
                            $data['mcq_marks'] = $MCQ_Test1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = "0";
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultMCQTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject','=',$idsubject)->where('academic_year','=',$acayear)->where('term','=',$term)->update($data);
                        } else {
                            $reg = new ResultMCQTest();
                            $reg->studentinfo_idstudentinfo = $idstudentinfo;
                            $reg->class = $clsname;
                            $reg->section = $secname;
                            $reg->idclasssection = $idcourseteacher;
                            $reg->courseteacher_idcourseteacher = $course->idcourseteacher;
                            $reg->idsubject = $idsubject;
                            $reg->subject_name = $subname;
                            $reg->total = $total;
                            $reg->mcq_marks = $MCQ_Test1;
                            $reg->academic_year =Input::get('year');
                            $reg->term = $term;
                            $reg->converted_marks = "0";
                            $reg->insert_at = Carbon\Carbon::now('+6');
                            $reg->save();
                        }
                    }
                }
            }
            return Redirect::back()->with('msg', 'MCQ test marks saved successfully!');
        }
        return Redirect::back();
    }
    public function resultindividual()
    {
        $idclass = Session::get('idclass');
        $subject2 = Session::get('subject');
        $term = Session::get('term');
        $year = Session::get('year');

        $class = StudentToSectionUpdate::where('student_idstudentinfo','=',Auth::user()->email)->first();
        $addclass3 = Addclass::where('class_name','=',$class->class)->where('section','=',$class->section)->where('shift','=',$class->shift)->first();
        $addclass = Addclass::where('class_name','=',$class->class)->first();
        $subject = SubjectToClass::where('class','=',$class->class)->get();
        if($subject!=null&&$subject!="")
        {
            if($idclass!=null&&$subject2!=null)
            {
                return View::make('result_management.student_result')->with('subject',$subject)->with('idclass',$addclass3->class_id)->with('subject2',$subject2)->with('idclass2',$idclass)->with('class',$class)->with('term',$term)->with('year', $year);
            }
            else{
                return View::make('result_management.student_result')->with('subject',$subject)->with('idclass',$addclass3->class_id)->with('subject2',null)->with('idclass2',null)->with('term',null)->with('year', null);
            }
        }
        else
        {
            return Redirect::back();
        }
    }

    public function showreport_for_student(){

        return Redirect::to('result_management/student_report_card');
    }

    public function showresultlink()
    {
        return Redirect::to('result_management/student_result')->with('subject',Input::get('cat'))->with('term',Input::get('term'))->with('year',Input::get('year'))->with('idclass',Input::get('idclass'));
    }

    public function showresultdetails($data1,$data2)
    {
        //  return $data2;
        if($data1=="RT")
        {
            $result = ResultRegularAssessment::where('idresult_regular_asssessment','=',$data2)->first();
            if($result!=null||$result!=""){
                return View::make('result_management.show_result_details')->with('result',$result)->with('type',$data1);
            }
            else{
                return Redirect::to('result_management/student_result');
            }

        }
        if($data1=="CT")
        {
            $result = ResultClassTest::where('idresult_class_test','=',$data2)->first();
            if($result!=null||$result!=""){
                return View::make('result_management.show_result_details')->with('result',$result)->with('type',$data1);
            }
            else{
                return Redirect::to('result_management/student_result');
            }

        }
        if($data1=="HT")
        {
            $result = ResultHallTest::where('idresult_hall_test','=',$data2)->first();
            if($result!=null||$result!=""){
                return View::make('result_management.show_result_details')->with('result',$result)->with('type',$data1);
            }
            else{
                return Redirect::to('result_management/student_result');
            }

        }
        if($data1=="LT")
        {
            $result = ResultLabTest::where('idresult_lab','=',$data2)->first();
            if($result!=null||$result!=""){
                return View::make('result_management.show_result_details')->with('result',$result)->with('type',$data1);
            }
            else{
                return Redirect::to('result_management/student_result');
            }

        }
        if($data1=="MT")
        {
            $result = ResultMCQTest::where('idresult_mcq','=',$data2)->first();
            if($result!=null||$result!=""){
                return View::make('result_management.show_result_details')->with('result',$result)->with('type',$data1);
            }
            else{
                return Redirect::to('result_management/student_result');
            }

        }
    }


    public function failedstudentdetails($std_id, $std_term, $std_year)
    {
        //  return $data2;
        $result = TStudentResult::where('st_id','=',$std_id)->where('academic_year','=',$std_year)->first();
        $results = TStudentResult::where('st_id','=',$std_id)->where('academic_year','=',$std_year)->get();
        $st_rank = StudentRank::where('student_id','=',$std_id)->where('term','=','Final')->where('year','=',$std_year)->first();

        $rc = count($result);
        $rsc = count($results);
        $src = count($st_rank);

        //return Redirect::to('grace_management/'.$counts.$count);
        //$result = StudentResult::where('S_ID','=',$std_id)->where('term','=',$std_term)->where('Year','=',$std_year)->first();
        //$results = StudentResult::where('S_ID','=',$std_id)->where('term','=',$std_term)->where('Year','=',$std_year)->get();

        if($rc && $rsc && $src)
            return View::make('result_management.failed_student_details')->with('result', $result)->with('results', $results)->with('year', $std_year)->with('st_rank', $st_rank);

        else
            return Redirect::to('/grace_management');

    }

// for submitting marks by the Class Teacher, added on 02Mar16 by Shohag

    public function submit_mark()
    {
        $year = Input::get('year');
        $term = Input::get('term');
        $class = Input::get('class');
        $section = Input::get('section');
        $u_id = Auth::user()->email;
        $cls_val = Addclass::where('class_name','=',$class)->where('section','=',$section)->pluck('value');

        $std_no = count(StudentToSectionUpdate::where('Class','=',$class)->where('Section','=',$section)->where('Year','=',$year)->get());
        $students = TStudentResult::where('class','=',$class)
            ->where('section','=',$section)
            ->where('academic_year','=',$year)
            ->orderby('st_id', 'ASC')->orderby('subject', 'ASC')->get();

        if(count($students)) {

            $sub_no = (count($students)) / $std_no;
            $cnt = 0;

            for ($i = 0; $i < $std_no; $i++) {
                $std = $i * $sub_no;
                $all_subject_total = 0;
                $cgpa = 0.00;
                $is_fail = 0;

                for ($j = 0; $j < $sub_no; $j++) {
                    $result = $students[$cnt];
                    $cnt++;
                    $total = 0;

                    $total += $result->h_total;

                    if ($term == "Final") {
                        if ($cls_val < 9) {
                            $total += $result->f_total;
                            $total = ceil($total / 2);
                        }
                        else
                            $total = $result->f_total;
                    }


                    $rtotal = $result->total;
                    $grade = GradingTable::where('total', '=', $rtotal)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();

                    $grade_l = $grade->grade;
                    $grade_p = $grade->gpa;

                    $rcls = $result->class;

                    /*if ($rcls != "Nine" && $rcls != "Ten") {
                        if ($total < ($rtotal / 2)) {
                            $grade_p = "0.00";
                            $grade_l = "F";

                        }
                    } */
                    if ($grade_l == "F") $is_fail++;
                    $cgpa += $grade_p;
                    $all_subject_total += $total;

                }
                if ($is_fail) $std_cgpa = 0.00; else $std_cgpa = sprintf("%.2f", $cgpa / $sub_no);

                $std_roll = StudentToSectionUpdate::where('student_idstudentinfo', '=', $students[$std]->st_id)->pluck('st_roll');


                $student_marks = new StudentRank();

                $student_marks->student_id = $students[$std]->st_id;
                $student_marks->roll = $std_roll;
                $student_marks->class = $students[$std]->class;
                $student_marks->section = $students[$std]->section;
                $student_marks->term = $term;
                $student_marks->year = $students[$std]->academic_year;
                $student_marks->total_mark = $all_subject_total;
                $student_marks->cgpa = $std_cgpa;

                $student_marks->save();
            }
            /* Start Rasel's Work for Student Rank and Position */

            /* $marks = "CREATE TABLE temp_rank SELECT d.*,c.ranks_temp FROM
                    (SELECT cgpa,@rank:=@rank+1 ranks_temp FROM
                            (SELECT DISTINCT cgpa FROM student_rank a
                             WHERE term='$term' AND year = '$year' AND class = '$class' AND section = '$section'
                                    ORDER BY cgpa DESC) t,
                                    (SELECT @rank:=0 ) r ) c
                                          INNER JOIN student_rank d on c.cgpa =d.cgpa
                                          WHERE term='$term' AND year = '$year' AND class = '$class' AND section = '$section'
                                          ORDER BY c.ranks_temp ASC, total_mark DESC";
            $stmt2 = DB::statement($marks); */

            $marks = "CREATE TABLE temp_rank SELECT d.*,c.ranks_temp FROM
                (SELECT total_mark,@rank:=@rank+1 ranks_temp FROM
                        (SELECT DISTINCT total_mark FROM student_rank a
                         WHERE term='$term' AND year = '$year' AND class = '$class' AND section = '$section'
                                ORDER BY total_mark DESC) t,
                                (SELECT @rank:=0 ) r ) c
                                      INNER JOIN student_rank d on c.total_mark =d.total_mark
                                      WHERE term='$term' AND year = '$year' AND class = '$class' AND section = '$section'
                                      ORDER BY c.ranks_temp ASC, cgpa DESC";
            $stmt2 = DB::statement($marks);

            $tmp = TmpRank::all();
            $counter = 0;

            foreach ($tmp as $st) {

                $sid = $st->student_id;


                if ($st->cgpa != 0.00) {
                    $s = $st->ranks_temp;
                    $counter++;
                    $grade = $st->cgpa;

                    if ($grade >= 5.00) {
                        $g = "A+";
                    } else if (($grade >= 4.00) && ($grade <= 4.99)) {
                        $g = "A";
                    } else if (($grade >= 3.50) && ($grade <= 3.99)) {
                        $g = "A-";
                    } else if (($grade >= 3.00) && ($grade <= 3.49)) {
                        $g = "B";
                    } else if (($grade >= 2.00) && ($grade <= 2.99)) {
                        $g = "C";
                    } else if (($grade >= 1.00) && ($grade <= 1.99)) {
                        $g = "D";
                    } else {
                        $g = "F";
                    }

                    if ($term == 'Half Yearly') {
                        if (($st->roll) == $s) {
                            $comment = "Good Result. Keep it up also in Final Term.";
                        } else if (($st->roll) > $s) {
                            $comment = "Excellent. Keep it up also in Final Term.";
                        } else {
                            $comment = "Try to concentrate more on your study for Final Term.";
                        }

                    } else {
                        if (($st->roll) == $s) {
                            $comment = "Good Result. Keep it up.";
                        } else if (($st->roll) > $s) {
                            $comment = "Excellent. You have done a good result.";
                        } else {
                            $comment = "Try to concentrate more on your study.";
                        }
                    }

                    $pass_type = "pass";

                } else {
                    $s = "N/A";
                    $counter = "N/A";
                    $g = "F";

                    if ($term == 'Half Yearly') {
                        $comment = "Not Satisfactory. Work hard for your improvement.";
                    } else {
                        $comment = "You are Failed.";
                    }

                    $pass_type = "fail";
                }

                $sql = "UPDATE `student_rank` SET `grade`='$g', `rank`='$s', `counter_position`= '$counter', `comment`='$comment', `pass_type`='$pass_type' WHERE `student_id` = $sid AND `term` = '$term' AND `year` = '$year'";
                $stmt3 = DB::statement($sql);
            }

            $del = "DROP TABLE IF EXISTS temp_rank";
            $stmt9 = DB::statement($del);

            /* End Rasel's Work for Student Rank and Position */


            $pub = new PublishResult();

            $pub->class = $class;
            $pub->section = $section;
            $pub->year = $year;
            $pub->term = $term;
            $pub->approved = 'Y';
            $pub->approved_by = $u_id;
            $pub->published = 'N';
            $pub->save();

            $msg = "Marks has been submitted";
        }
        else $msg = "Marks not submitted as there's appears to be a data error. Please contact with the system administrator.";

        return Redirect::to('submit_marks')->with('shohag_msg',$msg);
    }


    public function grant_grace()
    {
        $class = Input::get('classname');
        $section = Input::get('sectionname');
        $year = Input::get('year');
        $filter = Input::get('filters');
        $stds = Session::get('newpass_std');
        Session::set('filters', $filter);
        //$rank = StudentRank::where();
        $stdnos= count($stds);
        //if($class == "Nine" || $class=="Ten") $grade = "D"; else $grade = "B";
        for($i=0; $i<$stdnos; $i++)
        {
            $updatedata['pass_type'] = "grace";
            //$updatedata['grade'] = $grade;
            $updatedata['comment'] = "Passed with ".$filter."% grace.";
            StudentRank::where('student_id','=',$stds[$i])->where('term','=','Final')->update($updatedata);

        }

        return Redirect::to('/grace_management')
            ->with('classname', $class)
            ->with('sectionname', $section)
            ->with('year', $year);
    }

    public function grant_spc()
    {
        //$class = Input::get('classname');
        $comment = Input::get('comment');
        if($comment == "") $comment ="Passed Under Special Consideration";
        $year = Input::get('year');
        $std_id = Input ::get('student_id');
        $stds = Session::get('newpass_std');
        //$rank = StudentRank::where();
        $stdnos= count($stds);
        //if($class == "Nine" || $class=="Ten") $grade = "D"; else $grade = "B";
        $updatedata['pass_type'] = "Special Consideration";
        //$updatedata['grade'] = $grade;
        $updatedata['comment'] = $comment;
        StudentRank::where('student_id','=',$std_id)->where('term','=','Final')->update($updatedata);
        $st_rank = StudentRank::where('student_id','=',$std_id)->where('term','=','Final')->where('year','=',$year)->first();
        $result = TStudentResult::where('st_id','=',$std_id)->where('academic_year','=',$year)->first();
        $results = TStudentResult::where('st_id','=',$std_id)->where('academic_year','=',$year)->get();


        return View::make('result_management.failed_student_details')
            ->with('result', $result)
            ->with('results', $results)
            ->with('st_rank', $st_rank)
            ->with('term', 'Final');


    }

    public function studentwisedetails($std_id, $std_year)
    {
        //  return $data2;
        $result = TStudentResult::where('st_id','=',$std_id)->where('academic_year','=',$std_year)->first();
        $results = TStudentResult::where('st_id','=',$std_id)->where('academic_year','=',$std_year)->get();
        $st_rank = StudentRank::where('student_id','=',$std_id)->where('term','=','Final')->where('year','=',$std_year)->first();

        $rc = count($result);
        $rsc = count($results);
        $src = count($st_rank);

        //return Redirect::to('grace_management/'.$counts.$count);
        //$result = StudentResult::where('S_ID','=',$std_id)->where('term','=',$std_term)->where('Year','=',$std_year)->first();
        //$results = StudentResult::where('S_ID','=',$std_id)->where('term','=',$std_term)->where('Year','=',$std_year)->get();

        if($rc && $rsc && $src)
            return View::make('result_management.studentwise_tabulation_sheet')->with('result', $result)->with('results', $results)->with('year', $std_year)->with('st_rank', $st_rank);

        else
            return Redirect::to('/grace_management');

    }






}
