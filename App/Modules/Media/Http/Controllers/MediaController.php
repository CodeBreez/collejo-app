<?php

namespace Collejo\App\Modules\Media\Http\Controllers;

use Collejo\App\Http\Controller;
use Collejo\App\Modules\Media\Contracts\MediaRepositoryContract as MediaRepository;
use Exception;
use Request;

class MediaController extends Controller
{
    private $mediaRepository;

    /**
     * Uploads a file.
     *
     * @param Request $request
     *
     * @throws Exception
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpload(Request $request)
    {
        if ($request::hasFile('file')) {
            $media = $this->mediaRepository->upload($request::file('file'), $request::get('bucket'));

            return $this->printJson(true, [
                'media' => $media,
            ]);
        }

        throw new Exception('a file must be uploaded');
    }

    /**
     * Retrieves a file by path
     * If the file is an image retrieve the resized version of it.
     *
     * @param $bucketName
     * @param $fileName
     *
     * @return mixed
     */
    public function getMedia($bucketName, $fileName)
    {
        $parts = explode('.', $fileName);
        $parts = explode('_', $parts[0]);

        if (!count($parts)) {
            abort(404);
        }

        $id = $parts[0];
        $size = isset($parts[1]) ? $parts[1] : 'original';

        return $this->mediaRepository->getMedia($id, $bucketName, $size);
    }

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }
}
