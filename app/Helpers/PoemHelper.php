<?php

namespace App\Helpers;

class PoemHelper
{
    /**
     * Format poem content for preview display
     * Shows specified number of lines in proper poem format
     */
    public static function formatPoemPreview(string $content, int $maxLines = 8): string
    {
        // Clean the content
        $content = strip_tags($content);
        
        // Split into lines
        $lines = preg_split('/\r\n|\r|\n/', $content);
        
        // Filter out empty lines
        $lines = array_filter($lines, function($line) {
            return trim($line) !== '';
        });
        
        // Take only the specified number of lines
        $previewLines = array_slice($lines, 0, $maxLines);
        
        // Join lines with proper line breaks
        return implode("\n", $previewLines);
    }
    
    /**
     * Format poem content for full display
     * Preserves original formatting and line breaks
     */
    public static function formatPoemContent(string $content): string
    {
        // Clean the content but preserve line breaks
        $content = strip_tags($content);
        
        // Split into lines
        $lines = preg_split('/\r\n|\r|\n/', $content);
        
        // Filter out empty lines but preserve structure
        $formattedLines = [];
        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            if ($trimmedLine !== '') {
                $formattedLines[] = $trimmedLine;
            } else {
                // Preserve empty lines for stanza breaks
                $formattedLines[] = '';
            }
        }
        
        return implode("\n", $formattedLines);
    }
    
    /**
     * Get poem excerpt for meta descriptions
     */
    public static function getPoemExcerpt(string $content, int $maxLength = 150): string
    {
        $content = strip_tags($content);
        $content = preg_replace('/\s+/', ' ', $content);
        
        if (strlen($content) <= $maxLength) {
            return $content;
        }
        
        return substr($content, 0, $maxLength) . '...';
    }
}
