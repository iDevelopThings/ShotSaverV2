@extends('layouts.app')

@section('meta')
    @include('file.meta-tags', ['file' => $file])
@endsection

@section('css')

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    @if($file->type === 'code')
        <link rel="stylesheet"
              href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/styles/atom-one-dark.min.css">
    @endif

@endsection

@section('content')
    @if($file->status === 'processing')
        <div class="container text-center">
            <h4>File is still processing...</h4>
            <p>We will refresh this page when it's complete.</p>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body d-inline-flex align-items-center ">
                            <div class="flex-grow-1">
                                <h4 class="">{{$file->name}}</h4>

                                <ul class="list-inline mb-0">
                                    <li class="list-inline-item">
                                        @if($file->type === 'code')
                                            <div class="badge badge-primary">{{$file->meta['name']}}</div>
                                        @else
                                            <div class="badge badge-primary">{{$file->type}}</div>
                                        @endif
                                    </li>
                                    <li class="list-inline-item">
                                        File Size:
                                        <div class="badge badge-primary">{{$file->formatSizeUnits()}}</div>
                                    </li>
                                    <li class="list-inline-item">
                                        Privacy:
                                        <div class="badge badge-primary">{{$file->private ? 'Private' : 'Public'}}</div>
                                    </li>
                                </ul>
                            </div>


                            @guest
                                <button class="btn btn-outline-primary mr-4"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Log in or Register to favourite this file.">
                                    <i class="far fa-star"></i> Favourite
                                </button>
                            @else
                                @if(auth()->id() === $file->user_id)
                                    <button class="btn btn-outline-success mr-4"
                                            data-toggle="modal"
                                            data-target="#edit-file">
                                        <i class="fas fa-edit"></i> Edit File
                                    </button>
                                @endif

                                <form action="{{route('favourite-file', $file)}}" method="post">
                                    @csrf
                                    @if($file->hasFavourited())
                                        <button class="btn btn-outline-primary mr-4">
                                            <i class="far fa-star"></i> Favourite
                                        </button>
                                    @else
                                        <button class="btn btn-primary mr-4">
                                            <i class="fas fa-star"></i> Un Favourite
                                        </button>
                                    @endif
                                </form>
                            @endguest
                            <a href="{{route('download-file', $file)}}" class="btn btn-dark">
                                <i class="fas fa-download"></i> Download
                            </a>
                        </div>
                    </div>

                    @if($file->type === 'video')

                        <div class="video-container">
                            <video class="afterglow"
                                   id="myvideo"
                                   width="1920"
                                   height="1080"
                                   poster="{{$file->file('thumb')}}">
                                <source type="video/mp4" src="{{$file->file('sd')}}" />
                                <source type="video/mp4" src="{{$file->file('hd')}}" data-quality="hd" />
                            </video>
                        </div>

                    @elseif($file->type === 'image')

                        <div class="image-container" style="background-image: url('{{$file->file('hd')}}')">
                            <div class="image-overlay">
                                <img src="{{$file->file('hd')}}" alt="" class="img-fluid">
                            </div>
                        </div>

                    @elseif($file->type === 'code')
                        <div class="code-container">
                            <pre><code>{{$file->codeFileContents()}}</code></pre>
                        </div>
                    @endif

                    <div class="my-5">
                        <p>{{$file->description ?? 'No Description'}}</p>
                        @if(!auth()->guest())
                            <a
                                data-toggle="modal"
                                data-target="#edit-file" href="javascript:;">Edit Description</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade"
             id="edit-file"
             tabindex="-1"
             role="dialog"
             aria-labelledby="edit-fileLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form action="{{route('edit-file', $file)}}" method="post">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="edit-fileLabel">Edit File</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea type="text"
                                          name="description"
                                          id="description"
                                          class="form-control"
                                          placeholder="Enter a description about this file">{{$file->description}}</textarea>
                            </div>


                            <label for="private" class="mr-4">Privacy</label>
                            <input type="checkbox"
                                   name="private"
                                   {{$file->private ? 'checked' : ''}} id="toggle">
                            <p class="mt-3">
                                If this file is public, anybody with the link can view it.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    @endif
@endsection

@section('js')
    @if($file->status === 'processing')
        <script>
            setTimeout(function () {
                window.location = window.location;
            }, 2500)
        </script>
    @else

        @if($file->type === 'video')
            <script src="//cdn.jsdelivr.net/npm/afterglowplayer@1.x"></script>
        @elseif($file->type === 'code')
            <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.15.10/highlight.min.js"></script>
            <script src="//cdn.jsdelivr.net/npm/highlightjs-line-numbers.js@2.7.0/dist/highlightjs-line-numbers.min.js"></script>

            <script>
                hljs.initHighlightingOnLoad();
                hljs.initLineNumbersOnLoad();

            </script>
        @endif

        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script>
            $(function () {
                $('#toggle').bootstrapToggle({
                    on       : 'Private',
                    off      : 'Public',
                    onstyle  : 'success',
                    offstyle : 'danger',
                    width    : 100
                });
            })
        </script>
    @endif


@endsection
