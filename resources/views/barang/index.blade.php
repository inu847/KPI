@extends('layouts.global')

@section('title')
    Halaman Barang
@endsection

@section('content')
    Halaman utama barang
    
    <div class="row" id="table-list"></div>
    <form action="">
        <input type="file" id="image" class="form-control">
        <button id="btnSubmit">Submit</button>
    </form>

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
                                            <img src="{{ asset("asset/logo.png")}}" width="100%" height="350px">
                                            <table>
                                                <tr>
                                                    <th style="padding-right: 30px;"><span class="badge badge-info"> Product Name</span></th>
                                                    <td>KOHAKU</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-right: 30px;"><span class="badge badge-info"> Quantity</span></th>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <th style="padding-right: 30px;"><span class="badge badge-info"> Status</span></th>
                                                    <td>5</td>
                                                </tr>
                                                <tr class="text-center">
                                                    <th>
                                                        <div class="d-grid gap-2">
                                                            <button class="btn btn-info">UPDATE</button>
                                                        </div>
                                                    </th>
                                                    <th>
                                                        <div class="d-grid gap-2">
                                                            <button class="btn btn-danger">DELETE</button>
                                                        </div>
                                                    </th>
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

        // POST DATA
        $(document).on('click', '#btnSubmit', function(){
            // onclick btn submit get value by id
            // validation if value null alert
            // push to firebase
            var createId = Number(lastId) + 1;
            var reader = new FileReader()
            // STORE IMAGES
            var name = document.getElementById("image").files[0].name
            reader.addEventListener('load', function(){
                if (this.result && localStorage) {
                    window.localStorage.setItem(name, this.result)
                    alert("image stored in local storage")
                }else{
                    alert("failed")
                }
            })
            reader.readAsDataURL(document.getElementById("image").files[0])

            firebase.database().ref('barangs/'+createId).set({
                product_name: "Kohaku Size 40cm",
                quantity: "5",
                status: "success",
                user_id: "1"
            });
            lastId = createId;

            alert(reader)
        })

        // EDIT DATA
        // get id

        // DELETE
        
            // var id = $('#post-id').val();
            // firebase.database().ref('barangs/'+createId).remove()

            // $('#post-id').val('');
            // $("#delete-modal").modal('hide');


        // UPLOAD IMAGES
        
        </script>
@endsection