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
                <div class="col-md-12">

                </div>

                </div>
                
            </div>
        </div>
    </div>

    <script>
        
    </script>
</x-app-layout>
