@extends('layouts.global')

@section('title')
    Halaman Tambah Barang
@endsection

@section('content')
    <div class="card mb-5">
        <div class="card-header">
            Tambah Barang
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="">Nama Barang</label>
                <input type="text" class="form-control" id="product_name" placeholder="Nama Barang">
            </div>
            <div class="form-group">
                <label for="">Quantity</label>
                <input type="number" class="form-control" id="qty" placeholder="Quantity">
            </div>
            <div class="form-group">
                <label for="">Link Gambar</label>
                <small>input berupa link gambar</small>
                <input type="text" class="form-control" id="link" placeholder="masukkan link gambar">
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="" class="form-control" id="status">
                    <option value="" selected disabled>- Chose Option -</option>
                    <option value="masuk">Masuk</option>
                    <option value="keluar">Keluar</option>
                </select>
            </div>
            <button class="col-md-12 btn btn-primary" id="btnSubmit">Submit</button>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            Record Data
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Index</th>
                        <th>Nama Barang</th>
                        <th>Quantity</th>
                        <th>Images</th>
                        <th>Status</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody id="record_data">

                </tbody>
            </table>
        </div>
    </div>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnUpdate">Save changes</button>
        </div>
      </div>
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
        var lastIdLog = 0;

        // GET DATA
        database.ref("barangs").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function(index, value){
                if(value) {
                    htmls.push(`<tr>
                                    <td>`+index+`</td>
                                    <td>`+value.product_name+`</td>
                                    <td>`+value.qty+`</td>
                                    <td>
                                        <img src="`+value.link+`" alt=""width="70" height="70">
                                    </td>
                                    <td>`+value.status+`</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"
                                        id="update"
                                        data-id="`+index+`"
                                        data-product_name="`+value.product_name+`"
                                        data-qty="`+value.qty+`"
                                        data-link="`+value.link+`"
                                        data-status="`+value.status+`">
                                        UPDATE
                                    </button>
                                        <button id="destroy"data-id="`+index+`" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>`);
                }       
                lastId = index;
            });
            $('#record_data').html(htmls);
        });

        database.ref("log_barangs").on('value', function(snapshot) {
            var value = snapshot.val();
            var htmls = [];
            $.each(value, function(index, value){     
                lastIdLog = index;
            });
        });

        // POST DATA
        $(document).on('click', '#btnSubmit', function(){
            // get input value
            var product_name = document.getElementById('product_name').value
            var qty = document.getElementById('qty').value
            var link = document.getElementById('link').value
            var status = $("#status option:selected").val()

            // push to firebase
            var createId = Number(lastId) + 1;
            firebase.database().ref('barangs/'+createId).set({
                product_name : product_name,
                qty : qty,
                link : link,
                status : status,
                user_id: "{{ Auth::guard('user')->user()->id }}"
            });
            lastIdLogs = Number(lastIdLog) + 1
            firebase.database().ref('log_barangs/'+lastIdLogs).set({
                product_name : product_name,
                qty : qty,
                link : link,
                status : status,
                user_id: "{{ Auth::guard('user')->user()->id }}",
                keterangan: "created data!!"
            });
            lastId = createId;
            lastIdLog = lastIdLogs
        })

        
        // DELETE
        $(document).on('click', '#destroy',  function (e) {
            if("{{ Auth::guard('user')->user()->roles->status }}" == 'ADMIN'){
                var id = e.currentTarget.dataset.id
                firebase.database().ref('barangs/'+id).remove()

                database.ref("barangs/"+id).on('value', function(snapshot) {
                    var value = snapshot.val();
                    var htmls = [];
                    lastIdLogs = Number(lastIdLog) + 1
                    $.each(value, function(index, value){     
                        firebase.database().ref('log_barangs/'+lastIdLogs).set({
                            product_name : value.product_name,
                            qty : value.qty,
                            link : value.link,
                            status : value.status,
                            user_id: value.user_id,
                            keterangan: "removed data!!"
                        });
                        lastIdLog = lastIdLogs
                    });
                });
            }else{
                alert('ANDA TIDAK MEMPUNYAI HAK AKSES!!')
            }
        })

        $(document).on('click', '#update',  function (e) {
            var id = e.currentTarget.dataset.id
            var product_name = e.currentTarget.dataset.product_name
            var qty = e.currentTarget.dataset.qty
            var link = e.currentTarget.dataset.link
            var status = e.currentTarget.dataset.status
            var formUpdate = `<div class="form-group">
                                <label for="">Nama Barang</label>
                                <input type="text" class="form-control" value="`+product_name+`" id="update_product_name" placeholder="Nama Barang">
                            </div>
                            <div class="form-group">
                                <label for="">Quantity</label>
                                <input type="number" class="form-control" value="`+qty+`" id="update_qty" placeholder="Quantity">
                            </div>
                            <div class="form-group">
                                <label for="">Link Gambar</label>
                                <small>input berupa link gambar</small>
                                <input type="text" class="form-control" value="`+link+`" id="update_link" placeholder="masukkan link gambar">
                            </div>
                            <div class="form-group">
                                <label for="">Status</label>
                                <select name="" class="form-control" id="update_status">
                                    <option value="`+status+`" selected>`+status+`</option>
                                    <option value="masuk">Masuk</option>
                                    <option value="keluar">Keluar</option>
                                </select>
                            </div>
                            <input type="hidden" id="update_id" value="`+id+`">`
            $('.modal-body').html(formUpdate)
        })

        $(document).on('click', '#btnUpdate', function () {
            var updateId = document.getElementById('update_id').value
            var update_product_name = document.getElementById('update_product_name').value
            var update_qty = document.getElementById('update_qty').value
            var update_link = document.getElementById('update_link').value
            var update_status = $('#update_status option:selected').val()
            console.log(update_status)
            firebase.database().ref('barangs/'+updateId).set({
                product_name : update_product_name,
                qty : update_qty,
                link : update_link,
                status : update_status,
                user_id: "{{ Auth::guard('user')->user()->id }}"
            });
            lastIdLogs = Number(lastIdLog) + 1
            firebase.database().ref('log_barangs/'+lastIdLogs).set({
                product_name : update_product_name,
                qty : update_qty,
                link : update_link,
                status : update_status,
                user_id: "{{ Auth::guard('user')->user()->id }}",
                keterangan: "updated data!!"
            });
            lastIdLog = lastIdLogs
        })
    </script>
@endsection