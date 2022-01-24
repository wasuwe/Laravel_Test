<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            สวัสดี, {{Auth::user()->name}}
            <div class="float-end">{{thaidate('l j F Y', 'now')}}</div>
        </h2>
    </x-slot>
    
    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ลำดับ</th>
                            <th>ชื่อ</th>
                            <th>อีเมล</th>
                            <th>เริ่มใช้งานระบบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users)
                            @php($index=1)
                            @foreach($users as $row)
                                <tr>
                                    <td>{{$index}}</td>
                                    <td>{{$row->name}}</td>
                                    <td>{{$row->email}}</td>
                                    <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
                                </tr>
                                @php($index++)
                            @endforeach
                        @endif
                    </tbody>
                </table>

                <!-- <x-jet-welcome /> -->
            </div>
        </div>
    </div>
</x-app-layout>
