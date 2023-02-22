@extends('admin._layouts.default')

@section('content')
<form method="post" enctype="multipart/form-data">
    @csrf
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            Add New Theme
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <a href="{{url('/theme')}}" class="btn box mr-2 flex items-center ml-auto sm:ml-0"> <i class="w-4 h-4 mr-2" data-lucide="arrow-left"></i> Back </a>
            <button type="submit" class="dropdown-toggle btn btn-primary shadow-md flex items-center"> Save <i class="w-4 h-4 ml-2" data-lucide="save"></i> </button>

        </div>
    </div>
    <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Post Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <input type="text" name="name" class="intro-y form-control py-3 px-4 box pr-10" placeholder="Name">
            @if($errors->has('name'))
                <div class="pristine-error text-danger mt-2">{{$errors->first('name')}}</div>
            @endif
            <div class="post intro-y overflow-hidden box mt-5">
                <div class="post__content tab-content">
                    <div id="content" class="tab-pane p-5 active" role="tabpanel" aria-labelledby="content-tab">
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5 mt-5">
                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> Caption & Images </div>
                            <div class="mt-5">
                                <div>
                                    <label for="post-form-7" class="form-label">Caption</label>
                                    <input id="post-form-7" name="description" type="text" class="form-control" placeholder="Write caption">
                                    @if($errors->has('description'))
                                        <div class="pristine-error text-danger mt-2">{{$errors->first('description')}}</div>
                                    @endif
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Upload Thumbnail</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div id="thumbnailCover" class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" id="thumbnailPreview" src="#">
                                                <div title="Remove this image?" id="removeThumbnail" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">Upload a file</span> or drag and drop
                                            <input type="file" name="thumbnail" id="thumbnailUpload" class="w-full h-full top-0 left-0 absolute opacity-0">
                                            @if($errors->has('thumbnail'))
                                                <div class="pristine-error text-danger mt-2">{{$errors->first('thumbnail')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label">Upload Design Capture</label>
                                    <div class="border-2 border-dashed dark:border-darkmode-400 rounded-md pt-4">
                                        <div class="flex flex-wrap px-4">
                                            <div id="designCaptureCover" class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                <img class="rounded-md" id="designCapturePreview" src="#">
                                                <div title="Remove this image?" id="removedesignCapture" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-danger right-0 top-0 -mr-2 -mt-2"> <i data-lucide="x" class="w-4 h-4"></i> </div>
                                            </div>
                                        </div>
                                        <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                            <i data-lucide="image" class="w-4 h-4 mr-2"></i> <span class="text-primary mr-1">Upload a file</span> or drag and drop
                                            <input type="file" name="design_capture" id="designCaptureUpload" class="w-full h-full top-0 left-0 absolute opacity-0">
                                            @if($errors->has('design_capture'))
                                                <div class="pristine-error text-danger mt-2">{{$errors->first('design_capture')}}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="border border-slate-200/60 dark:border-darkmode-400 rounded-md p-5">
                            <div class="font-medium flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5"> <i data-lucide="chevron-down" class="w-4 h-4 mr-2"></i> File & Price </div>
                            <div class="mt-5">
                                <label for="post-form-7" class="form-label">Theme File</label>
                                <input id="post-form-7" name="theme_file" type="file" class="flex">
                                @if($errors->has('theme_file'))
                                    <div class="pristine-error text-danger mt-2">{{$errors->first('theme_file')}}</div>
                                @endif
                            </div>
                            <div class="mt-5">
                                <label for="post-form-7" class="form-label">Purchase Price</label>
                                <input id="theme_cost" type="text" name="theme_cost" class="form-control" placeholder="Rp.0">
                                @if($errors->has('theme_cost'))
                                    <div class="pristine-error text-danger mt-2">{{$errors->first('theme_cost')}}</div>
                                @endif
                            </div>
                            <div class="mt-5">
                                <label for="post-form-7" class="form-label">Selling Price</label>
                                <input id="price" type="text" name="price" class="form-control" placeholder="Rp.0">
                                @if($errors->has('price'))
                                    <div class="pristine-error text-danger mt-2">{{$errors->first('price')}}</div>
                                @endif
                            </div>
                            <div class="mt-5">
                                <label for="post-form-7" class="form-label">Discount (Optional)</label>
                                <input id="discount" type="text" name="discount" class="form-control" placeholder="0%">
                                @if($errors->has('discount'))
                                    <div class="pristine-error text-danger mt-2">{{$errors->first('discount')}}</div>
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- END: Post Content -->
        <!-- BEGIN: Post Info -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y box p-5">
                {{-- <div class="mt-3">
                    <label for="post-form-2" class="form-label">Post Date</label>
                    <input type="text" class="datepicker form-control" id="post-form-2" data-single-mode="true">
                </div> --}}
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Creator By</label>
                    <select data-placeholder="Select categories" name="creator" class="tom-select w-full" id="post-form-3">
                        @foreach ($creators as $creator)
                            <option value="{{$creator->id}}">{{$creator->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('creator'))
                        <div class="pristine-error text-danger mt-2">{{$errors->first('creator')}}</div>
                    @endif
                </div>
                <div class="mt-3">
                    <label for="post-form-3" class="form-label">Categories</label>
                    <select data-placeholder="Select categories" name="category" class="tom-select w-full" id="post-form-3">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('category'))
                        <div class="pristine-error text-danger mt-2">{{$errors->first('category')}}</div>
                    @endif
                </div>
                <div class="mt-3">
                    <label for="post-form-4" class="form-label">Tags</label>
                    <select data-placeholder="Select your favorite actors" name="tags[]" class="tom-select w-full" id="post-form-4" multiple>
                        <option value="1" selected>Leonardo DiCaprio</option>
                        <option value="2">Johnny Deep</option>
                        <option value="3" selected>Robert Downey, Jr</option>
                        <option value="4">Samuel L. Jackson</option>
                        <option value="5">Morgan Freeman</option>
                    </select>
                    @if($errors->has('tags'))
                        <div class="pristine-error text-danger mt-2">{{$errors->first('tags')}}</div>
                    @endif
                </div>
                <div class="form-check form-switch flex flex-col items-start mt-3">
                    <label for="post-form-5" class="form-check-label ml-0 mb-2">Published</label>
                    <input id="post-form-5" name="published" class="form-check-input" type="checkbox">
                </div>
                <div class="form-check form-switch flex flex-col items-start mt-3">
                    <label for="post-form-6" class="form-check-label ml-0 mb-2">Show Author Name</label>
                    <input id="post-form-6" name="show_author_name" class="form-check-input" type="checkbox">
                </div>
            </div>
        </div>
        <!-- END: Post Info -->
    </div>
</form>
@endsection
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    {{-- <script src="{{asset('admin/dist/js/jquery.priceformat.min.js')}}"></script> --}}
    <script>
        const thumbnailCover = $('#thumbnailCover');
        const designCaptureCover = $('#designCaptureCover');
        thumbnailCover.hide();
        designCaptureCover.hide();
        $(document).ready(function() {

            $('#thumbnailUpload').change(function(){
                const file = this.files[0];
                if (file){
                    thumbnailCover.show();
                    let reader = new FileReader();
                    reader.onload = function(event){
                        console.log(event.target.result);
                        $('#thumbnailPreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            $('#removeThumbnail').click(function(){
                thumbnailCover.hide();
                $('#thumbnailPreview').attr('src', '');
            })

            $('#designCaptureUpload').change(function(){
                const file = this.files[0];
                if (file){
                    designCaptureCover.show();
                    let reader = new FileReader();
                    reader.onload = function(event){
                        console.log(event.target.result);
                        $('#designCapturePreview').attr('src', event.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
            $('#removedesignCapture').click(function(){
                designCaptureCover.hide();
                $('#designCapturePreview').attr('src', '');
            })

            // $('#price').priceFormat({
            //     prefix: 'Rp',
            //     centsSeparator: ',',
            //     thousandsSeparator: '.',
            // });
            // $('#theme_cost').priceFormat({
            //     prefix: 'Rp',
            //     centsSeparator: ',',
            //     thousandsSeparator: '.',
            // });
            // $('#discount').priceFormat({
            //     prefix: 'Rp',
            //     centsSeparator: ',',
            //     thousandsSeparator: '.',
            // });
        })
    </script>
@endpush
