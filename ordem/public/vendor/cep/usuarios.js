var App_usuarios = function () {


    var preenche_endereco = function () {


        $('[name=cliente_cep]').focusout(function () {
            
           

            var cliente_cep = $(this).val(); //recupera o valor do cep
            
//           alert(BASE_URL);


            $.ajax({

                type: 'post',
                url: BASE_URL + '/clientes/preenche_endereco',
                dataType: 'json',
                data: {cliente_cep: cliente_cep},
                beforeSend: function () {

                    //Definifir disables e pagar erros de validação

                    $('#cliente_cep').html('<i class="fas fa-cog fa-spin text-info"></i>&nbsp;Consultando o cep...'); // animando icone

                },
                success: function (response) {

                    if (response.erro === 0) {

                        //Limpando o texto
                        $('#cliente_cep').html('');


                        if (!response.fornecedor_endereco) {
                            $('[name=cliente_endereco]').addClass('bg-white text-dark');
                            $('[name=cliente_endereco]').prop('readonly', false);
                        }

                        if (!response.fornecedor_bairro) {
                            $('[name=cliente_bairro]').addClass('bg-white text-dark');
                            $('[name=cliente_bairro]').prop('readonly', false);
                        }



                        $('[name=cliente_endereco]').val(response.cliente_endereco);
                        $('[name=cliente_bairro]').val(response.cliente_bairro);
                        $('[name=cliente_cidade]').val(response.cliente_cidade);
                        $('[name=cliente_estado]').val(response.cliente_estado);


                    } else {


                        $('#cliente_cep').html(response.cliente_cep);

                    }

                },

                error: function (response) {

                    $('#cliente_cep').html(response.mensagem);

                }


            });



        });



    }
    
    var preenche_endereco_fornecedores = function () {


        $('[name=fornecedor_cep]').focusout(function () {
            
           

            var fornecedor_cep = $(this).val(); //recupera o valor do cep
            
//           alert(BASE_URL);


            $.ajax({

                type: 'post',
                url: BASE_URL + '/fornecedores/preenche_endereco_fornecedores',
                dataType: 'json',
                data: {fornecedor_cep: fornecedor_cep},
                beforeSend: function () {

                    //Definifir disables e pagar erros de validação

                    $('#fornecedor_cep').html('<i class="fas fa-cog fa-spin text-info"></i>&nbsp;Consultando o cep...'); // animando icone

                },
                success: function (response) {

                    if (response.erro === 0) {

                        //Limpando o texto
                        $('#fornecedor_cep').html('');


                        if (!response.fornecedor_endereco) {
                            $('[name=fornecedor_endereco]').addClass('bg-white text-dark');
                            $('[name=fornecedor_endereco]').prop('readonly', false);
                        }

                        if (!response.fornecedor_bairro) {
                            $('[name=fornecedor_bairro]').addClass('bg-white text-dark');
                            $('[name=fornecedor_bairro]').prop('readonly', false);
                        }



                        $('[name=fornecedor_endereco]').val(response.fornecedor_endereco);
                        $('[name=fornecedor_bairro]').val(response.fornecedor_bairro);
                        $('[name=fornecedor_cidade]').val(response.fornecedor_cidade);
                        $('[name=fornecedor_estado]').val(response.fornecedor_estado);


                    } else {


                        $('#fornecedor_cep').html(response.cliente_cep);

                    }

                },

                error: function (response) {

                    $('#fornecedor_cep').html(response.mensagem);

                }


            });



        });



    }
    
    var preenche_endereco_vendedores = function () {


        $('[name=vendedor_cep]').focusout(function () {
            
           

            var vendedor_cep = $(this).val(); //recupera o valor do cep
            
//           alert(BASE_URL);


            $.ajax({

                type: 'post',
                url: BASE_URL + '/vendedores/preenche_endereco_vendedores',
                dataType: 'json',
                data: {vendedor_cep: vendedor_cep},
                beforeSend: function () {

                    //Definifir disables e pagar erros de validação

                    $('#vendedor_cep').html('<i class="fas fa-cog fa-spin text-info"></i>&nbsp;Consultando o cep...'); // animando icone

                },
                success: function (response) {

                    if (response.erro === 0) {

                        //Limpando o texto
                        $('#vendedor_cep').html('');


                        if (!response.fornecedor_endereco) {
                            $('[name=vendedor_endereco]').addClass('bg-white text-dark');
                            $('[name=vendedor_endereco]').prop('readonly', false);
                        }

                        if (!response.fornecedor_bairro) {
                            $('[name=vendedor_bairro]').addClass('bg-white text-dark');
                            $('[name=vendedor_bairro]').prop('readonly', false);
                        }



                        $('[name=vendedor_endereco]').val(response.vendedor_endereco);
                        $('[name=vendedor_bairro]').val(response.vendedor_bairro);
                        $('[name=vendedor_cidade]').val(response.vendedor_cidade);
                        $('[name=vendedor_estado]').val(response.vendedor_estado);


                    } else {


                        $('#vendedor_cep').html(response.cliente_cep);

                    }

                },

                error: function (response) {

                    $('#vendedor_cep').html(response.mensagem);

                }


            });



        });



    }


    return {

        init: function () {

            
            preenche_endereco();
            preenche_endereco_fornecedores();
            preenche_endereco_vendedores();
            envia_imagem_usuario();

        }

    }




}(); //Inicializa ao carregar a view



jQuery(document).ready(function () {

    $(window).keydown(function (event) {


        if (event.keyCode == 13) {

            event.preventDefault();
            return false;

        }


    });

    App_usuarios.init();

});


