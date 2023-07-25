<?php

namespace App\ValueObjects\Concretes;

use App\ValueObjects\ValueObject;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class File extends ValueObject
{

    protected UploadedFile $value;

    protected function __construct(protected readonly string $path)
    {
        $this->value = new UploadedFile(
            Storage::disk('public')->path($path),
            basename($this->path)
        );

        $this->validate();
    }

    public function value(): UploadedFile
    {
        return $this->value;
    }

    public function filename(): string
    {
        return $this->value->getClientOriginalName();
    }

    public function extension(): string
    {
        return $this->value->getClientOriginalExtension();
    }

    public function size(): int
    {
        return $this->value->getSize();
    }

    public function mimeType(): string
    {
        return $this->value->getMimeType();
    }

    public function absolutePath(): string
    {
        return $this->value->getRealPath();
    }

    public function path(): string
    {
        return $this->path;
    }

    public function toArray(): array
    {
        return [
            'filename' => $this->filename(),
            'extension' => $this->extension(),
            'size' => $this->size(),
            'mime_type' => $this->mimeType(),
            'absolute_path' => $this->absolutePath(),
            'path' => $this->path(),
        ];
    }

    public function validate(): void
    {
        if (Storage::disk('public')->exists($this->path)) {
            throw new \Exception("The file {$this->path} exist.");
        }
        if (!$this->value->isFile()) {
            throw new \Exception("The file {$this->path} is not a file.");
        }
    }
}
