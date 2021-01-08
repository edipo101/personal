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

    $('#btn-pdf').click(function(){
      console.log('pdf');
      $('#pdf').val('1');
      var form = $('#form-filter');
      form.attr('target', '_blank');
      form.submit();
      form.removeAttr('target');
      $('#pdf').removeAttr('value');
    });

  });
</script>