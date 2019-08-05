<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart1 = \Chart::title([
            'text' => 'Voting ballon d`or 2018',
        ])
        ->chart([
        'type'     => 'line', // pie , columnt ect
        'renderTo' => 'chart1', // render the chart into your div with id
    ])
        ->subtitle([
            'text' => 'This Subtitle',
        ])
        ->colors([
            '#0c2959'
        ])
        ->xaxis([
            'categories' => [
                'Alex Turner',
                'Julian Casablancas',
                'Bambang Pamungkas',
                'Mbah Surip',
            ],
            'labels'     => [
                'rotation'  => 15,
                'align'     => 'top',
                'formatter' => 'startJs:function(){return this.value + " (Footbal Player)"}:endJs', 
            // use 'startJs:yourjavasscripthere:endJs'
            ],
        ])
        ->yaxis([
            'text' => 'This Y Axis',
        ])
        ->legend([
            'layout'        => 'vertikal',
            'align'         => 'right',
            'verticalAlign' => 'middle',
        ])
        ->series(
            [
                [
                    'name'  => 'Voting',
                    'data'  => [43934, 52503, 57177, 69658],
                // 'color' => '#0c2959',
                ],
            ]
        )
        ->display();
        
        return view('home', [
            'chart1' => $chart1,
        ]);
    }
}
