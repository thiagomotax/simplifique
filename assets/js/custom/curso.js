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
                Swal.fire({
                  type: 'success',
                  showConfirmButton: false,
                  html:
                  '<button id="ok" class="btn btn-primary"><i class="fa fa-plus"></i> Cadastrar outro</button>',
                  title: 'Curso cadastrado com sucesso!',
                  footer: '<a href="viewListarCursos.php">Ver lista de cursos</a>'
                });
                $("#form-cadastrar-curso")[0].reset();
                $("#ok").click(function () {
                  Swal.close();
                });
                
              } else if (result == 2) {
                $body.removeClass("loading");
                // $('#nome').focus();
              }     
            }
          });
          return false;
        }
      });
    });
  });

  // Função para editar Serviço
$(document).ready(function () {
  $('#btnEditarCurso').click(function () {
      var dados = $('#verMembro-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
          type: "POST",
          url: "../controller/controllerCurso.php",
          data: dados,
          success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $('#verCurso').modal('hide');
                Swal.fire({
                  type: 'success',
                  showConfirmButton: false,
                  html:
                  '<button id="ok" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i> Ver cursos</button>',
                  title: 'Curso editado com sucesso!',
                  footer: '<a href="viewAdicionarCurso.php">Adicionar novo curso</a>'
                });
                $("#ok").click(function () {
                  Swal.close();
                });                
                  var table = $('#listar_cursos').DataTable();
                  table.ajax.reload(null, false);
                  
              } else if (result == 2) {
                  var table = $('#listar_cursos').DataTable();
                  table.ajax.reload(null, false);
                  Swal.fire("erro ao editar");
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
      title: 'Confirma?',
      text: "Deseja realmente excluir o curso " + nome + "?",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Sim, excluir!",
      cancelButtonText: "Não, cancelar!",
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
                    Swal.fire({
                      type: 'success',
                      showConfirmButton: false,
                      html:
                      '<button id="ok" type="submit" class="btn btn-primary"><i class="fa fa-eye"></i> Ver cursos</button>',
                      title: 'Curso excluído com sucesso!',
                      footer: '<a href="viewAdicionarCurso.php">Adicionar novo curso</a>'
                    });
                    $("#ok").click(function () {
                      Swal.close();
                    });
                      var table = $('#listar_cursos').DataTable();
                      table.ajax.reload(null, false);
                  }
                  else{
                    $body.removeClass("loading");
                    alert("fuck");
                  }

              }
          });
      }
  });
  return false;
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