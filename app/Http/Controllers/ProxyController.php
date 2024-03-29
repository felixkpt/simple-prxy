<?php

namespace App\Http\Controllers;

class ProxyController extends Controller
{

    public function actionProxy()
    {
        Proxy::$AUTH_KEY = 'Bj5pnZEX6DkcG6Nz6AjDUT1bvcGRVhRaXDuKDX9CjsEs2';
        // Do your custom logic before running proxy

        $responseBody = '';
        ob_start();
        $responseCode = Proxy::run();
        $responseBody = ob_get_clean();

        return view('proxy', ['content' => $responseBody]);

        // Do your custom logic after running proxy
        // You can utilize HTTP response code returned from the run() method
    }

    public function index()
    {
        $source = request()->source;

        if (!$source) {
            $content = 'Source not supplied';
        } else {


            try {

                $content = file_get_contents($source);
                if ($content === false) {
                    $content = 'Failed to retrieve content from the source';
                }
            } catch (\Exception $e) {
                // Handle the exception
                $errorMessage = $e->getMessage();
                $content = "<div>Error: $errorMessage</div>";
            }
        }

        return view('proxy', ['content' => $content]);
    }
}
