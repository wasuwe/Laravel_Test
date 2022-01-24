<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use Carbon\Carbon;
use PDF;

class DepartmentController extends Controller
{
    public function index() {
        // ดึงข้อมูล แบบ Eloquent
        // $departments = Department::all();

        // Paginate แบบ Eloquent
        $departments = Department::paginate(5);
        $trashDepartments = Department::onlyTrashed()->paginate(5);
       
        // ดึงข้อมูล แบบ Quest Builder
        // $departments = DB::table('departments')->get();

        // Paginate แบบ Quest Builder
        // $departments = DB::table('departments')->paginate(2);

        // Join แบบ Quest Builder
        // $departments = DB::table('departments')
        // ->join('users', 'departments.user_id', 'users.id')
        // ->select('departments.*', 'users.name')
        // ->paginate(2);

        return view('admin.department.index', compact('departments', 'trashDepartments'));
    }

    // public function test() {
       
        //     $Arr = [2, 5, 17, 57, 143145];
        
        //     foreach ($Arr as $number){  

        //         if($number % 2 != 0){
        //             $number = $number - 1;
        //         }

        //         $area = $number*$number;
                
        //         $tree = floor($area/4);

        //         echo $area." = ".$tree."<br>";
        //     }

        //     exit;

        //     return view('admin.department.index', compact('test'));
    // }

    public function save(Request $request) {
        // ตรวจสอบข้อมูล
        $request->validate([
            'department_name' => 'required|unique:departments|max:255'
        ],
        [
            'department_name.required' => "กรุณากรอกชื่อแผนก",
            'department_name.unique' => "มีชื่อแผนกนี้แล้ว",
            'department_name.max' => "กรุณากรอกชื่อแผนกไม่เกิน 255 ตัวอักษร"
        ]);

        // บันทึกข้อมูล แบบ Eloquent
        // $department = new Department;
        // $department->department_name = $request->department_name;
        // $department->user_id = Auth::user()->id;
        // $department->save();

        // บันทึกข้อมูล แบบ Quest Builder
        $data = [];
        $data['department_name'] = $request->department_name;
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now();
        $data['updated_at'] = Carbon::now();
        DB::table('departments')->insert($data);

        return  redirect()->back()->with('success', "บันทึกข้อมูลสำเร็จ");
    }

    public function edit($id) {
        // ใช้ ID ค้นหาชุดข้อมูลที่ต้องการ
        $departments = Department::find($id);
        
        return view('admin.department.edit', compact('departments'));
    }

    public function update(Request $request, $id) {
        // ตรวจสอบข้อมูล
        $request->validate([
            'department_name' => 'required|unique:departments|max:255'
        ],
        [
            'department_name.required' => "กรุณากรอกชื่อแผนก",
            'department_name.unique' => "มีชื่อแผนกนี้แล้ว",
            'department_name.max' => "กรุณากรอกชื่อแผนกไม่เกิน 255 ตัวอักษร"
        ]);


        // อัพเดทข้อมูล แบบ Eloquent
        $data = [];
        $update = Department::find($id)->update([
            'department_name' => $request->department_name,
            'updated_at' => Carbon::now()
        ]);


        return  redirect()->route('department')->with('success', "แก้ไขข้อมูลสำเร็จ");
    }

    public function softdelete($id) {
        // ลบข้อมูล แบบ Eloquent
        $delete = Department::find($id)->delete();

        return  redirect()->back()->with('success', "ลบข้อมูลสำเร็จ");
    }

    public function restore($id) {
        // กู้คืนข้อมูล
        $departments = Department::withTrashed()->find($id)->restore();
        
        return  redirect()->route('department')->with('success', "กู้คืนข้อมูลสำเร็จ");
    }
    
    public function delete($id) {
        // กู้คืนข้อมูล
        $departments = Department::withTrashed()->find($id)->forceDelete();
        
        return  redirect()->route('department')->with('success', "ลบข้อมูลถาวรสำเร็จ");
    }

    public function pdf() {
      
        $departments = Department::all();

        return view('admin.department.pdf', compact('departments'));
    }

    
    public function createPDF() {
      
        $departments = Department::all();
       
         // share data to view
        view()->share('employee',$departments);
        $pdf = PDF::loadView('admin.department.pdf', $departments);
        
        dd($departments);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');

    }

    public function test() {

        // เลขคู่
        $oddArr = range(2, 100, 2);
        echo '<pre>'; print_r($oddArr);

        // เลขคู่
        $evenArr = range(1, 100, 2);
        echo '<pre>'; print_r($oddArr);

        $allArr = array_merge($oddArr, $evenArr);
        sort($allArr);
        echo '<pre>'; print_r($allArr);
        exit;


       
        return view('admin.department.index', compact('test'));
      }
  

}
