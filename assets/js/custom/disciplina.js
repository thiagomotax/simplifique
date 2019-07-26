$(document).ready(function () {
    $('#button-cadastrar-disciplina').click(function () {
      jQuery('.js-validation-disciplina').validate({
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
            'idP': {
                required: true,
            },
            'idC': {
                required: true,
            },
            'ano': {
                required: true,
                maxlength: 4
            }
        },
        messages: {
            'nome': {
                required: 'Por favor, preencha o nome da disciplina!'
            },
            'idP': {
                required: 'Por favor, preencha a o professor da disciplina!'
            },
            'idC': {
                required: 'Por favor, o disciplina que a disciplina pertence'
            },
            'ano': {
                required: 'Por favor, preencha a ano do disciplina!',
                maxlength: 'Preencha o ano na forma YYYY'
            }
        },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-disciplina').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/controllerDisciplina.php",
            data: dados,
            success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-disciplina")[0].reset()
                alerta("success", "Disciplina cadastrada com sucesso!", " Cadastrar outra", "Ver lista de disciplinas", "viewListarDisciplinas.php");               
                atualizarTabela();
                
              } else if(result == 2){
                $body.removeClass("loading");
                alerta("error", "Erro ao cadastrar disciplina!", " Cadastrar outra", "Ver lista de disciplinas", "viewListarDisciplinas.php");         
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
  $('#btnEditarDisciplina').click(function () {
      var dados = $('#verDisciplina-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $('#verDisciplina').modal('hide');
      $.ajax({
          type: "POST",
          url: "../controller/controllerDisciplina.php",
          data: dados,
          success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Disciplina editado com sucesso!", " Ver disciplinas", "Adicionar nova disciplina", "viewAdicionarDisciplina.php");               
                atualizarTabela();
                  
              } else if(result == 2){
                $body.removeClass("loading");
                alerta("error", "Erro ao editar Disciplina", " Ver disciplinas", "Adicionar nova disciplina", "viewAdicionarDisciplina.php");               
                atualizarTabela();
              }
          }
      });
      return false;
  });
});

function excluirDisciplina(id) {
  var nome = $('#rowDeleteDisciplina_' + (id - 1)).attr("data-nome");
  var id = $('#rowDeleteDisciplina_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir o disciplina " + nome + "?",
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
              url: "../controller/ControllerDisciplina.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Disciplina excluída com sucesso!", " Ver disciplinas", "Adicionar nova disciplina", "viewAdicionarDisciplina.php");
                    atualizarTabela();
                  }
                  else if(result == 2){
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir a disciplina!", " Ver disciplinas", "Adicionar nova disciplina", "viewAdicionarDisciplina.php");
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
    var table = $('#listar_disciplinas').DataTable();
    table.ajax.reload(null, false);
  }

  function editarDisciplina(id) {
    var idDisciplina = $('#rowEditarDisciplina_' + (id - 1)).attr("data-idD");
    var idCurso = $('#rowEditarDisciplina_' + (id - 1)).attr("data-idC");
    var idProfessor = $('#rowEditarDisciplina_' + (id - 1)).attr("data-idP");
    var nomeDisciplina = $('#rowEditarDisciplina_' + (id - 1)).attr("data-nome");
    var anoDisciplina = $('#rowEditarDisciplina_' + (id - 1)).attr("data-ano");

    // document.getElementById('idPx').options[0].text = nomeDisciplina;
    $('#verDisciplina').modal('show');
    $('.modal .modal-dialog .modal-content #nomeC').text("Detalhes da disciplina " + nomeDisciplina);
    $('.modal .modal-dialog .modal-content #idD').val(idDisciplina);
    $('.modal .modal-dialog .modal-content #idP').val(nomeDisciplina);
    $('.modal .modal-dialog .modal-content #nomeCs').val(idCurso);
    $('.modal .modal-dialog .modal-content #nomeP').val(nomeDisciplina);
    $('.modal .modal-dialog .modal-content #nomeD').val(nomeDisciplina);
    $('.modal .modal-dialog .modal-content #ano').val(anoDisciplina);
  
}