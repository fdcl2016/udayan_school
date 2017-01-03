<?php

class ResultController extends \BaseController {

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
            $data['home_work'] ;
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

    public function teacher_result_insert()
    {
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

        $isEditable= TabulationSheetEditable::where('academic_year','=',$year)->where('term','=',$term)->where('idsubject','=',$subject)->where('class','=',$aclass)->where('section','=',$asec)->where('flag','=','non_editable')->get();
        $cnt= count($isEditable);
        // $cnt=5;
        if($course!=null && $subject != null && $year != null)
        {
            $courseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
            return View::make('result_management.teacher_result_insert')->with('courseteacher', $courseteacher)->with('course',$clsname )->with('subject',$subject)->with('year',$year)->with('term',$term)->with('countedit',$cnt)->with('classnm',$aclass)->with('clssec',$asec)->with('sub_name',$sub_name);
        }
        else {
            $courseteacher = CourseTeacher::where('idteacherinfo','=',Auth::user()->user_id)->groupBy('idclasssection')->get();
            return View::make('result_management.teacher_result_insert')->with('courseteacher', $courseteacher)->with('course',null)->with('subject',null)->with('year',null)->with('term',$term);
        }
    }

    public function teacher_result_insert2()
    {
        return Redirect::to('result_management/teacher_result_insert')->with('course',Input::get('cat'))->with('subject',Input::get('sub'))->with('year',Input::get('year'))->with('term',Input::get('term'));
    }

    public function regular_assesment($data,$data1,$data2,$year,$term,$sec)
    {
        $course = Addclass::where('class_name','=',$data)->where('section','=',$sec)->first();
        return View::make('result_management.result_insert_individual')->with('type',$data1)->with('course',$course)->with('data2',$data2)->with('year',$year)->with('term',$term)->with('sec',$sec);

    }

