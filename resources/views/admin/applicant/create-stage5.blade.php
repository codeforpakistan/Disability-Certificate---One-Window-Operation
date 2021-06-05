<html>
    <head>
        <style type='text/css'>
            body, html {
                margin: 0;
                padding: 0;
            }
            body {
                color: black;
                display: table;
                font-family: Georgia, serif;
                font-size: 24px;
                text-align: center;
            }
            .container {
                border: 20px solid grey;
                width: 900px;
                height: 650px;
                display: table-cell;
                vertical-align: middle;
            }
            .logo {
                color: tan;
            }

            .marquee {
                color: tan;
                font-size: 48px;
                margin: 20px;
            }
            .assignment {
                margin: 20px;
            }
            .person {
                border-bottom: 2px solid black;
                font-size: 32px;
                font-style: italic;
                margin: 20px auto;
                width: 400px;
            }
            .reason {
                margin: 20px;
            }
            .uppercase {
                text-transform:uppercase;
            }
        </style>
        <title>Disability Certificate - {{ $applicant->cnic }}</title>
    </head>
    <body>
        <div class="container">
            <table style="border-collapse: collapse; width: 100%;" border="0">
                <tbody>
                    <tr style="border: 0px">
                        <td style="width: 100%; border: 0px" colspan="2">
                            <table style="width: 100%; border: 0px" border="0">
                                <tbody>
                                    <tr style="border: 0px">
                                        <td style="width: 20%; border: 0px">
                                            <img style="width: 120px;" src="{{ asset('img/pak-logo.png') }}" alt="">
                                        </td>
                                        <td style="width: 80%; border: 0px">
                                            <p style="text-align: center;">COUNCIL ON RIGHTS OF PERSONS WITH DISABILITIES</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: left; padding: 5px;">
                            <p style="text-align: left; padding: 5px; padding: 20px">Date: <u class="uppercase">{{ date('d/m/Y') }}</u></p>
                        </td>
                        <td style="width: 50%; text-align: right;">
                            <p style="text-align: right; padding: 20px">Reg# {{ $applicant->id . '/' . date('Y') . "-CRPD" }}</p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 100%; text-align: center;" colspan="2">
                            <p style="font-size: 26px; text-align: center;"><span style="text-decoration: underline;">DISABILITY CERTIFICATE</span></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 100%; text-align: center;" colspan="2">
                            <p style="text-align: center;">ASSESSMENT BOARD FOR THE DISABLED PERSONS, ISLAMABAD</p><br>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%;">
                            <p style="text-align: left; padding: 5px;">1. Name: <u class="uppercase">{{ $applicant->name }}</u></p>
                        </td>
                        <td style="width: 50%;">
                            <p style="text-align: left; padding: 5px;">2. Father Name: <u class="uppercase">{{ $applicant->father_name }}</u></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;">
                            <p style="text-align: left; padding: 5px;">3. Married / Unmarried: <u class="uppercase">{{ $applicant->marital_status }}</u></p></p>
                        </td>
                        <td style="width: 50%; text-align: center;">
                            <p style="text-align: left; padding: 5px;">4. Spouse: <u class="uppercase">{{ $applicant->spouse_name ? $applicant->spouse_name : "N/A" }}</u></p></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;">
                            <p style="text-align: left; padding: 5px;">5. Date of Birth: <u class="uppercase">{{ $applicant->dob->format('d/m/Y') }}</u></p>
                        </td>
                        <td style="width: 50%; text-align: center;">
                            <p style="text-align: left; padding: 5px;">6. NIC No: <u class="uppercase">{{ $applicant->cnic }}</u></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;">
                            <p style="text-align: left; padding: 5px;">7. Qualification: <u class="uppercase">{{ $applicant->qualification }}</u></p>
                        </td>
                        <td style="width: 50%; text-align: center;">
                            <p style="text-align: left; padding: 5px;">8. Nature of Disability: <u class="uppercase">{{ $applicant->nature_of_disability }}</u></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;" colspan="2">
                            <p style="text-align: left; padding: 5px;">9. Type of disability: <u class="uppercase">{{ $applicant->disabilityType->type }}</u></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;" colspan="2">
                            <p style="text-align: left; padding: 5px;">10. Present Address: <u class="uppercase">{{ $applicant->address }}</u></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;" colspan="2">
                            <p style="text-align: left; padding: 5px;">11. Permanent Address: <u class="uppercase">As Above</u></p>
                        </td>
                    </tr>
                    <tr style="border: 0px;">
                        <td style="width: 50%; text-align: center;" colspan="2">
                            <p style="text-align: left; padding: 5px;">12. Recommendation of Board: <u style="padding-left: 120px">(i) Fit to work</u> <u style="padding-left: 120px">(ii) Not fit to work</u></p><br></td>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; text-align: center;" >
                            {{-- <p><img src="{{ asset('img/signature-2.svg') }}" style="width: 180px;" alt=""></p> --}}
                            <p style="text-align: center;">
                                _________________________<br>
                                RANA SAEED RAMZAN <br>
                                Deputy Director <br>
                                NCRPD, Islamabad
                            </p>
                        </td>
                        <td style="width: 50%; text-align: center;">
                            <p><img src="{{ asset('img/signature-2.svg') }}" style="width: 180px;" alt=""></p>
                            <p style="text-align: center;">
                                _________________________<br>
                                DR. FARIDULLAH KHAN ZIMRI<br>
                                Chairman <br>
                                Assessment Board, Islamabad
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
    </body>
</html>