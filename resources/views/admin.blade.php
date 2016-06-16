@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey'))

    <grid position="b1:c2" style="text-align: center">
        <section class="admin">
            <h1>Admin</h1>

            <form action="/admin" method="post">

                {{csrf_field()}}

                <div class="row">
                    <div class="col-1">
                        <label for="title">Titel</label>
                    </div>

                    <div class="col-3">
                        <input type="text" name="title">
                    </div>
                </div>
                <div class="row">

                    <div class="col-1">
                        <label for="message">Besked</label>
                    </div>

                    <div class="col-3">
                        <textarea name="message" class="block"></textarea>
                    </div>
                </div>

                <input type="submit" value="opret">

            </form>
        </section>
    </grid>


    <notification></notification>

@endsection