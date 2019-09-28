$(document).ready(function () {
    $('#button-Gerar-Cronograma').click(function () {
      jQuery('.js-validation-cronograma').validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: (error, e) => {
            jQuery(e).parents('.form-group > div').append(error);
        },
        highlight: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        rules: {
          'curso': {
              required: true,
          },
          'disciplina': {
              required: true,
          },
          '': {
              required: true,
              email: true
          }
        },
        messages: {
          'curso': {
            required: 'Por favor, selecione um curso',
          },
          'disciplina': {
            required: 'Por favor, selecione uma disciplina',
          },
          '': {
            required: 'Por favor, digite o e-mail do cronograma',
            email: 'Digite um endereço de email válido'
          },
          '': {
            required: 'Por favor, digite a senha do cronograma',
            minlength: 'A senha deve ter no mínimo 8 caracteres'
          }
         },
      });
    });


    $('#button-cadastrar-cronograma').click(function () {
      jQuery('.js-validation-cronograma').validate({
        errorClass: 'invalid-feedback animated fadeInDown',
        errorElement: 'div',
        errorPlacement: (error, e) => {
            jQuery(e).parents('.form-group > div').append(error);
        },
        highlight: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid').addClass('is-invalid');
        },
        success: e => {
            jQuery(e).closest('.form-group').removeClass('is-invalid');
            jQuery(e).remove();
        },
        rules: {
          '': {
              required: true,
          },
        },
        messages: {
          '': {
            required: '',
          },
         },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-cronograma').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/ControllerCronograma.php",
            data: dados,
            success: function (result) {
            alert(result);
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-cronograma")[0].reset();
                alerta("success", "Cadastrado com sucesso!", " ", "Atualizar lista", "");
                $("#listar_cronograma").bootstrapTable('refresh');
              } else{
                $body.removeClass("loading");
                alerta("error", "Erro!", " Tentar novamente", "Voltar", "");
              }
            }
          });
          return false;
        }
      });
    });
  });

$(document).ready(function () {
  $('#btnEditarCronograma').click(function () {
      var dados = $('#verCronograma-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $('#verCronograma').modal('hide');
      $.ajax({
          type: "POST",
          url: "../controller/ControllerCronograma.php",
          data: dados,
          success: function (result) {
          alert(result);
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Cronograma editado com sucesso!", " Voltar", "Atualizar lista", "");

              } else{
                $body.removeClass("loading");
                alerta("error", "Erro ao editar cronograma <br> Verifique se a data foi adicionada", " Voltar", "", "");
              }
          }
      });
      return false;
  });
});

function excluirCronograma(id) {
  var id = $('#rowDeleteCronograma_' + (id)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o cronograma ?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#D05BE2",
      confirmButtonText: "<i class='fa fa-times'></i> Excluir",
      cancelButtonText: "<i class='fa fa-check'></i> Cancelar",
      preConfirm: function () {
        $body = $("body");
        $body.addClass("loading");
          $.ajax({
              type: "POST",
              url: "../controller/ControllerCronograma.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Excluído com sucesso!", " Voltar", "Atualizar lista", "");
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir!", " Voltar", "", "");
                  }

              }
          });
      }
  });
  return false;
}
  function alerta(type, title, button, footer, link){
    Swal.fire({
      type: type,
      showConfirmButton: false,
      html:
      '<button id="ok" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i>'+ button +'</button>',
      title: title,
      footer: '<a href="'+link+'">'+footer+'</a>'
    });
    $("#ok").click(function () {
      Swal.close();
    });
  }

 /* function atualizarTabela(){
    var table = $('#listar_cronograma').DataTable();
    able.ajax.reload(null, false);
  }
 */
  function editarCronograma(id) {
    var idCronograma = $('#rowEditarCronograma_' + (id)).attr("data-id");
    var tituloCronograma = $('#rowEditarCronograma_' + (id)).attr("data-titulo");
    var dataCronograma = $('#rowEditarCronograma_' + (id)).attr("data-data");
    var descricaoCronograma = $('#rowEditarCronograma_' + (id)).attr("data-descricao");


    $('#verCronograma').modal('show');

    $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes");
    $('.modal .modal-dialog .modal-content #id').val(idCronograma);
    $('.modal .modal-dialog .modal-content #titulo').val(tituloCronograma);
    $('.modal .modal-dialog .modal-content #data').val(dataCronograma);
    $('.modal .modal-dialog .modal-content #descricao').val(descricaoCronograma);

}


