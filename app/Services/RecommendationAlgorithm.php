<?php

namespace App\Services;

use App\Models\User;
use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Support\Collection;

class RecommendationAlgorithm
{
    public function getRecommendations(User $user, int $numRecommendations = 5)
    {
        // Step 1: Calculate similarity between users
        $similarUsers = $this->calculateSimilarity($user);

        // Step 2: Identify nearest neighbors (users with the highest similarity)
        $nearestNeighbors = $this->getNearestNeighbors($similarUsers, $numRecommendations);

        // Step 3: Generate recommendations
        $recommendations = [];
        foreach ($nearestNeighbors as $neighborId => $similarity) {
            $neighbor = User::find($neighborId);

            // Get movies rated by the neighbor but not rated by the user
            $moviesRatedByNeighbor = Rating::where('user_id', $neighbor->id)
                ->whereNotIn('movie_id', $user->ratings->pluck('movie_id'))
                ->get();

            foreach ($moviesRatedByNeighbor as $rating) {
                if (!isset($recommendations[$rating->movie_id])) {
                    $recommendations[$rating->movie_id] = 0;
                }
                // Weighted rating based on similarity
                $recommendations[$rating->movie_id] += $rating->rating * $similarity;
            }
        }

        // Step 4: Sort recommendations by weighted rating and return top results
        arsort($recommendations);

        // Return the top N recommendations (by movie IDs and their predicted ratings)
        return array_slice($recommendations, 0, $numRecommendations, true);
    }

    private function calculateSimilarity(User $user)
    {
        $similarUsers = [];
        $userRatings = $user->ratings->pluck('rating', 'movie_id');

        // Compare this user with every other user
        foreach (User::where('id', '!=', $user->id)->get() as $otherUser) {
            $otherUserRatings = $otherUser->ratings->pluck('rating', 'movie_id');
            $commonMovies = $userRatings->keys()->intersect($otherUserRatings->keys());

            // Only calculate similarity if they have rated common movies
            if ($commonMovies->count() > 0) {
                $similarity = $this->calculatePearsonCorrelation(
                    $userRatings->only($commonMovies),
                    $otherUserRatings->only($commonMovies)
                );

                // Only add if similarity is valid (not NaN or 0)
                if (!is_nan($similarity) && $similarity > 0) {
                    $similarUsers[$otherUser->id] = $similarity;
                }
            }
        }

        return $similarUsers;
    }

    private function getNearestNeighbors(array $similarUsers, int $numNeighbors)
    {
        // Sort by similarity in descending order and get the top N neighbors
        arsort($similarUsers);

        // Limit to the top N neighbors
        return array_slice($similarUsers, 0, $numNeighbors, true);
    }

    private function calculatePearsonCorrelation(Collection $userRatings, Collection $otherUserRatings)
    {
        $n = $userRatings->count();

        if ($n === 0) {
            return 0; // No common movies to compare
        }

        $sum1 = $userRatings->sum();
        $sum2 = $otherUserRatings->sum();
        $sum1Sq = $userRatings->sum(fn($rating) => $rating ** 2);
        $sum2Sq = $otherUserRatings->sum(fn($rating) => $rating ** 2);
        $pSum = $userRatings->zip($otherUserRatings)->sum(fn($pair) => $pair[0] * $pair[1]);

        $num = $pSum - (($sum1 * $sum2) / $n);
        $den = sqrt(($sum1Sq - ($sum1 ** 2) / $n) * ($sum2Sq - ($sum2 ** 2) / $n));

        return ($den == 0) ? 0 : $num / $den;
    }
}
