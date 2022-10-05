@extends('pub_theme::layouts.app')
@section('content')

    {{--
    
    --}}
    <section class="py-5">
        <div class="container">
       
            <div class="row">
                
                <div class="col">
                    <br/><br/><br/>
                    <livewire:ticket.create ></livewire:ticket.create>
                </div>
            </div>
        </div>
    </section>


@endsection