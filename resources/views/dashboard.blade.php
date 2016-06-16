@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey'))

    <google-calendar grid="a1:a2"></google-calendar>

    <last-fm grid="b1:c1"></last-fm>

    <current-time grid="d1" dateformat="dddd DD/MM"></current-time>

    <packagist-statistics grid="b2"></packagist-statistics>

    <rain-forecast grid="c2"></rain-forecast>

    <livecam grid="d2"></livecam>

    <notification grid="a3"></notification>

    <notification grid="b3"></notification>

    <notification grid="c3"></notification>

    <notification grid="d3"></notification>
@endsection