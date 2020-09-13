<?php

namespace App\Http\Controllers;

use App\File;
use App\Http\Resources\FileResource;
use App\Jobs\ProcessFile;
use App\Services\FileValidation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use function auth;

class FileController extends Controller
{
	/**
	 * Allow the user to view all of their uploads
	 *
	 * @return Factory|View
	 */
	public function uploads()
	{
		return view('file.uploads');
	}

	/**
	 * Allow the user to view their favourites
	 *
	 * @return Application|Factory|View
	 */
	public function favourites()
	{
		return view('file.favourites');
	}

	/**
	 * View a specific file
	 *
	 * @param $file
	 *
	 * @return Factory|View
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
	 * Get a url for a specific file
	 *
	 * @param $file
	 *
	 * @return Factory|View
	 */
	public function getUrl(File $file, $name)
	{

		if(!in_array($name, ['hd', 'sd', 'thumb', 'thumb_hd']))
			abort(404);

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

		/*Storage::cloud()->temporaryUrl(
			'file1.jpg', Carbon::now()->addMinutes(5)
		);*/



		return Storage::cloud()->download($file->{$name}, "{$name}.{$file->extension}");
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
		$fileName = Str::random() . '.' . $file->getClientOriginalExtension();
		$originalFileLocation = $file->storeAs('files-to-process/' . $directory, $fileName);

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
	 * @return AnonymousResourceCollection
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
	 * Return a list of the users favourited files
	 *
	 * @return AnonymousResourceCollection
	 */
	public function listFavourites()
	{
		$user = auth()->user();

		$files = $user->favouriteFiles()
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
	 * @return JsonResponse
	 */
	public function favouriteToggle(File $file)
	{
		if ($file->private && auth()->id() !== $file->user_id) {
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

	/**
	 * @param File $file
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function edit(File $file)
	{
		if (auth()->id() !== $file->user_id) {
			abort(404);
		}
		$private    = request('private');
		$is_private = ($private === null ? false : true);

		if ($file->private !== $is_private) {
			if ($is_private) {
				$file->setPrivate();
			} else {
				$file->setPublic();
			}
		}

		$file->description = request('description');
		$file->private     = ($private === null ? false : true);
		$file->save();


		return back();
	}
}
