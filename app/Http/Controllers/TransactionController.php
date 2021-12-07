<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show all transactions data
        try {
            $transactions = Transaction::orderBy('created_at', 'DESC')->get();
            $response = [
                'message'=>'list of transactions data',
                'data'=>$transactions
            ];

            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::debug($th);
            $response = [
                'message'=>'error',
                'data'=>[]
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // menyimpan data transaction
        $validator = Validator::make($request->all(),[
            'title'=>['required'],
            'amount'=>['required', 'numeric'],
            'type'=>['required','in:expense,revenue']
        ]);

        if($validator->fails()){
            $response = [
                'message'=>$validator->errors(),
                'data'=>[]
            ];
            return response()->json($response, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        try {
            $transaction = Transaction::create($request->all());
            $response = [
                'message'=>"ok",
                'data'=>$transaction
            ];
            return response()->json($response, Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::debug($th);
            $response = [
                'message'=>$th,
                'data'=>[]
            ];
            return response()->json($response, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
