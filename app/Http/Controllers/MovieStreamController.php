<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\StreamedResponse;

class MovieStreamController extends Controller
{
    /**
     * Stream the specific quality variant of the HLS playlist
     *
     * @param int $id
     * @param string $quality
     * @return StreamedResponse
     */
    public function stream($id, $quality)
    {
        $movie = Movie::findOrFail($id); // Use findOrFail to handle cases where the movie is not found

        $filename = $movie->title;

        $baseDirectory = public_path('movies');


        // Define the full path to the HLS quality variant playlist
        $filePath = "{$baseDirectory}/{$filename}_hls/{$quality}"; // assuming each quality has its own directory

        // Check if the HLS playlist file exists
        if (!File::exists($filePath)) {
            abort(404, 'Playlist not found.');
        }

        // Create a streamed response to serve the file
        $response = new StreamedResponse(function () use ($filePath) {
            $stream = fopen($filePath, 'r');
            fpassthru($stream);
            fclose($stream);
        });

        // Set headers to indicate the content type and disposition
        $response->headers->set('Content-Type', 'application/vnd.apple.mpegurl');
        $response->headers->set('Content-Disposition', 'inline; filename="' . basename($filePath) . '"');

        return $response;
    }

    /**
     * Stream the master HLS playlist
     *
     * @param int $id
     * @return StreamedResponse
     */
    public function streamVideo($id)
    {
        $movie = Movie::findOrFail($id); // Use findOrFail to handle cases where the movie is not found
        $filename = $movie->title;

        $baseDirectory = public_path('movies');

        // Define the full path to the HLS master playlist
        $filePath = "{$baseDirectory}/{$filename}_hls/master.m3u8";

        // Check if the HLS master playlist file exists
        if (!File::exists($filePath)) {
            abort(404, 'Master playlist not found.');
        }

        // Create a streamed response to serve the file
        $response = new StreamedResponse(function () use ($filePath) {
            $stream = fopen($filePath, 'r');
            fpassthru($stream);
            fclose($stream);
        });

        // Set headers to indicate the content type and disposition
        $response->headers->set('Content-Type', 'application/vnd.apple.mpegurl');
        $response->headers->set('Content-Disposition', 'inline; filename="' . basename($filePath) . '"');

        return $response;
    }
}
