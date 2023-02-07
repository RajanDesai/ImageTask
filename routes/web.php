<?php

use Illuminate\Support\Facades\Route;
use App\Models\Image;
use App\Models\ImageVariation;
use GuzzleHttp\Psr7;
use GuzzleHttp\Client;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/images', function () {
    $images = Image::get();
    return view('images')->with(['images' => $images]);
});

Route::get('/images/{id}/edit', function ($id) {
    $image = Image::where('id', $id)->first();
    return view('edit-image')->with(['image' => $image]);
});

Route::get('/create-image-variations', function () {
    $image = Image::where('id', request('image_id'))->first();
    $client = new Client();
    $response = $client->request('POST', 'https://api.openai.com/v1/images/variations', ['headers' => 
    [
        'Authorization' => "Bearer " . env('OPENAI_API_KEY')
    ],
    
        'multipart' => [
            [
                'name' => 'image',
                'contents' => Psr7\Utils::tryFopen(storage_path('/app/public/') . $image->filename, 'r')
            ]
        ]
    
    ]);
    $response = $response->getBody()->getContents();
    $response = json_decode($response);
    foreach ($response->data as $img) {
        $contents = file_get_contents($img->url);
        $fileParts = pathinfo(strtok($img->url, '?'));
        \Storage::put('public/' . $fileParts['basename'], $contents);
        $image = ImageVariation::create(['image_id' => request('image_id'), 'filename' => $fileParts['basename']]);
    }
    $imageData = Image::where('id', request('image_id'))->first();
    return redirect('images'. '/' . $imageData->id . '/' . 'edit');
    // return view('edit-image')->with(['image' => $imageData]);
});

Route::post('/', function () {
    if (!empty(request('img_name'))) {
        $data['url'] = 'https://api.openai.com/v1/images/generations';
        $data['img_name'] = request('img_name');
        $response = curlRequest($data);
        $response = json_decode($response);

        if (!empty($response->data[0]->url)) {
            $url = $response->data[0]->url;
            $contents = file_get_contents($url);
            $fileParts = pathinfo(strtok($url, '?'));
            \Storage::put('public/' . $fileParts['basename'], $contents);
            $image = Image::create(['search_keyword' => request('img_name'), 'filename' => $fileParts['basename']]);
            return view('welcome')->with(['image' => $image]);
        } else {
            return view('welcome');
        }
    } else {
        return view('welcome');
    }
    // print_r($response->data[0]->url);
});

function curlRequest($data) {
    $ch = curl_init();
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
        "Authorization: Bearer " . env('OPENAI_API_KEY')
    );
    curl_setopt($ch, CURLOPT_URL, $data['url']);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    $body = '{
        "prompt" : "'.$data['img_name'].'"
    }';

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);

    return $response;
}