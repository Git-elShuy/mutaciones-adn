<?php
namespace App\Http\Controllers;
use App\Models\Adn;
use Illuminate\Http\Request;
use App\Services\MutationService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;


class AdnController extends Controller {
    public function verificar(Request $request, MutationService $service){
        $adn = $request->input('adn'); //tomamos el valor que viene en la url del post

        if (!is_array($adn)) {
        return response()->json(['error' => 'Formato inválido se esperaba un Array.'], 400);
        }

        $hasMutation = $service->hasMutation($adn); //llamamos al servicio

        // guardar en bd solo si no existe
        $existe = Adn::whereJsonContains('adn', $adn)->exists();
         //$existe = Adn::where('adn', $adn)->exists();

        if (!$existe) {
            Adn::create([
            'adn' => $adn,
            'has_mutation' => $hasMutation,
            ]);
        }

        if ($hasMutation) {
        return response()->json(['message' => 'Mutación detectada'], 200);
        } else {
        return response()->json(['message' => 'No se detectó mutación'], 403);
        }

    }
    public function list(){ //metodo para obtener los ultimos 10 registros
    $data = Adn::orderBy('created_at', 'desc')
        ->take(10)
        ->get(['adn', 'has_mutation', 'created_at'])
        ->map(function ($item) {
            return [
                'cadena_adn' => implode(',', $item->adn),
                'resultado' => $item->has_mutation ? 'Mutación' : 'Sin Mutación',
                'created_at' => $item->created_at->format('Y-m-d'),
            ];
        });

    return response()->json($data);
}

}