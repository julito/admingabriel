DELIMITER //

CREATE PROCEDURE estadisticas(IN fecha_inicio DATETIME, IN fecha_fin DATETIME, IN nombre_hotel VARCHAR(100))
BEGIN
    SELECT
        `hotel`,
        `origen`,
        GROUP_CONCAT(`dia` SEPARATOR ', ') AS dias,
        GROUP_CONCAT(`total_por_dia` SEPARATOR ', ') AS totales
    FROM (
        SELECT
            `hotel`,
            `origen`,
            DATE_FORMAT(`fecha`, '%e') AS `dia`,
            SUM(1) AS `total_por_dia`
        FROM
            `bitacora`
        WHERE
            (`fecha` >= fecha_inicio AND `fecha` <= DATE_ADD(fecha_fin, INTERVAL 1 DAY))
            AND `hotel` LIKE CONCAT('%', nombre_hotel, '%')
        GROUP BY
            `hotel`,
            `origen`,
            `dia`
        ORDER BY
            `dia` ASC  -- Ordenar los días ascendente
    ) AS subconsulta
    GROUP BY
        `hotel`,
        `origen`
    ORDER BY
        `hotel`,
        `origen`;
END //
DELIMITER ;
