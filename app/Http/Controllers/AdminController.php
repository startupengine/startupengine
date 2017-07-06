<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Contentful\Delivery\Client as DeliveryClient;

class AdminController extends Controller
{

    /**
     * @var DeliveryClient
     */
    private $client;

    public function __construct(DeliveryClient $client) {
        $this->client = $client;
    }

    public function index() {
        $query = (new \Contentful\Delivery\Query());
        $query->setContentType('defaults')
            ->where('fields.slug', 'default');
        $defaults = $this->client->getEntries($query);
        if(!empty($defaults->getItems())) { $defaults = $defaults->getItems()[0]; } else { $defaults = NULL; }
        return view('admin.index')->with('defaults', $defaults);
    }
}
