@extends('driver.shell')

@section('driver-content')

    @include('driver.application.partials.header')
    @include('driver.application.partials.status-card')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">

            @include('driver.application.partials.application-info')
            @include('driver.application.partials.submitted-documents')
            @include('driver.application.partials.payment-section')
            @include('driver.application.partials.timeline')

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            @include('driver.application.partials.sidebar.summary')
            @include('driver.application.partials.sidebar.documents')
            @include('driver.application.partials.sidebar.next-actions')
            @include('driver.application.partials.sidebar.support')
        </div>
    </div>

    @include('driver.application.partials.scripts')

@endsection
