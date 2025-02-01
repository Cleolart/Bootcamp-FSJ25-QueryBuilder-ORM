<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestQBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/orders', [OrderController::class,'index']); //muestra todas las ordenes
Route::post('/setups', [TestQBuilder::class,'setup']); //inserta los datos a la base ejercicio 1
Route::get('/users/{id}/orders', [OrderController::class,'ordersByUser']); //devuelve las órdnes del usuario con el id especificado ejercicio 2

Route::get('/users/{id}/ordersCount', [OrderController::class,'ordersCount']); // calcula el total de pedidos según el id ejercicio 6

Route::get('/orders/range', [OrderController::class,'ordersRange']); //devuelve las órdenes con totales entre 100 y 250 ejecicio 4

Route::get('/orders/detail', [OrderController::class,'orderDetail']); //obetner todos los pedidos incluyendo nombre y correo ejercicio 3

Route::get('/orders/desOrders', [OrderController::class,'desOrders']); //Recupera todos los pedidos ordenados desc ejercicio 7

Route::get('/orders/containsR', [OrderController::class,'containsR']); // Devuelve los nombres que comiencen con "R" ejercio 5

Route::get('/orders/totalSum', [OrderController::class,'totalSum']); //devuelve la suma total de los pedidos 8 ejercicio

Route::get('/orders/minTotal', [OrderController::class,'minTotal']); //9 Devuelve el pedido con el total más bajo ejercicio 9

Route::get('/orders/ordersByUsers', [OrderController::class,'ordersByUsers']); //Obtiene el producto, la cantidad y el total de cada pedido, agrupándolos por usuario ejercicio 10
