<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Spatie\Browsershot\Browsershot;

class PdfController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function renderAsPdf(Request $request)
    {
        $url = urldecode($request->get('url'));

        $config = <<<EOT
{
    "url": "$url",
    "margins": "5mm",
    "paperSize": "Letter",
    "orientation": "Portrait",
    "printBackground": true,
    "header": "",
    "footer": "",
    "mediaType": "print",
    "async": false
}
EOT;

        $response = Http::withHeaders([
                'x-api-key' => config('services.pdf.token'),
                'Content-Type' => 'application/json'
            ]
        )->post('https://api.pdf.co/v1/pdf/convert/from/url', json_decode($config));

        return redirect($response->json()['url']);
    }
}
