$(function(){
    //untuk fgs
    $('.tombolTambahDataFgs').on('click',function () {
        $('#formModalLabel').html('Add New Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action','/fgs');
        $('#sap_code').val("");
        $('#material_desc').val("");
        $('#price_lbs').val("");
        $('#lbs').val("");
        $('#std_price').val("");
        $('#processing_fee').val("");
    });
    $('.tampilModalUbahFgs').on('click',function () {
        $('#formModalLabel').html('Update Item');
        $('.modal-footer button[type=submit]').html('Update');
        var id = $(this).data('id');
        $('.modal-body form').attr('action','/fgs/'+id+'/update');
        $.ajax({
            url: '/fgs/getubah',
            data: {id : id},
            method:'get',
            dataType : 'json',
            success: function (data) {
                $('#sap_code').val(data.sap_code);
                $('#material_desc').val(data.material_desc);
                $('#plant').val(data.plant);
                $('#price_lbs').val(data.price_lbs);
                $('#lbs').val(data.lbs);
                $('#std_price').val(data.std_price);
                $('#processing_fee').val(data.processing_fee);
                $('#category').val(data.category);
            }
        });
    });

    //untuk macs
    $('.tombolTambahDataMacs').on('click',function () {
        $('#formModalLabel').html('Add New Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action','/macs');
        $('#sap_code').val("");
        $('#material_desc').val("");
        $('#price_lbs').val("");
        $('#lbs').val("");
        $('#std_price').val("");
        $('#processing_fee').val("");
    });
    $('.tampilModalUbahMacs').on('click',function () {
        $('#formModalLabel').html('Update Item');
        $('.modal-footer button[type=submit]').html('Update');
        var id = $(this).data('id');
        $('.modal-body form').attr('action','/macs/'+id+'/update');
        $.ajax({
            url: '/macs/getubah',
            data: {id : id},
            method:'get',
            dataType : 'json',
            success: function (data) {
                $('#sap_code').val(data.sap_code);
                $('#material_desc').val(data.material_desc);
                $('#plant').val(data.plant);
                $('#mac').val(data.mac);
            }
        });
    });


    //untuk pts
    $('.tampilModalUbahPts').on('click',function () {
        var id = $(this).data('id');
        $('.modal-body form').attr('action','/pts/'+id+'/update');
        $.ajax({
            url: '/ptspt/getubah',
            data: {id : id},
            method:'get',
            dataType : 'json',
            success: function (data) {
                $('#lbs').val(data.lbs);
                $('#loin').val(data.loin);
            }
        });
    });
    $("#pt_name, #plant").on("keyup", function(){
        $("#validatept").val($("#pt_name").val() + $("#plant").val());
    });

    //untuk packagings
    $('.tombolTambahDataPackagings').on('click',function () {
        $('#formModalLabel').html('Add New Item');
        $('.modal-footer button[type=submit]').html('Add');
        $('.modal-body form').attr('action','/packagings');
        $('#month').val("");
        $('#lab').val("");
        $('#ofc').val("");
        $('#expenses').val("");
        $('#packaging').val("");
        $('#lbs').val("");
        $('#other').val("");
    });
    $('.tampilModalUbahPackaging').on('click',function () {
        $('#formModalLabel').html('Update Item');
        $('.modal-footer button[type=submit]').html('Update');
        var id = $(this).data('id');
        $('.modal-body form').attr('action','/packagings/'+id+'/update');
        $.ajax({
            url: '/packagings/getubah',
            data: {id : id},
            method:'get',
            dataType : 'json',
            success: function (data) {
                $('#month').val(data.month);
                $('#lab').val(data.lab);
                $('#ofc').val(data.ofc);
                $('#expenses').val(data.expenses);
                $('#packaging').val(data.packaging);
                $('#lbs').val(data.lbs);
                $('#other').val(data.other);
            }
        });
    });

    $('.formProfile').on('click',function () {
        $('#formModalLabel').html('Update Item');
        $('.modal-footer button[type=submit]').html('Update');
        var id = $(this).data('id');
        $('.modal-body form').attr('action','/profile/'+id+'/update');
        $.ajax({
            url: '/profileuser/getuser',
            data: {id : id},
            method:'get',
            dataType : 'json',
            success: function (data) {
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#departement').val(data.departement);
                $('#position').val(data.position);
                $('#education').val(data.education);
                $('#address').val(data.address);
                $('#avatar').val(data.avatar);
            }
        });
    });

    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": true,
        });
      });

      $(document).ready(function () {
        bsCustomFileInput.init();
      });

});