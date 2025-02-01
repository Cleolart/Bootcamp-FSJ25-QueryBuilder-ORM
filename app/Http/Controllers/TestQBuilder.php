<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class TestQBuilder extends Controller
{
    private $_users = [
        [
            'name' => 'Ana',
            'email' => 'ana@email.com',
            'phone' => '+503 75525622'
        ],
        [
            'name' => 'Juan',
            'email' => 'juan@email.com',
            'phone' => '+503 56452361'
        ],
        [
            'name' => 'Renato',
            'email' => 'renato@email.com',
            'phone' => '+503 75452369'
        ],
        [
            'name' => 'María',
            'email' => 'maria@email.com',
            'phone' => '+503 25365897'
        ],
        [
            'name' => 'Andrea',
            'email' => 'andrea@email.com',
            'phone' => '+503 123568989'
        ],
        [
            'name' => 'Paola',
            'email' => 'paola@email.com',
            'phone' => '+503 8125689'
        ]
        ];

    private $_orders = [
        [
            'product' => 'Monitor',
            'qty' => 1,
            'total' => 125,
            'user_id' => 1
        ],
        [
            'product' => 'Tablet Wacom',
            'qty' => 1,
            'total' => 2500,
            'usuario_id' => 2
        ],
        [
            'product' => 'Auriculares',
            'qty' => 2,
            'total' => 560,
            'usuario_id' => 5
        ],
        [
            'product' => 'PC Gamer',
            'qty' => 1,
            'total' => 750,
            'usuario_id' => 2
        ],
        [
            'product' => 'Auriculares AlienWare',
            'qty' => 1,
            'total' => 235,
            'usuario_id' => 4
        ],
        [
            'product' => 'Telescopio',
            'qty' => 2,
            'total' => 826,
            'usuario_id' => 5
        ],
        [
            'product' => 'Teclado',
            'qty' => 1,
            'total' => 50,
            'usuario_id' => 3
        ],
        [
            'product' => 'Mouse gamer',
            'qty' => 1,
            'total' => 50,
            'usuario_id' => 6
        ],
        [
            'product' => 'Estuche celular',
            'qty' => 2,
            'total' => 30,
            'usuario_id' => 4
        ],
        [
            'product' => 'chipset intell',
            'qty' => 1,
            'total' => 258,
            'usuario_id' => 1
        ]
        ];

    public function setup()
    {
        //Crea usuarios
        User::insert($this->_users);

        //Lista todos los usuarios
        $users = User::all();
        
        //Crea ordenes para los usuarios
        Order::insert($this->_orders);
        
        //Lista todas las ordenes
        $orders = Order::all();
        return response()->json([
            'Message' => 'Records created successfully',
            'Users' => $users,
            'Pedidos' => $orders
        ], 201);
    }

}
