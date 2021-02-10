<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use App\Models\EnvatoProduct;
use App\Rules\EnvatoItemId;
use App\Rules\EnvatoPurchaseKey;
use App\Rules\GithubRepo;

class EnvatoProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = EnvatoProduct::paginate(15);
        
        return view('backend.envato-products.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.envato-products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'envato_id' => ['required', 'unique:envato_products,envato_id', new EnvatoItemId ],
            'github_repo' => ['required', 'unique:envato_products,github_repo', new GithubRepo ]
        ]);
        $item = $this->envatoItem($request->envato_item_id);

        $r = EnvatoProduct::create([
            'envato_id' => $request->envato_item_id,
            'name' => $item['name'],
            'author_name' => $item['author_username'],
            'url' => $item['url'],
            'thumbnail' => $item['previews']['icon_preview']['icon_url'],
            'github_repo' => $request->github_repo,
        ]);

        notify()->success("Add New Envato Item Successfully");
        return back();
    }

    private function envatoItem($item_id)
    {
        $client = new Client();

        $r = $client->request(
            "GET",
            "https://api.envato.com/v3/market/catalog/item?id={$item_id}",
            [
                "headers" => [
                    "Authorization" => "Bearer " . env('ENVATO_PARSONAL_TOKEN'),
                    'Accept'     => 'application/json',
                ],
            ]
        );

        return json_decode($r->getBody(), true);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = EnvatoProduct::FindOrFail($id);
        return view('backend.envato-products.create', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'envato_id' => ['required', "unique:envato_products,envato_id,id,{$id}", new EnvatoItemId],
            'github_repo' => ['required', "unique:envato_products,github_repo,id,{$id}", new GithubRepo]
        ]);
        $item = $this->envatoItem($request->envato_item_id);

        $r = EnvatoProduct::create([
            'envato_id' => $request->envato_item_id,
            'name' => $item['name'],
            'author_name' => $item['author_username'],
            'url' => $item['url'],
            'thumbnail' => $item['previews']['icon_preview']['icon_url'],
            'github_repo' => $request->github_repo,
        ]);

        notify()->success("Update Envato Item Successfully", "Successfull");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = EnvatoProduct::findOrFail($id);

        if($data != null){
            $data->delete();
        }
        notify()->success('Envato Item remove', 'Successfully');
        return back();
    }

    /**
     * Display a listing of the sale.
     *
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request)
    {
        $data = false;
        $code = $request->input('code');
        if ($code) {
            $request->validate([
                'code' => [new EnvatoPurchaseKey]
            ]);

            try {
                $client = new Client();
                $r = $client->request(
                    "GET",
                    "https://api.envato.com/v3/market/author/sale?code={$code}",
                    [
                        "headers" => [
                            "Authorization" => "Bearer " . env('ENVATO_PARSONAL_TOKEN'),
                            'Accept'     => 'application/json',
                        ],
                    ]
                );
                $data = json_decode($r->getBody(), true);
            } catch (\Throwable $th) {
                //throw $th;
                $data = false;
            }
        }
        return view('backend.envato-products.verify', compact('data', 'code'));
    }
}
