<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index() {
       
        $service = Service::paginate(5);

        return view('admin.service.index', compact('service'));
    }

    public function save(Request $request) {
        // ตรวจสอบข้อมูล
        $request->validate([
            'service_name' => 'required|unique:services|max:255',
            'service_image' => 'required|mimes:jpg,jpeg,png'
        ],
        [
            'service_name.required' => "กรุณากรอกชื่อบริการ",
            'service_name.unique' => "มีชื่อบริการนี้แล้ว",
            'service_name.max' => "กรุณากรอกชื่อบริการไม่เกิน 255 ตัวอักษร",

            'service_image.required' => "กรุณาใส่ภาพบริการ",
            'service_image.mimes' => "นามสกุลภาพบริการไม่ถูกต้อง กรุณาใส่ภาพบริการนามสกุล jpg, jpeg, png",
        ]);

        // เข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');

        // Generate ชื่อภาพ
        $name_get = hexdec(uniqid());

        // ดึงนามสกุลรูปภาพ
        $img_ext = strtolower($service_image->getClientOriginalExtension());

        $img_name = $name_get.'.'.$img_ext;
        
        // อัพโหลดและบันทึกข้อมูล 
        $upload_location =  'images/services/';
        $full_path = $upload_location.$img_name;

        // ทดลองอัพโหลด
        $service = Service::insert([
            'service_name' => $request->service_name,
            'service_image' => $full_path,
            'created_at' => Carbon::now()
        ]);

        $service_image->move($upload_location, $img_name);

        return  redirect()->back()->with('success', "บันทึกข้อมูลสำเร็จ");
    }

    public function edit($id) {
        // ใช้ ID ค้นหาชุดข้อมูลที่ต้องการ
        $service = Service::find($id);
        
        return view('admin.service.edit', compact('service'));
    }

    public function update(Request $request, $id) {
        // ตรวจสอบข้อมูล
        $request->validate([
            'service_name' => 'required|max:255',
        ],
        [
            'service_name.required' => "กรุณากรอกชื่อบริการ",
            'service_name.max' => "กรุณากรอกชื่อบริการไม่เกิน 255 ตัวอักษร"
        ]);

        // เข้ารหัสรูปภาพ
        $service_image = $request->file('service_image');

        if ($service_image) {
           // Generate ชื่อภาพ
            $name_get = hexdec(uniqid());

            // ดึงนามสกุลรูปภาพ
            $img_ext = strtolower($service_image->getClientOriginalExtension());

            $img_name = $name_get.'.'.$img_ext;

             // อัพโหลดและบันทึกข้อมูล 
             $upload_location = 'images/services/';
             $full_path = $upload_location.$img_name;
            
            // อัพโหลด
            $service = Service::find($id)->update([
                'service_name' => $request->service_name,
                'service_image' => $full_path,
                'updated_at' => Carbon::now()
            ]);

            //ลบภาพเดิม
            $old_image = $request->old_image;
            if ($old_image){
                unlink($old_image);
            }
            $service_image->move($upload_location, $img_name);
             
        }else{
            $service = Service::find($id)->update([
                'service_name' => $request->service_name,
                'updated_at' => Carbon::now()
            ]);

        }


        return  redirect()->route('services')->with('success', "แก้ไขข้อมูลสำเร็จ");
    }

    public function delete($id) {
       // ลบรูป
        $img = Service::find($id)->service_image;
        $departments = Service::find($id)->forceDelete();
        if ($departments){
            if ($img){
                unlink($img);
            }
        }
      
        return $departments;
    }
}
