<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            สวัสดี, {{Auth::user()->name}}
            <div class="float-end">{{thaidate('l j F Y', 'now')}}</div> 
        </h2>
    </x-slot>
    
    <div class="py-12"> 
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @if (session("success"))
                        <div class="alert alert-success">{{session("success")}}</div>
                    @endif
                    
                    <div class="card">
                        <div class="card-header">ตารางข้อมูลแผนก</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">ชื่อแผนก</th>
                                        <th class="text-center">ผู้เพิ่มข้อมูล</th>
                                        <th class="text-center">แก้ไขข้อมูลล่าสุด</th>
                                        <th class="text-center">แก้ไข</th>
                                        <th class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($departments)>0)
                                        @foreach($departments as $row)
                                            <tr>
                                                <td class="text-center">{{$departments->firstItem()+$loop->index}}</td>
                                                <td>{{$row->department_name}}</td>
                                                <td>{{$row->user->name}}</td>
                                                @if ($row->updated_at)
                                                    <td class="text-center">{{Carbon\Carbon::parse($row->updated_at)->diffForHumans()}}</td>
                                                @else ()
                                                    <td class="text-center">{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                                @endif
                                                <td class="text-center"><a class="btn btn-warning" href="{{url('/department/edit/'.$row->id)}}" target="_self" title="Edit"><i class="fas fa-edit"></i></a></td>
                                                <td class="text-center"><a class="btn btn-danger" href="{{url('/department/softdelete/'.$row->id)}}" target="_self" title="Edit"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{$departments->links()}}
                        </div>
                    </div>

                    @if (count($trashDepartments)>0)
                        <div class="card my-4">
                            <div class="card-header">ถังขยะ</div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="text-center">ลำดับ</th>
                                            <th class="text-center">ชื่อแผนก</th>
                                            <th class="text-center">ผู้เพิ่มข้อมูล</th>
                                            <th class="text-center">แก้ไขข้อมูลล่าสุด</th>
                                            <th class="text-center">กู้คืนข้อมูล</th>
                                            <th class="text-center">ลบข้อมูลถาวร</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            @foreach($trashDepartments as $row)
                                                <tr>
                                                    <td class="text-center">{{$trashDepartments->firstItem()+$loop->index}}</td>
                                                    <td>{{$row->department_name}}</td>
                                                    <td>{{$row->user->name}}</td>
                                                    @if ($row->deleted_at)
                                                        <td class="text-center">{{Carbon\Carbon::parse($row->deleted_at)->diffForHumans()}}</td>
                                                    @else ()
                                                        <td class="text-center"> - </td>
                                                    @endif
                                                    <td class="text-center"><a class="btn btn-warning" href="{{url('/department/restore/'.$row->id)}}" target="_self" title="Edit"><i class="fas fa-trash-restore"></i></a></td>
                                                    <td class="text-center"><a class="btn btn-danger" href="{{url('/department/delete/'.$row->id)}}" target="_self" title="Edit"><i class="fas fa-trash-alt"></i></a></td>
                                                </tr>
                                            @endforeach
                                        
                                    </tbody>
                                </table>
                                {{$trashDepartments->links()}}
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">เพิ่มข้อมูลแผนก</div>
                        <div class="card-body">
                            <form action="{{route('savedepartment')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="department_name">
                                </div>
                                @error('department_name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror                                
                                <br>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="บันทึก">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
