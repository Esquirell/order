<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{

    const MERCHANT_ACCOUNT = 'test_merch_n1';
    const MERCHANT_DOMAIN_NAME = 'http://95.47.114.115/';
    const PRODUCT_PRICE = 1;
    const KEY = "flk3409refn54t54t*FNJRET";
    public $redirectUrl;

    public function test(Request $request)
    {

        $latestOrder = Order::orderBy('created_at', 'DESC')->first();
        if (is_null($latestOrder)) {
            $order_reference = 'ID_' . str_pad('1', 8, '0', STR_PAD_LEFT);
        } else {
            $order_reference = 'ID_' . str_pad($latestOrder->id + 1, 8, '0', STR_PAD_LEFT);
        }

        $time = (string)Carbon::now()->timestamp;

        $string = self::MERCHANT_ACCOUNT . ';'
            . self::MERCHANT_DOMAIN_NAME . ';'
            . $order_reference . ';'
            . $time . ';'
            . $request->input('productCount')[0] . ';'
            . 'UAH' . ';'
            . $request->input('productCount')[0] . ' крд.' . ';'
            . $request->input('productCount')[0] . ';'
            . self::PRODUCT_PRICE;
        $hash = hash_hmac("md5", $string, self::KEY);

        $user = Auth::user();
        $user->name = $hash;
        $user->save();

        $data = [
            "merchantAccount" => self::MERCHANT_ACCOUNT,
            "merchantDomainName" => self::MERCHANT_DOMAIN_NAME,
            "merchantAuthType" => "SimpleSignature",
            "merchantSignature" => $hash,
            "orderReference" => $order_reference,
            "orderDate" => "$time",
            "amount" => $request->input('productCount')[0],
            "currency" => 'UAH',
            "orderLifeTime" => "5",
            "productName" => [
                "0" => $request->input('productCount')[0] . ' крд.'
            ],
            "productPrice" => [
                "0" => self::PRODUCT_PRICE
            ],
            "productCount" => [
                "0" => $request->input('productCount')[0]
            ],
//            "apiVersion" => 2,
            "serviceUrl" => self::MERCHANT_DOMAIN_NAME."response",
            "returnUrl" => self::MERCHANT_ACCOUNT."success"
        ];

        $data2 = $data;
        $data2['hash'] = $hash;

        $order = Order::create($data2);

        $client = new Client(['base_uri' => 'https://secure.wayforpay.com/api']);

        $response = $client->request('POST', 'https://secure.wayforpay.com/pay', [
            'form_params' => $data,
            'on_stats' => function (TransferStats $stats) {
                $this->redirectUrl = $stats->getEffectiveUri();
            }
        ]);
        return redirect($this->redirectUrl);
    }

    public function pay()
    {
        return view('pay');
    }

    public function indexOrders()
    {
        $orders = Order::all();
        return view('orders', compact('orders'));
    }

    public function check($id)
    {
        $order = Order::find($id);

        $client = new Client(['base_uri' => 'https://api.wayforpay.com/api']);


        $string = self::MERCHANT_ACCOUNT . ';' . $order->orderReference;
        $hash = hash_hmac("md5", $string, self::KEY);

        $response = $client->request('POST', 'https://api.wayforpay.com/api', [
            'json' => [
                "apiVersion" => 1,
                "transactionType" => "CHECK_STATUS",
                "merchantAccount" => self::MERCHANT_ACCOUNT,
                "orderReference" => $order->orderReference,
                "merchantSignature" => $hash
            ]
        ]);

        $otvet = $response->getBody()->getContents();
        dd(json_decode($otvet));
    }

    public function response(Request $request)
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
//        $contents = Storage::get('example.txt');
//        $array = json_decode($contents, true);
//        dd($array, $contents);
//        $json = json_encode($request->input());
//        Storage::disk('local')->put('example.txt', $json);

        if($obj['reasonCode'] === 1100 && $obj['transactionStatus'] == 'Approved') {
            $order = Order::where('orderReference', $obj['orderReference'])->first();
            $user = $order->user;
            $user->credits += $obj['amount']*100;
            $user->save();
        }

        $time = (string)Carbon::now()->timestamp;

        $string = $obj['orderReference'].';'.'accept'.';'.$time;
        $hash = hash_hmac("md5", $string, self::KEY);

        return response()->json([
            'orderReference' => $obj['orderReference'],
            'status' => 'accept',
            'time' => $time,
            'signature' => $hash
        ]);

    }

    public function success(Request $request)
    {
        $json = file_get_contents('php://input');
        $obj = json_decode($json, true);
        dd($request->input(), $obj);
    }


}
