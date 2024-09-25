<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\CandidateRepository;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Http\Resources\CandidateRepositoryResource;
use App\Models\JobNew;

class CandidateRepositoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $candidateRepositories = CandidateRepository::all();
        $candidateRepositories = CandidateRepositoryResource::collection($candidateRepositories);
        return $this->apiResponse($candidateRepositories);
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
            'job_new_id' => 'required|exists:job_news,id',
            'cv' => 'required|image',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required',
        ],[
            'job_new_id.required' => 'Bạn chưa chọn tin tuyển dụng',
            'job_new_id.exists' => 'Tin tuyển dụng không tồn tại',
            'cv.required' => 'Bạn chưa chọn CV',
            'cv.image' => 'CV không tồn tại',
            'name.required' => 'Bạn chưa điền tên',
            'email.required' => 'Bạn chưa điền email',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Bạn chưa điền số điện thoại',
            'dob.required' => 'Bạn chưa điền ngày tháng năm sinh',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $candidateRepository = new CandidateRepository();
        $candidateRepository->user_id = Auth::user()->id;
        $candidateRepository->job_new_id = $request->job_new_id;
        $candidateRepository->status_id = Status::where('name', 'Ứng tuyển')->first()->id;

        if($request->cv) {
            $cv_image = 'cv_url_' . uniqid() . $request->cv->extension();
            $request->cv->storeAs('public/CV', $cv_image);
            $candidateRepository->cv = $cv_image;
        }

        $candidateRepository->name = $request->name;
        $candidateRepository->email = $request->email;
        $candidateRepository->phone = $request->phone;
        $candidateRepository->dob = $request->dob;

        $candidateRepository->save();

        $jobNew = JobNew::findOrfail($request->job_new_id);
        $jobNew->candidate_quantity = $jobNew->candidate_quantity+1;
        $jobNew->save();

        return $this->apiResponse(new CandidateRepositoryResource($candidateRepository), true, 201, 'Ứng viên đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $candidateRepository = CandidateRepository::findOrfail($id);
        $candidateRepository = new CandidateRepositoryResource($candidateRepository);
        return $this->apiResponse($candidateRepository);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $candidateRepository = CandidateRepository::findOrfail($id);
        $candidateRepository = new CandidateRepositoryResource($candidateRepository);
        return $this->apiResponse($candidateRepository);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'job_new_id' => 'required|exists:job_news,id',
            'cv' => 'required|image',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'dob' => 'required',
        ],[
            'job_new_id.required' => 'Bạn chưa chọn tin tuyển dụng',
            'job_new_id.exists' => 'Tin tuyển dụng không tồn tại',
            'cv.required' => 'Bạn chưa chọn CV',
            'cv.image' => 'CV không tồn tại',
            'name.required' => 'Bạn chưa điền tên',
            'email.required' => 'Bạn chưa điền email',
            'email.email' => 'Email không đúng định dạng',
            'phone.required' => 'Bạn chưa điền số điện thoại',
            'dob.required' => 'Bạn chưa điền ngày tháng năm sinh',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $candidateRepository = CandidateRepository::findOrfail($id);
        $candidateRepository->user_id = Auth::user()->id;
        $candidateRepository->job_new_id = $request->job_new_id;
        $candidateRepository->status_id = Status::where('name', 'Ứng tuyển')->first()->id;

        if($request->cv) {
            if($candidateRepository->cv && Storage::exists('public/CV/' . $candidateRepository->cv)) {
                Storage::delete('public/CV/' . $candidateRepository->cv);
            }
            $cv_image = 'cv_url_' . uniqid() . $request->cv->extension();
            $request->cv->storeAs('public/CV', $cv_image);
            $candidateRepository->cv = $cv_image;
        }

        $candidateRepository->name = $request->name;
        $candidateRepository->email = $request->email;
        $candidateRepository->phone = $request->phone;
        $candidateRepository->dob = $request->dob;

        $candidateRepository->save();
        return $this->apiResponse(new CandidateRepositoryResource($candidateRepository), true, 201, 'Ứng viên đã được chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $candidateRepository = CandidateRepository::findOrfail($id);
        if($candidateRepository->cv && Storage::exists('public/CV/' . $candidateRepository->cv)) {
            Storage::delete('public/CV/' . $candidateRepository->cv);
        }
        $candidateRepository->delete();
        return $this->apiResponse(new CandidateRepositoryResource($candidateRepository), true, 201, 'Ứng viên đã được xóa thành công');
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
