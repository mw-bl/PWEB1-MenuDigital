<div align="center">
<img width="300" src="https://github.com/user-attachments/assets/38a0c9d1-41cd-474d-81b8-258bbb68a710">
</div>

# GoMenu

## Para rodar o projeto, siga esses passos:

### 1. Depois do clone, abra a pasta do projeto no terminal ou ferramenta de sua escolha e execute os comandos:

```
composer self-update
```
```
composer install
```

### 2. Faça uma cópia do arquivo ``.env.example``, e renomeie essa cópia para ``.env`` e ajuste as configurações do bano de dados.

### 3. Para executar as migrations, execute no terminal:
```
php artisan migrate
```

### 4. Para gerar a chave da aplicação, execute no terminal:
```
php artisan key:generate
```

### 5. Para iniciar o serviço da aplicação 
```
php artisan serve
```
