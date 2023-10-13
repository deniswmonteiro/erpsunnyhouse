<div class="tab-pane fade show @if ($i == 0) active @endif"
    id="pills-image-{{$images_types[$i]['class']}}-{{$gen_key + 1}}" 
    role="tabpanel" 
    aria-labelledby="pills-image-tab-{{$images_types[$i]['class']}}-{{$gen_key + 1}}">
    <div class="card">
        <div class="card-body ps-0 pe-0" id="card-{{$images_types[$i]['class']}}-{{$gen_key + 1}}">
            <div class="row">
                <div class="col-12">
                    <ul class="custom-control">
                        @foreach ($arr_images as $key => $image)
                            @if ($image->type == $images_types[$i]['type'])
                                <li id="generator-thumbnail-{{$gen_key + 1}}-{{$key + 1}}">
                                    <img src="{{asset('/images/engineering/' . Str::of($image->image_generator_path)->substr(13))}}" alt="{{$image->name}}">
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="slide-wrapper">
                        <ul class="slide">
                            @foreach ($arr_images as $key => $image)
                                @if ($image->exists() && $image->type == $images_types[$i]['type'])
                                    <li id="generator-image-{{$gen_key + 1}}-{{$key + 1}}">
                                        <img src="{{asset('/images/engineering/' . Str::of($image->image_generator_path)->substr(13))}}" alt="{{$image->name}}">
                                        <h6 class="mt-3">{{$image->name}}</h6>
                                        <button type="button" class="btn bg-danger text-white mt-3"
                                            id="btn-delete-generator-image-{{$gen_key + 1}}-{{$key + 1}}"
                                            value={{encrypt($image->id)}}
                                            onclick="return window.removeGeneratorImage(this)"
                                            onmousedown="return event.stopPropagation()"
                                            onmouseup="return event.stopPropagation()">
                                            <i class="bi bi-trash-fill"></i>

                                            <div class="spinner-border spinner-border-sm text-white d-none"
                                                id="btn-delete-generator-image-loading-{{$gen_key + 1}}-{{$key + 1}}"
                                                role="status">
                                                <span class="visually-hidden">
                                                    Loading...
                                                </span>
                                            </div>
                                        </button>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>