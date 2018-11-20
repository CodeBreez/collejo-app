<?php

namespace Collejo\App\Modules\Media\Contracts;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface MediaRepositoryContract
{

    public static function upload(UploadedFile $file, $bucketName);

    public static function getMedia($id, $bucketName, $size);
}
