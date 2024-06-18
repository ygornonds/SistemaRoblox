create database teste_estoque_kkkk;
use teste_estoque_kkkk;
show tables;

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL
);

ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

INSERT INTO `categoria` (`id`, `nome`) VALUES
(11, 'Informática'),
(12, 'Roupas'),
(13, 'Calçados'),
(14, 'Outros'),
(27, 'Eletrônico');

CREATE TABLE `produto` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `id_categoria` int(11) DEFAULT NULL
);

ALTER TABLE `produto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_categoria` (`id_categoria`);
  
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

INSERT INTO `produto` (`id`, `nome`, `quantidade`, `preco`, `id_categoria`) VALUES
(622, 'Mouse', 1, '1.00', 11),
(623, 'Teclado', 1, '1.00', 11),
(624, 'CPU', 1, '1.00', 11),
(625, 'Tênis', 1, '1.00', 13),
(626, 'Chinelo', 1, '1.00', 13),
(627, 'Outros', 1, '1.00', 14),
(628, 'TV', 1, '1.00', 27),
(629, 'uia', 1, '1.00', 14);

select * from categoria;
select * from produto;
	-- Join dos produtos e categorias
select p.nome, p.quantidade, p.preco, c.id, c.nome as categoria
from produto as p
join categoria as c on p.id_categoria = c.id;
	-- Join Group By
select p.nome, p.quantidade, p.preco, c.id, c.nome as categoria
from produto as p
join categoria as c on p.id_categoria = c.id
group by c.id;
	-- Join contando em grupo
select p.nome, p.quantidade, p.preco, count(c.id) as contIDcat, c.nome as categoria
from produto as p
join categoria as c on p.id_categoria = c.id
group by c.id order by contIDcat desc;
	-- Join só com a contagem e a categoria
select count(c.id) as contIDcat, c.nome as categoria
from produto as p
join categoria as c on p.id_categoria = c.id
group by c.id order by contIDcat desc;
	-- Join para pegar o maior valor da categoria
select count(c.id) as contIDcat
from produto as p
join categoria as c on p.id_categoria = c.id
group by c.id order by contIDcat desc limit 1;


	-- View para atalho
create view testeRelatorio as select count(c.id) as contIDcat, c.nome as categoria
from produto as p
join categoria as c on p.id_categoria = c.id
group by c.id order by contIDcat desc;
	--
select * from testeRelatorio;
	-- Relatório Final
select * from testeRelatorio where contIDcat = (
select count(c.id) as contIDcat
from produto as p
join categoria as c on p.id_categoria = c.id
group by c.id order by contIDcat desc limit 1);

