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
        <form action="{{url('/setting/theme-category/add')}}" method="POST">
            @csrf
            <div class="intro-y box p-5">
                <div>
                    <label for="crud-form-1" class="form-label">Category Name</label>
                    <input id="crud-form-1" type="text" name="name" class="form-control w-full" placeholder="Ex: Wedding">
                    @if($errors->has('name'))
                        <div class="pristine-error text-danger mt-2">{{$errors->first('name')}}</div>
                    @endif
                </div>
                <div class="text-right mt-5">
                    <a href="{{url('/setting/theme-category')}}" type="button" class="btn btn-outline-secondary w-24 mr-1">Cancel</a>
                    <button type="submit" class="btn btn-primary w-24">Save</button>
                </div>
            </div>
        </form>
        <!-- END: Form Layout -->
    </div>
</div>
@endsection
