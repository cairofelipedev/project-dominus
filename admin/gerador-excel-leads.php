<?php
require_once 'dbconfig.php';
error_reporting(~E_ALL);

$arqexcel = "<meta charset='UTF-8'>";

$arqexcel .= "<table border='1'>";
$arqexcel .= "<thead>
    <tr>
      <th>DATA NASCIMENTO</th>
      <th>NOME</th>
      <th>EMAIL</th>
      <th>WHATS</th>
      <th>TIPO</th>
    </tr>
  </thead>
  <tbody>";
$stmt = $DB_con->prepare("SELECT id,nome,data_envio,email,whats,tipo FROM forms ORDER BY id DESC");
$stmt->execute();
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $arqexcel .= "<tr>
      <td>$data_envio</td>
      <td>$nome</td>
      <td>";
      if ($email == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $email;
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
      if ($tipo == null or '') {
        $arqexcel .= "NÃO INFORMADO";
      } else {
        $arqexcel .= $tipo;
      }
      $arqexcel .="</td>";
      $arqexcel .="</tr>";
  }
}
$arqexcel .= "</tbody>
  </table>";

header("Content-Type: application/xls");
header("Content-Disposition:attachment; filename = relatorio-excel-leads.xls");

echo $arqexcel;