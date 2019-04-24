<?php

namespace Collejo\App\Modules\Media\Repositories;

use Collejo\App\Modules\Media\Contracts\MediaRepositoryContract;
use Collejo\App\Modules\Media\Helpers\Bucket;
use Collejo\App\Modules\Media\Models\Media;
use Collejo\Foundation\Exceptions\DisplayableException;
use Collejo\Foundation\Repository\BaseRepository;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Exception;
use Storage;

class MediaRepository extends BaseRepository implements MediaRepositoryContract
{
    /**
     * Upload a file to a given bucket.
     *
     * @param UploadedFile $file
     * @param $bucketName
     *
     * @throws Exception
     *
     * @return mixed
     */
    public static function upload(UploadedFile $file, $bucketName)
    {
        if (!$file->isValid()) {
            throw new DisplayableException(trans('media::uploader.invalid_file'));
        }

        $bucket = Bucket::find($bucketName);

        if (!in_array($file->getMimeType(), $bucket->mimeTypes())) {
            throw new DisplayableException(trans('media::uploader.invalid_file_type'));
        }

        if ($file->getSize() > $bucket->maxSize()) {
            throw new DisplayableException(trans('media::uploader.invalid_file_size'));
        }

        $disk = Storage::disk($bucket->disk());

        $media = Media::create([
            'mime'   => $file->getMimeType(),
            'bucket' => $bucketName,
            'ext'    => $file->guessExtension(),
        ]);

        $disk->put($bucket->path().'/original/'.$media->fileName, File::get($file));

        if (is_array($bucket->resize())) {
            foreach ($bucket->resize() as $name => $size) {
                $temp = tempnam(storage_path('tmp'), 'tmp');

                Image::make(File::get($file))->fit($size[0], $size[1])->save($temp);

                $disk->put($bucket->path().'/'.$name.'/'.$media->fileName, File::get($temp));

                unlink($temp);
            }
        }

        return $media;
    }

    /**
     * Gets media file by id and bucket name.
     *
     * @param $id
     * @param $bucketName
     * @param $size
     *
     * @throws Exception
     */
    public static function getMedia($id, $bucketName, $size)
    {
        $media = Media::where(['id' => $id, 'bucket' => $bucketName])->first();

        if (is_null($media)) {
            return abort(404);
        }

        $bucket = Bucket::find($bucketName);

        $disk = Storage::disk($bucket->disk());

        if ($disk->exists($bucket->path().'/'.$size.'/'.$media->fileName)) {
            return response($disk->get($bucket->path().'/'.$size.'/'.$media->fileName))->header('Content-type', $media->mime);
        }

        abort(404);
    }
}
