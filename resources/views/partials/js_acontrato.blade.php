<script>
  function resize(option){
    if (option == 'nombre')
      $('#group-value').width(220);
    else
      $('#group-value').width(150);
  }

  $(document).ready(function(){
    $('#field').change(function(){
      resize(this.value);
      $('#value').val('');
    });

    op_cant = "{{request('op_cant')}}";
    if (op_cant != '')
      $('#cant').removeAttr('disabled');

    $('#op_cant').change(function(){
      option = this.value;
      if (option == ''){
        $('#cant').attr('disabled', 'disabled');
        $('#cant').val('');
      }
      else
        $('#cant').removeAttr('disabled');
    });

    op_year = "{{request('op_year')}}";
    if (op_year != '')
      $('#year').removeAttr('disabled');

    $('#op_year').change(function(){
      option = this.value;
      if (option == ''){
        $('#year').attr('disabled', 'disabled');
        $('#year').val('');
      }
      else
        $('#year').removeAttr('disabled');
    });

    $('#btn-pdf').click(function(){
      console.log('pdf');
      $('#pdf').val('1');
      var form = $('#form-filter');
      form.attr('target', '_blank');
      form.submit();
      form.removeAttr('target');
      $('#pdf').removeAttr('value');
    });

    $('.btn-contr').click(function(e){
      e.preventDefault();
      var row = $(this).parents('tr');
      id = row.data('id');
        // console.log(id);
        contratos = $('#funcs').find('tr#'+id);
        if (!contratos.length){
          var url = '{{route('contratos.index')}}';
          var data = $("#form-filter").serialize();
          data = data+"&id_func="+id+"&type=json";

          $.get(url, data, function(data){
            $('#contratos').html('');
            $.each(data, function (index, value) {
              $('#contratos').append(
                $('<tr>').append(
                  $('<td>').text(value.id),
                  $('<td class="center">').text(value.nro_doc),
                  $('<td class="right">').text(value.nro_contrato),
                  $('<td>').text(value.cargo),
                  $('<td>').text(value.unidad),
                  $('<td class="right">').text(value.sueldo),
                  $('<td class="center date">').text(dateFormatSql(value.fecha_inicio)),
                  $('<td class="center">').text(dateFormatSql(value.fecha_final)),
                  $('<td class="center">').text(value.gestion)
                  ));
            });
            tr_clone = $('#clone').clone();
            tr_clone.attr('id', id);
            tr_clone.find('#contratos').removeAttr('id');
            row.after(tr_clone);
            tr_clone.show();
          });
        }
        contratos.toggle();
      });

  });
</script>