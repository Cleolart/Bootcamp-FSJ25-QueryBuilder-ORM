<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class OrderController extends Controller
{
    /**
     * Muestras todas las órdenes
     */
    public function index()
    {
        try {

            return response()->json([
                'message' => 'Test',
                'data' => Order::all(),
                    ], 201);
            
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    // EJERCICIO 1 EN TESTQBUILDER

    // EJERCICIO 2 devuelve las órdnes del usuario con el id especificado
    public function ordersByUser($userid)
    {
        try {

            return response()->json([
                'message' => 'Test',
                'data' => User::find($userid)->orders,
                    ], 201);
            
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

    //EJERCICIO 3 obetner todos los pedidos incluyendo nombre y correo
     public function orderDetail()
     {
 
         $orderDetail = DB::table('orders')                               
             ->join('users', 'orders.user_id', '=', 'users.id')
            
             ->select(           
                 'orders.*',        
                 'users.name',   
                 'users.email'    
                     )
             ->get();  
 
         return response()->json([
             'data' => $orderDetail
         ]);
     }


//EJERCICIO 4 devuelve las órdenes con totales entre 100 y 250
    public function ordersRange()
    {
        try {

            return response()->json([
                'message' => 'Test',
                'data' => Order::all()->where("total", '>=', 100)->where('total', '<=', 250),
                    ], 201);
            
        } catch (Exception $error) {
            return response()->json([
                'error' => $error->getMessage()
            ], 400);
        }
    }

         // EJERCICIO 5 Devuelve los nombres que comiencen con "R"
    public function containsR()
    {

        $containsR = DB::table('users')
            ->whereLike('name', 'R%', caseSensitive: false)
            ->get();

        return response()->json([
            'data' => $containsR
        ]);
    }

    //EJERCICIO 6 calcula el total de pedidos según el id
    public function ordersCount($userid)
    {

        $ordersCount = DB::table('orders')
            ->where('user_id', $userid) 
            ->count();              

        return response()->json([
            'data' => 'There are ' . $ordersCount . ' orders with user '. $userid
        ]);
    }

     // EJERCICIO 7 Recupera todos los pedidos ordenados desc

     public function desOrders()
     {
 
         $desOrders = DB::table('orders')
             ->join('users', 'orders.user_id', '=', 'users.id') 
             ->select('orders.*', 'users.*')
             ->orderBy('orders.total', 'desc') 
             ->get();
 
         //Respuesta de exito
         return response()->json([
             'data' => $desOrders
         ]);
     }

    //EJERCICIO 8 devuelve la suma total de los pedidos
    public function totalSum()
    {

        $totalSum = DB::table('orders')->sum('total'); 

        //Respuesta de exito
        return response()->json([
            'Total' => '$' . $totalSum
        ]);
    }

        //EJERCICIO 9 Devuelve el pedido con el total más bajo
        public function minTotal()
        {
    
            $mintotal = DB::table('orders')->min('total');
    
            $cheapTotal = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.*', 'users.name')
                ->where('orders.total', $mintotal)
                ->get();
    
            return response()->json([
                'Cheap Total' => $cheapTotal
            ]);
        }
    
        //EJERCICIO 10 Obtén el producto, la cantidad y el total de cada pedido, agrupándolos por usuario
        public function ordersByUsers()
        {
    
            $ordersByUsers = DB::table('orders')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select(
                    'users.name as user_name',
                    'orders.product',
                    DB::raw('SUM(orders.qty) as total_quantity'), 
                    DB::raw('SUM(orders.total) as total_order')
                )
                ->groupBy('users.id', 'users.name', 'orders.product') 
                ->get();
    
            return response()->json([
                 'data' => $ordersByUsers
            ]);
        }


}
