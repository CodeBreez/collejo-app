<?php

namespace Collejo\App\Modules\Media\Http\Controllers;

use Collejo\App\Http\Controllers\Controller;
use Request;
use Uploader;

class MediaController extends Controller
{

	public function postUpload(Request $request)
	{

		if ($request::hasFile('file')) {

			$media = Uploader::upload($request::file('file'), $request::get('bucket'));

			return $this->printPartial(view('media::partials.file', [
										'media' => $media, 
										'maxFiles' => intval($request::get('max')),
										'fieldName' => $request::get('name')
									]));
		}

		throw new \Exception('a file must be uploaded');
	}

	public function getMedia($bucketName, $fileName)
	{
		$parts = explode('.', $fileName);
		$parts = explode('_', $parts[0]);

		if (!count($parts)) {
			abort(404);
		}

		$id = $parts[0];
		$size = isset($parts[1]) ? $parts[1] : 'original';

		return Uploader::getMedia($id, $bucketName, $size);
	}
}
