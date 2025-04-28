@extends('layouts.frontend.app', ['class' => 'g-sidenav-show bg-gray-100'])
<style>
#map_outer {
    display: none !important;
}
</style>
@section('content')
@include('layouts.navbars.guest.navbar', ['title' => 'Dashboard'])
<div class="container my-3 my-lg-5">
    <div class='row'>
        <livewire:collaborators />
    </div>
</div>
@include('layouts.footers.guest.footer')
@endsection