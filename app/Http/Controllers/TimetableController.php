<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timetable;
class TimetableController extends Controller
{
    public function GroupTimetable($id)
    {
        return Timetable::where('group_id' , $id)->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Timetable::create($request->all())->fresh();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $formdata = $request->only(['monday' , 'tuesday' ,'wednesday', 'thursday' , 'friday' , 'saturday']);
        return Timetable::find($id)->update($formdata);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Timetable::find($id)->delete();
    }

}
