@extends('admin._layouts.default')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Add Theme Category
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-12 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <form action="{{url('/package-feature')}}" method="POST">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">Feature Name</label>
                    <input id="crud-form-1" type="text" name="name" class="form-control w-full" placeholder="Ex: Wedding">
                    {{-- @if($errors->has('name'))
                        <div class="pristine-error text-danger mt-2">{{$errors->first('name')}}</div>
                    @endif --}}
                </div>
                <div class="text-right mt-5">
                    <a href="{{url('/package-feature')}}" type="button" class="btn btn-outline-secondary w-24 mr-1">Back</a>
                    <button type="submit" class="btn btn-primary w-24">Save</button>
                </div>
            </div>
        </form>
        <!-- END: Form Layout -->
    </div>
</div>
<div id="success-notification-content" class="toastify-content hidden flex"> <i class="text-success" data-lucide="check-circle"></i>
    <div class="ml-4 mr-4">
        <div class="font-medium">Package Feature Saved!</div>
        <div class="text-slate-500 mt-1">The package feature successfully saved!.</div>
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
