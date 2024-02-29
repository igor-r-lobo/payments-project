# Introdução
Este projeto foi criado em busca de conhecimento referente ao framework hyperf
# Processo

O projeto foi desenvolvido em container docker, para iniciar basta executar

```bash
docker compose up
```
Assim que o projeto subir deve-se rodar as migrations
```bash
docker container exec -it hyperf-skeleton php bin/hyperf.php migrate
```

# Api

As rotas disponíveis são

```bash
/users [POST][GET]
```

```bash
/transaction/deposit [POST]
```

```bash
/transaction/transfer [POST]
```

Para rodar os testes automatizados basta utilizar o seguinte comando

```bash
docker container exec -it hyperf-skeleton composer test
```

# payments-project
