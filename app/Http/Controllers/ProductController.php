<?php



namespace App\Http\Controllers; 

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
{
    // Générer un random string pour ref_command
    $randomString = Str::random(12);

    // Définir les paramètres de la requête
    $postfields = [
        'item_name' => 'Iphone 7',
        'item_price' => 100,
        'ref_command' => $randomString, // Utilisation correcte de ref_command
        'command_name' => 'Paiement Iphone 7',
        'env' => 'test',  // Assurez-vous d'utiliser l'environnement de test
        'ipn_url' => 'https://127.0.0.1:8000/ipn',  // URL de notification
        'success_url' => 'https://127.0.0.1:8000/success',  // URL de succès
        'cancel_url' => 'https://127.0.0.1:8000/cancel',  // URL d'annulation
    ];

    // Clés API PayTech
    $api_key = 'votre_cles_api_key';  // Remplacez par votre clé API
    $api_secret = 'votre_api_secret';  // Remplacez par votre clé secrète

    // Envoyer la requête POST à PayTech
    $response = Http::withHeaders([
        'API_KEY' => $api_key,
        'API_SECRET' => $api_secret,
    ])->post('https://paytech.sn/api/payment/request-payment', $postfields);

    // Vérifier le statut de la réponse
    if ($response->status() == 200) {
        // Si la réponse est valide, rediriger l'utilisateur vers l'URL de redirection
        return redirect($response['redirect_url']);
    } else {
        // En cas d'erreur, afficher le statut et le message d'erreur
        dd($response->status(), $response->json());  // Affichez la réponse pour le débogage
    }
}




    public function success(){

        dd('La transaction à été bien effectuer');
        
    } 
    public function cancel(){
        dd('La transaction n'/'a pas aboutie ');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
