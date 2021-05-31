<?php
require_once 'dbconfig.php';
error_reporting(~E_ALL);

$arqexcel = "<meta charset='UTF-8'>";

$arqexcel .= "<table border='1'>";
$arqexcel .= "<thead>
    <tr>
      <th>DATA DE INCLUSÃO</th>
      <th>NOME</th>
      <th>PREÇO</th>
      <th>DESCONTO</th>
      <th>VALOR COM DESCONTO</th>
      <th>CATEGORIA</th>
      <th>DESCRIÇÃO</th>
      <th>STATUS</th>
      <th>COD REFERÊNCIA</th>
      <th>ALTURA</th>
      <th>PROFUNDIDADE</th>
      <th>LARGURA</th>
      <th>PESO</th>
      <th>COR 1</th>
      <th>COR 2</th>
      <th>COR 3</th>
      <th>COR 4</th>
      <th>COR 5</th>
    </tr>
  </thead>
  <tbody>";
$stmt = $DB_con->prepare("SELECT id,data_add,nome,price,category,descricao,status,desconto,valor_desconto,cod,altura,profu,largura,peso,cor1,cor2,cor3,cor4,cor5 FROM produtos ORDER BY id DESC");
$stmt->execute();
if ($stmt->rowCount() > 0) {
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    extract($row);

    $arqexcel .= "<tr>
      <td>$data_add</td>
      <td>$nome</td>
      <td>";
    if ($price == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $price;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($desconto == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $desconto;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($valor_desconto == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $valor_desconto;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($category == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $category;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($descricao == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $descricao;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($status == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $status;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($cod == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $cod;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($altura == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $altura;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($profu == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= "'$profu'";
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($largura == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $largura;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($peso == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $peso;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($cor1 == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $cor1;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($cor2 == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $cor2;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($cor3 == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $cor3;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($cor4 == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $cor4;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "<td>";
    if ($cor5 == null or '') {
      $arqexcel .= "NÃO INFORMADO";
    } else {
      $arqexcel .= $cor5;
    }
    $arqexcel .= "</td>";
    $arqexcel .= "</tr>";
  }
}
$arqexcel .= "</tbody>
  </table>";

header("Content-Type: application/xls");
header("Content-Disposition:attachment; filename = relatorio-excel-produtos.xls");

echo $arqexcel;
