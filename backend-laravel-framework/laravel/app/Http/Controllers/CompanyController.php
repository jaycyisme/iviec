<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use App\Http\Resources\CompanyResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Drivers\Imagick\Driver;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::all();
        $companies = CompanyResource::collection($companies);
        return $this->apiResponse($companies);
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
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên công ty',
            'email.required' => 'Bạn chưa nhập email công ty',
            'phone.required' => 'Bạn chưa nhập số điện thoại công ty',
            'address.required' => 'Bạn chưa nhập địa chỉ công ty',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $company = new Company();
        $company->user_id = Auth::user()->id;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;

        if($request->image) {
            $company_image = 'company_url_' . uniqid() . '.webp';
            $request->image->storeAs('public/Company', $company_image);

            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/Company/' . $company_image));
            $encoded = $image->toWebp(60);
            Storage::put('public/Company/' . $company_image, $encoded);

            $company->image = $company_image;
        }

        if($request->banner) {
            $banner_image = 'company_url_' . uniqid() . '.webp';
            $request->banner->storeAs('public/Company', $banner_image);

            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/Company/' . $banner_image));
            $encoded = $image->toWebp(60);
            Storage::put('public/Company/' . $banner_image, $encoded);

            $company->banner = $banner_image;
        }

        $company->link_of_company_website = $request->link_of_company_website;
        $company->business_area = $request->business_area;
        $company->employee_quantity = $request->employee_quantity;

        $company->save();

        return $this->apiResponse(new CompanyResource($company), true, 201, 'Công ty đã được tạo thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $company = Company::findOrfail($id);
        $company = new CompanyResource($company);
        return $this->apiResponse($company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $company = Company::findOrfail($id);
        $company = new CompanyResource($company);
        return $this->apiResponse($company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ],[
            'name.required' => 'Bạn chưa nhập tên công ty',
            'email.required' => 'Bạn chưa nhập email công ty',
            'phone.required' => 'Bạn chưa nhập số điện thoại công ty',
            'address.required' => 'Bạn chưa nhập địa chỉ công ty',
        ]);

        if ($validated->fails()) {
            return $this->apiResponse($validated->errors(), false, 404, 'Validate Error');
        }

        $company = Company::findOrfail($id);
        $company->user_id = Auth::user()->id;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->phone = $request->phone;
        $company->address = $request->address;

        if($request->image) {
            if($company->image && Storage::exists('public/Company/' . $company->image)) {
                Storage::delete('public/Company/' . $company->image);
            }
            $company_image = 'company_url_' . uniqid() . '.webp';
            $request->image->storeAs('public/Company', $company_image);

            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/Company/' . $company_image));
            $encoded = $image->toWebp(60);
            Storage::put('public/Company/' . $company_image, $encoded);

            $company->image = $company_image;
        }

        if($request->banner) {
            if($company->banner && Storage::exists('public/Company/' . $company->banner)) {
                Storage::delete('public/Company/' . $company->banner);
            }
            $banner_image = 'company_url_' . uniqid() . '.webp';
            $request->banner->storeAs('public/Company', $banner_image);

            $manager = new ImageManager(new Driver());
            $image = $manager->read(storage_path('app/public/Company/' . $banner_image));
            $encoded = $image->toWebp(60);
            Storage::put('public/Company/' . $banner_image, $encoded);

            $company->banner = $banner_image;
        }

        $company->link_of_company_website = $request->link_of_company_website;
        $company->business_area = $request->business_area;
        $company->employee_quantity = $request->employee_quantity;

        $company->save();

        return $this->apiResponse(new CompanyResource($company), true, 201, 'Công ty đã được sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::findOrfail($id);
        $company->delete();
        return $this->apiResponse($company, true, 201, "Công ty đã được xóa thành công");
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
