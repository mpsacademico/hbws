Hummm Burgueria Web Service
=======================

HBWS é um sistema para uma rede de lanchonetes fictícia.  
Este é um projeto universitário da disciplina de **Sistemas Distribuídos**.

Como usar este Web Service?
------------

##### Requisições via POST

1. Registrar um novo pedido

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto "novo" | Ação para criar um novo pedido
2 |  | apelido-cliente | Texto | Apelido do cliente que poderá ser impresso na embalagem da mercadoria

2. Finalizar um pedido aberto

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto “finalizar” | Ação para finalizar um pedido aberto
2 | X | codigo | Inteiro | Código do pedido que será finalizado 

3. Cancelar um pedido aberto

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto “cancelar” | Ação para cancelar um pedido aberto
2 | X | codigo | Inteiro | Código do pedido que será cancelado

4. Adicionar mercadorias a um pedido específico

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto “adicionar” | Ação para adicionar mercadorias a um pedido
2 | X | codigo-pedido | Inteiro | Código do pedido que irá receber mercadorias 
3 | X | mercadorias | JSON | Documento com as mercadorias e quantidades

Exemplo de retorno JSON para mercadorias:
```javascript
{
{
categoria: “<texto>”,
id-mercadoria: <inteiro>,
quantidade: <inteiro>
}
}
```

##### Requisições via GET

1. Obter todas as informações das mercadorias de uma categoria

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
01 | X | categoria | texto |	Categoria de Mercadorias

2. Obter informações sobre uma mercadoria específica

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | categoria | Texto | Categoria da mercadoria
2 | X | codigo | Inteiro | Identificador único da mercadoria

OBS: Disponibilidade atual apenas para categoria “lanche”
