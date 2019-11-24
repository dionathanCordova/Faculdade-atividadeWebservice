<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Personal</title>
    <script src="<?php echo base_url('Assets/js/library/jquery.js')?>"></script>
    <script src="<?php echo base_url('/Assets/js/bootstrap.min.js')?>"></script>
    <link rel="stylesheet" href="<?php echo base_url('Assets/css/bootstrap.min.css')?>">
</head>
<body>

    <div class='container'>
        <H1>Json da Api</H1>
    
        <div class="container">
            <div class="panel panel-default">
                <div class="panel-heading">ADIOCIONAR PERSONAL</div>
                <div class="panel-body">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="email">Nome:</label>
                            <input type="text" class="form-control" id="nome" placeholder="Nome completo" name="nome">
                        </div>
                         <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input type="password" class="form-control" id="senha" placeholder="Enter password" name="senha">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Academia:</label>
                            <input type="text" class="form-control" id="academia" placeholder="Enter password" name="academia">
                        </div>
                        <div class="form-group">
                            <label for="pwd">PERSONAL:</label>
                            <input type="text" class="form-control" id="userstatus" placeholder="PERSONAL" value='personal' name="userstatus" disabled>
                        </div>
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
            

            let nome = $('#nome').val();
            let email = $('#email').val();
            let senha = $('#senha').val();
            let academia = $('#academia').val();
            let userstatus = $('#userstatus').val();

            $.ajax({
                url: 'https://wspersonalapp.herokuapp.com/api/createUser',
                type: 'POST',
                data: {nome : nome, email : email, senha : senha, academia : academia, userstatus: userstatus},
                dataType: "json",
                success: function (response) {
                    $('#response').html('response: ' + response.msg)
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