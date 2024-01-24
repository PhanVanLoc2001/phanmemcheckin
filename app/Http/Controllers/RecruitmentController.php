<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecruitmentRequest;
use App\Models\Recruitment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
const TEMPLATE_NAME = 'frontend';
class RecruitmentController extends Controller
{
    public function index()
    {
        $recruitments = Recruitment::paginate(10);
        return view('recruitments.index', compact('recruitments'));
    }

    public function getRecruitmentThemes()
    {
        $templates = File::glob(base_path('/resources/views/'.TEMPLATE_NAME.'/recruitmentSingle-*.blade.php'));
        return array_map(function ($file) {
            $filename = pathinfo($file)['filename'];
            return str_replace(['recruitmentSingle-', '.blade'], ['', ''], $filename);
        }, $templates);
    }

    public function create()
    {
        $arrayTheme = $this->getRecruitmentThemes();
        return view('recruitments.create',[
            'arrayTheme'=>$arrayTheme
        ]);
    }

    public function store(StoreRecruitmentRequest $request)
    {
        $recruitments = Recruitment::create($request->validated());
        if ($request->has('rec_thumb')) {
            $recruitments->rec_thumb = $request->input('rec_thumb');
        }
        $recruitments->save();
        return redirect()->route('recruitments.index');
    }


    public function edit($id)
    {
        $recruitment = Recruitment::find($id);
        $arrayTheme = $this->getRecruitmentThemes();
        return view('recruitments.edit', compact('recruitment','arrayTheme'));
    }

    public function update(Request $request, $id)
    {
        $recruitment = Recruitment::findOrFail($id);
        $recruitment->fill($request->only([
            'rec_title', 'rec_slug', 'rec_desc', 'rec_content',
            'rec_thumb', 'rec_seotitle', 'rec_seodesc', 'rec_spin', 'rec_status', 'rec_quantity',
            'rec_time', 'rec_money', 'rec_department', 'rec_template', 'rec_workplace', 'rec_address'
        ]));
        if ($request->has('rec_thumb')) {
            $recruitment->rec_thumb = $request->input('rec_thumb');
        }
        $recruitment->save();
        return redirect()->route('recruitments.index');
    }

    public function destroy(Recruitment $recruitment)
    {
        $recruitment->delete();
        // Thực hiện các logic sau khi xóa thành công

        return redirect()->route('recruitments.index');
    }
}
