<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class PdfController extends Controller
{
    /**
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function renderAsPdf(Request $request): Response
    {
        $url = urldecode($request->get('url'));

        $client = new Client();

        /**
         * @TODO Determine how to get the final HTML after the redirect.
         *
         * In the example RSS feed for this exercise, google news always hits a page which then redirects after some
         * delay which is preventing this logic from rendering the article as a PDF.
         *
         * The example RSS url is https://news.google.com/rss?pz=1&cf=all&hl=en-US&gl=US&ceid=US:en
         */
        $html = $client->request('GET', $url, ['allow_redirects' => true])->getBody();

        $pdf = PDF::loadHTML($html);

        return $pdf->download('article.pdf');
    }
}
