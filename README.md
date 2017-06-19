# Hummm Burgueria Web Service

HBWS é um protótipo de sistema para uma rede de lanchonetes fictícia denominada Hummm Burgueria.  
O objetivo é integrar e automatizar o sistema administrativo e de suplementos das unidades da rede.  
Este foi um projeto universitário da disciplina de Sistemas Distribuídos.

## Como usar este Web Service?

### Requisições via POST

#### 1. Registrar um novo pedido

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto "novo" | Ação para criar um novo pedido
2 |  | apelido-cliente | Texto | Apelido do cliente que poderá ser impresso na embalagem da mercadoria

```
acao=novo&apelido-cliente=marcos
```

#### 2. Finalizar um pedido aberto

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto “finalizar” | Ação para finalizar um pedido aberto
2 | X | codigo | Inteiro | Código do pedido que será finalizado 

```
acao=finalizar&codigo=1
```

#### 3. Cancelar um pedido aberto

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto “cancelar” | Ação para cancelar um pedido aberto
2 | X | codigo | Inteiro | Código do pedido que será cancelado

```
acao=cancelar&codigo=1
```

#### 4. Adicionar mercadorias a um pedido específico

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | acao | Texto “adicionar” | Ação para adicionar mercadorias a um pedido
2 | X | codigo-pedido | Inteiro | Código do pedido que irá receber mercadorias 
3 | X | mercadorias | JSON | Documento com as mercadorias e quantidades

```
acao=adicionar&codigo-pedido=1&mercadoria={"categoria":"lanches","id-mercadoria":1:"Misto Quentes"}
```

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

### Requisições via GET

#### 1. Obter todas as informações das mercadorias de uma categoria

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
01 | X | categoria | texto |	Categoria de Mercadorias

```
index.php?categoria=lanche
```

#### 2. Obter informações sobre uma mercadoria específica

ID | O | Parâmetro | Tipo | Descrição
:---: | :---: | :---: | :---: | :---
1 | X | categoria | Texto | Categoria da mercadoria
2 | X | codigo | Inteiro | Identificador único da mercadoria

```
index.php?categoria=lanche&codigo=1
```

```javascript
{
  id_lanche: 1,
  nome_lanche: "X-Salada",
  preco_unitario: 5.3,
  ingredientes: [
    {
      id_ingrediente: 1,
      nome: "Pão"
    },
    {
      id_ingrediente: 2,
      nome: "Hamburguer"
    },
    {
      id_ingrediente: 3,
      nome: "Presunto"
    },
    {
      id_ingrediente: 4,
      nome: "Mussarela"
    },
    {
      id_ingrediente: 5,
      nome: "Alface"
    },
    {
      id_ingrediente: 6,
      nome: "Tomate"
    },
    {
      id_ingrediente: 7,
      nome: "Maionese"
    }
  ]
}
```

OBS: Disponibilidade atual apenas para categoria “lanche”.
