@extends('admin._layouts.default')
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Package Feature Lists
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{url("package-feature/create")}}" class="btn btn-primary shadow-md mr-2">Add New Feature</a>
            <div class="hidden md:block mx-auto text-slate-500"></div>
        </div>
    </div>
    <div class="box p-5 mt-5">
        <div class="overflow-x-auto">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap">Name</th>
                        <th class="whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($features as $key => $feature)
                        <tr>
                            <td>{{$feature->id}}</td>
                            <td>{{$feature->name}}</td>
                            <td>
                                <a href="" class="btn btn-warning-soft">
                                    <i class="w-4 h-4" data-lucide="pencil"></i>
                                </a>
                                <a href="" class="btn btn-danger-soft">
                                    <i class="w-4 h-4" data-lucide="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($features) <= 0)
                <div class="text-center mt-3">No Data Found</div>
            @endif

        </div>
    </div>
@endsection
