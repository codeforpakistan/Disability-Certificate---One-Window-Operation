<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Applicant Registration') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center my-5">

        <div class="col-md-12">
            <div class="card shadow bg-light">
                <div class="card-body bg-white px-5 py-3 border-bottom rounded-top">
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <h4 class="alert-heading">Error!</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('client.applications.update', [$applicant->id]) }}">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="update_mode" value="full">
                        @include('client.applicant.form-stage1')
                        <div class="d-flex justify-content-end align-items-baseline">
                            <x-jet-button>
                                {{ __('Update applicant data') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
        <script>
            $(":input").inputmask();

            $(document).ready(function(){
                $("#marital_status").change(function(){
                    $(this).find("option:selected").each(function(){
                        var optionValue = $(this).attr("value");
                        if(optionValue == "Married"){
                            $("#spouse-details").show();
                        } else{
                            $("#spouse-details").hide();
                        }
                    });
                }).change();
            });
        </script>
    @endpush
</x-app-layout>