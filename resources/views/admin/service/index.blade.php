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
                        <div class="card-header">ตารางข้อมูลบริการ</div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">ลำดับ</th>
                                        <th class="text-center">รูปบริการ</th>
                                        <th class="text-center">ชื่อบริการ</th>
                                        <th class="text-center">แก้ไขข้อมูลล่าสุด</th>
                                        <th class="text-center">แก้ไข</th>
                                        <th class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($service)>0)
                                        @foreach($service as $row)
                                            <tr>
                                                <td class="text-center">{{$service->firstItem()+$loop->index}}</td>
                                                <td><img src="{{asset($row->service_image)}}" width="100px" height="100px" alt=""></td>
                                                <td>{{$row->service_name}}</td>
                                                @if ($row->updated_at)
                                                    <td class="text-center">{{Carbon\Carbon::parse($row->updated_at)->diffForHumans()}}</td>
                                                @else ()
                                                    <td class="text-center">{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                                @endif
                                                <td class="text-center"><a class="btn btn-warning" href="{{url('/service/edit/'.$row->id)}}" target="_self" title="Edit"><i class="fas fa-edit"></i></a></td>
                                                <td class="text-center"><a class="btn btn-danger" href="javascript:void(0)" onclick="deleteData({{$row->id}});" target="_self" title="Edit"><i class="fas fa-trash-alt"></i></a></td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{$service->links()}}
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">เพิ่มข้อมูลบริการ</div>
                        <div class="card-body">
                            <form action="{{route('saveservice')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="service_name">ชื่อบริการ</label>
                                    <input type="text" class="form-control" name="service_name">
                                </div>
                                @error('service_name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror      
                                
                                <div class="form-group mb-4">
                                    <label for="service_image">ภาพบริการ</label>
                                    <input type="file" class="form-control" name="service_image">
                                </div>
                                @error('service_image')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror  
                                
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
    <script>
        function deleteData(id) {

            dialogConfirm("คุณแน่ใจหรือไม่?", "แจ้งเตือนการลบ", function() {
                $.ajax({
                    type: 'GET',
                    url: '{{url('/service/delete/')}}/'+id,
                    success: function(resp) {
                        Swal.fire({
                            position: 'ลบข้อมูล!',
                            icon: 'success',
                            title: 'ลบข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        window.open('{{url('/service/all/')}}', '_self');
                    },
                    error: function() {
                        Swal.fire({
                            position: 'ลบข้อมูล!',
                            icon: 'error',
                            title: 'ลบข้อมูลไม่สำเร็จ',
                            showConfirmButton: true
                        })
                    }
                });
            });
            
        }
    </script>
</x-app-layout>
