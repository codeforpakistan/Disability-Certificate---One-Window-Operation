<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Patient Registration') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div id='stage1' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
                    @if ($errors->any())
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
                            <p class="font-bold">Error!</p>
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        <br>
                    @endif
                    <form method="POST" action="{{ route('admin.applications.store') }}">
                        @csrf
                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="cnic">
                                    CNIC No.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="cnic" name="cnic" type="text" value="" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X" required>
                                <p class="py-2 text-sm text-gray-600">Enter The patient's CNIC or Form B.</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="dob">
                                    Date of birth
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="dob" name="dob" type="date" value="" required>
                                <p class="py-2 text-sm text-gray-600">Select the Date of bith of the patient.</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="name">
                                    Patient name.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="name" name="name" type="text" value="" placeholder="Enter patient name" required>
                                <p class="py-2 text-sm text-gray-600">Write patient name.</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="father_name">
                                    Father name.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="father_name" name="father_name" type="text" value="" placeholder="Enter father name" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's father name</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="gender">
                                    Gender
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <select class="form-select block w-full focus:bg-white" id="gender" name="gender" required>
                                    <option value="">Select gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>

                                <p class="py-2 text-sm text-gray-600">Choose if patient's gender.</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="phone_no">
                                    Mobile No.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="phone_no" name="phone_no" type="text" value="" data-inputmask="'mask': '0399-9999999'"  placeholder="03XX-XXXXXXX" maxlength="12" required>
                                <p class="py-2 text-sm text-gray-600">Enter The patient's Mobile number.</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="address">
                                    Address.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="address" name="address" type="text" value="" placeholder="Enter address" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's address</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="marital_status">
                                    Marital Status
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <select class="form-select block w-full focus:bg-white" id="marital_status" name="marital_status" required>
                                    <option value="">Select marital status</option>
                                    <option value="Married">Married</option>
                                    <option value="Not Married">Not Married</option>
                                </select>

                                <p class="py-2 text-sm text-gray-600">Choose if patient is married or not.</p>
                            </div>
                        </div>

                        <div class="md:flex mb-6" id="spouse-details">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="spouse_name">
                                    Spouse Name.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="spouse_name" name="spouse_name" type="text" value="" placeholder="Enter spouse name">
                                <p class="py-2 text-sm text-gray-600">Write patient's spouse name if he/she is married</p>
                            </div>
                        </div>

                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="qualification">
                                    Qualification
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="qualification" name="qualification" type="text" value="" placeholder="Enter qualification" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's qualification</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="type_of_disability">
                                    Type of disability.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="type_of_disability" name="type_of_disability" type="text" value="" placeholder="Enter type of disability" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's type of disability.</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="nature_of_disability">
                                    Nature of disability.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="nature_of_disability" name="nature_of_disability" type="text" value="" placeholder="Enter nature of disability" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's nature of disability.</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="cause_of_disability">
                                    Cause of disability.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="cause_of_disability" name="cause_of_disability" type="text" value="" placeholder="Enter cause of disability" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's cause of disability.</p>
                            </div>
                        </div>
                        <div class="md:flex mb-6">
                            <div class="md:w-1/6">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="source_of_income">
                                    Source of income.
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="source_of_income" name="source_of_income" type="text" value="" placeholder="Enter source of income" required>
                                <p class="py-2 text-sm text-gray-600">Write patient's source of income.</p>
                            </div>
                            <div class="md:w-1/6 ml-2">
                                <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="type_of_job">
                                    Type of job (that patient can do).
                                </label>
                            </div>
                            <div class="md:w-2/6">
                                <input class="form-input block w-full focus:bg-white" id="type_of_job" name="type_of_job" type="text" value="" placeholder="Enter type of job" required>
                                <p class="py-2 text-sm text-gray-600">Write type of job (that patient can do or is doing).</p>
                            </div>
                        </div>
                        <div class="md:flex md:items-center">
                            <div class="md:w-1/6"></div>
                            <div class="md:w-2/6">
                                <button class="shadow bg-yellow-700 hover:bg-yellow-500 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
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

{{-- Text Area --}}
{{-- <div class="md:flex mb-6">
    <div class="md:w-1/6">
        <label class="block text-gray-600 font-bold md:text-left mb-3 md:mb-0 pr-4" for="my-textarea">
            Text Area
        </label>
    </div>
    <div class="md:w-2/6">
        <textarea class="form-textarea block w-full focus:bg-white" id="my-textarea" value="" rows="8"></textarea>
        <p class="py-2 text-sm text-gray-600">add notes about populating the field</p>
    </div>
</div> --}}