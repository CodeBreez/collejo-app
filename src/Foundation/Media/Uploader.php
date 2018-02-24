<?php

namespace Collejo\App\Foundation\Media;

use Collejo\App\Models\Media;
use Illuminate\Support\Facades\File;
use Image;
use Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Uploader
{
    public static function renderUploader($model, $relationship, $fieldName, $bucketName, $maxFiles = false)
    {
        return view('media::upload', [
                            'id'           => str_random(),
                            'model'        => $model,
                            'relationship' => $relationship,
                            'fieldName'    => $fieldName,
                            'bucketName'   => $bucketName,
                            'maxFiles'     => $maxFiles,
                        ])->render();
    }

    public static function upload(UploadedFile $file, $bucketName)
    {
        if (!$file->isValid()) {
            throw new \Exception(trans('validation.invalid_file'));
        }

        $bucket = Bucket::find($bucketName);

        if (!empty($bucket->mimeTypes()) && !in_array($file->getMimeType(), $bucket->mimeTypes())) {
            throw new \Exception(trans('validation.invalid_file_type'));
        }

        if (!empty($bucket->maxSize()) && !in_array($file->getClientSize(), $bucket->maxSize())) {
            throw new \Exception(trans('validation.invalid_file_size'));
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
