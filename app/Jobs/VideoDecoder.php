<?php

namespace App\Jobs;

use Exception;
use App\Models\Movie;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class VideoDecoder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $videoFilename;
    protected $movieName;

    /**
     * Create a new job instance.
     *
     * @param string $videoFilename
     * @param string $movieName
     */
    public function __construct($videoFilename, $movieName)
    {
        $this->videoFilename = $videoFilename;
        $this->movieName = $movieName;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        set_time_limit(0); // Set an unlimited execution time limit if necessary

        // Retrieve the movie record
        $movie = Movie::where('title', $this->movieName)->first();
        if (!$movie) {
            throw new Exception("Movie not found: " . $this->movieName);
        }

        // Initialize progress
        $this->updateProgress($movie, 0);

        try {
            // Step 1: Start processing (e.g., video decoding)
            $this->updateProgress($movie, 25);
            Artisan::call('video:process', [
                'videoFilename' => $this->videoFilename,
                'movieName' => $this->movieName,
            ]);

            // Check if command was successful
            $output = Artisan::output();
            if (strpos($output, 'Video processing completed successfully.') === false) {
                throw new Exception("Video processing failed. Output: $output");
            }

            // Step 2: Further processing steps
            $this->updateProgress($movie, 50);
            // Simulate additional steps like thumbnail generation
            sleep(2); // Replace with actual processing

            // Step 3: Final steps
            $this->updateProgress($movie, 75);
            // Simulate finalization
            sleep(2); // Replace with actual processing

            // Processing completed
            $this->updateProgress($movie, 100);
            
        } catch (Exception $e) {
            $this->updateProgress($movie, -1); // Indicate an error
            throw new Exception("Video processing failed: " . $e->getMessage());
        }
    }

    /**
     * Update the progress of the video processing.
     *
     * @param \App\Models\Movie $movie
     * @param int $progress
     * @return void
     */
    protected function updateProgress(Movie $movie, int $progress)
    {
        $movie->update(['processing_progress' => $progress]);
    }
}