    public function regular_assesment2()
    {
        //  return Input::all();
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
        $stdcount= StudentToSection::where('class','=',$clsname)->where('section','=',$secname)->where('year','=',$acayear)->get();
        $sc= count($stdcount);
        // return $course;

        // Saving one row to tabulation sheet editable


        $subtoclass = SubjectToClass::where('idsubject','=',$idsubject)->where('class','=',$clsname)->first();

        $total = TotalMarksConfiguration::where('configuration_type','=',$subtoclass->markconfiguration_name)->pluck('total');

        $subname = Subject::where('idsubject','=',$idsubject)->pluck('subject_name');

        if($type=="RT") {

            $tabulation = new TabulationSheetEditable();
            $tabulation->idcourseteacher =  $classteacher->idteacherinfo;
            $tabulation->flag = "editable";
            $tabulation->exam_type="RT";
            $tabulation->term = $term;
            $tabulation->academic_year =$acayear;
            $tabulation->class = $clsname;
            $tabulation->section = $secname;
            $tabulation->idsubject = $idsubject;
            $tabulation->approved_by= "0";
            $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
            $tabulation->save();

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
                $cl = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','class_work')->first();
                $hw = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','home_work')->first();
                $bo = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','bothe')->first();
                if($cl!=""||$cl!=null)
                {
                    $totalcl = ($class_work1*$cl->converted_marks)/$cl->weighted_marks;
                }else
                {
                    $totalcl=null;
                }
                if($hw!=""||$hw!=null)
                {
                    $totalhw = ($home_work1*$hw->converted_marks)/$hw->weighted_marks;
                }else
                {
                    $totalhw=null;
                }
                if($bo!=""||$bo!=null)
                {
                    $totalbo = ($bothe1*$bo->converted_marks)/$bo->weighted_marks;
                }else
                {
                    $totalbo=null;
                }

                $exist = ResultRegularAssessment::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();

                if ($idstudentinfo != null) {
                    if ($exist != null) {
                        $editable = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$exist->courseteacher_idcourseteacher)->where('flag','=',"editable")->where('exam_type','=','RT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->get();
                        // if($editable!="[]") {

                        if($class_work1 != "" || $home_work1!= "" || $bothe != ""){
                            $data['classwork'] = $class_work1;
                            $data['homework'] = $home_work1;
                            $data['bothe'] = $bothe1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = $totalcl + $totalhw + $totalbo;
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultRegularAssessment::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject','=',$idsubject)->where('academic_year','=',$acayear)->where('term','=',$term)->update($data);
                        }
                        else{
                            return Redirect::back();
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
                        $reg->converted_marks = $totalcl+$totalhw+$totalbo;
                        $reg->insert_at = Carbon\Carbon::now('+6');
                        $reg->save();


                    }
                }
            }
        }
        if($type=="CT") {

            $tabulation = new TabulationSheetEditable();
            $tabulation->idcourseteacher =  $classteacher->idteacherinfo;
            $tabulation->flag = "editable";
            $tabulation->exam_type="CT";
            $tabulation->term = $term;
            $tabulation->academic_year =$acayear;
            $tabulation->class = $clsname;
            $tabulation->section = $secname;
            $tabulation->idsubject = $idsubject;
            $tabulation->approved_by= "0";
            $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
            $tabulation->save();
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

                $ct1 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','class_test_1')->first();
                $ct2 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','class_test_2')->first();
                $ct3 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','class_test_3')->first();
                $ct4 = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','class_test_4')->first();
                if($ct1!=""||$ct1!=null)
                {
                    $totalct1 = ($class_Test_11*$ct1->converted_marks)/$ct1->weighted_marks;
                }
                else
                {
                    $totalct1=null;
                }
                if($ct2!=""||$ct2!=null)
                {
                    $totalct2 = ($class_Test_21*$ct2->converted_marks)/$ct2->weighted_marks;
                }else
                {
                    $totalct2=null;
                }
                if($ct3!=""||$ct3!=null)
                {
                    $totalct3 = ($class_Test_31*$ct3->converted_marks)/$ct3->weighted_marks;
                }else
                {
                    $totalct3=null;
                }

                if($ct4!=""||$ct4!=null)
                {
                    $totalct4 = ($class_Test_41*$ct4->converted_marks)/$ct4->weighted_marks;
                }else
                {
                    $totalct4=null;
                }


                $exist = ResultClassTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();
                if ($idstudentinfo != null) {
                    if ($exist != null) {
                        $editable = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$exist->courseteacher_idcourseteacher)->where('flag','=',"editable")->where('exam_type','=','RT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->get();

                        //  if($editable!="[]") {

                        if ($class_Test_11 != "" ||  $class_Test_21 != "" || $class_Test_31 != "" || $class_Test_41 != "") {
                            $data['ct1'] = $class_Test_11;
                            $data['ct2'] = $class_Test_21;
                            $data['ct3'] = $class_Test_31;
                            $data['ct4'] = $class_Test_41;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = $totalct1 + $totalct2 + $totalct3 + $totalct4;
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultClassTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('term','=',$term)->update($data);
                        }
                        else
                        {
                            return Redirect::back();
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
                        $reg->converted_marks = $totalct1+$totalct2+$totalct3+$totalct4;
                        $reg->insert_at = Carbon\Carbon::now('+6');
                        $reg->save();


                    }
                }
            }
        }
        if($type=="HT") {

            $tabulation = new TabulationSheetEditable();
            $tabulation->idcourseteacher =  $classteacher->idteacherinfo;
            $tabulation->flag = "editable";
            $tabulation->exam_type="HT";
            $tabulation->term = $term;
            $tabulation->academic_year =$acayear;
            $tabulation->class = $clsname;
            $tabulation->section = $secname;
            $tabulation->idsubject = $idsubject;
            $tabulation->approved_by= "0";
            $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
            $tabulation->save();

            for ($i = 1; $i <= $sc; $i++) {
                $idstudentinfo = Input::get('idstudentinfo' . $i);
                $Hall_Test = Input::get('Hall_Test' . $i);
                if ($Hall_Test != "" && $Hall_Test != null)
                    $Hall_Test1 = $Hall_Test;
                else $Hall_Test1 = null;
                $ht = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','Hall_Test')->first();
                if($ht!=""||$ht!=null)
                {
                    $totalht = ($Hall_Test1*$ht->converted_marks)/$ht->weighted_marks;
                }
                else
                {
                    $totalht=null;
                }
                $exist = ResultHallTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();

                if ($idstudentinfo != null) {
                    if ($exist != null) {
                        $editable = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$exist->courseteacher_idcourseteacher)->where('flag','=',"editable")->where('exam_type','=','HT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->get();

                        if($editable!="[]") {
                            $data['hall_test_marks'] = $Hall_Test1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = $totalht;
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultHallTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject','=',$idsubject)->where('academic_year','=',$acayear)->where('term','=',$term)->update($data);
                        }
                        else{
                            return Redirect::back();
                        }
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
                        $reg->converted_marks = $totalht;
                        $reg->insert_at = Carbon\Carbon::now('+6');
                        $reg->save();


                    }
                }
            }
        }
        if($type=="LT") {

            $tabulation = new TabulationSheetEditable();
            $tabulation->idcourseteacher =  $classteacher->idteacherinfo;
            $tabulation->flag = "editable";
            $tabulation->exam_type="LT";
            $tabulation->term = $term;
            $tabulation->academic_year =$acayear;
            $tabulation->class = $clsname;
            $tabulation->section = $secname;
            $tabulation->idsubject = $idsubject;
            $tabulation->approved_by= "0";
            $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
            $tabulation->save();

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
                $vt = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','viva')->first();
                $et = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','experiment')->first();
                if($vt!=""||$vt!=null)
                {
                    $totalvt = ($viva1*$vt->converted_marks)/$vt->weighted_marks;
                }
                else
                {
                    $totalvt=null;
                }
                if($et!=""||$et!=null)
                {
                    $totalet = ($experiment1*$et->converted_marks)/$et->weighted_marks;
                }
                else
                {
                    $totalet=null;
                }
                $exist = ResultLabTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();
                if ($idstudentinfo != null) {
                    if ($exist != null) {
                        $editable = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$exist->courseteacher_idcourseteacher)->where('flag','=',"editable")->where('exam_type','=','RT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->get();

                        if($editable!="[]") {
                            $data['viva_marks'] = $viva1;
                            $data['experiment_marks'] = $experiment1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = $totalvt + $totalet;
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultLabTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject','=',$idsubject)->where('academic_year','=',$acayear)->where('term','=',$term)->update($data);
                        }
                        else{
                            return Redirect::back();
                        }
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
                        $reg->converted_marks = $totalvt+$totalet;
                        $reg->insert_at = Carbon\Carbon::now('+6');
                        $reg->save();

                    }
                }
            }
        }
        if($type=="MT") {

            $tabulation = new TabulationSheetEditable();
            $tabulation->idcourseteacher =  $classteacher->idteacherinfo;
            $tabulation->flag = "editable";
            $tabulation->exam_type="MT";
            $tabulation->term = $term;
            $tabulation->academic_year =$acayear;
            $tabulation->class = $clsname;
            $tabulation->section = $secname;
            $tabulation->idsubject = $idsubject;
            $tabulation->approved_by= "0";
            $tabulation->courseteacher_idcourseteacher = $course->idcourseteacher;
            $tabulation->save();

            for ($i = 1; $i <= $sc; $i++) {
                $idstudentinfo = Input::get('idstudentinfo' . $i);

                $MCQ_Test = Input::get('MCQ_Test' . $i);
                if ($MCQ_Test != "" && $MCQ_Test != null)
                    $MCQ_Test1 = $MCQ_Test;
                else $MCQ_Test1 = null;
                $mt = MarksConfiguration::where('configuration_name','=',$configuration_name)->where('configuration_type','=',$type)->where('exam_name','=','MCQ_Test')->first();
                if($mt!=""||$mt!=null)
                {
                    $totalmt = ($MCQ_Test1*$mt->converted_marks)/$mt->weighted_marks;
                }
                else
                {
                    $totalmt=null;
                }
                $exist = ResultMCQTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('courseteacher_idcourseteacher','=',$course->idcourseteacher)->where('term','=',$term)->first();
                if ($idstudentinfo != null) {
                    if ($exist != null) {
                        $editable = TabulationSheetEditable::where('courseteacher_idcourseteacher','=',$exist->courseteacher_idcourseteacher)->where('flag','=',"editable")->where('exam_type','=','RT')->where('term','=',$term)->where('academic_year','=',Input::get('year'))->get();

                        if($editable!="[]") {
                            $data['mcq_marks'] = $MCQ_Test1;
                            $data['academic_year'] = Input::get('year');
                            $data['converted_marks'] = $totalmt;
                            $data['last_update'] = Carbon\Carbon::now('+6');
                            ResultMCQTest::where('studentinfo_idstudentinfo', '=', $idstudentinfo)->where('idsubject','=',$idsubject)->where('academic_year','=',$acayear)->where('term','=',$term)->update($data);
                        }
                        else{
                            return Redirect::back();
                        }
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
                        $reg->converted_marks = $totalmt;
                        $reg->insert_at = Carbon\Carbon::now('+6');
                        $reg->save();
                    }
                }
            }
        }
        return Redirect::to('result_management/teacher_result_insert');
    }

    public function resultindividual()
    {
        $idclass = Session::get('idclass');
        $subject2 = Session::get('subject');
        $class = StudentToSectionUpdate::where('student_idstudentinfo','=',Auth::user()->email)->first();
        $addclass3 = Addclass::where('class_name','=',$class->class)->where('section','=',$class->section)->where('shift','=',$class->shift)->first();
        $addclass = Addclass::where('class_name','=',$class->class)->first();
        $subject = SubjectToClass::where('idclass','=',$addclass->class_id)->get();
        if($subject!=null&&$subject!="")
        {
            if($idclass!=null&&$subject2!=null)
            {
                return View::make('result_management.student_result')->with('subject',$subject)->with('idclass',$addclass3->class_id)->with('subject2',$subject2)->with('idclass2',$idclass);
            }
            else{
                return View::make('result_management.student_result')->with('subject',$subject)->with('idclass',$addclass3->class_id)->with('subject2',null)->with('idclass2',null);
            }

        }
        else
        {
            return Redirect::to('home/studenthome');
        }
    }


    public function showreport_for_student(){

        return Redirect::to('result_management/student_report_card');
    }

    public function showresultlink()
    {
        return Redirect::to('result_management/student_result')->with('subject',Input::get('cat'))->with('idclass',Input::get('idclass'));
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

        $std_no = count(StudentToSection::where('Class','=',$class)->where('Section','=',$section)->where('Year','=',$year)->get());
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
                        $total += $result->f_total;

                        $total = ceil($total / 2);

                    }

                    $rtotal = $result->total;
                    $grade = GradingTable::where('total', '=', $rtotal)->where('highest_range', '>=', $total)->where('lowest_range', '<=', $total)->first();


                    $grade_l = $grade->grade;
                    $grade_p = $grade->gpa;

                    $rcls = $result->class;

                    if ($rcls != "Nine" && $rcls != "Ten") {
                        if ($total < ($rtotal / 2)) {
                            $grade_p = "0.00";
                            $grade_l = "F";

                        }
                    }
                    if ($grade_l == "F") $is_fail++;
                    $cgpa += $grade_p;
                    $all_subject_total += $total;

                }
                if ($is_fail) $std_cgpa = 0.00; else $std_cgpa = sprintf("%.2f", $cgpa / $sub_no);

                $std_roll = Studentinfo::where('idstudentinfo', '=', $students[$std]->st_id)->pluck('student_roll');

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