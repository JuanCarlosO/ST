ALTER TABLE bienes ADD FOREIGN KEY (marca_id) REFERENCES marcas(id);
ALTER TABLE bienes ADD FOREIGN KEY (grupo_id) REFERENCES grupos(id);
ALTER TABLE bienes ADD FOREIGN KEY (tipo_id) REFERENCES t_bienes(id);
ALTER TABLE bienes ADD FOREIGN KEY (color_id) REFERENCES color(id);
ALTER TABLE bienes ADD FOREIGN KEY (material_id) REFERENCES materiales(id);
ALTER TABLE bienes ADD FOREIGN KEY (modelo_id) REFERENCES modelos(id);