$(document).ready(function () {
    $('#button-cadastrar-curso').click(function () {
      jQuery('.js-validation-curso').validate({
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
            'nome': {
                required: true,
            },
            'descricao': {
                required: true,
            }
        },
        messages: {
            'nome': {
                required: 'Por favor, preencha o nome do curso!'
            },
            'descricao': {
                required: 'Por favor, preencha a descrição do curso!'
            }
        },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-curso').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/controllerCurso.php",
            data: dados,
            success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-curso")[0].reset()
                alerta("success", "Curso cadastrado com sucesso!", " Cadastrar outro", "Ver lista de cursos", "viewListarCursos.php");               
                atualizarTabela();
                
              } else{
                $body.removeClass("loading");
                alerta("error", "Erro ao cadastrar curso!", " Cadastrar outro", "Ver lista de cursos", "viewListarCursos.php");         
                atualizarTabela();
              }     
            }
          });
          return false;
        }
      });
    });
  });

$(document).ready(function () {
  $('#btnEditarCurso').click(function () {
      var dados = $('#verMembro-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $('#verCurso').modal('hide');
      $.ajax({
          type: "POST",
          url: "../controller/controllerCurso.php",
          data: dados,
          success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Curso editado com sucesso!", " Ver cursos", "Adicionar novo curso", "viewAdicionarCurso.php");               
                atualizarTabela();
                  
              } else{
                $body.removeClass("loading");
                alerta("error", "Erro ao editar curso", " Ver cursos", "Adicionar novo curso", "viewAdicionarCurso.php");               
                atualizarTabela();
              }
          }
      });
      return false;
  });
});

function excluirCurso(id) {
  var nome = $('#rowDeleteCurso_' + (id - 1)).attr("data-nome");
  var id = $('#rowDeleteCurso_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o curso " + nome + "?",
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
              url: "../controller/ControllerCurso.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Curso excluído com sucesso!", " Ver cursos", "Adicionar novo curso", "viewAdicionarCurso.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir o curso!", " Ver cursos", "Adicionar novo curso", "viewAdicionarCurso.php");
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
    var table = $('#listar_cursos').DataTable();
    table.ajax.reload(null, false);
  }

  function editarCurso(id) {
    var idCurso = $('#rowEditarCurso_' + (id - 1)).attr("data-id");
    var nomeCurso = $('#rowEditarCurso_' + (id - 1)).attr("data-nome");
    var descricaoCurso = $('#rowEditarCurso_' + (id - 1)).attr("data-descricao");

    $('#verCurso').modal('show');

    $('.modal .modal-dialog .modal-content #nomeC').text("Detalhes do curso " + nomeCurso);
    $('.modal .modal-dialog .modal-content #id').val(idCurso);
    $('.modal .modal-dialog .modal-content #nome').val(nomeCurso);
    $('.modal .modal-dialog .modal-content #descricao').val(descricaoCurso);
  
}