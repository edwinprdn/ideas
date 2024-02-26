@extends('layout.layout')

@section('content')
    <div class="container py-4">
        <div class="row">
            <div class="col-3">
                @include('shared.left-sidebar')
            </div>
            <div class="col-6">
                @include('shared.success-message')
                <h1>TERMS</h1>
                <div>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. At perspiciatis eveniet voluptate eius
                    reiciendis, dolorem aliquam tenetur similique, amet dicta incidunt ab earum blanditiis, repellendus est
                    rerum quas. Eveniet, necessitatibus.
                </div>
            </div>
            <div class="col-3">
                @include('shared.search')
                @include('shared.follow-box')
            </div>
        </div>
    </div>
@endsection
