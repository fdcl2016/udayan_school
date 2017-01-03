<?php

class RoutineController extends \BaseController {

    public function create_configuration()
    {
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('routine.create_configuration')->with('class', $class);
    }

    public function create_configuration2()
    {

        $hour=Input::get('hour');
        $min=Input::get('min');
        $ampm=Input::get('ampm');
 
        $config = new Configuration();
        $config->shift = Input::get('shift');
        $config->number_period = Input::get('number_period');
        $config->class_start_time = $hour . ":" . $min;
        $config->class_duration = Input::get('class_duration');
        $config->tiffin_breake = Input::get('tiffin_breake');
        $config->weekly_holyday = Input::get('weekly_holyday');
        $config->weekly_holyday1 = Input::get('weekly_holyday1');
        $config->tiffin_duration = Input::get('tiffin_duration');
        $config->year = Input::get('year');
        $config->save();
        return Redirect::to('routine/create_configuration');
    }

    public function create_routine()
    {
        $class = Addclass::groupby('class_name')->orderBy('value','ASC')->get();
        return View::make('routine.create_routine')->with('class', $class);
    }



       public function create_routine2()
    {
         $class_name = Input::get('cat');
        $section_name = Input::get('sub');
        $shift = Input::get('year1');
        $class = Addclass::where('class_name', '=', $class_name)->where('section', '=', $section_name)->first();

        $c = RoutineCreate::where('course_section_id','=',$class->class_id)->get();

        $count = count($c);
        if($class!="")
        {
            $config = Configuration::where('shift', '=', $shift)->where('year', '=', Input::get('year'))->first();


            if($config!="")

            {
                if($count !=0){
                    return Redirect::back()->with('message','Already Created');

                }
                else{
                return Redirect::to('routine/routine')->with('number_period', $config->number_period)->with('idconfiguration', $config->idconfiguration)
                    ->with('class_name', $class->class_name)->with('class_id', $class->class_id)->with('section', $class->section)
                    ->with('weekly_holyday', $config->weekly_holiday)->with('tiffin_breake', $config->tiffin_breake)
                    ->with('shift', $shift)->with('start_time', $config->class_start_time)->with('class_duration', $config->class_duration)
                    ->with('tiffin_duration', $config->tiffin_duration)->with('year',Input::get('year'));
            }

            }

            else
            {
                return Redirect::back()->with('error','No configuration file');
            }

        }
        else
        {
            return Redirect::back()->with('error','Does not match class and section');
        }


    }
    public function routine2()
    {
        // return Input::all();
        $countCourseTeacher = 0;
        $pi = "";
        //$routine = new RoutineCreate;
        $idcnfg = Input::get('configuration_id');
        $seccourseid = Input::get('course_section_id');
        $number_of_period = Input::get('number_of_period');
        $year = Input::get('year');

        for ($j = 1; $j <= 7; $j++) {
            $routine = new RoutineCreate;
            $routine->configuration_id = $idcnfg;
            $routine->course_section_id = $seccourseid;

            $routine->year = $year;
            $day = Input::get('day' . $j);
            if ($day == "") {
                $countCourseTeacher = $countCourseTeacher + $number_of_period+1;
            }
            if ($day != "") {
                $routine->day = $day;
                for ($i = 1; $i <= $number_of_period+1; $i++) {
                    $pi = "p" . $i;
                    $countCourseTeacher++;

                    $routine->$pi = Input::get('course_teacher' . $countCourseTeacher);
                }

                $routine->save();
            }
        }
        return Redirect::to('routine/create_routine');

    }

    public function test2($id)
    {
        $class = Addclass::groupby('class_name')->get();
        return View::make('routine.test1')->with('class', $class)->with('idconfig', $id);
    }


    public function list_of_configuration()
    {
        $lists = Configuration::groupBy('shift')->groupBy('year')->get();
        return View::make('routine.list_of_configuration')->with('lists', $lists);
    }

    public function edit_config($idconfiguration)
    {
        $list = Configuration::where('idconfiguration','=',$idconfiguration)->first();
        return View::make('routine.edit_configuration')->with('list',$list);
    }

    public function edit_configuration()
    {
        $hour=Input::get('hour');
        $min=Input::get('min');
        $ampm=Input::get('ampm');
        $idconfiguration = Input::get('idconfiguration');
        $input['shift'] =  Input::get('shift');
        $input['number_period'] = Input::get('number_period');
        $input['class_start_time']  = $hour . ":" . $min;
       $input['class_duration']  = Input::get('class_duration');
        $input['tiffin_breake']= Input::get('tiffin_breake');
        $input['weekly_holyday'] = Input::get('weekly_holyday');
        $input['tiffin_duration'] = Input::get('tiffin_duration');
        $input['year']  = Input::get('year');
        Configuration::where('idconfiguration','=',$idconfiguration)->update($input);
        return Redirect::to('routine/list_of_configuration');
    }


   public function view_routine(){

        $lists = Configuration::groupBy('shift')->groupBy('year')->get();
        return View::make('routine.view_routine')->with('lists', $lists);

       // return View::make('routine.view_routine');
    }

}
