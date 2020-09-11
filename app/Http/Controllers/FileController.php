<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Resources\FileResource;
use App\Jobs\ProcessFile;
use App\Services\FileValidation;
use BoyHagemann\Waveform\Waveform;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PHPVideoToolkit\Config;
use PHPVideoToolkit\ProgressHandlerPortable;

class FileController extends Controller
{
    /**
     * Allow the user to view all of their uploads
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function uploads()
    {
        return view('file.uploads');
    }

    /**
     * View a specific file
     *
     * @param $file
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function view($file)
    {
        $file = File::where('name', $file)->first();

        if (!$file) {
            abort(404);
        }

        if ($file->private) {
            if (!auth()->user()) {
                abort(404);
            }
            if (auth()->id() !== $file->user_id) {
                abort(404);
            }
        }

        $file->saveView();

        return view('file.view-file', [
            'file' => $file,
        ]);
    }

    /**
     * Upload a file to shotsaver
     *
     * @return string
     */
    public function upload()
    {
        $user = auth()->user();

        $file = request()->file('file');

        if (!$file) {
            return "No file uploaded.";
        }

        $directory = Str::random();

        $originalFileLocation = $file->storeAs('files-to-process/' . $directory, Str::random() . '.' . $file->getClientOriginalExtension());

        $fileModel = File::create([
            'user_id' => $user->id,
            'name'    => $directory,
            'private' => $user->private_uploads,
            'type'    => app(FileValidation::class)->fileType($file->getMimeType()),
        ]);

        dispatch(new ProcessFile($fileModel, $user->id, $originalFileLocation, $directory));

        return route('view-file', $fileModel->name);
    }

    /**
     * Return a list of the users uploaded files
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function listFiles()
    {
        $user = auth()->user();

        $files = $user->files()
            ->withCount('views')
            ->withCount('favourites as total_favourites')
            ->withCount([
                'favourites as favourited' => function ($query) {
                    $query->where('user_id', request()->user('api')->id);
                },
            ])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return FileResource::collection($files);
    }

    /**
     * Toggles "favourited" for this file
     *
     * @param File $file
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function favouriteToggle(File $file)
    {
        if ($file->private && \auth()->id() !== $file->user_id) {
            return response()->json(['message' => 'You do not have permission to favourite this file.'], 401);
        }

        $favourited = $file->favourite();

        if (request()->isJson() || request()->isXmlHttpRequest()) {
            return response()->json([
                'favourited'       => $favourited,
                'total_favourites' => $file->favourites()->count(),
            ]);
        }

        return redirect()->back();
    }

    public function delete(File $file)
    {
        if ($file->user_id !== auth()->id()) {
            abort(404);
        }

        Storage::cloud()->deleteDirectory($file->name);
        $file->delete();

        if (request()->isJson() || request()->isXmlHttpRequest()) {
            return response()->json(['message' => 'Successfully deleted file']);
        }

        return redirect()->route('home')->with('success', 'Successfully deleted file');
    }

    public function download(File $file)
    {
        if ($file->private) {
            if (!auth()->user()) {
                abort(404);
            }
            if (auth()->id() !== $file->user_id) {
                abort(404);
            }
        }

        return Storage::cloud()->download($file->hd, "{$file->name}.{$file->extension}");
    }

    public function downloadLowDef(File $file)
    {
        if ($file->private) {
            if (!auth()->user()) {
                abort(404);
            }
            if (auth()->id() !== $file->user_id) {
                abort(404);
            }
        }

        return Storage::cloud()->download($file->sd, "{$file->name}.{$file->extension}");
    }

    public function edit(File $file)
    {
        if (auth()->id() !== $file->user_id) {
            abort(404);
        }

        $private           = request('private');
        $file->description = request('description');
        $file->private     = ($private === null ? false : true);
        $file->save();

        return back();
    }
}
