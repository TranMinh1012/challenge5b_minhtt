<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Homework;
use App\Models\Solution;
use Illuminate\Support\Facades\Auth;

class HomeworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 0) {
            $homeworks = Homework::orderByDesc('id')->get();
        } else {
            $homeworks = Homework::where('teacher_id', Auth::user()->id)->orderByDesc('id')->get();
        }

        return view('homeworks.index',compact('homeworks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('homeworks.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('homework')) {
            if ($request->file('homework')->isValid()) {
                $request->homework->storeAs('/public/homeworks', $request->homework->getClientOriginalName());
                Homework::create([
                    'title' => $request->title,
                    'homework_file' => '/storage/homeworks/' . $request->homework->getClientOriginalName(),
                    'teacher_id' => Auth::user()->id,
                    'assignment_time' => date('Y-m-d H:i:s')
                ]);
            }
        }

        return redirect()->route('homework.list')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solutions = Solution::where('homework_id', $id)->get();

        return view('homeworks.show', compact('solutions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $homework = Homework::find($id);
        
        return view('homeworks.edit', compact('homework'));
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
        $homework = Homework::find($id);
        $homework->title = $request->title;
        $homework->assignment_time = date('Y-m-d H:i:s');
        if ($request->hasFile('homework')) {
            if ($request->file('homework')->isValid()) {
                $request->homework->storeAs('/public/homeworks', $request->homework->getClientOriginalName());
                $homework->homework_file = '/storage/homeworks/' . $request->homework->getClientOriginalName();
            }
        }
        $homework->save();

        return redirect()->route('homework.list')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $homework = Homework::find($id);
        $homework->delete();

        return redirect()->back()->with('success','Xóa thành công.');
    }

    public function showMarkForm($id)
    {
        $solution = Solution::where('homework_id', $id)->first();

        return view('homeworks.mark', compact('id', 'solution'));
    }

    public function mark(Request $request, $id)
    {
        Solution::where('homework_id', $id)->update(['score' => $request->score]);

        return redirect()->route('homework.show', compact('id'))->with('success', 'Cập nhật thành công');
    }

    public function showSubmitForm($id)
    {
        $solution = Solution::where([['homework_id', $id], ['student_id', Auth::user()->id]])->first();

        return view('homeworks.submit', compact('id', 'solution'));
    }

    public function submit(Request $request, $id)
    {
        if ($request->hasFile('solution')) {
            if ($request->file('solution')->isValid()) {
                $request->solution->storeAs('/public/solutions', $request->solution->getClientOriginalName());
                Solution::create([
                    'student_id' => Auth::user()->id,
                    'solution_file' => '/storage/solutions/' . $request->solution->getClientOriginalName(),
                    'submission_time' => date('Y-m-d H:i:s'),
                    'homework_id' => $id
                ]);

                return redirect()->back()->with('success', 'Nộp bài thành công');
            }
        }
    }

    public function updateSolution(Request $request, $id)
    {
        $solution = Solution::find($id);
        if ($request->hasFile('solution')) {
            if ($request->file('solution')->isValid()) {
                $request->solution->storeAs('/public/solutions', $request->solution->getClientOriginalName());
                $solution->homework_file = '/storage/solutions/' . $request->solution->getClientOriginalName();
            }
        }
        $solution->save();

        return redirect()->back()->with('success', 'Cập nhật thành công');
    }
}
