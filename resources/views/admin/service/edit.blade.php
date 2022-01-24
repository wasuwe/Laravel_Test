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
                <div class="offset-md-3 col-md-6">
                    <div class="card">
                        <div class="card-header">แก้ไขข้อมูลบริการ</div>
                        <div class="card-body">
                            <form action="{{url('/service/update/'.$service->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="service_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="service_name" value="{{$service->service_name}}">
                                </div>
                                @error('service_name')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror   
                                
                                <div class="form-group mb-4">
                                    <label for="service_image">ภาพบริการ</label>
                                    <input type="file" class="form-control" name="service_image" value="{{$service->service_image}}">
                                    <input type="hidden" class="form-control" name="old_image" value="{{$service->service_image}}">
                                </div>
                                <div class="form-group mb-4">
                                    <img src="{{asset($service->service_image)}}" width="200px" height="200px" alt="">
                                </div>
                                @error('service_image')
                                    <div class="my-2">
                                        <span class="text-danger">{{$message}}</span>
                                    </div>
                                @enderror  
                                
                                <br>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="บันทึก">
                                    <input type="button" class="btn btn-secondary" value="กลับ">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
