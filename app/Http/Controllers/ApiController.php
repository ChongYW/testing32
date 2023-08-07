<?php

namespace App\Http\Controllers;

use App\Models\Huobi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
//    public function getSelectedValues(array $keys)
//    {
//        $apiResponse = Http::get('https://api.huobi.pro/market/history/kline?period=1day&size=1&symbol=trxusdt');
//
//        if ($apiResponse->successful()) {
//            $apiData = $apiResponse->json();
//
//            $result = [];
//
//            if (isset($apiData['data'][0])) {
//                foreach ($keys as $key) {
//                    $value = data_get($apiData, "data.0.$key");
//                    $result[$key] = $value;
//                }
//            }
//
//            Huobi::create($result);
//
//            return $result;
//        }
//
//        return [
//            'error' => 'Failed to fetch data from the API.',
//        ];
//    }
//
//    public function showSelectedValues()
//    {
//
//        $selectedKeys = ['open', 'close', 'test'];
//
//        $results = $this->getSelectedValues($selectedKeys);
//
//        foreach ($results as $key => $value)
//        {
//            if (empty($value)){
//                echo "$key : Not found<br>";
//            }else{
//                echo "$key : $value<br>";
//            }
//        }
//    }

// v2
    public function getSelectedValues(array $keys)
    {
        $apiResponse = Http::get('https://api.huobi.pro/market/history/kline?period=1day&size=1&symbol=trxusdt');

        if ($apiResponse->successful()) {
            $apiData = $apiResponse->json();

            $result = [];

            foreach ($keys as $key) {
                $value = data_get($apiData, $key);
                $result[$key] = $value;
            }

            return $result;
        }

        return [
            'error' => 'Failed to fetch data from the API.',
        ];
    }

    public function showSelectedValues()
    {
        $selectedKeys = ['ts', 'data.0.open', 'test'];

        $results = $this->getSelectedValues($selectedKeys);

        foreach ($results as $key => $value) {
            if (empty($value)){
                echo "$key : Not found<br>";
            }else{
                echo "$key : $value<br>";
            }
        }
    }

}
