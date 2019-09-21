<?php


namespace App\Services;


class FileValidation
{

    public function fileType($mimeType)
    {
        switch ($mimeType) {
            case strstr($mimeType, "video/"):
                return "video";
                break;
            case strstr($mimeType, "image/gif"):
            case strstr($mimeType, "image/jpe"):
            case strstr($mimeType, "image/jpeg"):
            case strstr($mimeType, "image/jpg"):
            case strstr($mimeType, "image/png"):
            case strstr($mimeType, "image/bmp"):
                return "image";
                break;
            case strstr($mimeType, "audio/"):
                return "audio";
                break;
            case strstr($mimeType, "text/"):
                return "text";
                break;
            case strstr($mimeType, "application/x-gtar"):
            case strstr($mimeType, "application/zip"):
            case strstr($mimeType, "application/x-rar-compressed"):
            case strstr($mimeType, "application/x-7z-compressed"):
                return "compressed";
                break;
        }

        return null;
    }

    public function isCodeFile($extension)
    {
        $types = [
            'ABAP'                => 'abap',
            'Windows Bat'         => 'bat',
            'BibTeX'              => 'bibtex',
            'Clojure'             => 'clojure',
            'Coffeescript'        => 'coffeescript',
            'C'                   => 'c',
            'C++'                 => 'cpp',
            'C#'                  => 'csharp',
            'CSS'                 => 'css',
            'Diff'                => 'diff',
            'Dockerfile'          => 'dockerfile',
            'F#'                  => 'fsharp',
            'Git'                 => ['git-commit', 'git-rebase'],
            'Go'                  => 'go',
            'Groovy'              => 'groovy',
            'Handlebars'          => 'handlebars',
            'HTML'                => 'html',
            'Ini'                 => 'ini',
            'Java'                => 'java',
            'JavaScript'          => ['javascript', 'js'],
            'JSON'                => 'json',
            'JSON with Comments'  => 'jsonc',
            'LaTeX'               => 'latex',
            'Less'                => 'less',
            'Lua'                 => 'lua',
            'Makefile'            => 'makefile',
            'Markdown'            => 'markdown',
            'Objective-C'         => 'objective-c',
            'Objective-C++'       => 'objective-cpp',
            'Perl'                => ['perl', 'perl6'],
            'PHP'                 => 'php',
            'Powershell'          => 'powershell',
            'Pug'                 => 'jade',
            'Python'              => ['python', 'py'],
            'R'                   => 'r',
            'Razor (cshtml)'      => 'razor',
            'Ruby'                => 'ruby',
            'Rust'                => 'rust',
            'SCSS'                => ['scss', 'sass'],
            'ShaderLab'           => 'shaderlab',
            'Shell Script (Bash)' => 'shellscript',
            'SQL'                 => 'sql',
            'Swift'               => 'swift',
            'TypeScript'          => ['typescript', 'ts'],
            'TeX'                 => 'tex',
            'Visual Basic'        => 'vb',
            'XML'                 => 'xml',
            'XSL'                 => 'xsl',
            'YAML'                => 'yaml',
            'VueJS'               => 'vue',
            'ReactJS'             => 'jsx',
        ];

        $extension = \strtolower($extension);

        foreach ($types as $extensionName => $extensionType) {
            if (is_array($extensionType)) {
                if (in_array($extension, $extensionType)) {
                    return [
                        'name'      => $extensionName,
                        'extension' => $extensionType,
                    ];
                }
            } else {
                if ($extensionType === $extension) {
                    return [
                        'name'      => $extensionName,
                        'extension' => $extensionType,
                    ];
                }
            }
        }


    }

}
