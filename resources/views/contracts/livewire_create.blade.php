<div>
    @section('title', 'Agreements Management')
    @component('components.breadcrumb')
        @slot('sub_title')
            Agreements
        @endslot
        @slot('action')
            Create
        @endslot
    @endcomponent
{{--    @include('contractss._contract_sub_menu')--}}
    <div class="content">
        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <span style="font-weight: bold; font-size: medium" class="mt-5">Register Agreements</span>
                <a href="{{route('contractss.index')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                </a>
            </div>

            {!! Form::open(['route' => 'contractss.store', 'files' => true]) !!}

            <div class="card-body">
                @include('error')

                <div class="row">
                    @include('contracts.fields')
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('contractss.index') }}" class="btn btn-default">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>
