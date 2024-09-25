<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobNew;
use App\Models\Status;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use App\Models\CandidateRepository;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use App\Http\Resources\CandidateRepositoryResource;

class CandidateController extends Controller
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function getAllJobs() {
        $jobs = Job::all();
        return $this->apiResponse($jobs);
    }

    public function getAllJobNews(int $number) {
        $jobNews = JobNew::with(['recruitmentRequirement.company',
                                 'salaryType',
                                 'status' => function($query) {
                                        $query->select('id', 'name');
                                    },
                                 'addresses', ])->latest()->paginate($number);
        return $this->apiResponse($jobNews);
    }

    public function participateJobNews(Request $request) {
        $user = Auth::user();
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

    public function apiResponse($data = null, $status = true, $status_code = 200, $message = null) {
        return response()->json([
            'data' => $data,
            'status' => $data = null ? false : $status,
            'status_code' => $data = null ? 404 : $status_code,
            'message' => $data = null ? 'Không tìm thấy dữ liệu' : $message,
        ]);
    }
}
