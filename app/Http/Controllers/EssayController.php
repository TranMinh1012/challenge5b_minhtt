<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Essay;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;

class EssayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role != 0) {
            $essays = Essay::orderByDesc('id')->get();
        } else {
            $essays = Essay::where('teacher_id', Auth::user()->id)->orderByDesc('id')->get();
        }

        return view('essays.index',compact('essays'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('essays.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('essay')) {
            if ($request->file('essay')->isValid()) {
                if (pathinfo($request->essay->getClientOriginalName(), PATHINFO_EXTENSION) == 'txt') {
                    $request->essay->storeAs('/public/essays', str_replace("_", " ", $this->vn_to_str($request->essay->getClientOriginalName())));
                    Essay::create([
                        'teacher_id' => Auth::user()->id,
                        'essay' => '/storage/essays/' . str_replace("_", " ", $this->vn_to_str($request->essay->getClientOriginalName())),
                        'tip' => $request->tip,
                        'assignment_time' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    return redirect()->back()->with('invalid', 'File phải là txt');
                }
            }
        }

        return redirect()->route('essay.list')->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $essay = Essay::find($id);
        
        return view('essays.edit', compact('essay'));
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
        $essay = Essay::find($id);
        $essay->tip = $request->tip;
        if ($request->hasFile('essay')) {
            if ($request->file('essay')->isValid()) {
                if (pathinfo($request->essay->getClientOriginalName(), PATHINFO_EXTENSION) == 'txt') {
                    $request->essay->storeAs('/public/essays', str_replace("_", " ", $this->vn_to_str($request->essay->getClientOriginalName())));
                    $essay->essay = '/storage/essays/' . str_replace("_", " ", $this->vn_to_str($request->essay->getClientOriginalName()));
                } else {
                    return redirect()->back()->with('invalid', 'File phải là txt');
                }
            }
        }
        $essay->save();

        return redirect()->route('essay.list')->with('success', 'Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $essay = Essay::find($id);
        $essay->delete();

        return redirect()->back()->with('success','Xóa thành công.');
    }

    protected function vn_to_str($str){
        $unicode = [
         
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            
            'd'=>'đ',
            
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            
            'i'=>'í|ì|ỉ|ĩ|ị',
            
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            
            'A'=>'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            
            'D'=>'Đ',
            
            'E'=>'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            
            'I'=>'Í|Ì|Ỉ|Ĩ|Ị',
            
            'O'=>'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            
            'U'=>'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            
            'Y'=>'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
         
        ];
         
        foreach($unicode as $nonUnicode=>$uni){
         
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
         
        }
         
        return $str;
         
    }

    public function showSubmitForm($id)
    {
        return view('essays.submit', compact('id'));
    }

    public function submit(Request $request, $id)
    {
        if ($this->vn_to_str(str_replace(" ", "", strtolower($request->answer))) == str_replace(" ", "", strtolower(basename(Essay::find($id)->essay, ".txt")))) {
            Answer::create([
                'student_id' => Auth::user()->id,
                'answer' => $request->answer,
                'essay_id' => $id,
                'answer_time' => date('Y-m-d H:i:s')
            ]);

            return redirect()->route('essay.list')->with('success', 'Câu trả lời chính xác, mời bạn xem nội dung file');
        } else {
            return redirect()->back()->with('invalid','Câu trả lời không đúng, vui lòng thử lại');
        }
    }
}
