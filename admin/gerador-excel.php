<?php
require_once 'dbconfig.php';
error_reporting(~E_ALL);

$arqexcel = "<meta charset='UTF-8'>";

$arqexcel .= "<table border='1'>";
$arqexcel .= "<thead>
    <tr>
      <th>NOME</th>
      <th>DATA NASCIMENTO</th>
      <th>CPF/CNPJ</th>
      <th>EMAIL</th>
      <th>ENDEREÇO</th>
      <th>WHATS</th>
      <th>TELEFONE 2</th>
      <th>TIPO</th>
      <th>NÚMERO DE INSCRIÇÃO</th>
    </tr>
  </thead>
  <tbody>";
$stmt = $DB_con->prepare("SELECT id,nome,cpf_cnpj,email,endereco,whats,telefone2,tipo,data_nascimento,id_estadual FROM clientes ORDER BY id DESC");
$stmt->execute();
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $arqexcel .= "<tr>
      <td>$nome</td>
      <td>";
      if ($data_nascimento == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $data_nascimento;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($cpf_cnpj == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $cpf_cnpj;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($email == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $email;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($endereco == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $endereco;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($whats == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $whats;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($telefone2 == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $telefone2;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($tipo == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $tipo;
      }
      $arqexcel .="</td>";
      $arqexcel .= "<td>";
      if ($id_estadual == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= "'$id_estadual'";
      }
      $arqexcel .="</td>";
      $arqexcel .="</tr>";
  }
}
$arqexcel .= "</tbody>
  </table>";

header("Content-Type: application/xls");
header("Content-Disposition:attachment; filename = relatorio-excel.xls");

echo $arqexcel;