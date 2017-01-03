<?php

class NoticeController extends \BaseController {


	public function show_notice()
	{
		$notice = Notice::OrderBy('idnotice','desc')->get();
		return View::make('notice_management.show_notice')->with('notice',$notice);
	}


	public function add_notice()
	{
		return View::make('notice_management.add_notice');
	}


	public function store()
	{
		//return Input::all();
		$notice = new Notice();
		$notice->title = Input::get('title');
		$notice->ref_no = Input::get('refNo');
		$notice->date = Input::get('date');
		$notice->short_desc = Input::get('short_description');
		$notice->description = Input::get('description');
                $notice->notice_type = Input::get('utype');

		$image = Input::file('filename');
		$destination = 'public/uploads/';
		if($image!=null) {
			$filename = Str::lower(
				pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)
				. '-'
				. uniqid()
				. '.'
				. $image->getClientOriginalExtension()
			);

			$image->move($destination, $filename);
			$notice->filename = $filename;

		}
		$notice->author = Input::get('author');
		$notice->save();
		return Redirect::to('notice_management/add_notice');
	}

	public function edit($id)
	{
		return View::make('notice.edit');
	}
	public function show($idnotice)
	{
		$notice = Notice::where('idnotice','=',$idnotice)->first();
		return View::make('notice_management.individual_notice')->with('notice',$notice);
	}
	public function show_notice_student()
	{
		if(Auth::user()->type == 'student'){

     $notice = Notice::where('notice_type','Students')->orwhere('notice_type','Public')->OrderBy('idnotice','desc')->get();
                 }
               else{
           $notice = Notice::where('notice_type','Teachers')->orwhere('notice_type','Public')->OrderBy('idnotice','desc')->get();
               }

               


		return View::make('notice_management.show_notice_student')->with('notice',$notice);
	}
	public function show_student($idnotice)
	{
		$notice = Notice::where('idnotice','=',$idnotice)->first();
		return View::make('notice_management.individual_notice_student')->with('notice',$notice);
	}
	public function download($idnotice)
	{
		$notice = Notice::where('idnotice','=',$idnotice)->first();
		$file= "public/uploads/".$notice->filename;
		$headers = array(
			'Content-Type: application/pdf',
		);
		return Response::download($file, $notice->filename);
	}
	public function show_individual($idnotice)
	{
		$notice = Notice::where('idnotice','=',$idnotice)->first();
		return View::make('notice_management.show_individual_notice')->with('notice',$notice);
	}
}