DELIMITER //

CREATE PROCEDURE Adaugare_interventii(
    IN p_cnp CHAR(13),
    IN p_descriere VARCHAR(60),
    IN p_data_interventie DATE,
    IN p_id_medic INT,
    IN p_timp_reactie INT
)
BEGIN    
    DECLARE v_an_curent INT DEFAULT YEAR(CURDATE());
    DECLARE nr_interventii INT DEFAULT 0;
    DECLARE p_cost DECIMAL(6,2); 

    SELECT COUNT(id) 
    INTO nr_interventii 
    FROM interventii 
    WHERE YEAR(data) = v_an_curent AND cnp = p_cnp;

    IF nr_interventii = 0 THEN 
        SET p_cost = 0.0;
    ELSEIF p_timp_reactie < 600 THEN 
        SET p_cost = 50.00; 
    ELSE 
        SET p_cost = 30.00;
    END IF;

    -- Inserarea interventiei
    INSERT INTO interventii (cnp, descriere, data, id_medic, timp_reactie, cost)
    VALUES (p_cnp, p_descriere, p_data_interventie, p_id_medic, p_timp_reactie, p_cost);
    
END //

DELIMITER ;

DELIMITER //

CREATE TRIGGER ActualizareCost
AFTER INSERT ON interventii
FOR EACH ROW
BEGIN
    UPDATE pacienti
    SET cost_total = cost_total + NEW.cost
    WHERE cnp = NEW.cnp;
END //

DELIMITER ;