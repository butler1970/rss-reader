<?php

namespace App\Http\Controllers;

use App\Models\RssFeed;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Vedmant\FeedReader\Facades\FeedReader;

class RssFeedController extends Controller
{
    /**
     * Display initial form with empty rss feed url text box.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index(Request $request)
    {
        $result = ['items' => []];
        return view('rss-feed', compact('result'));
    }

    /**
     * Add specified rss feed url to the database and render feed.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * @throws ValidationException
     */
    public function update(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'url' => 'required',
        ]);

        //  Store data in database
        RssFeed::create($request->all());
        //

        $f = FeedReader::read($request->url);
        $result = [
            'title' => $f->get_title(),
            'description' => $f->get_description(),
            'permalink' => $f->get_permalink(),
            'link' => $f->get_link(),
            'copyright' => $f->get_copyright(),
            'language' => $f->get_language(),
            'image_url' => $f->get_image_url(),
            'author' => $f->get_author()
        ];

        foreach ($f->get_items(0, $f->get_item_quantity()) as $item) {
            $i['title'] = $item->get_title();
            $i['description'] = $item->get_description();
            $i['id'] = $item->get_id();
            $i['content'] = $item->get_content();
            $i['thumbnail'] = $item->get_thumbnail();
            $i['category'] = $item->get_category();
            $i['categories'] = $item->get_categories();
            $i['author'] = $item->get_author();
            $i['authors'] = $item->get_authors();
            $i['contributor'] = $item->get_contributor();
            $i['copyright'] = $item->get_copyright();
            $i['date'] = $item->get_date();
            $i['updated_date'] = $item->get_updated_date();
            $i['local_date'] = $item->get_local_date();
            $i['permalink'] = $item->get_permalink();
            $i['link'] = $item->get_link();
            $i['links'] = $item->get_links();
            $i['enclosure'] = $item->get_enclosure();
            $i['audio_link'] = $item->get_enclosure()->get_link();
            $i['enclosures'] = $item->get_enclosures();
            $i['latitude'] = $item->get_latitude();
            $i['longitude'] = $item->get_longitude();
            $i['source'] = $item->get_source();
            $i['pdf_url'] = '/pdf?url=' . urlencode($item->get_link());

            $result['items'][] = $i;
        }

        return view('rss-feed', compact('result'));
    }
}
