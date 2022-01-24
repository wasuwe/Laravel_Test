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
                        <div class="card-header">แก้ไขข้อมูลแผนก</div>
                        <div class="card-body">
                            <form action="{{url('/department/update/'.$departments->id)}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="department_name">ชื่อแผนก</label>
                                    <input type="text" class="form-control" name="department_name" value="{{$departments->department_name}}">
                                </div>
                                @error('department_name')
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

    {{-- <script type="text/javascript">
        $("#back").on("click",function(){
            window.open('{{ __('Department') }}','_blank');
        });
    </script> --}}

</x-app-layout>
