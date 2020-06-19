<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tambah Data</title>
<link rel="icon" href="tambah.png">

<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/tambahdata.css')}}" />
<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/bootstrap.css')}}" />

</head>

<body>
	<div class="container-fluid">

        <div class="row header">
            <div class="col-lg-1">
                <img src="/image/logo.png" class="img-responsive">
            </div>
            <div class="col-lg-9 tittle">
                <h2>Persebaran Covid-19 | Provinsi Bali</h2>
            </div>

            <div class="row col-lg-2">
                <a class="tambahdata" href="/">Back</a>
            </div>
         </div>   <!--- End Header --->

    	<div class="row atas">

        	<div class="col-lg-12">
                <div class="box">
                <h4>Tambah Data Kasus Covid-19</h4>
                @if (session('alert'))
                    <div class="alert alert-success">
                        {{ session('alert') }}
                    </div>
                @endif
                    <form action="/pasien" method="post" id="form">
                    @csrf
                      <div class="form-group">
                        <label for="from" >Kabupaten :</label>
                        <select class="form-control" name="kabupaten" id="selectKabupaten" required>
                        <option value="">Pilih Kabupaten</option>
                        @foreach ($kabupaten as $item)
                                <option value="{{$item->id}}">{{ucfirst($item->kabupaten)}}</option>
                            @endforeach
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Kecamatan</label>
                        <select class="form-control"  name="kecamatan" id="selectKecamatan" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Kelurahan</label>
                        <select class="form-control" name="kelurahan" id="selectKelurahan" required>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputEmail1">PP-LN</label>
                        <input type="number" name="ppln" class="form-control" placeholder="Jumlah PP-LN" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">PP-DN</label>
                        <input type="number" name="ppdn" class="form-control" placeholder="Jumlah PP-DN" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">TL</label>
                        <input type="number" name="tl" class="form-control" placeholder="Jumlah TL" required>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Lainnya</label>
                        <input type="number" name="lainnya" class="form-control" placeholder="Jumlah Lainnya" required>
                    </div>

                      <div class="form-group">
                        <label for="from" >Tanggal :</label>
                        <input type="date" class="form-control" name="tgl_data" >
                      </div>

                      <div class="form-group">
                        <label for="from" >Sembuh :</label>
                        <input type="number" class="form-control" name="sembuh" >
                      </div>

                      <div class="form-group">
                        <label for="from" >Masih Dirawat :</label>
                        <input type="number" class="form-control" name="perawatan" >
                      </div>

                      <div class="form-group">
                        <label for="from" >Meninggal :</label>
                        <input type="number" class="form-control" name="meninggal" id="from">
                      </div>

                       <button type="submit" class="btn btn-success mb-2">Submit</button>

                    </form>
                </div><!--- End Box --->
             </div><!--- End Col-lg-12 --->

             <div class="row text col-lg-12">
                <div class="col-lg-6">&copy copyright 2020 Citra Pratiwi 1705552051</div>
        	</div>

        </div><!--- End info --->
    </div><!--- End container --->

</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<!-- <script src="/js/app.js"></script> -->
<script>
    $(document).ready(function() {
        $('.select2').select2();

        $('#selectKabupaten').on('change', function() {
            $.ajax({

                url:'getKecamatan',
                type:'get',
                dataType:'json',
                data:{id_kabupaten: this.value},
                success: function(response){
                    var $kecamatan = $('#selectKecamatan');
                    $kecamatan.empty();
                    console.log(response);
                    for(var i = 0; i < response.length; i++){
                        $kecamatan.append('<option id=' + response[i].id + ' value=' + response[i].id + '>' + response[i].kecamatan + '</option>');
                    }
                    $kecamatan.change();
                }
            });
        });

        $('#selectKecamatan').on('change', function() {
            $.ajax({
                url:'getKelurahan',
                type:'get',
                dataType:'json',
                data:{id_kecamatan: this.value},
                success: function(response){
                    var $kelurahan = $('#selectKelurahan');
                    $kelurahan.empty();
                    console.log(response);
                    for(var i = 0; i < response.length; i++){
                        $kelurahan.append('<option id=' + response[i].id + ' value=' + response[i].id + '>' + response[i].kelurahan + '</option>');
                    }
                    $kelurahan.change();
                }
            });
        });

        $('#expandable').on('click', function(){
            if($('#listKelurahan').is(':hidden')){
                $('#listKelurahan').show();
                $('#expandable').text("Sembunyikan");
            }else{
                $('#listKelurahan').hide();
                $('#expandable').text("Lihat detail");
            }
        });
    });


</script>
</html>
