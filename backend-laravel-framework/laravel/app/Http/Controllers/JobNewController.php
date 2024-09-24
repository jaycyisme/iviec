<?php

namespace App\Http\Controllers;

use App\Models\JobNew;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Http\Resources\JobNewResource;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class JobNewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jobNews = JobNew::all();
        foreach($jobNews as $jobNew) {
            $jobNew['company'] = $jobNew->company->name;
            $jobNew['status'] = $jobNew->status->name;
            $jobNew['salary_type'] = $jobNew->salaryType->name;
        }

        $jobNews = JobNewResource::collection($jobNews);
        return $this->apiResponse($jobNews);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'recruitment_requirement_id' => 'required|exists:recruitment_requirements,id',
            'job' => 'required',
            'position' => 'required',
            'job_description' => 'required',
            'requirement' => 'required',
            'benefit' => 'required',
            'working_form' => 'required',
            'level' => 'required',
            'salary_type_id' => 'required|exists:salary_types,id',
            'salary_start' => 'min:0',
            'salary_end' => 'min:0',
        ],[
            'title.required' => 'Bạn chưa nhập tiêu đề bản tin',
            'recruitment_requirement_id.required' => 'Bạn chưa nhập yêu cầu tuyển dụng',
            'recruitment_requirement_id.exists' => 'Yêu cầu tuyển dụng không tồn tại',
            'job.required' => 'Bạn chưa chọn công việc',
            'position.required' => 'Bạn chưa chọn vị trí',
            'job_description.required' => 'Bạn chưa điền mô tả công việc',
            'requirement.required' => 'Bạn chưa điền mô tả yêu cầu',
            'benefit.required' => 'Bạn chưa điền mô tả lợi ích',
            'working_form.required' => 'Bạn chưa chọn hình thức làm việc',
            'level.required' => 'Bạn chưa chọn cấp bậc',
            'salary_type_id.required' => 'Bạn chưa chọn mức lương',
            'salary_type_id.exists' => 'Mức lương không tồn tại',
            'salary_start.min' => 'Mức lương phải lớn hơn 0',
            'salary_end.min' => 'Mức lương phải lớn hơn 0',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $jobNew = new JobNew();
        $jobNew->title = $request->title;
        $jobNew->candidate_quantity = 0;
        $jobNew->recruitment_requirement_id = $request->recruitment_requirement_id;
        $jobNew->status_id = Status::where('name', 'Đang hoạt động')->first()->id;
        $jobNew->job = $request->job;
        $jobNew->position = $request->position;
        $jobNew->job_description = $request->job_description;
        $jobNew->requirement = $request->requirement;
        $jobNew->benefit = $request->benefit;
        $jobNew->working_form = $request->working_form;
        $jobNew->level = $request->level;
        $jobNew->salary_type_id = $request->salary_type_id;
        $jobNew->salary_start = $request->salary_start;
        $jobNew->salary_end = $request->salary_end;
        $jobNew->year_of_experience = $request->year_of_experience;
        $jobNew->gender = $request->gender;
        $jobNew->language = $request->language;
        $jobNew->save();

        return $this->apiResponse(new JobNewResource($jobNew), true, 201, 'Tin tuyển dụng đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jobNew = JobNew::findOrfail($id);
        $jobNew['status'] = $jobNew->status->name;
        $jobNew['salary_type'] = $jobNew->salaryType->name;

        $jobNew = new JobNewResource($jobNew);
        return $this->apiResponse($jobNew);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $jobNew = JobNew::findOrfail($id);
        $jobNew['status'] = $jobNew->status->name;
        $jobNew['salary_type'] = $jobNew->salaryType->name;

        $jobNew = new JobNewResource($jobNew);
        return $this->apiResponse($jobNew);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'title' => 'required',
            'recruitment_requirement_id' => 'required|exists:recruitment_requirements,id',
            'job' => 'required',
            'position' => 'required',
            'job_description' => 'required',
            'requirement' => 'required',
            'benefit' => 'required',
            'working_form' => 'required',
            'level' => 'required',
            'salary_type_id' => 'required|exists:salary_types,id',
            'salary_start' => 'min:0',
            'salary_end' => 'min:0',
        ],[
            'title.required' => 'Bạn chưa nhập tiêu đề bản tin',
            'recruitment_requirement_id.required' => 'Bạn chưa nhập yêu cầu tuyển dụng',
            'recruitment_requirement_id.exists' => 'Yêu cầu tuyển dụng không tồn tại',
            'job.required' => 'Bạn chưa chọn công việc',
            'position.required' => 'Bạn chưa chọn vị trí',
            'job_description.required' => 'Bạn chưa điền mô tả công việc',
            'requirement.required' => 'Bạn chưa điền mô tả yêu cầu',
            'benefit.required' => 'Bạn chưa điền mô tả lợi ích',
            'working_form.required' => 'Bạn chưa chọn hình thức làm việc',
            'level.required' => 'Bạn chưa chọn cấp bậc',
            'salary_type_id.required' => 'Bạn chưa chọn mức lương',
            'salary_type_id.exists' => 'Mức lương không tồn tại',
            'salary_start.min' => 'Mức lương phải lớn hơn 0',
            'salary_end.min' => 'Mức lương phải lớn hơn 0',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $jobNew = JobNew::findOrfail($id);
        $jobNew->title = $request->title;
        $jobNew->recruitment_requirement_id = $request->recruitment_requirement_id;
        $jobNew->status_id = $request->status_id;
        $jobNew->job = $request->job;
        $jobNew->position = $request->position;
        $jobNew->job_description = $request->job_description;
        $jobNew->requirement = $request->requirement;
        $jobNew->benefit = $request->benefit;
        $jobNew->working_form = $request->working_form;
        $jobNew->level = $request->level;
        $jobNew->salary_type_id = $request->salary_type_id;
        $jobNew->salary_start = $request->salary_start;
        $jobNew->salary_end = $request->salary_end;
        $jobNew->year_of_experience = $request->year_of_experience;
        $jobNew->gender = $request->gender;
        $jobNew->language = $request->language;
        $jobNew->save();

        return $this->apiResponse(new JobNewResource($jobNew), true, 201, 'Thông báo tuyển dụng đã được sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jobNew = JobNew::findOrfail($id);
        $jobNew->delete();
        return $this->apiResponse($jobNew, true, 201, "Thông báo tuyển dụng đã được xóa thành công");
    }





    public function apiResponse($data = null, $status = true, $status_code = 200, $message = null) {
        return response()->json([
            'data' => $data,
            'status' => $data = null ? false : $status,
            'status_code' => $data = null ? 404 : $status_code,
            'message' => $data = null ? 'Không tìm thấy dữ liệu' : $message,
        ]);
    }
}
