INSERT INTO lanche VALUES (null, 'X-Salada', 5.30);
INSERT INTO lanche VALUES (null, 'Americano', 6.05);
INSERT INTO lanche VALUES (null, 'X-Bacon', 7.10);
INSERT INTO lanche VALUES (null, 'X-Frango', 7.00);
INSERT INTO lanche VALUES (null, 'X-Filé', 8.00);
INSERT INTO lanche VALUES (null, 'X-Tudo', 9.00);
INSERT INTO lanche VALUES (null, 'X-Calabresa', 6.25);
INSERT INTO lanche VALUES (null, 'Filé com bacon', 8.00);
INSERT INTO lanche VALUES (null, 'X-Paulista', 7.00);
INSERT INTO lanche VALUES (null, 'Bauru', 4.15);
INSERT INTO lanche VALUES (null, 'Misto Quente', 4.00);

INSERT INTO ingrediente VALUES (null, 'Pão');
INSERT INTO ingrediente VALUES (null, 'Hamburguer');
INSERT INTO ingrediente VALUES (null, 'Presunto');
INSERT INTO ingrediente VALUES (null, 'Mussarela');
INSERT INTO ingrediente VALUES (null, 'Alface');
INSERT INTO ingrediente VALUES (null, 'Tomate');
INSERT INTO ingrediente VALUES (null, 'Maionese');
INSERT INTO ingrediente VALUES (null, 'Ovo');
INSERT INTO ingrediente VALUES (null, 'Bacon');
INSERT INTO ingrediente VALUES (null, 'Frango');
INSERT INTO ingrediente VALUES (null, 'Catupiry');
INSERT INTO ingrediente VALUES (null, 'Milho');
INSERT INTO ingrediente VALUES (null, 'Filé');
INSERT INTO ingrediente VALUES (null, 'Calabresa');
INSERT INTO ingrediente VALUES (null, 'Ervilha');

INSERT INTO lanche_tem_ingrediente(id_lanche, id_ingrediente) VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(2,1),(2,2),(2,4),(2,8),(2,3),(2,6),(2,7),(3,1),(3,2),(3,9),(3,3),(3,4),(3,6),(3,7),(4,1),(4,4),(4,10),(4,11),(4,12),(5,1),(5,13),(5,3),(5,4),(5,6),(5,7),(6,1),(6,2),(6,10),(6,8),(6,9),(6,4),(6,14),(6,6),(6,7),(7,1),(7,14),(7,4),(7,6),(7,7),(8,1),(8,13),(8,9),(8,4),(8,6),(8,7),(9,1),(9,4),(9,10),(9,15),(9,12),(10,1),(10,3),(10,4),(10,6),(10,7),(11,1),(11,7),(11,3),(11,4);