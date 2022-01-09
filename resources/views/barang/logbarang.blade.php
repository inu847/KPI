@extends('layouts.global')

@section('title')
    Log Barang
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            Record Data
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Product</th>
                        <th>Quantity</th>
                        <th>Status</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody id="record_data">
                    
                </tbody>
            </table>
        </div>
    </div>

    {{-- SCRIPT JS --}}
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
        database.ref("log_barangs").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function(index, value){
                if(value) {
                    htmls.push(`<tr>
                                    <td>`+index+`</td>
                                    <td>`+value.product_name+`</td>
                                    <td>`+value.qty+`</td>
                                    <td>`+value.status+`</td>
                                    <td>
                                        <img src="`+value.link+`" alt=""width="100" height="100">
                                    </td>
                                </tr>`);
                }       
                lastId = index;
            });
            $('#record_data').html(htmls);
        });
    </script>
@endsection