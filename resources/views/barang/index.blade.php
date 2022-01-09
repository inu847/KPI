@extends('layouts.global')

@section('title')
    Halaman Barang
@endsection

@section('content')    
    <div class="card">
        <div class="card-header">
            Halaman Utama Barang
        </div>
        <div class="card-body">
            <div class="row" id="table-list"></div>
        </div>
    </div>

    {{-- FIREBASE --}}
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.0.0/firebase-database.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        const firebaseConfig = {
          apiKey: "{{ config('services.firebase.apiKey') }}",
          authDomain: "{{ config('services.firebase.authDomain') }}",
          projectId: "{{ config('services.firebase.projectId') }}",
          storageBucket: "{{ config('services.firebase.storageBucket') }}",
          messagingSenderId: "{{ config('services.firebase.messagingSenderId') }}",
          appId: "{{ config('services.firebase.appId') }}",
          measurementId: "{{ config('services.firebase.measurementId') }}",
          databaseUrl: "{{ config('services.firebase.databaseUrl') }}"
        };
      
        // Initialize Firebase
        const app = firebase.initializeApp(firebaseConfig);
        var database = firebase.database();
        var lastId = 0;

        // GET DATA
        database.ref("barangs").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function(index, value){
                if(value) {
                    htmls.push(`<div class="col-md-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <img src="`+value.link+`" width="100%" height="350px" class="mb-3">
                                            <table>
                                                <tr>
                                                    <th style="padding-right: 30px;"><span class="badge badge-info"> Product Name</span></th>
                                                    <td style="padding-right: 5px;">:</td>
                                                    <td>`+value.product_name+`</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-right: 30px;"><span class="badge badge-info"> Quantity</span></th>
                                                    <td style="padding-right: 5px;">:</td>
                                                    <td>`+value.qty+`</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-right: 30px;"><span class="badge badge-info"> Status</span></th>
                                                    <td style="padding-right: 5px;">:</td>
                                                    <td><span class="badge badge-warning">`+value.status+`</span></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>`);
                }       
                lastId = index;
            });
            $('#table-list').html(htmls);
        });
        
        </script>
@endsection