<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UploadService
{
    /**
     * Allowed image MIME types and their extensions
     */
    protected const ALLOWED_MIMES = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/webp' => 'webp',
        'image/gif' => 'gif',
    ];

    /**
     * Maximum file sizes per context (in KB)
     */
    protected const MAX_SIZES = [
        'default' => 2048,    // 2MB
        'logo' => 512,        // 512KB
        'favicon' => 64,      // 64KB
        'og_image' => 1024,   // 1MB
        'product' => 2048,    // 2MB
        'category' => 2048,   // 2MB
        'slider' => 2048,     // 2MB
        'banner' => 2048,     // 2MB
        'about' => 2048,      // 2MB
        'landing' => 2048,    // 2MB
    ];

    /**
     * Upload a file with secure validation
     *
     * @param UploadedFile $file
     * @param string $folder Target folder under public/uploads/
     * @param string $context Context for size limits (default, logo, favicon, etc.)
     * @return string Saved filename
     * @throws ValidationException
     */
    public function upload(UploadedFile $file, string $folder, string $context = 'default'): string
    {
        $this->validateFile($file, $context);

        // Determine extension from MIME type (not user input)
        $extension = self::ALLOWED_MIMES[$file->getMimeType()] ?? 'jpg';

        // Generate secure filename
        $filename = Str::uuid() . '.' . $extension;

        // Ensure directory exists
        $directory = public_path('uploads/' . $folder);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
        $this->createHtaccess($directory);

        // Move file
        $file->move($directory, $filename);

        return $filename;
    }

    /**
     * Delete a file
     */
    public function delete(string $filename, string $folder): bool
    {
        $path = public_path('uploads/' . $folder . '/' . $filename);
        if (file_exists($path)) {
            return unlink($path);
        }
        return true;
    }

    /**
     * Validate uploaded file
     */
    protected function validateFile(UploadedFile $file, string $context): void
    {
        $mime = $file->getMimeType();
        $maxSize = self::MAX_SIZES[$context] ?? self::MAX_SIZES['default'];

        // Check MIME type
        if (!isset(self::ALLOWED_MIMES[$mime])) {
            throw ValidationException::withMessages([
                'file' => 'Invalid file type. Allowed: JPEG, PNG, WebP, GIF.',
            ]);
        }

        // Check file size
        if ($file->getSize() > $maxSize * 1024) {
            throw ValidationException::withMessages([
                'file' => "File size exceeds {$maxSize}KB limit.",
            ]);
        }

        // Additional security: verify file content matches MIME
        $this->verifyFileContent($file, $mime);
    }

    /**
     * Verify file content matches declared MIME type
     */
    protected function verifyFileContent(UploadedFile $file, string $expectedMime): void
    {
        $content = file_get_contents($file->getRealPath(), false, null, 0, 32);
        
        // JPEG: FF D8 FF
        if ($expectedMime === 'image/jpeg' && !preg_match('/^\xFF\xD8\xFF/', $content)) {
            throw ValidationException::withMessages(['file' => 'Invalid JPEG file.']);
        }
        // PNG: 89 50 4E 47 0D 0A 1A 0A
        if ($expectedMime === 'image/png' && !preg_match('/^\x89PNG\r\n\x1A\n/', $content)) {
            throw ValidationException::withMessages(['file' => 'Invalid PNG file.']);
        }
        // WebP: RIFF....WEBP
        if ($expectedMime === 'image/webp' && !preg_match('/^RIFF.{4}WEBP/', $content)) {
            throw ValidationException::withMessages(['file' => 'Invalid WebP file.']);
        }
        // GIF: GIF87a or GIF89a
        if ($expectedMime === 'image/gif' && !preg_match('/^GIF8[79]a/', $content)) {
            throw ValidationException::withMessages(['file' => 'Invalid GIF file.']);
        }
    }

    /**
     * Create .htaccess to prevent PHP execution in upload directory
     */
    public function createHtaccess(string $directory): void
    {
        $htaccessPath = $directory . '/.htaccess';
        if (!file_exists($htaccessPath)) {
            $content = <<<HTACCESS
# Prevent PHP execution
<FilesMatch "\.(php|phtml|phar|php\d)$">
    Require all denied
</FilesMatch>

# Disable PHP engine
php_flag engine off

# Prevent script execution
AddHandler cgi-script .php .phtml .phar
Options -ExecCGI
HTACCESS;
            file_put_contents($htaccessPath, $content);
        }
    }

    /**
     * Get allowed extensions for validation rules
     */
    public static function getAllowedExtensions(): array
    {
        return array_values(self::ALLOWED_MIMES);
    }

    /**
     * Get max size for context
     */
    public static function getMaxSize(string $context = 'default'): int
    {
        return self::MAX_SIZES[$context] ?? self::MAX_SIZES['default'];
    }
}