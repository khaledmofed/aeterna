@extends('layouts.app')

@section('content')
  @include('public.partials.hero')
  @include('public.partials.ticker')
  @include('public.partials.architecture')
  @include('public.partials.solutions')
  @include('public.partials.exchange')
  @include('public.partials.tokenomics')
  @include('public.partials.roadmap')
  @include('public.partials.use-cases')
  @include('public.partials.investors')
  @include('public.partials.explorer-section')
  @include('public.partials.thesis')
@endsection

@section('scripts')
@stack('scripts')
@endsection
