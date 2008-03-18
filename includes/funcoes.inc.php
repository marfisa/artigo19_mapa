<?php

  /* Queries */
 	$sqlGetEstados = "SELECT * FROM `ipso_uf` ORDER BY `nome`;";

	$sqlGetMunicipiosByCodUf =
		"SELECT
      `ipso_municipio`.*
    FROM
      `ipso_municipio`
    INNER JOIN
      `radios_comunitarias` ON `radios_comunitarias`.cod_municipio = `ipso_municipio`.codigo
    INNER JOIN
      `ipso_uf` ON  `ipso_uf`.id_uf = `ipso_municipio`.id_uf
    WHERE
      `ipso_uf`.`uf` = '%s'
    AND
      `radios_comunitarias`.visivel = 1
    GROUP BY
      `ipso_municipio`.codigo
    ORDER BY
      `ipso_municipio`.`nome`";

  $sqlGetProjetos = "SELECT * FROM `projetos` WHERE `VISIVEL` = 1 ORDER BY `NOME`";

  $sqlGetPopulacaoEstados =
    "SELECT
      u.uf,
      SUM(m.populacao) as populacao
    FROM
      ipso_municipio m,
      ipso_uf u
    WHERE
      m.id_uf = u.id_uf
    GROUP BY
      m.id_uf
    ORDER BY
      u.uf";

  $sqlGetTelecentrosEstados =
    "SELECT
      u.uf,
      COUNT(*) as radios
    FROM
      `radios_comunitarias` t
    INNER JOIN
      `ipso_municipio` m ON t.`COD_MUNICIPIO` = m.codigo
    INNER JOIN
      `ipso_uf` u ON m.`id_uf` = u.id_uf
    WHERE
      `VISIVEL` = 1
    GROUP BY
      m.id_uf
    ORDER BY
      u.uf";
