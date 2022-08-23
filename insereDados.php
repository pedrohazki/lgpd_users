<?php

//--- cifrando CPF com md5 ---
$cpf = md5('41145544400');

//--- cifrando número com  AES ---
$numero = "madruga";
$algoritmo = "AES-256-CBC";
$chave = "123456";
$iv = "wNYtCnelXfOa6uiJ";
$aes_cifrado = openssl_encrypt($numero, $algoritmo, $chave, OPENSSL_RAW_DATA, $iv);
$numero_cifrado = base64_encode($aes_cifrado);

//--- cifrando imagem com md5 ---
$imagem = md5('/img/imagem.png');

//--- cifrando senha com Bcrypt ---
$senha = "madruga";
$options = ['cost' => 8];
$hash = password_hash($senha,  PASSWORD_BCRYPT, $options);

//--- cifrando codigo com md5 ---
$codigo = md5('333');

try {
  $username = "lgpd_users";
  $password = "lgpd_users";
  $pdo = new PDO('mysql:host=localhost;dbname=lgpd_users', $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $stmt = $pdo->prepare('INSERT INTO usuarios ( nome, sobrenome, cpf, cep, numero, complemento, imagem, senha, cartao, codigo) '
    . 'VALUES(:nome, :sobrenome, :cpf, :cep, :numero, :complemento, :imagem, :senha, :cartao, :codigo)');
  $stmt->execute(array(
    ':nome' => 'Marcos',
    ':sobrenome' => 'Rosa',
    ':cpf' => $cpf,
    ':cep' => '12209390',
    ':numero' => $numero_cifrado,
    ':complemento' => 'perto do espetinho',
    ':imagem' => $imagem,
    ':senha' => $hash,
    ':cartao' => '123456321654',
    ':codigo' => $codigo,
  ));
  echo "Inserido com sucesso";
} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
