<?php
	require_once 'includes/common.php';
	require_once 'includes/database.php';

	$error = FALSE;
	if(isset($_SESSION['is_logged']) && $_SESSION['is_logged']){
		header("Location:" . BASE_URL . "webcam.php");
		exit();
	}

	// Form was submitted 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$nome = $_POST['nome'];
		$crm = $_POST['crm'];
		$email = $_POST['email'];
        $uf = $_POST['uf'];
        if(isset($_POST['autoriza']))
        {
            $autoriza = "SIM";
        }
        else
        {
            $autoriza = "NAO";
        }
		// Insert user data into the database
		$sql = "INSERT INTO cadastro_webcam (nome, email, crm, uf, autoriza) VALUES ('{$nome}', '{$email}', '{$crm}', '{$uf}', '{$autoriza}')";
		if ($conn->query($sql) === TRUE) {
			// Set session data
			$_SESSION['user_id'] = $conn->insert_id;
			$_SESSION['nome'] = $_POST['nome'];
			$_SESSION['crm'] = $_POST['crm'];
			$_SESSION['email'] = $_POST['email'];
			$_SESSION['autoriza'] = $autoriza;
            $_SESSION['uf'] = $uf;
			$_SESSION['is_logged'] = TRUE;

			// Redirect
			header("Location:" . BASE_URL . "webcam.php");
			exit();
		} else {
			// Store error msg
			$error = $conn->error;
		}
	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cadastro</title>
	<link rel="stylesheet" href="css/bulma.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Epilogue:wght@400;700;800&display=swap" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>
 <style>
     html {
         overflow: hidden;
     }
     </style>
</head>
<body>
<nav class="navbar">
  
  <img src="img/logo.png" width="460" height="400" alt="Viatris logo">

</nav>
<section class="form" style="max-width:50%">
            <div class="container">
                <div class="columns is-centered">
                    <div class="column is-half" style="width:100%">
                        <h1 class="title has-text-centered">Faça seu cadastro e receba sua foto por email!</h1>
						
						<?php if($error): ?>
							<div class="notification is-danger">
								<p>Ocorreu um erro ao cadastrar o usuário.</p>
								<?php print_r($error); ?>
							</div>
						<?php endif; ?>

                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <div class="field">
                                <label class="label" color="#363636" for="nome">Nome *</label>
                                <div class="control">
                                    <input id="nome" name="nome" class="input" type="text" placeholder="Seu nome" maxlength="30" required />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" color="#363636" for="email">Email *</label>
                                <div class="control">
                                    <input id="email" name="email" class="input" type="email" placeholder="Seu email" required />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" color="#363636" for="crm">CRM *</label>
                                <div class="control">
                                    <input id="crm" name="crm" class="input" type="text" placeholder="Seu CRM" required />
                                </div>
                            </div>

                            <div class="field">
                                <label class="label" color="#363636" for="crm">UF *</label>
                                <select class="uf" name="uf" id="uf" required >
                                <option value="">Selecione</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>

                        <br />

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkConfirmo" name="confirmo" required />
                                <label class="title" style="font-size: 110%; color: #363636" for="checkConfirmo">
                                     *Confirmo que sou um (a) profissional da saúde que exerce essa função no Brasil.
                                </label>
                            </div>
                            <br />

                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="checkAutorizo" name="autoriza" value="SIM" />
                                <label class="title" style="font-size: 110%; color: #363636" for="checkAutorizo">
                                Aceito receber por e-mail informações sobre produtos, marcas e serviços oferecidos
                                pela Viatris e empresas coligadas.
                                </label>
                            </div>

                            <br />
                            <div class="field is-grouped" style="justify-content: center;">
                                <div class="control">
                                    <input value="CONFIRMAR" type="submit" class="button" style="color:#703e97"/>
                                </div>
                            </div>
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                            <br />
                        </form>
                    </div>
                </div>
            </div>
</div>

        </section>
</body>
</html>