<?php

namespace App\Services;

use App\Models\User;

class RecommendationAlgorithm
{
    /**
     * Calculate similarity between two users based on their movie ratings.
     */
    private function calculateSimilarity(array $userA, array $userB): float
    {
        $commonItems = array_intersect_key($userA, $userB);

        if (empty($commonItems)) {
            return 0; // No common items, similarity is zero
        }

        $sumA = $sumB = $sumProduct = 0;

        foreach ($commonItems as $item => $ratingA) {
            $ratingB = $userB[$item];
            $sumA += $ratingA * $ratingA;
            $sumB += $ratingB * $ratingB;
            $sumProduct += $ratingA * $ratingB;
        }

        $denominator = sqrt($sumA) * sqrt($sumB);

        return $denominator == 0 ? 0 : $sumProduct / $denominator;
    }

    /**
     * Find similar users based on their movie ratings.
     */
    private function findSimilarUsers(array $targetUserPreferences, array $allUsers, int $topN = 5): array
    {
        $similarities = [];

        foreach ($allUsers as $userId => $preferences) {
            if ($userId !== $targetUserPreferences['user_id']) { // Don't compare with self
                $similarities[$userId] = $this->calculateSimilarity($targetUserPreferences['preferences'], $preferences['preferences']);
            }
        }

        // Sort by similarity score and get top N
        arsort($similarities);
        return array_slice($similarities, 0, $topN, true);
    }

    /**
     * Recommend movies based on similar users' preferences.
     */
    public function recommendMovies(int $userId, int $topN = 5): array
    {
        // Fetch the target user's preferences
        $targetUserPreferences = $this->getUserPreferences($userId);

        // Fetch all users and their preferences
        $allUsers = $this->getAllUsersPreferences();

        // Find similar users
        $similarUsers = $this->findSimilarUsers($targetUserPreferences, $allUsers, $topN);
        
        // Generate recommendations
        return $this->generateRecommendations($similarUsers, $targetUserPreferences['preferences'], $allUsers);
    }

    /**
     * Generate movie recommendations based on similar users' preferences.
     */
    private function generateRecommendations(array $similarUsers, array $targetUserPreferences, array $allUsers): array
    {
        $recommendations = [];

        foreach ($similarUsers as $similarUserId => $similarityScore) {
            $similarUserPreferences = $allUsers[$similarUserId]['preferences'];
            foreach ($similarUserPreferences as $movieId => $rating) {
                if (!isset($targetUserPreferences[$movieId])) { // Only recommend unseen movies
                    if (!isset($recommendations[$movieId])) {
                        $recommendations[$movieId] = 0;
                    }
                    // Weight the recommendation by similarity score
                    $recommendations[$movieId] += $rating * $similarityScore;
                }
            }
        }

        // Sort recommendations by score and return
        arsort($recommendations);
        return array_keys($recommendations); // Return movie IDs
    }

    /**
     * Get user preferences from the database.
     */
    private function getUserPreferences(int $userId): array
    {
        // Fetch the user's ratings for movies (assuming a User has a ratings relationship)
        $user = User::with('ratings')->find($userId);
        
        $preferences = [];
        foreach ($user->ratings as $rating) {
            $preferences[$rating->movie_id] = $rating->rating; // Use the 'rating' field from your ratings table
        }

        return [
            'user_id' => $userId,
            'preferences' => $preferences,
        ];
    }

    /**
     * Get all users' preferences from the database.
     */
    private function getAllUsersPreferences(): array
    {
        $users = User::with('ratings')->get();

        $allPreferences = [];

        foreach ($users as $user) {
            $preferences = [];
            foreach ($user->ratings as $rating) {
                $preferences[$rating->movie_id] = $rating->rating; // Use the 'rating' field
            }
            $allPreferences[$user->id] = [
                'user_id' => $user->id,
                'preferences' => $preferences,
            ];
        }

        return $allPreferences;
    }
}
