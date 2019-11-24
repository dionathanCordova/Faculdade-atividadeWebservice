<?php 
require "includes/header.php";
?>
<!-- Banner -->
<section class="banner">
	<article>
		<img src="images/slide01.jpg" alt="" />
		<div class="inner">
			<header>
				<p>Atividade pratica 1 API<a href="https://templated.co"></a></p>
				<h3>WEBSERVICE</h3>
			</header>
		</div>
	</article>
	<article>
		<img src="images/slide02.jpg" alt="" />
		<div class="inner">
			<header>
				<p>Cadastre os filmes</p>
				<h3>Create</h3>
			</header>
		</div>
	</article>
	<article>
		<img src="images/slide03.jpg"  alt="" />
		<div class="inner">
			<header>
				<p>Retorne filmes gerais ou por id</p>
				<h3>Read</h3>
			</header>
		</div>
	</article>
	<article>
		<img src="images/slide04.jpg"  alt="" />
		<div class="inner">
			<header>
				<p>Altere dados de um filme</p>
				<h3>Update</h3>
			</header>
		</div>
	</article>
	<article>
		<img src="images/slide05.jpg"  alt="" />
		<div class="inner">
			<header>
				<p>Remova um filme</p>
				<h3>Delete</h3>
			</header>
		</div>
	</article>
</section>

<!-- One -->
<section id="one" class="wrapper style2">
	<div class="inner">
		<div class="grid-style filmes">

		</div>
	</div>
</section>
			
<?php
require 'includes/footer.php';
?>
<script>
	$(document).ready(function() {     
		const url = "http://localhost:8080/Api/getFilmes"; 
		fetch(url) // https://cors-anywhere.herokuapp.com/https://example.com
		.then(response => response.text())
		.then(contents => {
			let obj = JSON.parse(contents);
			let html = '';
			for (let index = 0; index < obj.length; index++) {
				// width:"300vmin"; border:"1px solid silver"; display: inline-block; text-align: "center"; margin: "2vmin"; word-wrap: break-word;
				html +=  
				'<div class="col-sm-3 boxunitaria">' +
					'<div class="box">'+
						'<div class="image fit">'+
							'<img src="' + obj[index].poster + '" style="max-height= 80%" alt="" />'+
						'</div>'+
						'<div class="content">'+
							'<header class="align-center">'+
								'<p>Gênero <strong>' + obj[index].genero + '</strong></p>'+
								'<h2>' + obj[index].titulo + '</h2>'+
							'</header>'+
							'<p>' + obj[index].sinopse + '</p>'+
							'<footer class="align-center">'+
								'<a href="update.php?id='+obj[index].id + '" class="button infoFIlme" alt">Informações</a>'+
							'</footer>'+
						'</div>'+
					'</div>'+
				'</div>';
			}
			$('.filmes').html(html);
			console.log(html);
		})
		.catch(() => console.log("Can’t access " + url + " response. Blocked by browser?"))
	})
</script>



		
