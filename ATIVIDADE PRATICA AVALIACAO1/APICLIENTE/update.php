<?php
require_once "includes/header.php";
?>
<!-- One -->
<section id="One" class="wrapper style3">
	<div class="inner">
		<header class="align-center">
			<p>Cadastre filmes</p>
			<h2>Create</h2>
		</header>
	</div>
</section>

<!-- Two -->
	<section id="two" class="wrapper style2">
		<div class="inner">
			<div class="box">
				<div class="content">
					<header class="align-center">
						<p>Informe os dados do form para o cadastro</p>
						<h2>Todos required</h2>
					</header>

					<form method="post" action="#">
						<div class="row uniform">
							<div class="6u 12u$(xsmall)">
								<input type="text" name="titulo" id="titulo" value="" placeholder="Titulo" />
							</div>
							<div class="6u$ 12u$(xsmall)">
								<input type="text" name="genero" id="genero" value="" placeholder="Gênero" />
							</div>
							<div class="12u$">
								<input type="text" name="poster" id="poster" value="" placeholder="Url do poster ex: http://google.filme.jpg" />
							</div>
							<div class="12u$">
								<textarea name="sinopse" id="sinopse" placeholder="Sinopse abreviada" rows="2"></textarea>
							</div>
							<div class="12u$">
								<textarea name="sinopseFull" id="sinopseFull" placeholder="Sinopse Completa" rows="5"></textarea>
							</div>
							<!-- Break -->
							<div class="12u$">
								<ul class="actions">
									<li><input type="button" class='btnSubmit' value="Cadastrar" /></li>
									<li><input type="button"  class='btnDelete btn btn-danger' value="Deletar" class="alt" /></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
<?php
require 'includes/footer.php';
?>
	<script>
    $(document).ready(function() {     
        const filme_id = <?php echo $_GET['id']?>;
        const url = "http://localhost:8080/Api/getFilmesByid?filme_id=" + filme_id; 

        $.ajax({
            type: "GET",
            url: url,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(result) {
                console.log(result[0]);
                $('#genero').val(result[0].genero);
                $('#poster').val(result[0].poster);
                $('#titulo').val(result[0].titulo);
                $('#sinopse').val(result[0].sinopse);
                $('#sinopseFull').val(result[0].sinopseFull);

            }
        });

        $('.btnSubmit').click(function() {
            const url = "http://localhost:8080/Api/updatefilmes"; 
            let formData = new FormData();
            formData.append('filme_id', filme_id);
            formData.append('genero', $('#genero').val());
            formData.append('poster', $('#poster').val());
            formData.append('titulo', $('#titulo').val());
            formData.append('sinopse', $('#sinopse').val());
            formData.append('sinopseFull', $('#sinopseFull').val());

            fetch(url, {
                method: 'POST',
                body: formData
            }) 
            .then(response => response.text())
            .then(contents => {
                let obj = JSON.parse(contents);
                if(obj.status == 200) {
                    window.location = 'http://localhost:8081/index.php';
                }
            })
            .catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))

        })

        $('.btnDelete').click(function() {
            const url = "http://localhost:8080/Api/deleteFilme/" + filme_id; 
            $.ajax({
                type: "DELETE",
                url: url,
                dataType: "json",
                success: function(result) {
					console.log(result);
                    if(result.status == 200) {
                         window.location = 'http://localhost:8081/index.php';
                    }
                }
            });
        })
    })
</script>
