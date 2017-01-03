<?php

class HolidayController extends \BaseController {

    public function events_create()
    {
        return View::make('holiday_management.create_events');
    }

    public function create_event2()
    {
        //return Input::all();
        $hour=Input::get('hour');
        $min=Input::get('min');
        $ampm=Input::get('ampm');
        $hour1=Input::get('hour1');
        $min1=Input::get('min1');
        $ampm1=Input::get('ampm1');


        $events = new EventsManagement();
        $events->start_time = $hour1 . ":" . $min1 . $ampm1;
        $events->end_time  = $hour . ":" . $min . $ampm;

        $events->start_date = Input::get('start_date');
        $events->end_date = Input::get('end_date');
//        $events->start_time = Input::get('start_time');
//        $events->end_time = Input::get('end_time');
        $events->event_place = Input::get('event_place');
        $events->event_name = Input::get('event_name');
        $events->event_description = Input::get('event_description');
        $image = Input::file('event_image');
        $destination = 'public/uploads/';
        if (Input::get('event_name') != null) {
            if ($image != null) {
                $filename = Str::lower(
                    pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-' . uniqid() . '.' . $image->getClientOriginalExtension()
                );
                $image->move($destination, $filename);
                $events->event_image = $filename;
            }
        }

        $events->user_id = Auth::user()->user_id;
        $mytime = Carbon\Carbon::now();
        $events->insert_date = $mytime->toDateTimeString();
        $events->save();
        $events2 = EventsManagement::OrderBy('idevents', 'desc')->first();
        $datefrom = $events2->start_date;
        $dateto = $events2->end_date;
        $name = $events2->event_name;
        $range = range12($datefrom, $dateto);
        $count = count($range);
        for ($i = 0; $i < $count; $i++) {
            $eventac = new EventAnnualCalender();
            $eventac->h_date = $range[$i];
            $year = AcademicYear::OrderBy('idacademic_year','DESC')->first();
            $eventac->ac_year = $year->academic_year;
            $eventac->name = $name;
            $eventac->type = 'event';
            $eventac->save();
        }

        return Redirect::to('holiday_management/create_events');
    }

    public function edit_event()
    {
        //return Input::all();
        $hour=Input::get('hour');
        $min=Input::get('min');
        $ampm=Input::get('ampm');
        $hour1=Input::get('hour1');
        $min1=Input::get('min1');
        $ampm1=Input::get('ampm1');
        $eventid=Input::get('event_id');


        $event_prev_name = EventsManagement::where('idevents','=',$eventid)->pluck('event_name');
        $data['start_time'] = $hour1 . ":" . $min1 . $ampm1;
        $data['end_time']  = $hour . ":" . $min . $ampm;

        $data['start_date'] = Input::get('start_date');
        $data['end_date'] = Input::get('end_date');
//        $events->start_time = Input::get('start_time');
//        $events->end_time = Input::get('end_time');
        $data['event_place'] = Input::get('event_place');
        $data['event_name'] = Input::get('event_name');
        $data['event_description'] = Input::get('event_description');
        $image = Input::file('event_image');
        $destination = 'public/uploads/';
        if (Input::get('event_name') != null) {
            if ($image != null) {
                $filename = Str::lower(
                    pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-' . uniqid() . '.' . $image->getClientOriginalExtension()
                );
                $image->move($destination, $filename);
                $data['event_image'] = $filename;
            }
        }

        $data['user_id'] = Auth::user()->user_id;
        $mytime = Carbon\Carbon::now();
        $data['insert_date'] = $mytime->toDateTimeString();

        EventsManagement::where('idevents','=',$eventid)->update($data);

        $events2 = EventsManagement::where('idevents', $eventid)->first();
        $datefrom = $events2->start_date;
        $dateto = $events2->end_date;
        $name = $events2->event_name;
        $range = range12($datefrom, $dateto);
        $count = count($range);
        for ($i = 0; $i < $count; $i++) {
            //$eventac = new EventAnnualCalender();
            $eventac['h_date'] = $range[$i];
            $year = AcademicYear::OrderBy('idacademic_year','DESC')->first();
            $eventac['ac_year'] = $year->academic_year;
            $eventac['name'] = $name;
            $eventac['type'] = 'event';
            EventAnnualCalender::where('name','=',$event_prev_name)->update($eventac);
        }

        return Redirect::to('holiday_management/show_events');
    }

    public function create_annual_calender()
    {
        return View::make('holiday_management.create_annual_calender');
    }

    public function create_annual_calender2()
    {
        // return Input::all();
        $ac = new AnnualCalender();
        $ac->ac_year = Input::get('annual_year');
        $ac->from_date = Input::get('start_date');
        $ac->to_date = Input::get('end_date');
        $ac->holiday_name = Input::get('holiday_name');
        $ac->holiday_type = Input::get('holiday_type');
        $ac->holiday_description = Input::get('event_description');
        $ac->user_id = Auth::user()->user_id;
        $mytime = Carbon\Carbon::now();
        $ac->insert_date =  $mytime->toDateTimeString();
        $ac->save();


        $events2 = AnnualCalender::OrderBy('idannualcalender', 'desc')->first();
        $datefrom = $events2->from_date;
        $dateto = $events2->to_date;
        $name = $events2->holiday_name;
        $year = $events2->ac_year;
        $range = range12($datefrom,$dateto);
        $count = count($range);
        for($i = 0; $i< $count ; $i++)
        {
            $eventac = new EventAnnualCalender();
            $eventac->h_date = $range[$i];
            $eventac->ac_year = $year;
            $eventac->name = $name;
            $eventac->type = 'annual_calender';
            $eventac->save();
        }

        return Redirect::to('holiday_management/create_annual_calender');
    }



