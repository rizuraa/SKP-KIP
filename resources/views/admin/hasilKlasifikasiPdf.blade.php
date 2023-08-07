<!DOCTYPE html>
<html>
<head>
    <title>Hasil Klasifikasi</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png"> --}}
    <title>
        SPK Penerima KIP
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <!-- Nepcha Analytics (nepcha.com) -->
    <!-- Nepcha is a easy-to-use web analytics. No cookies and fully compliant with GDPR, CCPA and PECR. -->
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
    <style>        
        /* CSS reguler untuk tampilan halaman */
        .header {
            display: block;
            /* Atur tata letak dan gaya header */
        }

        .footer {
            display: block;
            /* Atur tata letak dan gaya footer */
        }

        /* CSS khusus untuk tampilan cetak (print) */
        @media print {
            .header, .footer {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">        
        <div class="d-flex justify-content-center">
            <div class="text-center">
                <img src="{{asset ('assets/img/kiri2.png')}}" class="img-responsive">
            </div>
        </div>            
    </div>
    <hr>
    <h5 class="text-center mt-5">Hasil Klasifikasi</h5>
    <div class="card-body d-flex justify-content-center px-0 pt-0 pb-2">
        <div class="table-responsive p-0" style="width: 50%">
            <div class="print-table-container">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" 
                            style="width: 8%;">
                            no
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" 
                            style="width: 20%;">
                            Nama
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" 
                            style="width: 10%;">
                            Hasil
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $counter = 1; @endphp                                                                                                
                        @foreach ($testing as $data)
                        <tr style="d-flex justify-content-center">
                            <td>
                                <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 text-sm">{{ $counter }}</h6>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">{{ $data->nama }}
                                </p>
                            </td>
                            <td >
                                <span
                                    class="text-xs font-weight-bold">{{ $data->nilai}}</span>
                            </td>
                        </tr>
                        @php
                            $counter++;
                         @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>    
</body>
</html>
<script type="text/javascript">
    window.print();
</script>