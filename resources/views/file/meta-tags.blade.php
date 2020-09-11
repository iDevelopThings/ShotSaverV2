<meta content="{{request()->fullUrl()}}" property="og:url" />

@if($file->type == 'image')
    <meta name="twitter:card" content="summary_large_image" />
    <meta property="og:image" content="{{$file->file('hd')}}">
    <meta property="og:image:type" content="{{$file->extension}}">
    <meta property="og:type" content="image">


    <meta property="og:image:width" content="{{$file->meta['hd']['dimensions'][0]}}" />
    <meta property="og:image:height" content="{{$file->meta['hd']['dimensions'][1]}}" />
    <meta content="article" property="og:type" />
@endif

<meta name="theme-color" content="#0084da">
<meta name="twitter:site" content="@ShotSaver" />
<meta name="twitter:title" content="ShotSaver" />
<meta name="og:site_name" content="ShotSaver" />
<meta name="twitter:description" content="{{ucfirst($file->type)}} uploaded to ShotSaver by {{$file->user->name}}" />
<meta name="description" content="Check out this video on Streamable using your phone, tablet or desktop.">
<meta property="og:description" content="{{ucfirst($file->type)}} uploaded to ShotSaver by {{$file->user->name}}" />

@if($file->type == 'video')
    <meta property="og:type" content="video.other">
    <meta property="og:image" content="{{$file->file('thumb')}}" />
    <meta property="og:image:secure_url" content="{{$file->file('thumb')}}" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="{{$file->meta['hd']['dimensions'][0]}}">
    <meta property="og:image:height" content="{{$file->meta['hd']['dimensions'][1]}}">

    <meta property="og:updated_time" content="{{$file->created_at->toAtomString() }}" />
    <meta property="og:video" content="{{$file->file('hd')}}">
    <meta property="og:video:url" content="{{$file->file('hd')}}">
    <meta property="og:video:secure_url" content="{{$file->file('hd')}}">
    <meta property="og:video:type" content="video/mp4">
    <meta property="og:video:width" content="{{$file->meta['hd']['dimensions'][0]}}">
    <meta property="og:video:height" content="{{$file->meta['hd']['dimensions'][1]}}">
    <meta name="twitter:card" content="player">
    <meta name="twitter:site" content="@ShotSaver">
    <meta name="twitter:image" content="{{$file->file('thumb')}}">
    <meta name="twitter:player:width" content="{{$file->meta['hd']['dimensions'][0]}}">
    <meta name="twitter:player:height" content="{{$file->meta['hd']['dimensions'][1]}}">
    {{--<meta name="twitter:player" content="{{route('file-twitter', ['file' => $file->name])}}">--}}
    <meta name="twitter:player:stream" content="{{$file->file('hd')}}">
    <meta name="twitter:player:stream:content_type" content="video/mp4">
@endif
