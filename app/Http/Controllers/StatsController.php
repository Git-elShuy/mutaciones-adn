<?php
namespace App\Http\Controllers;
use App\Models\Adn;
use Illuminate\Support\Facades\Redis;
class StatsController extends Controller{
    public function stats() {
    $count_mutations = Adn::where('has_mutation', true)->count();
    $count_no_mutation = Adn::where('has_mutation', false)->count();
    $ratio = null;
    if ($count_no_mutation > 0) {
        $ratio = round($count_mutations / $count_no_mutation, 2);
    }

    return response()->json([
        'count_mutations' => $count_mutations,
        'count_no_mutation' => $count_no_mutation,
        'ratio' => $ratio,
    ]);
 }
  
}