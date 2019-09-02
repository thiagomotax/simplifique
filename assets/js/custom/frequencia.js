$(document).ready(function () {
    $('#button-cadastrar-frequencia').click(function () {
      jQuery('.js-validation-frequencia').validate({
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
          'data': {
              required: true
          },
      },
      messages: {
        'curso': {
            required: 'Por favor, selecione o curso',
        },
        'disciplina': {
            required: 'Por favor, selecione a disciplina',
        },
        'data': {
            required: 'Por favor, selecione a data',
        }
    },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-frequencia').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/ControllerFrequencia.php",
            data: dados,
            success: function (result) {
            alert(result);
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-frequencia")[0].reset();
                window.location="viewAdicionarFrequencia.php";
              } else{
                $body.removeClass("loading");
                alerta("error", "Erro!<BR> Houve algum erro no processamento, tente novamente", "Voltar", "", "viewGerarFrequencia.php");
              }
            }
          });
          return false;
        }
      });
    });
  });


function editarFrequencia(id) {
      var situacao = $('#btnEditarFrequencia_' + (id)).attr("data-situacao");
      var idFrequencia = $('#btnEditarFrequencia_' + (id)).attr("data-id");
      /*var dados = $('#form-atualizar-frequencia').serializeArray();*/
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
        type: "POST",
          url: "../controller/ControllerFrequencia.php",
          /*data: dados, */
          data: {
                  acao: "editar",
                  situacao: situacao,
                  id: idFrequencia
              },
          success: function (result) {
            $body.removeClass("loading");
             atualizarTabela();
            //  alert(result);
             }


      });
      return false;
  }



  function editarrFrequencia(id) {
      var situacao = $('#btnEditarrFrequencia_' + (id)).attr("data-situacao");
      var idFrequencia = $('#btnEditarrFrequencia_' + (id)).attr("data-id");
      $body = $("body");
      $body.addClass("loading");
      $.ajax({
        type: "POST",
          url: "../controller/ControllerFrequencia.php",
          data: {
                  acao: "editar",
                  situacao: situacao,
                  id: idFrequencia
              },
          success: function (result) {
            $body.removeClass("loading");
          atualizarTabela();
          // alert(result);
          }


      });
      return false;
  }




function excluirFrequencia(id) {

    var idCurso = $('#rowDeleteFrequencia_' + (id - 1)).attr("data-curso");
    var dataFrequencia = $('#rowDeleteFrequencia_' + (id - 1)).attr("data-data");
    var idDisciplina = $('#rowDeleteFrequencia_' + (id - 1)).attr("data-disciplina");


  Swal.fire({
      title: "Deseja realmente excluir essa lista  ?",
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
              url: "../controller/ControllerFrequencia.php",
              data: {
                  acao: "excluir",
                  curso: idCurso,
                  data: dataFrequencia,
                  disciplina: idDisciplina

              },
              success: function (result) {
              alert(result);
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Lista exclu�da com sucesso!", " Ver frequencias lan�adas", "Gerar nova lista", "viewGerarFrequencia.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir lista!", " Ver frequencias lan�adas", "Gerar nova lista", "viewGerarFrequencia.php");
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

    var table = $('#listar_frequencia').DataTable();
    table.ajax.reload(null, false);
  }

 /* function editarFrequencia(id) {
    var idFrequencia = $('#rowEditarFrequencia_' + (id - 1)).attr("data-id");
    var nomeAluno = $('#rowEditarFrequencia_' + (id - 1)).attr("data-nome");


    var situacaoFrequencia = $('#rowEditarFrequencia_' + (id - 1)).attr("data-situacao");



    $('#verFrequencia').modal('show');

    $('.modal .modal-dialog .modal-content #nomeP').text("Detalhes do Aluno(a)");

    $('.modal .modal-dialog .modal-content #id').val(idFrequencia);

    $('.modal .modal-dialog .modal-content #situacao').val(situacaoFrequencia);

} */

