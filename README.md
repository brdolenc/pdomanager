# PDO Manager 

PDO manager é uma classe PHP que utiliza o módulo PDO para se comunicar com o banco de dados ralacional mysql. A classe disponibiliza o CRUD completo com todos os seus parâmetros necessários, condições, limites, ordenações, agrupamentos e contagem


## Usando a classe

Para utilizar inclua o arquivo e instancie a classe com os parâmetros de conexão

```bash
require_once('pdomanager.class.php');
$pdo = new PDO_Manager('localhost','database','user','pass');
```

## Métodos

#### table

######parâmetros:
- **tabela**  
- descrição: nome da tabela que será utilizada
- tipo : string

```bash
->table('tabela')
```

#### parameter

######parâmetros:
- **array**  
- descrição: array com o nome da coluna e o valor 
- tipo : array

```bash
->parameter(array)

ex:

$fields = array();
$fields['nome'] = 'Meu nome';
$fields['email'] = 'email@email.com';
```

#### condition

######parâmetros:
- **coluna**  
- descrição: nome da coluna 
- tipo : string
- **operador**  
- descrição: operador de comparação 
- value: : = , > , < , => , <= , like , in , not exist 
- tipo : string
- **valor**  
- descrição: valor a ser comparado
- tipo : array
- **junção**  
- descrição: junção, só é usado a partir da segunda condição
- value : AND , OR
- tipo : string
- opcional : não é permitido usar na primeira condição, e obrigatório das demais

```bash
->condition('coluna', 'operador', 'valor', 'junção')

ex:

->condition('coluna', 'like', '%valor%')
->condition('coluna', 'in', '(valor, valor)', 'AND')
```

#### groupby

######parâmetros:
- **coluna**  
- descrição: nome da coluna que será agrupada
- tipo : string

```bash
->groupby('coluna')
```

#### orderby

######parâmetros:
- **coluna**  
- descrição: nome da coluna que será ordenada
- tipo : string
- **ordenação**  
- descrição: ordenção ( ASC, DESC )
- tipo : string

```bash
->orderby('coluna', 'ordenação')
```

#### limit

######parâmetros:
- **inicial**  
- descrição: valor inicial
- tipo : int
- **final**  
- descrição: valor final, obs:sempre maior que o inicial
- tipo : int

```bash
->limit('inicial', 'final')
```

#### ready

######parâmetros:
- **colunas**  
- descrição: colunas que serão retornadas
- value : * , nome das colunas, obs: pode ser usado códigos sql ex: MAX(coluna) ou count(*)
- tipo : string
- **echo**  
- descrição: visualizar a query gerada para debugar
- value : echo, false
- tipo : string
- opcional : opcional

######retorno:
- descrição: objeto contendo todos as linhas selecionadas
- tipo : object

###### dependência:
é obrigatório o uso dos métodos 
- table()

```bash
->ready('colunas', 'echo')
```

#### insert

######retorno:
- descrição: último id cadastrado
- tipo : int

###### dependência:
é obrigatório o uso dos métodos 
- table()
- parameter()

```bash
->insert()
```

#### update

######retorno:
- descrição: retorna true ou false
- tipo : boolean

###### dependência:
é obrigatório o uso dos métodos 
- table()
- parameter()
- condition()

```bash
->update()
```

#### delete

######retorno:
- descrição: retorna true ou false
- tipo : boolean

###### dependência:
é obrigatório o uso dos métodos 
- table()
- condition()

```bash
->delete()
```


#### count

Método para contar os resultados do método ready, obs: esse método não pode ser encadeado

```bash
->count()
```


#### sqlquery

######parâmetros:
- **codigo**  
- descrição: código sql, obs: essa função não contém segurança anti-injection
- tipo : string

```bash
->sqlquery('codigo')
```

#### countquery

Método para contar os resultados do método sqlquery, obs: esse método não pode ser encadeado

```bash
->count()
```


#### close

Esse método é obrigatória após os métodos de CRUD

```bash
->close()
```


## Exemplos de uso


#### ready

```bash
$retorno = $pdo->table("users")
		   	   ->condition("id", "=", 1)
		   	   ->condition("name", "like", '%bruno%' , "OR")
		   	   ->limit(0,100)
		   	   ->orderby('id','ASC')
		   	   ->orderby('name','DESC')
		   	   ->groupby('id')
		   	   ->ready('*', 'echo');

var_dump($retorno);
echo $pdo->count();
```


#### insert

```bash

$fields = array();
$fields['nome'] = 'Meu nome';
$fields['email'] = 'email@email.com';

$retorno = $pdo->table("users")
			   ->parameter($fields)
		   	   ->insert();

echo $retorno;
```


#### update

```bash

$fields = array();
$fields['nome'] = 'Meu nome novo';
$fields['email'] = 'email_novo@email.com';

$retorno = $pdo->table("users")
			   ->parameter($fields)
			   ->condition("id", "=", 1)
		   	   ->update();

echo $retorno;
```


#### delete

```bash
$retorno = $pdo->table("users")
			   ->condition("id", "=", 1)
		   	   ->delete();

echo $retorno;
```


#### query

```bash
$retorno = $pdo->query("SELECT * FROM coluna WHERE id = 1");

var_dump($retorno);
echo $pdo->countquery();
```

