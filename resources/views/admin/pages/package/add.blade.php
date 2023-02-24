@extends('admin._layouts.default')
{{-- {{isset($package->name) ? 'PATCH' : 'POST'}} --}}
{{-- {{isset($package->name) ? url('package/update') : url('package')}} --}}
@section('content')
<form method="POST" action="{{isset($package->name) ? url('package/'.$package->id) : url('package')}}">
    @csrf
    @if (isset($package->name))
        {{ method_field('PATCH') }}
    @endif
    <div class="flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            @if (isset($package->name))
                Update Package
            @else
                Add New Package
            @endif
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{url('/package')}}" class="btn box mr-2 flex items-center ml-auto sm:ml-0"> <i class="w-4 h-4 mr-2" data-lucide="arrow-left"></i> Back </a>
            <button type="submit" class="dropdown-toggle btn btn-primary shadow-md flex items-center"> Save <i class="w-4 h-4 ml-2" data-lucide="save"></i> </button>
        </div>
    </div>
    <div class="pos grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Post Content -->
        <div class="col-span-12 lg:col-span-8">
            <input type="text" name="name" class="form-control py-3 px-4 box pr-10" placeholder="Name" value="{{isset($package->name) ? $package->name : ''}}">
            @if($errors->has('name'))
                <div class="pristine-error text-danger mt-2">{{$errors->first('name')}}</div>
            @endif
            <div class="post overflow-hidden box mt-5">
                <div class="post__content tab-content">
                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Description & Price </div>
                            <div class="mt-5">
                                <div>
                                    <label for="post-form-7" class="form-label">Description</label>
                                    <input id="post-form-7" name="description" type="text" class="form-control" placeholder="Write caption" value="{{isset($package->description) ? $package->description : ''}}">
                                    @if($errors->has('description'))
                                        <div class="pristine-error text-danger mt-2">{{$errors->first('description')}}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="mt-5">
                                <div>
                                    <label for="post-form-7" class="form-label">Price</label>
                                    <input id="post-form-7" name="price" type="text" class="form-control" placeholder="Price" value="{{isset($package->price) ? $package->price : ''}}">
                                    @if($errors->has('price'))
                                        <div class="pristine-error text-danger mt-2">{{$errors->first('price')}}</div>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END: Post Content -->
        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5 overflow-y-auto" style="height: 23.8rem">
                @foreach ($features as $feature)
                    <div class="inbox__item inbox__item--active inline-block sm:block text-slate-600 dark:text-slate-500 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                        <div class="flex px-5 py-3">
                            <div class="w-72 flex-none flex items-center mr-5">
                                <input name="features[]" class="form-check-input flex-none" {{in_array($feature->id, isset($package->selected) ? $package->selected : []) ? 'checked' : ''}} value="{{$feature->id}}" type="checkbox">
                                <a href="javascript:;" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-slate-400"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" class="lucide lucide-star w-4 h-4" data-lucide="star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> </a>
                                <div class="inbox__item--sender truncate ml-3">{{$feature->name}}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="inbox__item inline-block sm:block text-slate-600 dark:text-slate-500 bg-slate-100 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                    <div class="flex px-5 py-3">
                        <div class="w-72 flex-none flex items-center mr-5">
                            <input class="form-check-input flex-none" type="checkbox" checked="">
                            <a href="javascript:;" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-slate-400"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" class="lucide lucide-star w-4 h-4" data-lucide="star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> </a>
                            <div class="inbox__item--sender truncate ml-3">Kevin Spacey</div>
                        </div>
                    </div>
                </div>
                <div class="inbox__item inbox__item--active inline-block sm:block text-slate-600 dark:text-slate-500 dark:bg-darkmode-400/70 border-b border-slate-200/60 dark:border-darkmode-400">
                    <div class="flex px-5 py-3">
                        <div class="w-72 flex-none flex items-center mr-5">
                            <input class="form-check-input flex-none" type="checkbox">
                            <a href="javascript:;" class="w-5 h-5 flex-none ml-4 flex items-center justify-center text-slate-400"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="star" class="lucide lucide-star w-4 h-4" data-lucide="star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> </a>
                            <div class="inbox__item--sender truncate ml-3">Arnold Schwarzenegger</div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- END: Post Info -->
    </div>
</form>
@endsection
