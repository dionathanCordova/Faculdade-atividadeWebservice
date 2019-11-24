<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="<?php echo base_url('Assets/js/library/jquery.js')?>"></script>
    <script src="<?php echo base_url('/Assets/js/bootstrap.min.js')?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('Assets/css/bootstrap.min.css')?>">
</head>
<body>

    <div class='container'>
        <H1>Json da Api TESTE</H1>
        <p>O primeiro passo é você salvar o conteúdo do JSON em um arquivo com o nome answer.json, que irá usar no restante do desafio.</p>

        <div id="demo">
        
        </div>

        <div class='col-sm-8'>            
            <div class='col-sm-4'>
                <button type="button" onclick="loadXMLDoc()">Receber dados GET</button><br>
            </div>

            <div class='col-sm-4'>
                <button type="button" onclick="pegaJson()">Receber Dados JSON</button><br>
            </div>

            <div class='col-sm-4'>          
                <button type="button" onclick="loadXMLDocPost()">Dados Post</button><br>
            </div>
        </div>
        <br><br> <br><br>

        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">Panel Heading</div>
                <div class="panel-body">
                    <form action="" method="POST">
                        <!-- <div class="form-group">
                            <label for="email">Nome:</label>
                            <input type="email" class="form-control" id="nome" placeholder="Enter email" name="nome">
                        </div> -->
                        <div class="form-group">
                            <label for="email">PERSONAL ID:</label>
                            <input type="text" class="form-control" id="id_usuario" placeholder="PERSONAL ID" name="id_usuario">
                        </div>
                        <!-- <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="senha" placeholder="Enter password" name="senha">
                        </div>
                        <div class="form-group">
                            <label for="pwd">dataNascimento:</label>
                            <input type="password" class="form-control" id="dataNascimento" value='2019-02-02' placeholder="Enter password" name="dataNascimento">
                        </div>
                        <div class="form-group">
                            <label for="pwd">sexo:</label>
                            <input type="password" class="form-control" id="sexo" placeholder="Enter password" name="sexo">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="senha" placeholder="Enter password" name="senha">
                        </div>
                        <div class="form-group">
                            <label for="pwd">personal_id:</label>
                            <input type="password" class="form-control" id="personal_id" placeholder="Enter password" name="personal_id">
                        </div> -->

                        <button type="button" class="btn btn-success">Submit</button>
                    </form>   
                </div>
                <div class="panel-body">
                    <p id='response'></p>
                </div>
            </div>
        </div>                      
    </div>
   <script>
        $(".btn").click(function (e) {
            

            let id_usuario = $('#id_usuario').val();
            // let senha = $('#senha').val();

            $.ajax({
                url: 'https://wspersonalapp.herokuapp.com/api/setStatus',
                type: 'POST',
                data: {id_usuario : id_usuario},
                dataType: "json",
                success: function (response) {
                    $('#response').html('response: ' + response)
                    // alert('Mensagem: ' + response.msg);
                    // alert('id: ' + response.userData[0].id);
                    // document.location.href = 'https://wspersonalapp.herokuapp.com/createUser';
                },
                fail: function() {
                    alert("Servidor em baixo ou falha de rede");
                }
            });
        });

        
   </script>
</body>
</html>