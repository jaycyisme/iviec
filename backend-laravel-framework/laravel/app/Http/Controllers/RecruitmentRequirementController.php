<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecruitmentRequirementResource;
use App\Models\JobNew;
use App\Models\RecruitmentRequirement;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RecruitmentRequirementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recruitmentRequirements = RecruitmentRequirement::all();
        foreach($recruitmentRequirements as $requirement) {
            $requirement['news_quantity'] = JobNew::where('recruitment_requirement_id', $requirement->id)->count();
            $requirement['candidate_quantity'] = JobNew::where('recruitment_requirement_id', $requirement->id)->sum('candidate_quantity');
        }
        $recruitmentRequirements = RecruitmentRequirementResource::collection($recruitmentRequirements);
        return $this->apiResponse($recruitmentRequirements);
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
            'name' => 'required',
            'quantity_needed' => 'required|min:1',
            'expired_date' => 'required',
            'description' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên yêu cầu tuyển dụng',
            'quantity_needed.required' => 'Bạn chưa nhập số lượng tuyển dụng',
            'quantity_needed.min' => 'Số lượng ứng viên phải lớn hơn 0',
            'expired_date.required' => 'Bạn chưa nhập thời gian hết hạn',
            'description.required' => 'Bạn chưa nhập mô tả yêu cầu tuyển dụng',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $recruitmentRequirement = new RecruitmentRequirement();
        $recruitmentRequirement->name = $request->name;
        $recruitmentRequirement->quantity_needed = $request->quantity_needed;
        $recruitmentRequirement->quantity_recruited = 0;

        $recruitmentRequirement->company_id = $request->session()->get('company_id');

        $recruitmentRequirement->status_id = Status::where('name', 'Đang hoạt động')->first()->id;
        $recruitmentRequirement->expired_date = $request->expired_date;
        $recruitmentRequirement->description = $request->description;
        $recruitmentRequirement->save();

        return $this->apiResponse(new RecruitmentRequirementResource($recruitmentRequirement), true, 201, 'Yêu cầu tuyển dụng đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $recruitmentRequirement = RecruitmentRequirement::findOrfail($id);
        $recruitmentRequirement['news_quantity'] = JobNew::where('recruitment_requirement_id', $recruitmentRequirement->id)->count();
        $recruitmentRequirement['candidate_quantity'] = JobNew::where('recruitment_requirement_id', $recruitmentRequirement->id)->sum('candidate_quantity');

        $recruitmentRequirement = new RecruitmentRequirementResource($recruitmentRequirement);
        return $this->apiResponse($recruitmentRequirement);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $recruitmentRequirement = RecruitmentRequirement::findOrfail($id);
        $recruitmentRequirement['news_quantity'] = JobNew::where('recruitment_requirement_id', $recruitmentRequirement->id)->count();
        $recruitmentRequirement['candidate_quantity'] = JobNew::where('recruitment_requirement_id', $recruitmentRequirement->id)->sum('candidate_quantity');

        $recruitmentRequirement = new RecruitmentRequirementResource($recruitmentRequirement);
        return $this->apiResponse($recruitmentRequirement);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'quantity_needed' => 'required|min:1',
            'expired_date' => 'required',
            'description' => 'required'
        ],[
            'name.required' => 'Bạn chưa nhập tên yêu cầu tuyển dụng',
            'quantity_needed.required' => 'Bạn chưa nhập số lượng tuyển dụng',
            'quantity_needed.min' => 'Số lượng ứng viên phải lớn hơn 0',
            'expired_date.required' => 'Bạn chưa nhập thời gian hết hạn',
            'description.required' => 'Bạn chưa nhập mô tả yêu cầu tuyển dụng',
        ]);

        if($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $recruitmentRequirement = RecruitmentRequirement::findOrfail($id);
        $recruitmentRequirement->name = $request->name;
        $recruitmentRequirement->quantity_needed = $request->quantity_needed;
        $recruitmentRequirement->quantity_recruited = $request->quantity_recruited;
        $recruitmentRequirement->status_id = $request->status_id;
        $recruitmentRequirement->expired_date = $request->expired_date;
        $recruitmentRequirement->description = $request->description;
        $recruitmentRequirement->save();

        return $this->apiResponse(new RecruitmentRequirementResource($recruitmentRequirement), true, 201, 'Yêu cầu tuyển dụng đã được sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $recruitmentRequirement = RecruitmentRequirement::findOrfail($id);
        $recruitmentRequirement->delete();
        return $this->apiResponse($recruitmentRequirement, true, 201, "Yêu cầu tuyển dụng đã được xóa thành công");
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
