$(document).on('click','#btn-edit-produk', function () {
    $('.modal-body #id-produk').val($(this).data('id'));
    $('.modal-body #kode').val($(this).data('kode'));
    $('.modal-body #nama').val($(this).data('nama'));
    $('.modal-body #foto').val($(this).data('foto'));
    $('.modal-body #khas').val($(this).data('khas'));
    $('.modal-body #ijin').val($(this).data('ijin'));
    $('.modal-body #prod').val($(this).data('prod'));
})

$(document).on('click','#btn-edit-batch', function () {
    $('.modal-body #id-batch').val($(this).data('id'));
    $('.modal-body #kode').val($(this).data('kodebatch'));
    $('.modal-body #idproduk').val($(this).data('idproduk'));
})