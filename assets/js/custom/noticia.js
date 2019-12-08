$(document).ready(function () {
    $('#button-cadastrar-noticia').click(function () {
      jQuery('.js-validation-noticia').validate({
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
          'descricao': {
              required: true,
          },
          'data': {
              required: true,
          },
          'curso': {
              required: true,
          },
          'cpf': {
              required: true,
          }
      },
      messages: {
        'titulo': {
            required: 'Por favor, digite o titulo da notícia',
        },
        'descricao': {
            required: 'Por favor, descreva a notícia',
        },
        'data': {
            required: 'Por favor, preencha a data do cadastro',
        },
        'curso': {
            required: 'Por favor, selecione o curso',
        },
        'cpf': {
            required: '<BR> <BR> Por favor, selecione o campo',
        }
    },
        submitHandler: function (form) {
          var dados = $('#form-cadastrar-noticia').serializeArray();
          $body = $("body");
          $body.addClass("loading");
          $.ajax({
            type: "POST",
            url: "../controller/ControllerNoticia.php",
            data: dados,
            success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                $("#form-cadastrar-noticia")[0].reset()
                alerta("success", "Notícia cadastrada com sucesso!", " Cadastrar outra", "Ver notícias cadastradas", "viewListarNoticias.php");
              } else {
                $body.removeClass("loading");
                alerta("error", "Erro ao cadastrar notícia!", " Cadastrar outra", "Ver notícias cadastradas", "viewListarNoticias.php");
              }
            }
          });
          return false;
        }
      });
    });
  });

$(document).ready(function () {
  $('#btnEditarNoticia').click(function () {
      var dados = $('#verNoticia-form').serializeArray();
      $body = $("body");
      $body.addClass("loading");
      $('#verNoticia').modal('hide');
      $.ajax({
          type: "POST",
          url: "../controller/ControllerNoticia.php",
          data: dados,
          success: function (result) {
              if (result == 1) {
                $body.removeClass("loading");
                alerta("success", "Notícia editada com sucesso!", " Ver notícia", "Adicionar nova notícia", "viewAdicionarNoticias.php");
                atualizarTabela();

              } else{
                $body.removeClass("loading");
                alerta("error", "Erro ao editar notícia", " Ver notícia", "Adicionar nova notícia", "viewAdicionarNoticias.php");
                atualizarTabela();
              }
          }
      });
      return false;
  });
});

function excluirNoticia(id) {
  var id = $('#rowDeleteNoticia_' + (id - 1)).attr("data-id");

  Swal.fire({
      title: "Deseja realmente excluir a notícia ?",
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
              url: "../controller/ControllerNoticia.php",
              data: {
                  acao: "excluir",
                  id: id
              },
              success: function (result) {
                  if (result == 1) {
                    $body.removeClass("loading");
                    alerta("success", "Notícia excluída com sucesso!", " Ver notícia", "Adicionar nova notícia", "viewAdicionarNoticias.php");
                    atualizarTabela();
                  }
                  else{
                    $body.removeClass("loading");
                    alerta("error", "Erro ao excluir notícia!", " Ver notícia", "Adicionar nova notícia", "viewAdicionarNoticias.php");
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

    var table = $('#listar_noticias').DataTable();
    table.ajax.reload(null, false);
  }

function editarNoticia(id) {
    var idNoticia = $('#rowEditarNoticia_' + (id - 1)).attr("data-id");
    var cursoNoticia = $('#rowEditarNoticia_' + (id - 1)).attr("data-idC");
    var tituloNoticia = $('#rowEditarNoticia_' + (id - 1)).attr("data-titulo");
    var descricaoNoticia = $('#rowEditarNoticia_' + (id - 1)).attr("data-descricao");


    $('#curso').load('../view/hello.php?IdCurso='+cursoNoticia);

    $('#verNoticia').modal('show');
    $('.modal .modal-dialog .modal-content #tituloP').text("Detalhes da noticia ");
    $('.modal .modal-dialog .modal-content #id').val(idNoticia);
    $('.modal .modal-dialog .modal-content #titulo').val(tituloNoticia);
    $('.modal .modal-dialog .modal-content #descricao').val(descricaoNoticia);

}
