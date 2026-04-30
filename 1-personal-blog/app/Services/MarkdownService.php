<?php
// app/Services/MarkdownService.php
namespace App\Services;

use League\CommonMark\CommonMarkConverter;

class MarkdownService
{
    protected $converter;

    public function __construct()
    {
        $this->converter = new CommonMarkConverter();
    }

    public function toHtml(string $markdown): string
    {
        return $this->converter->convert($markdown)->getContent();
    }
}
