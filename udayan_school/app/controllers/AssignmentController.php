<?php

class AssignmentController extends \BaseController {



    public function store()
    {
        //return Input::all();
        $class = Addclass::where('class_name','=',Input::get('cat'))->where('section','=',Input::get('sub'))->first();

        $ass= new Assignment();
        $ass->assignment_subject = Input::get('title');
        $ass->assignment_topic = Input::get('topic');
        $ass->assignment_description = Input::get('description');
        $ass->idclass = $class->class_id;
        $ass->year = Input::get('yr');


        $image = Input::file('filename');
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
            $ass->filename = $filename;

            $ass->created_At = \Carbon\Carbon::now();

        }
        $ass->idteacherinfo = Auth::user()->user_id; //Input::get('author');

        $ass->save();
        $succ = "Your Assignment is submitted successfully";

        return Redirect::to('assignment_management/teacher_give_assignment')->with('success',$succ);
    }

 public function download($idassignment)
    {
        $assign = Assignment::where('idassignment','=',$idassignment)->first();
        $file= public_path('uploads/'.$assign->filename);
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


    }



    public function show()
    {
        $y = Input::get('yer');

        return View::make('assignment_management.assignment_view')->with('yr', $y);

    }

    public function chat($id){

        $chatid = $id ;
        return View::make('assignment_management.chat_view')->with('id', $chatid);
    }

    public  function chatajax(){


    }

    public function cht(){

        //$cat = Input::get('cat_id');
        $message = Input::get('message');
        $conversation_id = Input::get('conversation_id');
        $user_form = Input::get('user_form');
        $user_to  = Input::get('user_to');



        //decrypt the conversation_id,user_from,user_to


        $cn = new Messages();

        $cn->conversation_id = $conversation_id;
        $cn->message = $message;
        $cn->user_from = $user_form;
        $cn->user_to = $user_to;

        $cn->save();

        return View::make('assignment_management.chat_view');



    }




}