@extends('layouts.app')

@section('content')
    <div class="container">
        @php
            $rows = 4;
            $cols = 3;
        @endphp
        @for ($i = 0; $i < $rows; $i++)
            <div class="row justify-content-center py-2">
            @for ($j = 0; $j < $cols; $j++)
                @php
                    $rand = rand(0, 100) + rand();
                @endphp
                <div class="col d-flex flex-row justify-content-center mb-3">
                    <div class="card posts" style="width: 18rem;">
                        <img class="card-img-top" src="https://picsum.photos/200/150?random={{ $rand }}" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                                card's content.</p>
                            <a href="#" class="btn btn-primary btn-red">Go somewhere</a>
                        </div>
                    </div>
                </div>
            @endfor

            </div>
        @endfor
                
    </div>
@endsection
