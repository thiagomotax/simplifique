$(document).ready(function () {
    $('#button-cadastrar-anexo').click(function () {
      jQuery('.js-validation-anexo').validate({
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
          'titulo': {
              required: true,
          },
          'url': {
              required: false,
          },
          'file': {
              required: false,
          },
          'disciplina': {
              required: true,
          },
          'data': {
              required: true,
          },
          'curso': {
              required: true,
          }
      },
      messages: {
        'titulo': {
            required: 'Por favor, digite titulo do anexo',
        },
        'url': {
            required: 'Por favor, digite a url do anexo',
        },
        '': {
            required: 'Por favor, insira o anexo',
        },
         'disciplina': {
            required: 'Por favor, selecione a disciplina',
        },
         'data': {
            required: 'Por favor, insira a data',
        },
        'curso': {
            required: 'Por favor, selecione o curso',
        }
    },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-anexo').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/ControllerAnexo.php",
            data: dados,
            success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-anexo")[0].reset()
                alerta("success", "Anexo cadastrado com sucesso!", " Cadastrar outro", "Ver lista de anexos", "viewListarAnexo.php");
              } else {
                $body.removeClass("loading");
                alerta("error", "Erro ao cadastrar anexo!", " Cadastrar outro", "Ver lista de anexo", "viewListarAnexo.php");
              }     
            }
          });
          return false;
        }
      });
    });
  });

$(document).ready(function () {
  $('#btnEditarAnexo').click(function () {
      var dados = $('#verAnexo-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $('#verAnexo').modal('hide');
      $.ajax({
          type: "POST",
          url: "../controller/ControllerAnexo.php",
          data: dados,
          success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Anexo editado com sucesso!", " Ver anexo", "Adicionar novo anexo", "viewAdicionarAnexo.php");
                atualizarTabela();
                  
              } else {
                $body.removeClass("loading");
                alerta("error", "Erro ao editar anexo", " Ver anexo", "Adicionar novo anexo", "viewAdicionarAnexo.php");
                atualizarTabela();
              }
          }
      });
      return false;
  });
});

function excluirAnexo(id) {
  var titulo = $('#rowDeleteAnexo_' + (id - 1)).attr("data-titulo");
  var id = $('#rowDeleteAnexo_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o anexo ?",
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
              url: "../controller/ControllerAnexo.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Anexo excluído com sucesso!", " Ver anexo", "Adicionar novo anexo", "viewAdicionarAnexo.php");
                    atualizarTabela();
                  }
                  else if(result == 2){
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir o anexo!", " Ver anexo", "Adicionar novo anexo", "viewAdicionarAnexo.php");
                    atualizarTabela();
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

  function atualizarTabela(){
    var table = $('#listar_anexo').DataTable();
    table.ajax.reload(null, false);
  }

  function editarAnexo(id) {
    var idAnexo = $('#rowEditarAnexo_' + (id - 1)).attr("data-id");
    var cursoAnexo = $('#rowEditarAnexo_' + (id - 1)).attr("data-idC");
    var tituloAnexo = $('#rowEditarAnexo_' + (id - 1)).attr("data-titulo");
    var urlAnexo = $('#rowEditarAnexo_' + (id - 1)).attr("data-url");
    var disciplinaAnexo = $('#rowEditarAnexo_' + (id - 1)).attr("data-disciplina");
    var fileAnexo = $('#rowEditarAnexo_' + (id - 1)).attr("data-file");

    $('#curso').load('../view/hello.php?IdCurso='+cursoAnexo);
    $('#disciplina').load('../view/hello3.php?IdDisciplina='+disciplinaAnexo);

    $('#verAnexo').modal('show');
    $('.modal .modal-dialog .modal-content #tituloP').text("Detalhes do anexo ");
    $('.modal .modal-dialog .modal-content #id').val(idAnexo);
    $('.modal .modal-dialog .modal-content #titulo').val(tituloAnexo);
    $('.modal .modal-dialog .modal-content #url').val(urlAnexo);
    $('.modal .modal-dialog .modal-content #disciplina').val(disciplinaAnexo);
    $('.modal .modal-dialog .modal-content #file').val(fileAnexo);
  
}