    public function edit_annual_calender()
    {
        // return Input::all();
        //$ac = new AnnualCalender();
        $id = Input::get('event_id');
        $prev_name = AnnualCalender::where('idannualcalender','=',$id)->pluck('holiday_name');

        $ac['ac_year'] = Input::get('annual_year');
        $ac['from_date'] = Input::get('start_date');
        $ac['to_date'] = Input::get('end_date');
        $ac['holiday_name'] = Input::get('holiday_name');
        $ac['holiday_type'] = Input::get('holiday_type');
        $ac['holiday_description'] = Input::get('event_description');
        $ac['user_id'] = Auth::user()->user_id;
        $mytime = Carbon\Carbon::now();
        $ac['insert_date'] =  $mytime->toDateTimeString();
        //$ac->save();
        AnnualCalender::where('idannualcalender','=',$id)->update($ac);

        $events2 = AnnualCalender::where('idannualcalender','=', $id)->first();
        $datefrom = $events2->from_date;
        $dateto = $events2->to_date;
        $name = $events2->holiday_name;
        $year = $events2->ac_year;
        $range = range12($datefrom,$dateto);
        $count = count($range);
        for($i = 0; $i< $count ; $i++)
        {
            //$eventac = new EventAnnualCalender();
            $eventac['h_date'] = $range[$i];
            $eventac['ac_year'] = $year;
            $eventac['name'] = $name;
            $eventac['type'] = 'annual_calender';
            EventAnnualCalender::where('name', '=', $prev_name)->update($eventac);
        }

        return Redirect::to('holiday_management/view_annual_calender');
    }



    public function events_show()
    {
        $events = EventsManagement::all();
        return View::make('holiday_management.show_events')->with('events',$events);
    }

    public function show_event()
    {
        //return Input::all();
        $hour=Input::get('hour');
        $min=Input::get('min');
        $ampm=Input::get('ampm');
        $hour1=Input::get('hour1');
        $min1=Input::get('min1');
        $ampm1=Input::get('ampm1');


        $events = new EventsManagement();
        $events->start_time = $hour1 . ":" . $min1 . $ampm1;
        $events->end_time  = $hour . ":" . $min . $ampm;

        $events->start_date = Input::get('start_date');
        $events->end_date = Input::get('end_date');
//        $events->start_time = Input::get('start_time');
//        $events->end_time = Input::get('end_time');
        $events->event_place = Input::get('event_place');
        $events->event_name = Input::get('event_name');
        $events->event_description = Input::get('event_description');
        $image = Input::file('event_image');
        $destination = 'public/uploads/';
        if (Input::get('event_name') != null) {
            if ($image != null) {
                $filename = Str::lower(
                    pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
                    . '-' . uniqid() . '.' . $image->getClientOriginalExtension()
                );
                $image->move($destination, $filename);
                $events->event_image = $filename;
            }
        }

        $events->user_id = Auth::user()->user_id;
        $mytime = Carbon\Carbon::now();
        $events->insert_date = $mytime->toDateTimeString();
        $events->save();
        $events2 = EventsManagement::OrderBy('idevents', 'desc')->first();
        $datefrom = $events2->start_date;
        $dateto = $events2->end_date;
        $name = $events2->event_name;
        $range = range12($datefrom, $dateto);
        $count = count($range);
        for ($i = 0; $i < $count; $i++) {
            $eventac = new EventAnnualCalender();
            $eventac->h_date = $range[$i];
            $year = AcademicYear::OrderBy('idacademic_year','DESC')->first();
            $eventac->ac_year = $year->academic_year;
            $eventac->name = $name;
            $eventac->type = 'event';
            $eventac->save();
        }

        return Redirect::to('holiday_management/create_events');
    }

    public function view_annual_calender()
    {
        $calender = AnnualCalender::all();
        return View::make('holiday_management.show_annual_calender')->with('calender',$calender);
    }

    public function view_annual_calender2()
    {
        // return Input::all();
        $ac = new AnnualCalender();
        $ac->ac_year = Input::get('annual_year');
        $ac->from_date = Input::get('start_date');
        $ac->to_date = Input::get('end_date');
        $ac->holiday_name = Input::get('holiday_name');
        $ac->holiday_type = Input::get('holiday_type');
        $ac->holiday_description = Input::get('event_description');
        $ac->user_id = Auth::user()->user_id;
        $mytime = Carbon\Carbon::now();
        $ac->insert_date =  $mytime->toDateTimeString();
        $ac->save();


        $events2 = AnnualCalender::OrderBy('idannualcalender', 'desc')->first();
        $datefrom = $events2->from_date;
        $dateto = $events2->to_date;
        $name = $events2->holiday_name;
        $year = $events2->ac_year;
        $range = range12($datefrom,$dateto);
        $count = count($range);
        for($i = 0; $i< $count ; $i++)
        {
            $eventac = new EventAnnualCalender();
            $eventac->h_date = $range[$i];
            $eventac->ac_year = $year;
            $eventac->name = $name;
            $eventac->type = 'annual_calender';
            $eventac->save();
        }

        return Redirect::to('holiday_management/create_annual_calender');
    }


//    public function calender()
//    {
//
//        $month = Session::get('month');
//        if ( $month != null) {
//
//            return View::make('calender.calender')
//                ->with('month', $month);
//        } else {
//
//            return View::make('calender.calender')
//                ->with('month', null);
//        }
//    }
    public function calender2()
    {

        $month = Input::get('month');
        if(Auth::user()->type=='student'){
        return Redirect::to('home/studenthome')
            ->with('month', $month);
        }
        if(Auth::user()->type=='teacher'){
            return Redirect::to('home/teacherhome')
                ->with('month', $month);
        }
        if(Auth::user()->type=='admin'){
            return Redirect::to('home/adminhome')
                ->with('month', $month);
        }
    }


}
