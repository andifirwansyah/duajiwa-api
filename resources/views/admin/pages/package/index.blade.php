@extends('admin._layouts.default')
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Package Lists
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{url("package/create")}}" class="btn btn-primary shadow-md mr-2">Add New Package</a>
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
                        <th class="whitespace-nowrap">Description</th>
                        <th class="whitespace-nowrap">Price</th>
                        <th class="whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $key => $package)
                        <tr>
                            <td>{{$package->id}}</td>
                            <td>{{$package->name}}</td>
                            <td>{{$package->description}}</td>
                            <td>Rp{{number_format($package->price)}}</td>
                            <td class="flex items-center">
                                <a href="{{url('package/'.$package->id.'/edit')}}" class="btn btn-warning-soft mr-2">
                                    <i class="w-4 h-4" data-lucide="pencil"></i>
                                </a>
                                <form action="{{route('admin.package.destroy', ['package' => $package->id])}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger-soft">
                                        <i class="w-4 h-4" data-lucide="trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @if (count($packages) <= 0)
                <div class="text-center mt-3">No Data Found</div>
            @endif

        </div>
    </div>
    <div id="success-notification-content" class="toastify-content hidden flex"> <i class="text-success" data-lucide="check-circle"></i>
        <div class="ml-4 mr-4">
            <div class="font-medium">Package Saved!</div>
            <div class="text-slate-500 mt-1">The package successfully saved!.</div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            const isSuccess = "{{ Session::get('success') }}"
            if(isSuccess){
                Toastify({
                    node: $("#success-notification-content").clone().removeClass("hidden")[0],
                    duration: -1,
                    newWindow: true,
                    close: true,
                    gravity: "top",
                    position: "right",
                    stopOnFocus: true,
                }).showToast();
            }
        });
    </script>
@endpush
